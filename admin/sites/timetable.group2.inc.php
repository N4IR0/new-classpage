<?php
	echo "<h3>Vertretungen</h3>";

	$result = getSubstitution(1, 2);
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

	echo "<h3>Ausfall</h3>";

	$result = getSubstitution(0, 2);
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
?>