<?php
	$template = "home";
	require("inc/sessionheader.inc.php");
	require("inc/formbuilder.inc.php");
	require("inc/tablebuilder.inc.php");
	require("../inc/config.inc.php");
	
	if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
		require("inc/function.inc.php");
				
		if(isset($category)) {
			if($category=="logout") {
				$template = "login";
				$filename = "sites/_logout.inc.php";
			} else {
				$category = substr($_GET["c"], 1, -1);
				$category = mysql_real_escape_string($category);
				if (isset($_GET["s"])) {
					$site = mysql_real_escape_string($_GET["s"]);
					$filename = "sites/".$category.".".$site.".inc.php";
				} else {
					$filename = "sites/".$category.".home.inc.php";
				}
				if (!file_exists($filename)) {
					$filename = "sites/_404.inc.php";
				} else {
					$sql = "SELECT * FROM users WHERE id='$_SESSION[uid]'";
					$res = mysql_query($sql);
					$user = mysql_fetch_assoc($res);
					if ($user['activ'] == "0") {
						$filename = "sites/_notactive.inc.php";
					} else {
						$sql = "SELECT user_lvl FROM admin_category WHERE url='$category'";
						$res = mysql_query($sql);
						$cat = mysql_fetch_assoc($res);
						if ($user["user_lvl"] >= $cat["user_lvl"]) {
							$sql = "SELECT user_lvl FROM admin_pages WHERE url='$site'";
							$res = mysql_query($sql);
							$page = mysql_fetch_assoc($res);
							if ($user['user_lvl'] < $page['user_lvl']) {
								$filename = "sites/_noaccess.inc.php";
							}
						} else {
							$filename = "sites/_noaccess.inc.php";
						}
					}
				}
			}
		} else {
		$filename = "sites/dashboard.home.inc.php";
		}
	} else {
		$template = "login";
		$filename = "sites/_login.inc.php";
	}

	//Build Site
	if ($template == "login") {
		include("design/login/header.inc.php");
		include($filename);
		include("design/login/footer.inc.php");
	} else {
		include("design/home/header.inc.php");
		include($filename);
		include("design/home/footer.inc.php");
	}
	mysql_close();
?>