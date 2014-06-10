<?php
	echo "<h3>SMTP Einstellungen</h3>";
	$sql = "SELECT `id`, `setting`, `value` FROM `settings` WHERE `key`='smtp' ORDER BY `id`";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$name = $row["setting"];
		$value = $row["value"];
		$SETTING[$name] = $value;
	}
	$form = new formbuilder("modify", "Ändern");
	$form->textfield("Server", "server", $SETTING["server"]);
	$form->textfield("Port", "port", $SETTING["port"]);
	$form->textfield("User", "user", $SETTING["user"]);
	$form->password("Passwort", "password", "", 3, false);
	$form->buildForm();
?>