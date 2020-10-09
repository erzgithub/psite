<?php 
class ApplyController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function applysettings(){
		$apply = new Apply();
		$p = new Procedures();
		
		if(isset($_POST["atv"], $_POST["mvp"])){
			$atv1 = filter_var($_POST["atv"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$mvp = filter_var($_POST["mvp"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$atv = 0;
			if($atv1 == "Yes"){
				$atv = -1;
			}else{ 
				$atv = 0;
			}
			
			$this->execSettings($apply, "MaxVotePoints", $mvp);
			$this->execSettings($apply, "AllowToVote", $atv);
			
			echo "Settings updated successfully";
		}
	}
	
	function execSettings($apply, $fieldname, $value){
		$ar = array(":SettingValue" => $value, ":SettingName" => $fieldname);
		$condition = "SettingName = :SettingName";
		$apply->updateData("tbl_settings", "SettingValue = :SettingValue", $ar, true, $condition);
	}
	function applyAll(){
		$apply = new Apply();
		$apply->updateData("tbl_persons", "AllowedToVote = -1", null, false,null);
		echo "Success";
	}
}