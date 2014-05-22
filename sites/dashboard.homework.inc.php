<?php

if (isset($_GET["id1"]) && isset($_GET["id2"])) {
    $id1 = $_GET["id1"];
    $id2 = $_GET["id2"];

    $data = getHomework(NULL,$id2);

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
    $html.="<td>".$data['description']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Beschreibung lang</td>";
    $html.="<td>n/A</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Datum</td>";
    $html.="<td>".date("d.m.Y",$data['date'])."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Benachichtigt am</td>";
    $html.="<td>".$data['notify_date']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Lösung / Beispiel</td>";
    $html.="<td>Das könnte ein LINK sein</td>";
    $html.= "</tr>";
    $html.= "</table>";
    echo $html;
}
?>
