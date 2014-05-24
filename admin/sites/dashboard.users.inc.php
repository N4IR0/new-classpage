<?php
	if($_GET['id1']!="edit" AND $_GET['id1']!="delete" AND $_GET['id1']!="new") {
		echo "<h3>Benutzer Liste</h3>";
		
		echo "<a href='".$CONFIG["website"]["admin_path"]."dashboard/users/new'>Neuer Benutzer anlegen</a><br /><br />";
		
		$table1 = new tablebuilder();
		$table1->noHeader();
		
		$sql = "SELECT * FROM users ORDER BY user";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$sql2 = "SELECT name FROM user_lvl WHERE level = $row[user_lvl]";
			$result2 = mysql_query($sql2);
			$row2 = mysql_fetch_assoc($result2);
			
			$table1->addRow();
	
			if($row['activ']=="1") {
				$table1->addCloum("", "server_running");	
			} else {
				$table1->addCloum("", "server_stopp");	
			}
	
			$table1->addCloum("<div title='$row[email]'><b>$row[user]</b> ($row2[name])</div>");
			
			$table1->addCloum("<a href='".$CONFIG["website"]["admin_path"]."dashboard/users/edit/$row[id]' class=edit>Bearbeiten</a><a href='".$CONFIG["website"]["admin_path"]."dashboard/users/delete/$row[id]' class=delete>Löschen</a>", "action");
		}
		
		$table1->buildTable();		
	} 
?>	
	
<?php
	if($_GET['id1']=="edit") {
		echo "<h3>Benutzer bearbeiten</h3>";
		if(isset($_POST['form2'])) {
			if($_POST['name']=="" OR $_POST['email']=="" OR $_POST['user_lvl']=="" OR $_POST['activ']=="") {
				error("Bitte fülle alle Felder aus!");
			} else {
				$name = mysql_real_escape_string($_POST['name']);
				$mail = mysql_real_escape_string($_POST['email']);
				$user_lvl = mysql_real_escape_string($_POST['user_lvl']);
				$activ = mysql_real_escape_string($_POST['activ']);
				$id2 = mysql_real_escape_string($_GET['id2']);
				$insql = "UPDATE users SET user='$name', email='$mail', user_lvl='$user_lvl', activ='$activ' WHERE id='$id2'";
				if(mysql_query($insql)) {
					info("Der User wurde erfolgreich bearbeitet!");
				} else {
					error("Es ist ein Fehler aufgetreten!");
				}
			}
		}			
		
		if(isset($_GET["id2"])) {
			$sql = "SELECT * FROM users WHERE id='$_GET[id2]'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
			if($row['id']=="") {
				error("Der Benutzer wurde nicht gefunden!");
			} else {
				$form2 = new formbuilder("form2", "Speichern");
				$form2->textfield("Name", "name", $row['user']);
				$form2->email("E-Mail", "email", $row['email']);
				
				$sql2 = "SELECT * FROM user_lvl";
				$result2 = mysql_query($sql2);
				$rang = array();
				while($row2 = mysql_fetch_assoc($result2)) {
					$rang[$row2['level']]=$row2['name'];
				}
				$form2->dropdown("Rang", "user_lvl", $rang, $row['user_lvl']);
				
				$form2->dropdown("Aktiv", "activ", array(0=>"Nein", 1=>"Ja"), $row['activ']);
				$form2->buildForm();
			}
		} else {
			error("Bitte gebe einen User an!");
		}
	}
?>


<?php
	if($_GET['id1']=="new") {
		echo "<h3>Benutzer anlegen</h3>";
		if(isset($_POST['form1'])) {
			if($_POST['name']=="" OR $_POST['email']=="" OR $_POST['password']=="" OR $_POST['user_lvl']=="" OR $_POST['activ']=="") {
				error("Bitte fülle alle Felder aus!");
			} else {
				$name = mysql_real_escape_string($_POST['name']);
				$password = hash("sha256", $_POST['password']);
				$mail = mysql_real_escape_string($_POST['email']);
				$user_lvl = mysql_real_escape_string($_POST['user_lvl']);
				$activ = mysql_real_escape_string($_POST['activ']);
				$insql = "INSERT INTO users VALUES ('', '$name', '$password', '$mail', '$user_lvl', '$activ')";
				if(mysql_query($insql)) {
					info("Der User wurde erfolgreich angelegt!");
				} else {
					error("Es ist ein Fehler aufgetreten!");
				}
			}
		}			
		
		$form1 = new formbuilder("form1", "Erstellen");
		$form1->textfield("Name", "name");
		$form1->password("Passwort", "password");
		$form1->email("E-Mail", "email");
		
		$sql2 = "SELECT * FROM user_lvl";
		$result2 = mysql_query($sql2);
		$rang = array();
		while($row2 = mysql_fetch_assoc($result2)) {
			$rang[$row2['level']]=$row2['name'];
		}
		$form1->dropdown("Rang", "user_lvl", $rang);
		
		$form1->dropdown("Aktiv", "activ", array(0=>"Nein", 1=>"Ja"));
		$form1->buildForm();
	}
?>


<?php
	if($_GET['id1']=="delete") {
		echo "<h3>Benutzer löschen</h3>";
		
		if(isset($_POST['form3'])) {
			if($_POST['best']!="LOESCHEN") {
				error("Bitte gebe zur Bestätigung 'LOESCHEN' ein!");
			} else {
				$sql = "DELETE FROM users WHERE id='$_GET[id2]'";
				if (mysql_query($sql)) {
					info("Der Benutzer wurde erfolgreich gelöscht!");
					exit();
				} else {
					error("Es ist ein Fehler beim Löschen aufgetreten!");
				}
			}
		}
		
		if($_GET['id2']=="") {
			error("Bitte wählen sie ein Benutzer aus!");
		} else {
			$tpl = mysql_query("SELECT * FROM users WHERE id=$_GET[id2]");
			$num = mysql_num_rows($tpl);
			if ($num == 0) {
				error("Dieser Benutzer exestiert nicht!");	
			} else {
				$row = mysql_fetch_assoc($tpl);
				
				$form3 = new formbuilder("form3", "Löschen");
				$form3->infoText("Bist du dir sicher, dass du den Benutzer <b>$row[user]</b> löschen willst? Diese Option kann nicht rückgänig gemacht werden! Du kannst den Nutzer auch einfach nur deaktivieren.");				
				$form3->textfield("Bitte gebe 'LOESCHEN' ein", "best", "", 2);
				$form3->buildForm();
			}					
		}
	}
?>