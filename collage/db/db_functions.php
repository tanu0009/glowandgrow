<?php
class DB{
	var $Host 		= DB_HOST;		// Hostname of our MySQL server
	var $Database 	= DB_NAME;		// Logical database name on that server
	var $User 		= DB_USER;		// Database user
	var $Password 	= DB_PASS;		// Database user's password
	var $Query_ID 	= 0;			// Result of most recent mysql_query()
	var $Record 	= array();		// Current mysql_fetch_array()-result
	var $Errno 		= 0;			// Error state of query
	var $Error 		= "";
	var $Row;						// Current row number
	var $Link_ID; 					// Result of mysql_connect()
	
	function conn_halt($msg){
		$this->http_header();
		$json = '{"SERVER_ERROR":"'.$msg.'","ERROR_NO":"'.$this->Errno.'","ERROR_MSG":"'.$this->Error.'"}';
		echo $json;
		die();
	}
	
	function halt($msg){
		$this->http_header();
		$json = '{"DB_ERROR":"'.$this->space_injection($msg).'","ERROR_MSG":"'.$this->Error.'"}';
		$sql = "insert into query_error_log (fail_query, event_log) values ('".$this->no_injection($json)."', 'salon_wser');";
		mysqli_query($this->Link_ID, $sql);
		return 0;
		die();
	}
	
	function connect(){
		
		if(!$this->Link_ID){
			$this->Link_ID = mysqli_connect ($this->Host, $this->User, $this->Password, $this->Database);
			
			mysqli_set_charset($this->Link_ID, "utf8");
			date_default_timezone_set("Asia/Kolkata");
			if(mysqli_connect_errno()){
				$this->Errno = mysqli_connect_errno();
				$this->Error = mysqli_connect_error();
				$this->conn_halt("Link_ID == false, connect failed");
			}
		}
		return true;
	}
	
	function query($Query_String){
		if($this->connect())
		{
			$this->Row = 0;
			$this->Query_ID = mysqli_query($this->Link_ID, $Query_String);
			
			if(!$this->Query_ID)
			{
				$this->Error = mysqli_error($this->Link_ID);
				$this->halt("Invalid SQL: ".$Query_String);
				
			}
			else
			{
				return $this->Query_ID;
			}
		}
		else{
			$this->halt("Invalid SQL: ".$Query_String);
		}
	}
	
	function get_last_id(){
		return mysqli_insert_id($this->Link_ID); 
	}
	
	function next_record(){
		$this->Record = mysqli_fetch_array($this->Query_ID);
		$this->Row += 1;
		$this->Errno = mysqli_connect_errno();
		$this->Error = mysqli_connect_error();
		$stat = is_array($this->Record);
		if (!$stat){
			mysqli_free_result($this->Query_ID);
			$this->Query_ID = 0;
		}
		return $this->Record;
	}
	
	function num_rows(){
		return mysqli_num_rows($this->Query_ID);
	}
	
	function affected_rows(){
		return mysqli_affected_rows($this->Link_ID);
	}
	
	function optimize($tbl_name){
		$this->connect();
		$this->Query_ID = @mysqli_query("OPTIMIZE TABLE $tbl_name", $this->Link_ID);
	}
	
	function clean_results(){
		if($this->Query_ID != 0) mysqli_free_result($this->Query_ID);
	}
	
	function close(){
		if($this->Link_ID) {
			mysqli_close($this->Link_ID);
		}
	}
	
######### Check Injection ################
	function no_injection($string){
		$string = trim($string);
		$string = preg_replace('!\s+!', ' ', $string);
		$string = addslashes($string);
		return $string;
	}
	
	function space_injection($string){
		$string = preg_replace('!\s+!', ' ', $string);
		return $string;
	}
	
	function slash_remove_injection($string){
		$string = stripslashes($string);
		return $string;
	}
	
	function sql_injection($string){
		$string = trim($string);
		$string = addslashes($string);
		//$string = mysqli_real_escape_string($this->Link_ID, $string);
		return $string;
	}
######### End of Check Injection ################

######### HTTP Header ##############
	function http_header(){
		header("HTTP/1.1 400 Bad Request");
		header("Content-Type:application/json");
	}
######### HTTP Header ##############
}
?>