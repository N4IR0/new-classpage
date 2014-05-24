<?php
	if (isset($_COOKIE["group"]) && $_COOKIE["group"] == 2) {
		setcookie("group", "", time()-(3600*24*31*365));
	}
	setcookie("group", "1", time()+(3600*24*31*365), "/");
	$update = date("d.m.Y H:i", $CONFIG["updates"]["substitution"]);
	echo "<p style='text-align: right; color: darkgrey; font-size: 10px;'>Zuletzt aktualisiert: $update</span><br>";
	$timestamp = time();
	if (isset($_GET["id1"]) && $_GET["id1"] == "show") {
		if (is_numeric($_GET["id2"])) {
			$timestamp = $_GET["id2"];
		}
	}
	$prev = $timestamp-(3600*24*7);
	$next = $timestamp+(3600*24*7);
	$ts_monday = getMonday($timestamp);
	$monday = date("d.m.Y", $ts_monday);
	$ts_sunday = strtotime("next sunday", $ts_monday);
	$sunday = date("d.m.Y", $ts_sunday);
	echo "<h3>Woche vom $monday - $sunday</h3>";
	echo buildTimetable(1, $timestamp);
	echo "<p style='text-align: center;'><a href='/timetable/group1/show/$prev'>&laquo Vorherige Woche</a> | <a href='/timetable/group1'>Aktuelle Woche</a> | <a href='/timetable/group1/show/$next'>Nächste Woche &raquo</a></p><br>";
?>