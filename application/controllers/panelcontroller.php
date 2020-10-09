<?php 
class PanelController extends VanillaController{ 
	 
	
	function index(){
		$p = new Procedures();
		
		if($this->countexists("AllowToVote") == 0){
			$this->loaddefaults("AllowToVote", 0);
		}
		
		if($this->countexists("MaxVotePoints") == 0){
			$this->loaddefaults("MaxVotePoints", 1);
		}
		
		$session = new SecureSessionHandler("americantechincorporated");
		session_set_save_handler($session, true);
		session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
				
		$session->start();
		
		$this->set("Panel", $this->Panel);
		$this->set("session", $session);
		$this->set("atv", $this->getsettingvalue("AllowToVote"));
		$this->set("mvp", $this->getsettingvalue("MaxVotePoints"));
		
		
	}
	
	function loaddefaults($settingname, $settingvalue){
		$values = array(":SettingName" => $settingname, ":SettingValue" => $settingvalue);
		$this->Panel->insertData("tbl_settings", "SettingName, SettingValue", ":SettingName, :SettingValue", $values);
	}
	
	function countexists($settingname){
		return $this->Panel->getRecordCount("tbl_settings", "*", true, "Where SettingName = :SettingName", array(":SettingName" => $settingname));
	}
	
	function getsettingvalue($settingname){
		$query = $this->Panel->LoadChoices("tbl_settings", "*", true, "Where SettingName = :SettingName", null, array(":SettingName" => $settingname));
		return $query->fetch(PDO::FETCH_ASSOC);
	}
}