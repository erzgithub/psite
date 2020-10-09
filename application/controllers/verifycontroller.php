<?php 
class VerifyController extends VanillaController{
	function index(){
		$p = new Procedures();
		if(isset($_GET["p"])){
			$key = $p->Clean(str_replace(" ", "+", $_GET["p"]));
			$values = array(":PK" => $p->enc_dec("decrypt", $key));
			$condition = " Where ID = :PK";
			
			$Count = $this->Verify->getRecordCount("tbl_persons", "*", true, $condition, $values);
			
			if($Count == 1){
				$Verify = $this->Verify->LoadChoices("tbl_persons", "*", true, $condition, "", $values);
				$this->set("p", $p);
				$this->set("Count", $Count);
				$this->set("Verify", $Verify);
			}
		//$this->set("key", $key);
		}
	}
}