<?php
if (!empty($_POST['user']) && !empty($_POST['pw'])) {
	if (SID != "") {
		$status = "Bitte Cookies anschalten!";
	} else {
		$pw = hash("sha256", $_POST["pw"]);
		if (empty($status)) {
			$user = mysql_real_escape_string($_POST["user"]);
			$loginsql = "SELECT id, user, password, name, activ FROM users WHERE user='$user' AND password='$pw'";
			$loginres = mysql_query($loginsql);
			if (mysql_num_rows($loginres) == 1) {
				$user = mysql_fetch_assoc($loginres);
				
				if($user['activ']=="1") {
					$_SESSION["login"] = true;
					$_SESSION["user"] = $_POST["user"];
					$_SESSION["name"] = $user["name"];
					$_SESSION['uid'] = $user['id'];
					$status= "Du wurdest erfolgreich eingeloggt!<br>\n<a href=index.php>Weiter</a><br>\n";
					
					$c = ($_GET['c']=="" ? "dashboard" : $_GET['c']);
					$s = ($_GET['s']=="" ? "home" : $_GET['s']);
					if ($c == "login" || $c == "logout") {
						header('Location: dashboard/home');
					} else {
						header('Location: '.$c."/".$s);
					}
				} else {
					$status = "Dein Account ist deaktiviert.";				
				}
			} else {
				$_SESSION["login"] = false;
				$status = "Login inkorrekt!";
			}
		}
	}
}
?>