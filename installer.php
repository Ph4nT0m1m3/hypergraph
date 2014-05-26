<?php
	include ('core/db_config.php');
	include ('core/db_cmd.php');

	$cmd = new HyperCounter();
	$cmd->open();
		$inf = Config::$default['info'];
		$hits = Config::$default['hits'];
		$cmd->exec("CREATE TABLE IF NOT EXISTS $inf (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), addr VARCHAR(30), uagent VARCHAR(100), c_date VARCHAR(12), c_time VARCHAR(12) )");
		$cmd->exec("CREATE TABLE IF NOT EXISTS $hits (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), page char(100), h_date VARCHAR(12), h_time VARCHAR(12) )");		
	$cmd->close();
	echo "If no Error Message Shows, Installation Has Been Successful! Thank You For Using Hyper Graph";
	
?>

