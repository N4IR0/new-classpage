<?php
	if (isset($_GET["id1"]) && !empty($_GET["id1"])) {
		if ($_GET["id1"] == "create" && isset($_GET["id2"]) && !empty($_GET["id2"])) {
			if ($_GET["id2"] == "substitution") {
				echo "<h3>Neue Vertretung anlegen</h3>";
				echo "<br>";
				if (isset($_POST["create"])) {
					$error = false;
					$errortext = "";
					$date = explode(".", $_POST["date"]);
					$lesson = mysql_real_escape_string($_POST["lesson"]);
					$hours = mysql_real_escape_string($_POST["hours"]);
					$teacher = mysql_real_escape_string($_POST["teacher"]);
					$group = $_POST["group"];

					if (!isset($_POST["date"]) || empty($_POST["date"])) {
						$error = true;
						$errortext .= "Kein Datum angegeben!<br>";
					} elseif (!checkdate($date[1], $date[0], $date[2])) {
						$error = true;
						$errortext .= "Kein korrektes Datum angegeben!<br>";
					}
					if (!isset($lesson) || empty($lesson)) {
						$error = true;
						$errrotext .= "Kein Vertretungsfach angegeben!<br>";
					}
					if (!isset($hours) || empty($hours)) {
						$error = true;
						$errortext .= "Keine Stunden angegeben!<br>";
					} elseif ($hours != "*") {
						$hours_check = explode(";", $hours);
						foreach($hours_check as $value) {
							if (!is_numeric($value)) {
								$error = true;
								$errortext .= "Keine korrekte Stundenangabe!<br>";
								break;
							}
						}
					}
					if (!isset($teacher) || empty($teacher)) {
						$error = true;
						$errortext .= "Keinen Vertretungslehrer angegeben!<br>";
					}
					if (!isset($group) || (empty($group) && $group != 0)) {
						$error = true;
						$errortext .= "Keine Gruppe angegeben!<br>";
					} elseif (!is_numeric($group) || $group < 0) {
						$error = true;
						$errortext .= "Keine korrekte Gruppe angegeben!<br>";
					}
					if ($error) {
						error($errortext);
					} else {
						$date = str_replace(".", "-", $_POST["date"]);
						$timestamp = strtotime($date);
						$sql = "INSERT INTO `substitution` (`id`, `type`, `date`, `lesson`, `hours`, `teacher`, `group`) VALUES ('', '1', '$timestamp', '$lesson', '$hours', '$teacher', '$group')";
						if (mysql_query($sql)) {
							info("Vertretung erfolgreich angelegt!");
							$sql = "UPDATE `settings` SET `value`='".time()."' WHERE `key`='updates' AND `setting`='substitution'";
							mysql_query($sql);
						} else {
							error("Es ist ein Fehler beim Anlegen aufgetreten!<br>Bitte benachrichtige einen Admin!");
						}
					}
				}
				$form = new formbuilder("create", "Anlegen");
				$form->date("Datum(TT.MM.JJJJ)", "date");
				$form->textfield("Vertretungsfach", "lesson");
				$form->textfield("Stunden(1;2;3.../*)", "hours");
				$form->textfield("Vertretungslehrer", "teacher");
				$form->number("Gruppe(0 für alle)", "group");
				$form->buildForm();
			} elseif ($_GET["id2"] == "cancellation") {
				echo "<h3>Neue Ausfallstunde anlegen</h3>";
				echo "<br>";
				if (isset($_POST["create"])) {
					$error = false;
					$errortext = "";
					$date = explode(".", $_POST["date"]);
					$hours = mysql_real_escape_string($_POST["hours"]);
					$group = $_POST["group"];

					if (!isset($_POST["date"]) || empty($_POST["date"])) {
						$error = true;
						$errortext .= "Kein Datum angegeben!<br>";
					} elseif (!checkdate($date[1], $date[0], $date[2])) {
						$error = true;
						$errortext .= "Kein korrektes Datum angegeben!<br>";
					}
					if (!isset($hours) || empty($hours)) {
						$error = true;
						$errortext .= "Keine Stunden angegeben!<br>";
					} else {
						$hours_check = explode(";", $hours);
						foreach($hours_check as $value) {
							if (!is_numeric($value)) {
								$error = true;
								$errortext .= "Keine korrekte Stundenangabe!<br>";
								break;
							}
						}
					}
					if (!isset($group) || (empty($group) && $group != 0)) {
						$error = true;
						$errortext .= "Keine Gruppe angegeben!<br>";
					} elseif (!is_numeric($group) || $group < 0) {
						$error = true;
						$errortext .= "Keine korrekte Gruppe angegeben!<br>";
					}
					if ($error) {
						error($errortext);
					} else {
						$date = str_replace(".", "-", $_POST["date"]);
						$timestamp = strtotime($date);
						$sql = "INSERT INTO `substitution` (`id`, `type`, `date`, `hours`, `group`) VALUES ('', '0', '$timestamp', '$hours', '$group')";
						if (mysql_query($sql)) {
							info("Ausfall erfolgreich angelegt!");
							$sql = "UPDATE `settings` SET `value`='".time()."' WHERE `key`='updates' AND `setting`='substitution'";
							mysql_query($sql);
						} else {
							error("Es ist ein Fehler beim Anlegen aufgetreten!<br>Bitte benachrichtige einen Admin!");
						}
					}
				}
				$form = new formbuilder("create", "Anlegen");
				$form->date("Datum(TT.MM.JJJJ)", "date");
				$form->textfield("Stunden(1;2;3...)", "hours");
				$form->number("Gruppe(0 für alle)", "group");
				$form->buildForm();
			} else {
				error("Fehlerhafter Parameter!");
			}
		} elseif ($_GET["id1"] == "edit" && isset($_GET["id2"]) && !empty($_GET["id2"]) && is_numeric($_GET["id2"])) {
			$id = $_GET["id2"];
			$sql = "SELECT `type`, `date`, `lesson`, `hours`, `teacher`, `group`, `notify_date` FROM `substitution` WHERE `id`='$id'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if ($num > 0) {
				$row = mysql_fetch_assoc($result);
				if ($row["type"] == 0) {
					echo "<h3>Ausfall ändern</h3>";
					echo "";
					if (isset($_POST["modify"])) {
						$error = false;
						$errortext = "";
						$date = explode(".", $_POST["date"]);
						$hours = mysql_real_escape_string($_POST["hours"]);
						$group = $_POST["group"];

						if (!isset($_POST["date"]) || empty($_POST["date"])) {
							$error = true;
							$errortext .= "Kein Datum angegeben!<br>";
						} elseif (!checkdate($date[1], $date[0], $date[2])) {
							$error = true;
							$errortext .= "Kein korrektes Datum angegeben!<br>";
						}
						if (!isset($hours) || empty($hours)) {
							$error = true;
							$errortext .= "Keine Stunden angegeben!<br>";
						} else {
							$hours_check = explode(";", $hours);
							foreach($hours_check as $value) {
								if (!is_numeric($value)) {
									$error = true;
									$errortext .= "Keine korrekte Stundenangabe!<br>";
									break;
								}
							}
						}
						if (!isset($group) || (empty($group) && $group != 0)) {
							$error = true;
							$errortext .= "Keine Gruppe angegeben!<br>";
						} elseif (!is_numeric($group) || $group < 0) {
							$error = true;
							$errortext .= "Keine korrekte Gruppe angegeben!<br>";
						}
						if ($error) {
							error($errortext);
						} else {
							if (isset($_POST["reset"]) && $_POST["reset"] == 1) {
								$notify = 'NULL';
							} else {
								$notify = "'".$row["notify_date"]."'";
							}
							$date = str_replace(".", "-", $_POST["date"]);
							$timestamp = strtotime($date);
							$sql = "UPDATE `substitution` SET `date`='$timestamp', `hours`='$hours', `group`='$group', `notify_date`=$notify WHERE `id`='$id'";
							if (mysql_query($sql)) {
								info("Ausfall erfolgreich geändert!");
								$sql = "UPDATE `settings` SET `value`='".time()."' WHERE `key`='updates' AND `setting`='substitution'";
								mysql_query($sql);
							} else {
								error("Es ist ein Fehler beim Ändern aufgetreten!<br>Bitte benachrichtige einen Admin!");
							}
						}
					}
					$sql = "SELECT `type`, `date`, `lesson`, `hours`, `teacher`, `group`, `notify_date` FROM `substitution` WHERE `id`='$id'";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					$date = date("d.m.Y", $row["date"]);
					$form = new formbuilder("modify", "Ändern");
					$form->date("Datum(TT.MM.JJJJ)", "date", $date);
					$form->textfield("Stunden(1;2;3...)", "hours", $row["hours"]);
					$form->number("Gruppe(0 für alle)", "group", $row["group"]);
					$form->checkbox("Benachrichtigung zurücksetzen?", "reset", "1", false, false);
					$form->buildForm();
				} elseif ($row["type"] == 1) {
					echo "<h3>Vertretung ändern</h3>";
					echo "";
					if (isset($_POST["modify"])) {
						$error = false;
						$errortext = "";
						$date = explode(".", $_POST["date"]);
						$lesson = mysql_real_escape_string($_POST["lesson"]);
						$hours = mysql_real_escape_string($_POST["hours"]);
						$teacher = mysql_real_escape_string($_POST["teacher"]);
						$group = $_POST["group"];

						if (!isset($_POST["date"]) || empty($_POST["date"])) {
							$error = true;
							$errortext .= "Kein Datum angegeben!<br>";
						} elseif (!checkdate($date[1], $date[0], $date[2])) {
							$error = true;
							$errortext .= "Kein korrektes Datum angegeben!<br>";
						}
						if (!isset($lesson) || empty($lesson)) {
							$error = true;
							$errrotext .= "Kein Vertretungsfach angegeben!<br>";
						}
						if (!isset($hours) || empty($hours)) {
							$error = true;
							$errortext .= "Keine Stunden angegeben!<br>";
						} elseif ($hours != "*") {
							$hours_check = explode(";", $hours);
							foreach($hours_check as $value) {
								if (!is_numeric($value)) {
									$error = true;
									$errortext .= "Keine korrekte Stundenangabe!<br>";
									break;
								}
							}
						}
						if (!isset($teacher) || empty($teacher)) {
							$error = true;
							$errortext .= "Keinen Vertretungslehrer angegeben!<br>";
						}
						if (!isset($group) || (empty($group) && $group != 0)) {
							$error = true;
							$errortext .= "Keine Gruppe angegeben!<br>";
						} elseif (!is_numeric($group) || $group < 0) {
							$error = true;
							$errortext .= "Keine korrekte Gruppe angegeben!<br>";
						}
						if ($error) {
							error($errortext);
						} else {
							if (isset($_POST["reset"]) && $_POST["reset"] == 1) {
								$notify = 'NULL';
							} else {
								$notify = "'".$row["notify_date"]."'";
							}
							$date = str_replace(".", "-", $_POST["date"]);
							$timestamp = strtotime($date);
							$sql = "UPDATE `substitution` SET `date`='$timestamp', `lesson`='$lesson', `hours`='$hours', `teacher`='$teacher', `group`='$group', `notify_date`=$notify WHERE `id`='$id'";
							if (mysql_query($sql)) {
								info("Vertretung erfolgreich geändert!");
								$sql = "UPDATE `settings` SET `value`='".time()."' WHERE `key`='updates' AND `setting`='substitution'";
								mysql_query($sql);
							} else {
								error("Es ist ein Fehler beim Ändern aufgetreten!<br>Bitte benachrichtige einen Admin!");
							}
						}
					}
					$sql = "SELECT `type`, `date`, `lesson`, `hours`, `teacher`, `group`, `notify_date` FROM `substitution` WHERE `id`='$id'";
					$result = mysql_query($sql);
					$date = date("d.m.Y", $row["date"]);
					$form = new formbuilder("modify", "Ändern");
					$form->date("Datum(TT.MM.JJJJ)", "date", $date);
					$form->textfield("Vertretungsfach", "lesson", $row["lesson"]);
					$form->textfield("Stunden(1;2;3.../*)", "hours", $row["hours"]);
					$form->textfield("Vertretungslehrer", "teacher", $row["teacher"]);
					$form->number("Gruppe(0 für alle)", "group", $row["group"]);
					$form->checkbox("Benachrichtigung zurücksetzen?", "reset", "1", false, false);
					$form->buildForm();
				} else {
					error("Fehlerhafter Parameter!");
				}
			} else {
				error("Fehlerhafter Parameter!");
			}
		} elseif ($_GET["id1"] == "delete" && isset($_GET["id2"]) && !empty($_GET["id2"]) && is_numeric($_GET["id2"])) {
			$id = $_GET["id2"];
			$sql = "SELECT `type`, `date`, `hours` FROM `substitution` WHERE `id`='$id' AND (`type`='0' OR `type`='1')";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if ($num > 0) {
				$row = mysql_fetch_assoc($result);
				$date = date("d.m.Y", $row["date"]);
				if (!isset($_POST["confirmform"]) || $_POST["confirm"] != 1) {
					if ($row["type"] == "1") {
						echo "<h3>Vertretung löschen</h3>";
						echo "";
						$form = new formbuilder("confirmform", "Löschen bestätigen");
						$form->infoText("Bitte bestätige, dass du diese Vertretung (".$date." - Betroffene Stunden: ".$row["hours"].") löschen möchtest!");
						$form->hidden("confirm", 1);
						$form->buildForm();
					} else {
						echo "<h3>Ausfall löschen</h3>";
						echo "";
						$form = new formbuilder("confirmform", "Löschen bestätigen");
						$form->infoText("Bitte bestätige, dass du diesen Ausfall (".$date." - Betroffene Stunden: ".$row["hours"].") löschen möchtest!");
						$form->hidden("confirm", 1);
						$form->buildForm();
					}
				} else {
					$sql = "DELETE FROM `substitution` WHERE `id` = '$id'";
					if (mysql_query($sql)) {
						if ($row["type"] == "1") {
							info("Die Vertretung (".$date." - Betroffene Stunden: ".$row["hours"].") wurde erfolgreich gelöscht!");
						} else {
							info("Der Ausfall (".$date." - Betroffene Stunden: ".$row["hours"].") wurde erfolgreich gelöscht!");
						}
						$sql = "UPDATE `settings` SET `value`='".time()."' WHERE `key`='updates' AND `setting`='substitution'";
						mysql_query($sql);
					} else {
						error("Der Schulblock wurde aufgrund eines Fehlers nicht gelöscht!<br>Bitte benachrichtige einen Admin!");
					}
				}
			} else {
				error("Fehlerhafter Parameter!");
			}
		} else {
			error("Fehlerhafter Parameter!");
		}
	} else {
		echo "<h3>Vertretungen <a style='float: right;' href=".$CONFIG["website"]["admin_path"]."timetable/group1/create/substitution>(Erstellen)</a></h3>";

		$result = getSubstitution(1, 1);
		echo "<table class='datatables'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>Datum</th>";
					echo "<th>Fach</th>";
					echo "<th>Stunden</th>";
					echo "<th>Lehrer</th>";
					echo "<th>Gruppe</th>";
					echo "<th>Bearbeiten</th>";
					echo "<th>Löschen</th>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			while ($row = mysql_fetch_assoc($result)) {
				echo "<tr>";
					echo "<td>".date("d.m.Y", $row["date"])."</td>";
					echo "<td>".$row["lesson"]."</td>";
					echo "<td>".$row["hours"]."</td>";
					echo "<td>".$row["teacher"]."</td>";
					echo "<td>".$row["group"]."</td>";
					echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/group1/edit/".$row["id"].">x</a></td>";
					echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/group1/delete/".$row["id"].">x</a></td>";
				echo "</tr>";
			}
			echo "</tbody>";
		echo "</table>";
		echo "<br>";

		echo "<h3>Ausfall <a style='float: right;' href=".$CONFIG["website"]["admin_path"]."timetable/group1/create/cancellation>(Erstellen)</a></h3>";

		$result = getSubstitution(0, 1);
		echo "<table class='datatables'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>Datum</th>";
					echo "<th>Stunden</th>";
					echo "<th>Gruppe</th>";
					echo "<th>Bearbeiten</th>";
					echo "<th>Löschen</th>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			while ($row = mysql_fetch_assoc($result)) {
				echo "<tr>";
					echo "<td>".date("d.m.Y", $row["date"])."</td>";
					echo "<td>".$row["hours"]."</td>";
					echo "<td>".$row["group"]."</td>";
					echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/group1/edit/".$row["id"].">x</a></td>";
					echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/group1/delete/".$row["id"].">x</a></td>";
				echo "</tr>";
			}
			echo "</tbody>";
		echo "</table>";
	}
?>