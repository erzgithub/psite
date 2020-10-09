<?php 
class CheckloginController extends VanillaController{ 
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function verify(){
		$p = new Procedures();
		$cl = new CheckLogin();
		$session = new SecureSessionHandler("americantechincorporated");
		session_set_save_handler($session, true);
		session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
		
		$session->start();
		
		if(isset($_POST["txtuser"], $_POST["p"])){
			$username = filter_var($_POST["txtuser"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			
			if($cl->VerifyLogin($username, $_POST["p"], $session)){
				header("Location:" .BASE_PATH ."panel");
			}else{ 
				echo "Wrong Username or Password " ."&nbsp;" ."<a href='" .BASE_PATH ."adminlogin'>Try Again</a>";
			}
		}
	}
}