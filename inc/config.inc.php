<?php
	//Konfigurations Variablen
	
	//Datenbank Einstellungen
	$MYSQL["server"] = "localhost";
	$MYSQL["user"] = "fi13a";
	$MYSQL["password"] = "changeme";
	$MYSQL["database"] = "fi13a";
	
	//Initialisierung der Datenbankverbindung
	@mysql_connect($MYSQL["server"], $MYSQL["user"], $MYSQL["password"]) or die ("Verbindung zum MySQL-Server nicht möglich!");
	@mysql_select_db($MYSQL["database"]) or die ("Datenbank nicht gefunden!");

	//Setze Encoding auf UTF-8
	mysql_query("SET NAMES 'utf8'");
	
	//Einlesen der $CONFIG Variablen
	$sql = "SELECT * FROM `settings`";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$key = $row["key"];
		$name = $row["setting"];
		$value = $row["value"];
		$CONFIG[$key][$name] = $value;
	}
?>