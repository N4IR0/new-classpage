<?php
	if (isset($_COOKIE["group"])) {
		if (!$_SERVER['HTTPS']) {
			$proto = "http";
		} else {
			$proto = "https";
		}
		header('Location: '.$proto.'://'.$_SERVER["SERVER_NAME"].'/dashboard/group'.$_COOKIE["group"]);
	}
?>
<b>Herzlich Willkommen zurück!</b><br /><br />
<p>Hier findest du eine Übericht der aktuellen Hausaufgaben und Arbeiten. Bitte wähle links deine Gruppe aus.</p>