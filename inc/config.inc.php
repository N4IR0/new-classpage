<?php
	//Konfigurations Variablen
	
	//Datenbank Einstellungen
	$MYSQL["server"] = "localhost";
	$MYSQL["user"] = "fi13a";
	$MYSQL["password"] = "changeme";
	$MYSQL["database"] = "fi13a";
	
	//FTP Einstellungen
	$FTP["server"] = "ftp.fi13a.de";
	$FTP["port"] = "21";
	$FTP["user"] = "fi13";
	$FTP["password"] = "changeme";
	
	//SMTP Einstellungen
	$SMTP["server"] = "ssl://localhost";
	$SMTP["port"] = "465";
	$SMTP["user"] = "noreply@fi13a.de";
	$SMTP["password"] = "changeme";
	
	//Notification Einstellungen
	$NOTIFY["mail"] = "noreply@fi13a.de";
	$NOTIFY["sender"] = $CONFIG["class"]." Infowebsite <".$NOTIFY["mail"].">";
	
	//Initialisierung der Datenbankverbindung
	@mysql_connect($MYSQL["server"], $MYSQL["user"], $MYSQL["password"]) or die ("Verbindung zum MySQL-Server nicht möglich!");
	@mysql_select_db($MYSQL["database"]) or die ("Datenbank nicht gefunden!");
	
	//Einlesen der $CONFIG Variablen
	$sql = "SELECT `key`, `name`, `value` FROM `config`";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result) {
		$key = $row["key"];
		$name = $row["name"];
		$value = $row["value"];
		$CONFIG[$key][$name] = $value;
	}
?>