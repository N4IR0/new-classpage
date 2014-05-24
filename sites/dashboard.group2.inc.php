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
        <?php echo getScheduleData('homework', "2");?>
    </thead>

</table>
<h1>Übersicht der anstehenden Arbeiten</h1>
<table>
    <thead>
    <th>ID</th>
    <th>Fach</th>
    <th>Thema</th>
    <th>Datum</th>
    <th>Verbleibende Tage</th>
    </thead>
    <?php echo getScheduleData('tests', "2");?>
</table>