<?php
	if (isset($_COOKIE["group"])) {
		if (!$_SERVER['HTTPS']) {
			$proto = "http";
		} else {
			$proto = "https";
		}
		header('Location: '.$proto.'://'.$_SERVER["SERVER_NAME"].'/timetable/group'.$_COOKIE["group"]);
	}
?>
Hier findest du eine Übericht des aktuellen Stunden- bzw. Vertretungsplans.<br>
Bitte wähle links deine Gruppe aus.