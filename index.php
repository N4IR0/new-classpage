<?php
	require("inc/config.inc.php");
	require("inc/functions.inc.php");
	if (isset($_GET["c"])) {
		if (isset($_GET["s"])) {
			$site = $_GET["s"];
			$filename = "sites/".$_GET["c"].".".$site.".inc.php";
			if (!file_exists($filename)) {
				$filename = "sites/_404.inc.php";
			}
		} else {
			$filename = "sites/".$_GET["c"].".home.inc.php";
		}
	} else {
		$filename = "sites/dashboard.home.inc.php";
	}
	
	//Build Site
	include("design/header.inc.php");
	include($filename);
	include("design/footer.inc.php");
?>