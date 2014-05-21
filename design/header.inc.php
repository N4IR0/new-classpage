<?php
	$c = mysql_real_escape_string($_GET['c']);
	$s = mysql_real_escape_string($_GET['s']);
	
	$sql = "SELECT * FROM category WHERE url='$c'";
	$result = mysql_query($sql);
	$c = mysql_fetch_assoc($result);
	
	$sql = "SELECT * FROM admin_pages WHERE url='$s'";
	$result = mysql_query($sql);
	$s = mysql_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<title><?php echo $CONFIG["website"]["title"]; ?></title>
	
	<!-- CSS -->
	<link href="/style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="/style/css/tipsy.css" rel="stylesheet" type="text/css" media="screen" />
	
	<!-- JavaScripts-->
	<script type="text/javascript" src="/style/js/jquery.js"></script>
	<script type="text/javascript" src="/style/js/jquery.form-validator.min.js"></script>
	<script type="text/javascript" src="/style/js/jNice.js"></script>
	<script type="text/javascript" src="/style/js/jquery.tipsy.js"></script>
</head>

<body>
	<div id="wrapper">
		<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
		<div id="topbar">
			<h1><a href="#"><?php echo $CONFIG["website"]["title"]; ?></a></h1>
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
					echo "<li><a href='/$row[url]' $active>".strtoupper($row["name"])."</a></li>";
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
								echo "<li><a href='/$c[url]/$row[url]' $active>$row[name]</a></li>";
							}   
						?>
					</ul>
					<!-- // .sideNav -->
				</div>    
				<!-- // #sidebar -->
                
				<!-- h2 stays for breadcrumbs -->
				<h2><a href="<?php echo "/".$c["url"]; ?>"><?php echo $c['name']; ?></a> &raquo; <a href="<?php echo "/$c[url]/$s[url]"; ?>" class="active"><?php echo $s['name']; ?></a></h2>
                
				<div id="main">