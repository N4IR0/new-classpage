<?php
function status($server) {
	$status = "error";
	if($ssh = ssh2_connect('v2.v-infra.de', 36251, array('hostkey'=>'ssh-rsa'))) {
    	if (ssh2_auth_pubkey_file($ssh, 'minecraft', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft.pub', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft')) {
			if ($server == "-1") {
				$sn = "";
				$if = "Service laeuft nicht\n";
			} else {
				$sn = "hg".$server;
			    $sn2 = "HG".$server;
			    $if = $sn2." laeuft nicht\n";
			}
   		    $stream = ssh2_exec($ssh,"sudo /etc/init.d/hg status ".$sn);
   		    stream_set_blocking($stream, true);
  		    $data = '';
   		    while($buffer = fread($stream, 4096)) {
		 	    $data .= $buffer;
  		    }
  		    fclose($stream);
   		    if($data != $if) {
				$status = "ok";
			} else {
				$status = "notok";
			}
    	}
	} else {
		$status = "error";
	} 
	
	 return($status);
	 
	 
	 /*
	 $stats = array("ok", "notok", "whatever");
	 $x = rand(0, 2);
	 
	 return($stats[$x]);
	 */
}

function whitelist($server, $user) {
	$status = "error";
	if($ssh = ssh2_connect('v2.v-infra.de', 36251, array('hostkey'=>'ssh-rsa'))) {
    	if (ssh2_auth_pubkey_file($ssh, 'minecraft', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft.pub', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft')) {
			$sn = "hg".$server;
   		    $stream = ssh2_exec($ssh,"screen -p 0 -S ".$sn." -X stuff $'whitelist add ".$user."\015'");
			$status = "ok";
			stream_set_blocking($stream, true);
			fclose($stream);
    	}
	} else {
		$status = "error";
	}
	return($status);
}

function select($server) {
	$status = "error";
	if($ssh = ssh2_connect('v2.v-infra.de', 36251, array('hostkey'=>'ssh-rsa'))) {
    	if (ssh2_auth_pubkey_file($ssh, 'minecraft', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft.pub', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft')) {
				$sn = "hg".$server;
   		  $stream = ssh2_exec($ssh,"sudo /etc/init.d/hg select ".$sn);
			if (status("1") == "ok" || status("0") == "ok" || status("2") == "ok" || status("3") == "ok" || status("4") == "ok") {
				sleep(55);
			} else {
				sleep(20);
			}
			$status = "ok";
			stream_set_blocking($stream, true);
			fclose($stream);
    	}
	} else {
		$status = "error";
	}
	return($status);
}

function hold($server) {
	$status = "error";
	if($ssh = ssh2_connect('v2.v-infra.de', 36251, array('hostkey'=>'ssh-rsa'))) {
    	if (ssh2_auth_pubkey_file($ssh, 'minecraft', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft.pub', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft')) {
			$sn = "hg".$server;
   		    $stream = ssh2_exec($ssh,"sudo /etc/init.d/hg hold ".$sn);
			sleep(50);
			$status = "ok";
			stream_set_blocking($stream, true);
			fclose($stream);
    	}
	} else {
		$status = "error";
	}
	return($status);
}

function service($action) {
	$status = "error";
	if($ssh = ssh2_connect('v2.v-infra.de', 36251, array('hostkey'=>'ssh-rsa'))) {
    	if (ssh2_auth_pubkey_file($ssh, 'minecraft', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft.pub', '/var/www/vhosts/lordtoad.de/live.lordtoad.de/admin/inc/secret/minecraft')) {
			if ($action == "start") {
				$ac = "start";
				$stream = ssh2_exec($ssh,"sudo /etc/init.d/hg ".$ac);
				sleep(125);
				$status = "ok";
				stream_set_blocking($stream, true);
				fclose($stream);						
			} else {
				$status = "error";
			}
    	}
	} else {
		$status = "error";
	}
	return($status);
}

function mainPfad() {
	return "/admin";
}

function error($txt) {
	echo "<div class=error>$txt</div>";
}

function info($txt) {
	echo "<div class=correct>$txt</div>";
}

?>