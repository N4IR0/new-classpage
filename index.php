<?php
require("inc/sessionheader.inc.php");
require("inc/config.inc.php");
require("inc/functions.inc.php");

$category = mysql_real_escape_string($_GET["c"]);
if(isset($category)) {
	if($category=="logout") {
		$filename = "sites/_logout.inc.php";
	} elseif ($category=="login") {
			$filename = "sites/_login.inc.php";
	} else {
		if (isset($_GET["s"])) {
			$site = mysql_real_escape_string($_GET["s"]);
			$filename = "sites/".$category.".".$site.".inc.php";
		} else {
			$filename = "sites/".$category.".home.inc.php";
		}
		if (!file_exists($filename)) {
			$filename = "sites/_404.inc.php";
		} else {
			if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
				$sql = "SELECT * FROM users WHERE id='$_SESSION[uid]'";
				$res = mysql_query($sql);
				$user = mysql_fetch_assoc($res);
				if ($user['activ'] == "0") {
					$filename = "sites/_notactive.inc.php";
				}
			}	else {
				$user["user_lvl"] = 0;
			}
			$sql = "SELECT user_lvl FROM category WHERE url='$category'";
			$res = mysql_query($sql);
			$cat = mysql_fetch_assoc($res);
			if ($user["user_lvl"] >= $cat["user_lvl"]) {
				$sql = "SELECT user_lvl FROM pages WHERE url='$site'";
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
} else {
	$filename = "sites/dashboard.home.inc.php";
}

//Build Site
include("design/header.inc.php");
include($filename);
include("design/footer.inc.php");

mysql_close();
?>