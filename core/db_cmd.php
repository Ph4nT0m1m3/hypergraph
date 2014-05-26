<?php
	/********************************************************************
	*********************************************************************
	*		HyperCounter Version: 1_a-5								*
	*	 	Author: Jacob Baring										+
	*		Credits to: http://codebase.eu/source/code-php/ip-counter/ 	*			
	*********************************************************************
	*********************************************************************
	*/
?>

<?php

	class HyperCounter
	{

		private $db;
		private $data;
		private $info;
		private $hits;
		private $maxrows;
		private $expiration;

		public function __construct()
		{
				$this->data 		= Config::$default;	
				$this->info 		= $this->data['info'];
				$this->hits 		= $this->data['hits'];
				$this->maxrows 		= $this->data['max'];
				$this->expiration   = time() + $this->data['expiration'];
		}

		public function open()
		{
			try
			{
				$this->db = new pdo(
									$this->data['driver'].":dbname=".
                                 	$this->data['database'].";host=".
                                  	$this->data['host'],
                                  	$this->data['username'], 
                                  	$this->data['password'] 
                                );
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

		public function query($query)
		{
			try
			{
				$q = $this->db->query($query);
				return $q;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

		public function fetchAll($query)
		{
			try
			{
				$q = $this->db->query($query)->fetchAll();
				return $q;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

		public function exec($exec)
		{
			try
			{
				$c = $this->db->exec($exec);
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

		public function close()
		{
			$this->db = null;
		}



		public function addinfo($ip, $agent, $date, $time)
		{
			$query  = "SELECT addr FROM $this->info WHERE addr = '$ip'";
			$res 	= count($this->fetchAll($query));
			if($res < 1)
			{
				$this->exec("INSERT INTO $this->info (addr, uagent, c_date, c_time) VALUES('$ip' , '$agent','$date','$time') ");
			}
		}
		
		public function addhits($page, $date, $time)
		{
				$this->exec("INSERT INTO $this->hits (page, h_date, h_time) VALUES ('$page', '$date','$time')");
		}


		public function counthits()
		{
			$query 	= "SELECT * FROM hits"; 
			$res 	= count($this->fetchAll($query));

			return $res;
		}

		public function group_by($group)
		{
			$query  = " SELECT * FROM  $this->hits GROUP BY $group ASC";
			$res 	= $this->query($query);

			return $res;
		}

		public function group_by_limit($table, $group,$limit)
		{
			$query  = " SELECT * FROM  $table GROUP BY $group ASC LIMIT $limit";
			$res 	= $this->query($query);

			return $res;
		}

		public function count($where,$value)
		{
			$query  = "SELECT * FROM $this->hits WHERE $where = '$value'";
			$res 	= count($this->fetchAll($query));

			return $res;
		}

		public function count_limit($where,$value,$limit)
		{
			$query  = "SELECT * FROM $this->hits WHERE $where = '$value' LIMIT $limit" ;
			$res 	= count($this->fetchAll($query));

			return $res;
		}
		public function where($where,$value)
		{
			$query = "SELECT * FROM $this->hits WHERE $where = '$value'";
			$res = $this->query($query);

			return $res;
		}

		public function cookified_tits($page,$date,$time,$ip)
		{
			if(!isset($_COOKIE['addr']) || !isset($_COOKIE['page']))
			{
				setcookie('addr',$ip,$this->expiration);
				setcookie('page',$page,$this->expiration);
				$this->addhits($page,$date,$time);
			}
			else
			{
				if($_COOKIE['page'] != $page)
				{
					setcookie('addr',$ip,$this->expiration);
					setcookie('page',$page,$this->expiration);
					$this->addhits($page,$date,$time);
				}
			}
		}

		//group by for dates
		public function gbl_testbuild1($table, $group,$limit)
		{
			$query  = " SELECT * FROM (SELECT * FROM  $table GROUP BY $group DESC LIMIT $limit) as test ORDER BY $group ASC";
			$res 	= $this->query($query);

			return $res;
		}

		public function count_testbuild1($table, $where, $value)
		{
			$query  = "SELECT * FROM $table WHERE $where = '$value'";
			$res 	= count($this->fetchAll($query));

			return $res;
		}

		public function deleterow()
		{
			$query 	= $this->fetchAll("SELECT * FROM $this->info");
			$res 	= count($query);
			$to_delete 	= $res - $this->maxrows;

			if($to_delete > 0)
			{
				for ($i = 1; $i <= $to_delete; $i++) 
				{
					$this->exec("DELETE FROM $this->info ORDER BY id LIMIT 1");
				}
			}
		}
		//END COUNTER FUNCTIONS
	}
?>