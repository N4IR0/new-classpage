<?php

	function getSubstitution($type, $date=NULL) {
        if (!isset($date) || !is_numeric($date)) {
            $date = 0;
        } else {
            $day = date("j", $date);
            $month = date("n", $date);
            $year = date("Y", $date);
            $date = mktime(0, 0, 0, $month, $day, $year);
        }
        $sql = "SELECT `id`, `date`, `lesson`, `hours`, `teacher`, `group`, `notify_date` FROM `substitution` WHERE `date` >= '$date' ORDER BY `date`";
        $result = mysql_query($sql);
        return $result;
    }

	function error($txt) {
		echo "<div class=error>$txt</div>";
	}

	function info($txt) {
		echo "<div class=correct>$txt</div>";
	}

?>