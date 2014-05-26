<?php 

	function counts($page)
	{
		$db = new HyperCounter();
		$db->open();
			$ip 		= $_SERVER['REMOTE_ADDR'];
			$agent 		= $_SERVER["HTTP_USER_AGENT"];
			$date 		= date('m/d/Y');
			$time 		= date('H:i:s');
			$db->cookified_tits($page,$date,$time,$ip);
			$db->addinfo($ip, $agent, $date, $time);
			$db->deleterow();
		$db->close();
	}
?>