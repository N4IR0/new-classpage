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