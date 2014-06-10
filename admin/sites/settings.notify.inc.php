<?php
	echo "<h3>Benachrichtigungs Einstellungen</h3>";
	$sql = "SELECT `id`, `setting`, `value` FROM `settings` WHERE `key`='notify' ORDER BY `id`";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$name = $row["setting"];
		$value = $row["value"];
		$SETTING[$name] = $value;
	}
	$form = new formbuilder("modify", "Ändern");
	$form->textfield("Absendername", "sender", $SETTING["sender"]);
	$form->textfield("Absenderadresse", "mail", $SETTING["mail"]);
	$form->textfield("Betreffprefix", "prefix", $SETTING["prefix"]);
	$form->textfield("Pfad zum Logfile", "logpath", $SETTING["logpath"]);
	$form->textfield("Anmeldungbestätigungs Betreff", "confirmsubject", $SETTING["confirmsubject"]);
	$form->textarea("Neue Anmeldung Text", "newreg", $SETTING["newreg"]);
	$form->textarea("Bestätigungs Text", "confirmtext", $SETTING["confirmtext"]);
	$form->textfield("Erinnerungs Betreff", "remindersubject", $SETTING["remindersubject"]);
	$form->textarea("Erinnerungstext Anfang", "reminderbegin", $SETTING["reminderbegin"]);
	$form->textarea("Erinnerungstext Tests", "testreminder", $SETTING["testreminder"]);
	$form->textarea("Erinnerungstext Hausaufgaben", "hwreminder", $SETTING["hwreminder"]);
	$form->textarea("Erinnerungstext Ende", "reminderend", $SETTING["reminderend"]);
	$form->buildForm();
?>