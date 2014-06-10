<?php
	echo "<h3>Website Einstellungen</h3>";
	$sql = "SELECT `id`, `setting`, `value` FROM `settings` WHERE `key`='website' ORDER BY `id`";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$name = $row["setting"];
		$value = $row["value"];
		$SETTING[$name] = $value;
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