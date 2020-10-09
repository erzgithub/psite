<?php 
class LogoutController extends VanillaController{ 
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function confirmlogout(){
		$session = new SecureSessionHandler("cheese");
		session_set_save_handler($session, true);
		session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
		
		$session->start();
		
		$session->put("login.string", null);
		
		header("Location:" .BASE_PATH ."adminlogin");
	}
}