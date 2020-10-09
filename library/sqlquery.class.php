<?php 
class SQLQuery{
	protected $_query;
	protected $_table;
	protected $_database;
	
	function connect(){
		$this->_database = new Database();
		$this->_database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	
	function AutoLoad($tableName, $records, $position, $items_per_group, $Orderby, $withCondition = false, $condition = null){
		if($withCondition == true){
			$sql = "Select " .$records ." From " .$tableName ." " .$condition ." " .$Orderby ." Limit " .$position ."," .$items_per_group;
		}else{
			$sql = "Select " .$records ." From " .$tableName ." "  .$Orderby ." Limit " .$position ."," .$items_per_group;
		}
		   //echo $sql;
		$query = $this->_database->prepare($sql);
		$query->execute();
		return $query;
	}
	
	function getRecordCount($tableName, $records, $wCondition = false, $condition = null, $array = null){
		if($wCondition == true){
			$sql = "Select " .$records ." From " .$tableName ." " .$condition;
		}else{
			$sql = "Select " .$records ." From " .$tableName;
		}
		 //echo $sql;
		$query = $this->_database->prepare($sql);
		$query->execute($array);
		return $query->rowCount();
	}
	
	function LoadChoices($tableName, $records, $wCondition = false, $condition = null, $sortby = null, $array = null){
		if($wCondition == true){
			$sql = "Select " .$records ." From " .$tableName ." " .$condition ." " .$sortby;
		}else{
			$sql = "Select " .$records ." From " .$tableName ." " .$sortby;
		}
		//echo $sql;
		$query = $this->_database->prepare($sql);
		$query->execute($array);
		return $query;
	}
	
	function insertData($tableName, $fields, $values, $array){
		$sql = "Insert into " .$tableName ."(" .$fields .") Values (" .$values .")";
		/**/$query = $this->_database->prepare($sql);
		$query->execute($array);
		return $query->rowCount();
	}
	
	function updateData($tableName, $fields, $array, $wc = false, $cond = null){
		if($wc == true){
			$sql = "Update " .$tableName ." Set " .$fields ." Where " .$cond;
		}else{
			$sql = "Update " .$tableName ." Set " .$fields;
		}
		/*echo $sql;*/
		$query = $this->_database->prepare($sql);
		$query->execute($array);
	}
	
	function ConnClose(){
		$this->_database = null;
	}
	
	function insertProfile($tablename, $fields, $values){
		$sql = "Insert into " .$tablename ."(" .$fields .") Values (" .$values .")";
		$query = $this->_database->prepare($sql);
		return $query;
	}
	
	function removeData($tableName, $wc = false, $condition, $array){
		if($wc == true){
			$sql = "Delete From " .$tableName ." Where " .$condition;
		}else{ 
			$sql = "Delete From " .$tableName;
		}
		 
		$query = $this->_database->prepare($sql);
		$query->execute($array);
	}
	
	function updateProfile($tableName, $fields, $wc = false, $condition = null){
		
		if($wc == true){
			$sql = "Update " .$tableName ." set " .$fields . " Where " .$condition;
		}else{
			$sql = "Update " .$tableName ." set " .$fields;
		}
		
		$query = $this->_database->prepare($sql);
		return $query;
	}
	
	function countDuplicates($tablename, $fields, $wc = false, $condition, $array, $firstfield){
		if($wc == true){
			$sql = "Select " .$fields .",count(*) as c From " .$tablename ." Where " .$condition 
				." Group by " .$firstfield ." Having count(*) > 0";
		}else {
			$sql = "Select " .$fields .",count(*) as count From " .$tablename ." Group by " .$firstfield ." Having count(*) > 1";
		}
		$query = $this->_database->prepare($sql);
		$query->execute($array);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	function VerifyLogin($username, $password, $session){
		$sql = "Select * From tbl_uadmin Where Username = :Username";
		$query = $this->_database->prepare($sql);
		$query->execute(array(":Username" => $username));
		$row = $query->fetch(PDO::FETCH_BOTH);
		$user_id = $row["ID"];
		$salt = $row["salt"];
		
		$password = hash("sha512", $password .$salt);
		
		if($query->rowCount() == 1){
			if($this->CheckBrute($user_id)){
				return false;
			}else{ 
				if($row["Password"] == $password){
					//get the user-agent string of the user
					$user_browser = $_SERVER["HTTP_USER_AGENT"];
					//xss protection as we might print this value
					$user_id = preg_replace("/[^0-9]+/", "", $user_id);
					$session->put("valid.userid", $user_id);
					
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
					
					$session->put("valid.username", $username);
					$session->put("login.string", hash("sha512", $password, $user_browser));
					
					return true;
				}else{ 
					$now = time();
					$values = array(":User_ID" => $user_id, ":Time" => $now);
					$this->InsertData("tbl_login_attempts", "User_ID, Time", ":User_ID, :Time", $values);
					return false;
				}
			}
		}
	}
	
	function CheckBrute($userid){
		//get timestamp of current time
		$now = time();
		//all login attempts are counted from the past 2 hours
		$valid_attempts = $now - (2 * 60 * 60);
		
		$sql = "Select time From tbl_login_attempts Where User_ID = :User_ID And time > '" .$valid_attempts ."'";
		$query = $this->_database->prepare($sql);
		$query->execute(array(":User_ID" => $userid));
		
		if($query->rowCount() > 5){
			return true;
		}else{
			return false;
		}
	}
}