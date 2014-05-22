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
            $table.="<td style='color: #FF0000;'>";
            $table.=$diff." Tage";
            $table.="</td>";
        } elseif ($diff <= "5") {
            $table.= "<td style='color: #ffaf00;'>";
            $table.=$diff." Tage";
            $table.="</td>";
        } else {
            $table.="<td style='color: #008000;'>";
            $table.=$diff." Tage";
            $table.="</td>";
        }



        $table.="</tr>";
    }
    return $table;
}
	function getMonday($timestamp=NULL) {
		if (empty($timestamp)) {
			$timestamp = time();
		}
		$day = date("N", $timestamp);
		if ($day == "1") {
			$monday = strtotime("now", $timestamp);
		} elseif ($day >= "6") {
			$monday = strtotime("next monday", $timestamp);
		} else {
			$monday = strtotime("last monday", $timestamp);
		}
		return $monday;
	}
	function buildTimetable($group) {
		$timetable = NULL;
		$sql = "SELECT `id`, `mon`, `tue`, `wed`, `thu`, `fri` FROM `timetable_group".$group."`";
		$result = mysql_query($sql);
		$timetable .= "<table id='timetable'>";
		$timetable .= "<tr>";
		$timetable .= "<th>Stunde</th>";
		$timetable .= "<th>Montag</th>";
		$timetable .= "<th>Dienstag</th>";
		$timetable .= "<th>Mittwoch</th>";
		$timetable .= "<th>Donnerstag</th>";
		$timetable .= "<th>Freitag</th>";
		$timetable .= "</tr>";
		while ($row = mysql_fetch_assoc($result)) {
			$timetable .= "<tr>";
			$timetable .= "<th>$row[id]</th>";
			$day[0] = $row["mon"];
			$day[1] = $row["tue"];
			$day[2] = $row["wed"];
			$day[3] = $row["thu"];
			$day[4] = $row["fri"];
			$date = getMonday();
			for ($i = 0; $i <= 4; $i++) {
				if (empty($day[$i])) {
					$timetable .= "<td></td>";
				} else {
					$subst_sql = "SELECT `type`, `date`, `lesson`, `hours`, `teacher`, `group` FROM `substitution` WHERE `date` = $date AND (`group` = 0 OR `group` = $group) AND `hours` LIKE '%".$row["id"]."%'";
					$subst_result = mysql_query($subst_sql);
					$subst_num = mysql_num_rows($subst_result);
					if ($subst_num != 0) {
						$substitution = mysql_fetch_assoc($subst_result);
						$timetable .= "<td style='text-align: center; color: #FF0000;'>";
						if ($substitution["type"] == 0) {
							$timetable .= "<b>--</b>";
						} elseif ($substitution["type"] == 2) {
							$timetable .= "<b>--</b><br>";
							$timetable .= "$substitution[lesson]";
						} else {
							$timetable .= "<b>$substitution[lesson]</b><br>";
							$timetable .= "$substitution[teacher]";
						}
						$timetable .= "</td>";
					} else {
						$timetable .= "<td style='text-align: center;'>";
						$timetable .= $day[$i]."<br>";
						$teach_sql = "SELECT `name` FROM `teachers` WHERE `lessons` LIKE '%".$day[$i]."%'";
						$teach_result = mysql_query($teach_sql);
						$teach_num = mysql_num_rows($teach_result);
						if ($teach_num != 0) {
							$teacher = mysql_fetch_assoc($teach_result);
							$timetable .= $teacher["name"];
						} else {
							$timetable .= "nA";
						}
						$timetable .= "</td>";
					}
				}
				$date = $date + (60*60*24);
			}
			$timetable .= "</tr>";
		}
		$timetable .= "</table>";
		return $timetable;
	}
?>