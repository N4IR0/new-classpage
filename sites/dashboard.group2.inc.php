<?php
	if (isset($_COOKIE["group"]) && $_COOKIE["group"] == 1) {
		setcookie("group", "", time()-(3600*24*31*365));
	}
	setcookie("group", "2", time()+(3600*24*31*365), "/");
?>

<h1>Übersicht der nächsten 10 anstehenden Hausaufgaben</h1>
<table>
    <thead>
        <th>ID</th>
        <th>Fach</th>
        <th>Aufgabe</th>
        <th>Datum</th>
        <th>Verbleibende Tage</th>
        <?php echo getHomework("group2");?>
    </thead>

</table>
<h1>Übersicht der anstehenden Arbeiten</h1>
<table>
    <thead>
    <th>ID</th>
    <th>Fach</th>
    <th>Beschreibung</th>
    <th>Datum</th>
    </thead>
    <tr>
        <td>
            1
        </td>
        <td>
            Englisch
        </td>
        <td>
            Vortrag auf Englisch
        </td>
        <td>
            24.12.2014
        </td>
    </tr>
</table>