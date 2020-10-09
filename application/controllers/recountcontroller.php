<?php 
class RecountController extends VanillaController{ 
	function index(){
		$session = new SecureSessionHandler("americantechincorporated");
		session_set_save_handler($session, true);
		session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
				
		$session->start();
		$this->set("session", $session);
	}
}