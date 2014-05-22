<?php
	function error($txt) {
		echo "<div class=error>$txt</div>";
	}

	function info($txt) {
		echo "<div class=correct>$txt</div>";
	}
function getHomework($group, $date = NULL) {
    $table = NULL;
    $timestamp = time();
    $query= "SELECT `id`, `subject`, `description`, `date`, `notify_date` FROM `homework_$group` WHERE `date` >= '$timestamp' LIMIT 10";

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
        $table.=date("d.m.Y",$row['date']);
        $table.="</td>";

        $diff = $row['date'] - $timestamp;
        $diff = floor($diff / (3600*24));


        if ($diff <= "2") {
            $table.="<td color=\"#FF0000\">";
            $table.=$diff." Tage";
            $table.="</td>";
        } elseif ($diff <= "5") {
            $table.="<td color=\"#FFFF00\">";
            $table.=$diff." Tage";
            $table.="</td>";
        } else {
            $table.="<td color=\"#008000\">";
            $table.=$diff." Tage";
            $table.="</td>";
        }



        $table.="</tr>";
    }
    return $table;
}
?>