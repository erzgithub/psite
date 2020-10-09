<?php 
class Session{
	private $_db;
	function __construct(){
		// set our custom session functions.
	   session_set_save_handler(array($this, 'open'), array($this, 'close'), array($this, 'read'), array($this, 'write'), array($this, 'destroy'), array($this, 'gc'));
	 
	   // This line prevents unexpected effects when using objects as save handlers.
	   register_shutdown_function('session_write_close');
	}
	
	function start_session($session_name, $secure) {
	   // Make sure the session cookie is not accessable via javascript.
	   $httponly = true;
	 
	   // Hash algorithm to use for the sessionid. (use hash_algos() to get a list of available hashes.)
	   $session_hash = 'sha512';
	 
	   // Check if hash is available
	   if (in_array($session_hash, hash_algos())) {
		  // Set the has function.
		  ini_set('session.hash_function', $session_hash);
	   }
	   // How many bits per character of the hash.
	   // The possible values are '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ",").
	   ini_set('session.hash_bits_per_character', 5);
	 
	   // Force the session to only use cookies, not URL variables.
	   ini_set('session.use_only_cookies', 1);
	 
	   // Get session cookie parameters 
	   $cookieParams = session_get_cookie_params(); 
	   // Set the parameters
	   session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
	   // Change the session name 
	   session_name($session_name);
	   // Now we cat start the session
	   session_start();
	   // This line regenerates the session and delete the old one. 
	   // It also generates a new encryption key in the database. 
	   session_regenerate_id(true); 
	}
	
	function open(){
		$this->_db = new Database();
		$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	
	function close(){
		$this->_db = null;
	}
	
	function read($id){
		$data = null;
		$query = $this->_db->prepare("Select * From tbl_sessions Where id = :id Limit 1");
		$query->execute(array(":id" => $id));
		$row = $query->fetch(PDO::FETCH_BOTH);
		$key = $this->getKey($id);
		$data = $this->decrypt($data, $key);
		return $data;
	}
	
	function write($id, $data){
		$key = $this->getKey($id);
		$data = $this->encrypt($data, $key);
		$time = time();
	//	echo "Id=" .$id ."/ data=" .$data ."/ key=" .$key;
		$query = $this->_db->prepare("Replace into tbl_sessions(id, set_time, data, session_key) Values (:id, :set_time, :data, :session_key)");
		$query->execute(array(":id" => $id, ":set_time" => $time, ":data" => $data, ":session_key" => $key));
		
		return true;
	}
	
	function destroy($id){
		$query = $this->_db->prepare("Delete From tbl_sessions Where id = :id");
		$query->execute(array(":id" => $id));
	}
	
	function gc($max){
		$time = time() - $max;
		$query = $this->_db->prepare("Delete From tbl_sessions Where time < :time");
		$query->execute(array(":time" => $time));
		return true;
	}
	
	function getKey($id){
		$query = $this->_db->prepare("Select session_key From tbl_sessions Where id = :id Limit 1");
		$query->execute(array(":id" => $id));
		
		if($query->rowCount() == 1){
			$row = $query->fetch(PDO::FETCH_BOTH);
			$key = $row[0];
			return $key;
		}else{
			$random_key = hash("sha512", uniqid(mt_rand(1, mt_getrandmax()), true));
			return $random_key;
		}
	}
	
	private function encrypt($data, $key) {
	   $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
	   $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
	   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	   $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
	   return $encrypted;
	}
	
	private function decrypt($data, $key) {
	   $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
	   $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
	   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	   $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
	   return $decrypted;
	}
}