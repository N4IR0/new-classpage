<?php
	echo "<h3>FTP Einstellungen</h3>";
	$sql = "SELECT `id`, `setting`, `value` FROM `settings` WHERE `key`='ftp' ORDER BY `id`";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$name = $row["setting"];
		$value = $row["value"];
		$SETTING[$name] = $value;
	}
	if (isset($_POST["modify"])) {
		$changes = false;
		$changes_text = "";
		$error = false;
		$error_text = "";
		if (isset($_POST["server"]) && !empty($_POST["server"]) && $_POST["server"] != $SETTING["server"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["server"])."' WHERE `key`='ftp' AND `setting`='server'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Server,";
			} else {
				$error = true;
				$error_text .= " Server,";
			}
		}
		if (isset($_POST["port"]) && !empty($_POST["port"]) && $_POST["port"] != $SETTING["port"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["port"])."' WHERE `key`='ftp' AND `setting`='port'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Port,";
			} else {
				$error = true;
				$error_text .= " Port,";
			}
		}
		if (isset($_POST["user"]) && !empty($_POST["user"]) && $_POST["user"] != $SETTING["user"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["user"])."' WHERE `key`='ftp' AND `setting`='user'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " User,";
			} else {
				$error = true;
				$error_text .= " User,";
			}
		}
		if (isset($_POST["password"]) && !empty($_POST["password"])) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["password"])."' WHERE `key`='ftp' AND `setting`='password'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Passwort,";
			} else {
				$error = true;
				$error_text .= " Passwort,";
			}
		}
		if ($changes) {
			$changes_text = substr($changes_text, 0, -1);
			info($changes_text." wurden erfolgreich geändert!");
			$sql = "SELECT `id`, `setting`, `value` FROM `settings` WHERE `key`='ftp' ORDER BY `id`";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				$name = $row["setting"];
				$value = $row["value"];
				$SETTING[$name] = $value;
			}
		} else {
			error("Es wurden keine Änderungen vorgenommen!");
		}
		if ($error) {
			$error_text = substr($error_text, 0, -1);
			error($changes_text." wurden aufgrund eines Fehlers nicht geändert!");
		}
	}
	$form = new formbuilder("modify", "Ändern");
	$form->textfield("Server", "server", $SETTING["server"]);
	$form->textfield("Port", "port", $SETTING["port"]);
	$form->textfield("User", "user", $SETTING["user"]);
	$form->password("Passwort", "password", "", 3, false);
	$form->buildForm();
?>