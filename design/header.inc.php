<?php
	$main = mainPfad();
	
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
	<title>#ToadLive - Administation</title>
	
	<!-- CSS -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href="<?php echo $main; ?>/style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?php echo $main; ?>/style/css/tipsy.css" rel="stylesheet" type="text/css" media="screen" />
	
	<!-- JavaScripts-->
	<script type="text/javascript" src="<?php echo $main; ?>/style/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $main; ?>/style/js/jquery.form-validator.min.js"></script>
	<script type="text/javascript" src="<?php echo $main; ?>/style/js/jNice.js"></script>
	<script type="text/javascript" src="<?php echo $main; ?>/style/js/jquery.tipsy.js"></script>
</head>

<body>
	<div id="wrapper">
    	<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
    	<div id="topbar">
	    	<h1><a href="#">#ToadLive - Administation</a></h1>
	    	<div id="logininfo">Hallo <a href="<?php echo "$main/dashboard/home"; ?>"><?php echo ucfirst($_SESSION["user"]); ?></a>!</div>
    	</div>
        
        <!-- You can name the links with lowercase, they will be transformed to uppercase by CSS, we prefered to name them with uppercase to have the same effect with disabled stylesheet -->
        <ul id="mainNav">
        	<?php 
        		$sql = "SELECT * FROM admin_categorie";
				$result = mysql_query($sql);
				while($row = mysql_fetch_assoc($result)) {
					if($user['user_lvl']>=$row['user_lvl']) {
						if($c['url'] == $row['url']) { $active = "class='active'"; } else { $active = ""; }
						echo "<li><a href='$main/$row[url]' $active>".strtoupper($row["name"])."</a></li>";			
					}
				}        	
        	?>
        	<li class="logout"><a href="<?php echo "$main/logout";?>"></a></li>
        </ul>
        <!-- // #end mainNav -->
        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav">
                    	<?php
			        		$sql = "SELECT * FROM admin_pages WHERE cat='$c[id]'";
							$result = mysql_query($sql);
							while($row = mysql_fetch_assoc($result)) {
								if($user['user_lvl']>=$row['user_lvl']) {
									if($s['url'] == $row['url']) { $active = "class='active'"; } else { $active = ""; }
									echo "<li><a href='$main/$c[url]/$row[url]' $active>$row[name]</a></li>";
								}
							}   
                    	?>
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2><a href="<?php echo "$main/$c[url]"; ?>"><?php echo $c['name']; ?></a> &raquo; <a href="<?php echo "$main/$c[url]/$s[url]"; ?>" class="active"><?php echo $s['name']; ?></a></h2>
                
                <div id="main">