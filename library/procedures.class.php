<?php 
class Procedures{
	protected $_ses;
	protected $session_name;
	protected $cookieParams;
	
	function CheckInput($input){
		if($_SERVER["REQUEST_METHOD"] == "GET"){
			return $this->Clean($input);
		}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
			return $this->Clean($input);
		}
	}
	
	function Clean($val){
		return strip_tags(stripslashes($val));
	}
	
	 function sec_session_start(){
		$session_name = 'sec_session_id';
		$secure = false;
		 // This stops JavaScript being able to access the session id.
		$httponly = true;
		// Forces sessions to only use cookies.
		ini_set("session.use_cookies", 1);
		if(ini_set("session.use_only_cookies", 1) === false){
			header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
			exit();
		}
		
		// Gets current cookies params.
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"],
									$cookieParams["path"],
									$cookieParams["domain"],
									$secure,
									$httponly);
		session_name($session_name);
		session_start();		// Start the PHP session 
		session_regenerate_id();  // regenerated the session, delete the old one. 
	}
	
	function ses_destroy(){
		if(session_id() === ''){
			return false;
		}
		
		$_SESSION = [];
		
		setcookie(
			$this->session_name,
			'',
			time() - 42000,
			$this->cookieParams["path"],
			$this->cookieParams["domain"],
			$this->cookieParams["secure"],
			$this->cookieParams["httponly"]
		);
		
		return session_destroy();
		
	}
	
	 function enc_dec($action, $string){
		$output = false;
		$key = "Secret key";
		// initialization vector 
	   $iv = md5(md5($key));

	   if( $action == 'encrypt' ) {
		   $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
		   $output = base64_encode($output);
	   }
	   else if( $action == 'decrypt' ){
		   $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
		   $output = rtrim($output);
	   }
	   return $output;
	}
	
	function decodechar($val){
		$encoding = mb_detect_encoding($val, 'utf-8', true);
		return iconv($encoding, 'utf-8', $val);
	}
}