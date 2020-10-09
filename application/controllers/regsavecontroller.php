<?php 
class RegsaveController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function register(){
		$p = new Procedures();
		$regsave = new Regsave();
		if(isset($_POST["username"], $_POST["password"])){
			$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$password = $_POST["password"];
			
			if(strlen($password) !=128){
				echo "Invalid password configuration";
			}
			
			$value = array(":Username" => $username);
			$count = $regsave->getRecordCount("tbl_uadmin", "*", true, "Where Username = :Username", $value);
			
			if($count > 0){
				echo "Username already exists";
			}else{ 
				$salt = hash("sha512", uniqid(mt_rand(1, mt_getrandmax()), true));
				$password = hash("sha512", $password .$salt);
				$value = array(":Username" => $username, ":Password" => $password, ":salt" => $salt);
				$regsave->InsertData("tbl_uadmin", "Username, Password, salt", ":Username,:Password,:salt", $value);
				echo "User successfully saved";
			}
		}
	}
}