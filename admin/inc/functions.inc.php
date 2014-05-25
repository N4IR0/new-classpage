<?php

	function getDates($group, $type, $all=NULL) {
		if (!isset($type) || $type != "homework" || $type != "tests") {
			return false;
		}
		if (!isset($all)) {
			$all = 0;
		} else {
			$all = mktime(0, 0, 0);
		}
		$sql = "SELECT `id`, `subject`, `topic`, `description`, `date`, `notify_date`, `link`, `group` FROM `".$type."` WHERE `date` >= '".$all."'";
		$result = mysql_query($sql);
	}

	function error($txt) {
		echo "<div class=error>$txt</div>";
	}

	function info($txt) {
		echo "<div class=correct>$txt</div>";
	}

?>