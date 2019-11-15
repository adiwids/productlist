<?php
require_once('config.db.php');
class Koneksi{
	var $host = MYSQL_HOST;
	var $port = MYSQL_PORT;
	var $user = MYSQL_USER;
	var $pass = MYSQL_PASS;
	var $conn = NULL;
	var $db = MYSQL_DB;
	
	function __construct(){
		$this->selectdb($this->connect());
	}
	
	function connect(){
		$this->conn = mysql_connect($this->host.':'.$this->port, $this->user, $this->pass);
	}
	
	function selectdb(){
		if(!$this->conn){
			return NULL;
		}else{
			mysql_select_db($this->db);
		}
	}
	
	function execQuery($sql){
		$query = NULL;		
		$i = 0;
		if(!$this->conn){
			return -1;
		}else{						
			$query = mysql_query($sql, $this->conn);
			if(strtolower(substr($sql,0,1)) == 's'){
				if($this->recordCount($sql) > 1){
					while($rs = mysql_fetch_assoc($query)){
						$result[$i]= $rs;
						$i++;
					}				
				}else{
					$result = mysql_fetch_assoc($query);
				}			
				return $result;
			}
			if(strtolower(substr($sql,0,1)) == 'i' || strtolower(substr($sql,0,1)) == 'u' || strtolower(substr($sql,0,1)) == 'd'){
				return $this->rowAffected();
			}
		}
	}
	
	function recordCount($sql){
		$query = NULL;
		if(!$this->conn){			
			return 0;
		}else{			
			$query = mysql_query($sql, $this->conn);
			return mysql_num_rows($query);
		}
	}
	
	function preview($sql){
		echo "<pre>\n".print_r($this->execQuery($sql))."\n</pre>";		
	}
	
	function rowAffected(){
		return mysql_affected_rows();
	}
}
?>
