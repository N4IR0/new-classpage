<?php
	session_unset();
	if (isset($_COOKIE['PHPSESSID'])) {
		setcookie("PHPSESSID", "", time()-86400);
	}
	session_destroy();
	$status = "Erfolgreich ausgeloggt!";
	header('Location: login');
?>