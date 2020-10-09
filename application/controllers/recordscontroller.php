<?php 
class RecordsController extends VanillaController{
	 function index(){
		//$wc = isset($_POST["wc"]) ? true : false;
		$values = array();
		$wc = false;
		$category = isset($_POST["category"]) ? $_POST["category"] : null;
		$search = isset($_POST["search"]) ? $_POST["search"] : null;
		$condition = " Where " .str_replace(" ", "", $category) ." = ' :PK '";
		
		$session = new SecureSessionHandler("americantechincorporated");
		session_set_save_handler($session, true);
		session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
		
		if($category){
			$wc = true;
			$values[":PK"] = $search;
		}
			$Records = $this->Records->LoadChoices("tbl_persons", "*", $wc, $condition,"Order by ID ASC", $values);
			$RecordCount = $this->Records->getRecordCount("tbl_persons", "*", $wc, $condition, $values);
		$this->set("RecordCount", $RecordCount);
		$this->set("Records", $Records);
		$this->set("session", $session);
	 }
}