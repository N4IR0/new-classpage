<?php
	//Konfigurations Variablen
	
	//Website Einstellungen
	$CONFIG["class"] = "FI_13A";
	$CONFIG["protocol"] = "http";
	$CONFIG["domain"] = "www.fi13a.de";
	$CONFIG["mail"] = "noreply@fi13a.de";
	
	//Datenbank Einstellungen
	$MYSQL["server"] = "localhost";
	$MYSQL["user"] = "changeme";
	$MYSQL["password"] = "changeme";
	$MYSQL["database"] = "fi13a";
	
	//SMTP Einstellungen
	
	//Notification Einstellungen
	
	//Initialisierung der Datenbankverbindung
	@mysql_connect($MYSQL["server"], $MYSQL["user"], $MYSQL["password"]) or die ("Verbindung zum MySQL-Server nicht möglich!");
	@mysql_select_db($MYSQL["database"]) or die ("Datenbank nicht gefunden!");
?>