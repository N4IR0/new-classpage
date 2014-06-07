<?php

	if (isset($_GET["id1"]) && !empty($_GET["id1"])) {
		if ($_GET["id1"] == "create") {
			if ($_GET["id2"] == "freeday") {
				echo "<h3>Neuen schulfreien Tag anlegen</h3>";
				echo "<br>";
				if (isset($_POST["create"])) {
					$error = false;
					$errortext = "";
					$date = explode(".", $_POST["date"]);
					$reason = mysql_real_escape_string($_POST["reason"]);

					if (!isset($_POST["date"]) || empty($_POST["date"])) {
						$error = true;
						$errortext .= "Kein Datum angegeben!<br>";
					} else {
						if (!checkdate($date[1], $date[0], $date[2])) {
							$error = true;
							$errortext .= "Kein korrektes Datum angegeben!<br>";
						}
					}
					if (!isset($_POST["reason"]) || empty($_POST["reason"])) {
						$error = true;
						$errortext .= "Keinen Grund angegeben!<br>";
					}
					if ($error) {
						error($errortext);
					} else {
						$date = str_replace(".", "-", $_POST["date"]);
						$timestamp = strtotime($date);
						$sql = "INSERT INTO `substitution` (`id`, `type`, `date`, `lesson`, `hours`, `group`) VALUES ('', '2', '$timestamp', '$reason', '*', '0')";
						if (mysql_query($sql)) {
							info("Schulfreien Tag erfolgreich angelegt!");
						} else {
							error("Es ist ein Fehler beim Anlegen aufgetreten!<br>Bitte benachrichtige einen Admin!");
						}
					}
				}
				$form = new formbuilder("create", "Anlegen");
				$form->date("Datum(TT.MM.JJJJ)", "date");
				$form->textfield("Grund", "reason");
				$form->buildForm();
			} elseif ($_GET["id2"] == "schooltime") {

			} else {
				error("Fehlerhafter Paramter!");
			}
		} elseif ($_GET["id1"] == "edit" && isset($_GET["id2"])) {
			echo "<h3>Schulfreien Tag ändern</h3>";
			echo "<br>";
			$id = mysql_real_escape_string($_GET["id2"]);
			$sql = "SELECT `date`, `lesson` FROM `substitution` WHERE `id` = '$id' AND `type` = '2'";
			$result = mysql_query($sql);

			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_assoc($result);
				if (isset($_POST["modify"])) {
					$error = false;
					$errortext = "";
					$date = explode(".", $_POST["date"]);
					$reason = mysql_real_escape_string($_POST["reason"]);

					if (!isset($_POST["date"]) || empty($_POST["date"])) {
						$error = true;
						$errortext .= "Kein Datum angegeben!<br>";
					} else {
						if (!checkdate($date[1], $date[0], $date[2])) {
							$error = true;
							$errortext .= "Kein korrektes Datum angegeben!<br>";
						}
					}
					if (!isset($_POST["reason"]) || empty($_POST["reason"])) {
						$error = true;
						$errortext .= "Keinen Grund angegeben!<br>";
					}
					if ($error) {
						error($errortext);
					} else {
						$date = str_replace(".", "-", $_POST["date"]);
						$timestamp = strtotime($date);
						$sql = "UPDATE `substitution` SET `date`='$timestamp', `lesson`='$reason' WHERE `id`='$id'";
						if (mysql_query($sql)) {
							info("Schulfreien Tag erfolgreich geändert!");
						} else {
							error("Es ist ein Fehler beim Ändern aufgetreten!<br>Bitte benachrichtige einen Admin!");
						}
					}
				}
				$sql = "SELECT `date`, `lesson` FROM `substitution` WHERE `id` = '$id' AND `type` = '2'";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				$date = date("d.m.Y", $row["date"]);
				$form = new formbuilder("modify", "Ändern");
				$form->date("Datum(TT.MM.JJJJ)", "date", $date);
				$form->textfield("Grund", "reason", $row["lesson"]);
				$form->buildForm();
			} else {
				error("Fehlerhafter Paramter!");
			}
		} elseif ($_GET["id1"] == "delete" && isset($_GET["id2"])) {
			echo "<h3>Schulfreien Tag löschen</h3>";
			echo "<br>";
			$id = mysql_real_escape_string($_GET["id2"]);
			$sql = "SELECT `lesson` FROM `substitution` WHERE `id` = '$id' AND `type` = '2'";
			$result = mysql_query($sql);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_assoc($result);
				if (!isset($_POST["confirmform"]) || $_POST["confirm"] != 1) {
					echo "";
					$form = new formbuilder("confirmform", "Löschen bestätigen");
					$form->infoText("Bitte bestätige, dass du diesen schulfreien Tag (=".$row["lesson"].") löschen möchtest!");
					$form->hidden("confirm", 1);
					$form->buildForm();
				} else {
					$sql = "DELETE FROM `substitution` WHERE `id` = '$id'";
					if (mysql_query($sql)) {
						info("Der schulfreie Tag (=".$row["lesson"].") wurde erfolgreich gelöscht!");
					} else {
						error("Der schulfreie Tag(=".$row["lesson"].") wurde aufgrund eines Fehlers nicht gelöscht!<br>Bitte benachrichtige einen Admin!");
					}
				}
			} else {
				error("Fehlerhafter Paramter!");
			}
		} elseif ($_GET["id1"] == "edit2") {

		} elseif ($_GET["id1"] == "delete2") {

		} else {
			error("Fehlerhafter Paramter!");
		}
	} else {
		echo "<h3>Schulfreie Tage <a style='float: right;' href=".$CONFIG["website"]["admin_path"]."timetable/general/create/freeday>(Erstellen)</a></h3>";
		$result = getSubstitution(2);
		echo "<table class='datatables'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>Datum</th>";
					echo "<th>Grund</th>";
					echo "<th>Bearbeiten</th>";
					echo "<th>Löschen</th>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
				while ($row = mysql_fetch_assoc($result)) {
					echo "<tr>";
						echo "<td>".date("d.m.Y", $row["date"])."</td>";
						echo "<td>".$row["lesson"]."</td>";
						echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/general/edit/".$row["id"].">x</a></td>";
						echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/general/delete/".$row["id"].">x</a></td>";
					echo "</tr>";
				}
			echo "</tbody>";
		echo "</table>";
		echo "<br>";

		echo "<h3>Schulzeit <a style='float: right;' href=".$CONFIG["website"]["admin_path"]."timetable/general/create/schooltime>(Erstellen)</a></h3>";
		$result = getSchooltime();
		echo "<table class='datatables'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>Lehrjahr</th>";
					echo "<th>Von</th>";
					echo "<th>Bis</th>";
					echo "<th>Bearbeiten</th>";
					echo "<th>Löschen</th>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
				while ($row = mysql_fetch_assoc($result)) {
					echo "<tr>";
						echo "<td>".$row["year"]."</td>";
						echo "<td>".date("d.m.Y", $row["from"])."</td>";
						echo "<td>".date("d.m.Y", $row["to"])."</td>";
						echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/general/edit2/".$row["id"].">x</a></td>";
						echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/general/delete2/".$row["id"].">x</a></td>";
					echo "</tr>";
				}
			echo "</tbody>";
		echo "</table>";
	}
?>