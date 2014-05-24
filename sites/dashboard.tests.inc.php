<?php

if (isset($_GET["id1"]) && isset($_GET["id2"])) {
    $id1 = $_GET["id1"];
    $id2 = $_GET["id2"];

    $data = getScheduleData("tests", NULL, $id2);

    $html = "<h3>Details zur Arbeit Nr. ".$_GET["id2"]."</h3>";
    $html.= "<table>";
    $html.= "<tr>";
    $html.="<td>Arbeit Nr.</td>";
    $html.="<td>".$data['id']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Fach</td>";
    $html.="<td>".$data['subject']."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Thema</td>";
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
    $html.="<td>Benachichtigt am</td>";
    $html.="<td>".date("d.m.Y",$data['notify_date'])."</td>";
    $html.= "</tr>";
    $html.= "<tr>";
    $html.="<td>Lösung / Beispiel</td>";
    $html.="<td>".$data['link']."</td>";
    $html.= "</tr>";
    $html.= "</table>";
    echo $html;
}
?>
