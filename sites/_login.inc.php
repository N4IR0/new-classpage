<?php
$status = "";
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
	$status = "Du bist eingeloggt - <a href=logout>Ausloggen?</a>\n";
}
require "inc/loginmaker.inc.php";

if($status=="") {
	echo "<br /><br />";
} else {
	echo "<b style='color: red;'>$status</b><br /><br />";	
}

echo <<<FORMULAR
<form method="post">
<input type="text" name="user" value="Benutername" onblur="if(value=='') value = 'Benutername'" onfocus="if(value=='Benutername') value = ''"><br>
<input type="password" name="pw" value="Passwort" onblur="if(value=='') value = 'Passwort'" onfocus="if(value=='Passwort') value = ''"><br>
<input type="submit" value="Login" class="button">
</form>
FORMULAR;
?>