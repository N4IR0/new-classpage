<?php

if (isset($_GET["id1"]) && isset($_GET["id2"])) {
    $id1 = $_GET["id1"];
    $id2 = $_GET["id2"];

    $data = getScheduleData("homework", NULL, $id2);

    $html = "<h3>Details zur Hausaufgabe Nr. ".$_GET["id2"]."</h3>";
    $html.= "<table>";
    $html.= "<tr>";
    $html.="<td>Hausaufgabe Nr.</td>";
    $html.="<td>".$data['id']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Fach</td>";
    $html.="<td>".$data['subject']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Aufgabe</td>";
    $html.="<td>".$data['topic']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Beschreibung</td>";
    $html.="<td>".$data['description']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Datum</td>";
    $html.="<td>".date("d.m.Y",$data['date'])."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Letzte Benachichtigung am</td>";
		if (empty($data['notify_date'])) {
			$html.="<td>nie</td>";
		} else {
			$html.="<td>".date("d.m.Y",$data['notify_date'])."</td>";
		}
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Lösung / Beispiel</td>";
    $html.="<td>".$data['link']."</td>";
    $html.= "</tr>";
    $html.= "</table>";
    echo $html;
}
?>
