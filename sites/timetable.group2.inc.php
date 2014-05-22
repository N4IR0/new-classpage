<?php
	$update = date("d.m.Y H:i", $CONFIG["updates"]["substitution"]);
	echo "<p style='text-align: right; color: darkgrey; font-size: 10px;'>Zuletzt aktualisiert: $update</span><br>";
	echo buildTimetable(2);
?>