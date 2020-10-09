<?php 
class IndexController extends VanillaController{
	function index(){
		//echo dirname(dirname(dirname(__FILE__))) ."\sessions";
	/*	$s = new SecureSessionHandler("cheese");
		session_set_save_handler($s, true);
		session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
		
		$s->start();
		
		if(!$s->isvalid(5)){
			$s->forget();
		}
		

			echo $s->get("valid.email");*/
			
	$session = new SecureSessionHandler("cheese");
	$session->start();
	$session->forget();
	
	
	}
}