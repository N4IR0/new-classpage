<!-- comment -->
<?php
	$c = "/".mysql_real_escape_string($_GET['c']);
	$s = mysql_real_escape_string($_GET['s']);
	
	$sql = "SELECT * FROM category WHERE url='$c'";
	$result = mysql_query($sql);
	$c = mysql_fetch_assoc($result);
	
	$sql = "SELECT * FROM pages WHERE url='$s'";
	$result = mysql_query($sql);
	$s = mysql_fetch_assoc($result);

	if (isset($_POST["defaultGroup"])) {
		if ($_POST["defaultGroup"] == "none") {
			setcookie("group", "", time()-(3600*24*31*365));
		} elseif ($_POST["defaultGroup"] == "g1") {
			setcookie("group", "", time()-(3600*24*31*365));
			setcookie("group", "1", time()+(3600*24*31*365), "/");
		} elseif ($_POST["defaultGroup"] == "g2") {
			setcookie("group", "", time()-(3600*24*31*365));
			setcookie("group", "2", time()+(3600*24*31*365), "/");
		}
		if (!$_SERVER['HTTPS']) {
			$proto = "http";
		} else {
			$proto = "https";
		}
		header('Location: '.$proto.'://'.$_SERVER["SERVER_NAME"].$c["url"].'/'.$s["url"]);
	}
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<title><?php echo $CONFIG["website"]["title"]; ?></title>

	<!-- Font -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

	<!-- CSS -->
	<link href="/style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="/style/css/tipsy.css" rel="stylesheet" type="text/css" media="screen" />
	
	<!-- JavaScripts-->
	<script type="text/javascript" src="/style/js/jquery.js"></script>
	<script type="text/javascript" src="/style/js/jquery.form-validator.min.js"></script>
	<script type="text/javascript" src="/style/js/jNice.js"></script>
	<script type="text/javascript" src="/style/js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="/style/js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="/style/js/amcharts/serial.js"></script>
	<script type="text/javascript" src="/style/js/amcharts/amstock.js"></script>
	<script type="text/javascript" src="/style/js/own.js"></script>
</head>

<body>
	<div id="wrapper">
		<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
		<div id="topbar">
			<h1><a href="#"><?php echo $CONFIG["website"]["title"]; ?></a></h1>
			<span style="float: right; margin: 15px 5px 10px 0;">
				<form action="<?php echo $c["url"]."/".$s["url"]; ?>" name='groupChange' id='groupChangeForm' method="post">
					<select id="groupChangeSelect" name="defaultGroup">
						<?php
							$selected = array("none" => "", "g1" => "", "g2" => "");
							if (isset($_COOKIE["group"]) && $_COOKIE["group"] == 1) {
								$selected["g1"] = "selected";
							} elseif (isset($_COOKIE["group"]) && $_COOKIE["group"] == 2) {
								$selected["g2"] = "selected";
							} else {
								echo "<option value='none' ".$selected["none"].">Keine Gruppe</option>";
							}
							echo "<option value='g1' ".$selected["g1"].">Gruppe 1</option>";
							echo "<option value='g2' ".$selected["g2"].">Gruppe 2</option>";
						?>
					</select>
				</form>
			</span>
		</div>
		
		<!-- You can name the links with lowercase, they will be transformed to uppercase by CSS, we prefered to name them with uppercase to have the same effect with disabled stylesheet -->
		<ul id="mainNav">
			<?php 
				$sql = "SELECT * FROM category";
				$result = mysql_query($sql);
				while($row = mysql_fetch_assoc($result)) {
					if($c['url'] == $row['url']) { 
						$active = "class='active'"; 
					} else { 
						$active = ""; 
					}
					$target = "";
					if ($row["external"] == 1) {
						$target = "target='_blank'";
					}
					echo "<li><a href='$row[url]' $target $active>".strtoupper($row["name"])."</a></li>";
				}
			?>
		</ul>
		<!-- // #end mainNav -->
		
		<div id="containerHolder">
			<div id="container">
				<div id="sidebar">
					<ul class="sideNav">
						<?php
							$sql = "SELECT * FROM pages WHERE cat='$c[id]'";
							$result = mysql_query($sql);
							while($row = mysql_fetch_assoc($result)) {
								if($s['url'] == $row['url']) {
									$active = "class='active'"; 
								} else { 
									$active = ""; 
								}
								echo "<li><a href='$c[url]/$row[url]' $active>$row[name]</a></li>";
							}   
						?>
					</ul>
					<!-- // .sideNav -->
				</div>    
				<!-- // #sidebar -->
                
				<!-- h2 stays for breadcrumbs -->
				<?php
				if ($_GET["c"] == "impressum") {
					echo "<h2> &raquo; <a href='/impressum' class='active'>Impressum</a></h2>";
				} else {
					echo "<h2><a href='".$c["url"]."'>".$c["name"]."</a> &raquo; <a href='".$c["url"]."/".$s["url"]."' class='active'>".$s["name"]."</a></h2>";
				}
        ?>
				<div id="main">