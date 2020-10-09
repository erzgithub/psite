<?php 
class VerifyemailController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function verifythis($email = null, $id = null){
		$verify = new Verifyemail();
	
		 $values = array(":ID" => $id, ":Password" => $email);
		 $p = new Procedures();
		 $condition = "Where ID = :ID And Password = :Password And Individual = 'Member'";
		 
		 $count = $verify->getRecordCount("tbl_persons", "*", true, $condition, $values);
		 
		 if($count == 1){
			echo $p->enc_dec("encrypt", $email) ."&e=" .$p->enc_dec("encrypt", $id);
			
				$session = new SecureSessionHandler("americantechincorporated");
				session_set_save_handler($session, true);
				session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
				
				$session->start();
				
				$session->put("valid.email", $email);
				$session->put("valid.id", $id);
				
		 }else{
			echo 0;
		 }
	}
}