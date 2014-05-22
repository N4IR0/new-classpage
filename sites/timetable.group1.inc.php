<?php
	if (isset($_COOKIE["group"]) && $_COOKIE["group"] == 2) {
		setcookie("group", "", time()-(3600*24*31*365));
	}
	setcookie("group", "1", time()+(3600*24*31*365), "/");
	$update = date("d.m.Y H:i", $CONFIG["updates"]["substitution"]);
	echo "<p style='text-align: right; color: darkgrey; font-size: 10px;'>Zuletzt aktualisiert: $update</span><br>";
	$ts_monday = getMonday();
	$monday = date("d.m.", $ts_monday);
	$ts_sunday = strtotime("next sunday", $ts_monday);
	$sunday = date("d.m.", $ts_sunday);
	echo "<h3>Woche vom $monday - $sunday</h3>";
	echo buildTimetable(1);
?>