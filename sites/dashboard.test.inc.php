<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robert
 * Date: 21.05.14
 * Time: 16:32
 * To change this template use File | Settings | File Templates.
 *
 * !!! for testing purposes only !!!
 *
 */

function getHomework($date = NULL) {
    $table = NULL;
    if($date == NULL) {
        $query="SELECT * FROM `ḩomeworks`";
    } else {
    }
    $result= mysql_query($query);

    while($row = mysql_fetch_assoc($result)) {
        $table.="<tr>";
            $table.="<td>";
                $table.=$row['id'];
            $table.="</td>";
            $table.="<td>";
                $table.=$row['subject'];
            $table.="</td>";
            $table.="<td>";
                $table.=$row['description'];
            $table.="</td>";
            $table.="<td>";
                $table.=$row['date'];
            $table.="</td>";
        $table.="</tr>";
    }
}
?>
<br />
<h1>Übersicht der anstehenden Arbeiten</h1>
<table>
    <thead>
        <th>ID</th>
        <th>Fach</th>
        <th>Datum</th>
        <th>Wertigkeit</th>
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