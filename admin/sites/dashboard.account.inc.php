<h3>Passwort &auml;ndern</h3>
<?php
	if (isset($_POST["submit"])) {
		if ($_POST["newpw"] == $_POST["newb"]) {
			$oldpw = md5($_POST["oldpw"]);
			$newpw = md5($_POST["newpw"]);
			$user = $_SESSION["user"];
			$sql = "SELECT password FROM users WHERE user='$user' AND password='$oldpw'";
			$result = mysql_query($sql);
			$exs = mysql_num_rows($result);
			if ($exs == 1) {
				$sql = "UPDATE users SET password='$newpw' WHERE user='$user'";
				if (mysql_query($sql)) {
					info("Passwort erfolgreich ge&auml;ndert!");
				} else {
					error("Passwort wegen Fehler nicht ge&auml;ndert!");
				}
			} else {
				error("Passwort ist falsch!");
			}
		} else {
			error("Die neuen Passw&ouml;rter stimmen nicht &uuml;berein!");
		}
	}
	
	$form1 = new formbuilder("submit", "Passwort &auml;ndern");
	$form1->password("Altes Passwort", "oldpw");
	
	$form1->addLength(5);
	$form1->password("Neues Passwort", "newpw");
	
	$form1->password("Passwort best&auml;tigen", "newb");
	$form1->buildForm();
?>