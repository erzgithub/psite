<?php 
class StartvoteController extends VanillaController{
	function index(){
		$p = new Procedures();
		if(isset($_GET["p"], $_GET["e"])){
			$values = array();
			$currkey = str_replace(" ", "+", $_GET["e"]);
			$email = $p->enc_dec("decrypt", str_replace(" ", "+", $_GET["p"]));
			$id = $p->enc_dec("decrypt", str_replace(" ", "+", $_GET["e"]));
			$values[":ID"] = $id;
			$values[":Email"] = $email;
			$condition = "Where ID = :ID And Password = :Email";
			
			$condition1 = "Where VoterID = :VoterID";
			$values1[":VoterID"] = $id;
			
			$count = $this->Startvote->getRecordCount("tbl_persons", "*", true, $condition, $values);
			
			$vp1 = $this->Startvote->getRecordCount("tbl_votehistory", "*", true, $condition1, $values1);
			
			$query = $this->Startvote->LoadChoices("tbl_persons", "*", true, $condition, null, $values);
			$totalcandidates = $this->Startvote->getRecordCount("tbl_persons", "*", true, "Where isCandidate < 0", null);
			$row = $query->fetch(PDO::FETCH_BOTH);
			$fullname = ucwords($p->decodechar($row["FirstName"])) ." " .ucwords($p->decodechar($row["LastName"]));
		
			$qmvp = $this->getValue($this->Startvote, "tbl_settings","SettingValue",array(":SettingName" => "MaxVotePoints"));
			
			$mvp = (int)$qmvp["SettingValue"];
			$vp = $vp1;//(int)$row["VP"];
			
			$votepoints = ($mvp - $vp);
			
			$this->set("id", $id);
			$this->set("fullname", $fullname);
			$this->set("currkey", $currkey);
			$this->set("totalcandidates", $totalcandidates);
			$this->set("VotePoints", $votepoints);
			
			if($count == 1){
				/*	*/$session = new SecureSessionHandler("americantechincorporated");
				session_set_save_handler($session, true);
				session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
				
				$this->set("session", $session);
			}else{
				header("Location:" .BASE_PATH);
			}
			
		}else{
			header("Location:" .BASE_PATH);
		}
		
	}
	
	function getValue($sv, $tablename, $fields, $array){
		$condition = "Where SettingName = :SettingName";
		$query = $sv->LoadChoices($tablename, $fields, true, $condition, null, $array);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
}