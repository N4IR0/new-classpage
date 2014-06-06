<?php
	echo "<h3>Schulzeit</h3>";
    echo "<p>Coming soon...</p>";

	echo "<h3>Schulfreie Tage</h3>";
	$result = getSubstitution(2);
	echo "<table class='datatables'>";
		echo "<tr>";
			echo "<th>Datum</th>";
			echo "<th>Grund</th>";
			echo "<th>Bearbeiten</th>";
			echo "<th>Löschen</th>";
		echo "</tr>";
		while ($row = mysql_fetch_assoc($result)) {
			echo "<tr>";
				echo "<td>".date("d.m.Y", $row["date"])."</td>";
				echo "<td>".$row["lesson"]."</td>";
				echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/general/edit/".$row["id"].">x</a></td>";
				echo "<td><a href=".$CONFIG["website"]["admin_path"]."timetable/general/delete/".$row["id"].">x</a></td>";
			echo "</tr>";
		}
	echo "</table>";
?>