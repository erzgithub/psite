<?php
class RegistrationController extends VanillaController{
	function index(){
	/*	$session = new SecureSessionHandler("cheese");
		session_set_save_handler($session, true);
		session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
		
		$session->start();
		
		if($session->get("login.string") == null){
			header("Location:" .BASE_PATH);
			exit(0);
		}*/
		
	/*	$session->start();
		
		if(!$session->isvalid(5)){
			$session->forget();
		}
		
		$session->put("hello.world", "bonjour");*/
	}
	
	function extra($value = null){
		echo $value;
	}
	
	function sample(){
		echo "sample";
	}
}