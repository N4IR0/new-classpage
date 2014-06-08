<?php
	if (isset($_GET["id1"]) && !empty($_GET["id1"])) {
		if ($_GET["id1"] == "create" && isset($_GET["id2"]) && !empty($_GET["id2"])) {
			if ($_GET["id2"] == "substitution") {
				echo "<h3>Neue Vertretung anlegen</h3>";
				echo "<br>";
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
				$form = new formbuilder("create", "Anlegen");
				$form->date("Datum(TT.MM.JJJJ)", "date");
				$form->textfield("Stunden(1;2;3...)", "hours");
				$form->number("Gruppe(0 für alle)", "group");
				$form->buildForm();
			} else {
				error("Fehlerhafter Parameter!");
			}
		} elseif ($_GET["id1"] == "modify" && isset($_GET["id2"]) && !empty($_GET["id2"])) {
			$sql = "";
		} elseif ($_GET["id1"] == "delete" && isset($_GET["id2"]) && !empty($_GET["id2"])) {

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