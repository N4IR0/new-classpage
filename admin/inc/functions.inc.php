<?php

	function getSubstitution($type, $group=NULL, $date=NULL) {
    if (!isset($date) || !is_numeric($date)) {
			$date = 0;
		} else {
			$day = date("j", $date);
			$month = date("n", $date);
			$year = date("Y", $date);
			$date = mktime(0, 0, 0, $month, $day, $year);
		}
		if (!is_numeric($type)) {
			$type = 0;
		}
		if (!isset($group) || !is_numeric($group)) {
			$sql = "SELECT `id`, `date`, `lesson`, `hours`, `teacher`, `group`, `notify_date` FROM `substitution` WHERE `date` >= '$date' AND `type` = '$type' ORDER BY `date` DESC";
		} else {
			$sql = "SELECT `id`, `date`, `lesson`, `hours`, `teacher`, `group`, `notify_date` FROM `substitution` WHERE `date` >= '$date' AND `type` = '$type' AND (`group` = '0' OR `group` = '$group') ORDER BY `date` DESC";
		}
		$result = mysql_query($sql);
		return $result;
	}

	function getSchooltime($time=NULL) {
		if (!isset($time) || !is_numeric($time)) {
			$sql = "SELECT `id`, `from`, `to`, `year` FROM `schooltime` ORDER BY `from`";
			$result = mysql_query($sql);
			return $result;
		} else {
			$sql = "SELECT `id`, `from`, `to`, `year` FROM `schooltime` WHERE `from` <= $time AND `to` >= $time";
			$result = mysql_query($sql);
			if (mysql_num_rows($result) == 0) {
				return false;
			} else {
				return true;
			}
		}
	}

	function error($txt) {
		echo "<div class=error>$txt</div>";
	}

	function info($txt) {
		echo "<div class=correct>$txt</div>";
	}

?>