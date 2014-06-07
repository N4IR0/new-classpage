<?php

	if (isset($_GET["id1"]) && !empty($_GET["id1"])) {
		if ($_GET["id1"] == "create") {
			if ($_GET["id2"] == "freeday") {
				echo "<h3>Neuen schulfreien Tag anlegen</h3>";
				echo "<br>";
				echo "<fieldset>";
				echo "<center><form method='post'>";
							echo "<p><label>Datum(TT.MM.JJJJ):</label>";
							echo "<input type='text' class='datepicker' name='date' data-validation='date' data-validation-format='dd.mm.yyyy'></p>";
							echo "<p><label>Grund:</label>";
							echo "<input type='text' class='datepicker' name='reason'></p>";
							echo "<p><input class='button-submit' type='submit' value='Anlegen' name='submit'></p>";
				echo "</form></center>";
				echo "</fieldset>";
			} elseif ($_GET["id2"] == "schooltime") {

			} else {
				error("Fehlerhafter Paramter!");
			}
		} elseif ($_GET["id1"] == "edit") {

		} elseif ($_GET["id1"] == "delete") {

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