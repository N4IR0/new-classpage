<?php
	echo "<h3>Website Einstellungen</h3>";
	$sql = "SELECT `id`, `setting`, `value` FROM `settings` WHERE `key`='website' ORDER BY `id`";
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
		if (isset($_POST["title"]) && !empty($_POST["title"]) && $_POST["title"] != $SETTING["title"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["title"])."' WHERE `key`='website' AND `setting`='title'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Seitentitel,";
			} else {
				$error = true;
				$error_text .= " Seitentitel,";
			}
		}
		if (isset($_POST["class"]) && !empty($_POST["class"]) && $_POST["class"] != $SETTING["class"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["class"])."' WHERE `key`='website' AND `setting`='class'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Klassenname,";
			} else {
				$error = true;
				$error_text .= " Klassenname,";
			}
		}
		if (isset($_POST["url"]) && !empty($_POST["url"]) && $_POST["url"] != $SETTING["url"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["url"])."' WHERE `key`='website' AND `setting`='url'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Hauptadresse,";
			} else {
				$error = true;
				$error_text .= " Hauptadresse,";
			}
		}
		if (isset($_POST["path"]) && !empty($_POST["path"]) && $_POST["path"] != $SETTING["path"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["path"])."' WHERE `key`='website' AND `setting`='path'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Hauptpfad,";
			} else {
				$error = true;
				$error_text .= " Hauptpfad,";
			}
		}
		if (isset($_POST["admin_url"]) && !empty($_POST["admin_url"]) && $_POST["admin_url"] != $SETTING["admin_url"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["admin_url"])."' WHERE `key`='website' AND `setting`='admin_url'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Adminadresse,";
			} else {
				$error = true;
				$error_text .= " Adminadresse,";
			}
		}
		if (isset($_POST["admin_path"]) && !empty($_POST["admin_path"]) && $_POST["admin_path"] != $SETTING["admin_path"]) {
			$sql = "UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST["admin_path"])."' WHERE `key`='website' AND `setting`='admin_path'";
			if (mysql_query($sql)) {
				$changes = true;
				$changes_text .= " Adminpfad,";
			} else {
				$error = true;
				$error_text .= " Adminpfad,";
			}
		}
		if ($changes) {
			$changes_text = substr($changes_text, 0, -1);
			info($changes_text." wurden erfolgreich geändert!");
			$sql = "SELECT `id`, `setting`, `value` FROM `settings` WHERE `key`='website' ORDER BY `id`";
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
	$form->textfield("Seitentitel", "title", $SETTING["title"]);
	$form->textfield("Klassenname", "class", $SETTING["class"]);
	$form->textfield("Hauptadresse", "url", $SETTING["url"]);
	$form->textfield("Hauptpfad", "path", $SETTING["path"]);
	$form->textfield("Adminadresse", "admin_url", $SETTING["admin_url"]);
	$form->textfield("Adminpfad", "admin_path", $SETTING["admin_path"]);
	$form->buildForm();
?>