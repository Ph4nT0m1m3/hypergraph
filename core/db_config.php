<?php
	class Config
	{
		//[Note:] Modify this only if you know what to do!
		public static $default = array(
					'driver' 		=> 'mysql',			//Database Driver 				e.g. mysql, pg, mysqlite, etc.
					'host'	   		=> 'localhost',		//Database Hostname 			e.g. localhost
					'username' 		=> 'root',			//Database Username 			e.g. root, admin, etc.
					'password' 		=> '',				//Database Password
					'database' 		=> 'db_counter',	//Database Name 				e.g. counter, datab, etc.
					'hits'			=> 'hits',			//Database Tablename for hits
					'info'			=> 'info',			//Database Tablename for info
					'max'			=> 20,				//Max Rows for Unique IP
					'expiration'	=> 3600				//Cookie Expiration Time
			);
	}
?>