<?php 
class VotecancelController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function confirmCancel(){
		$p = new Procedures();
		$vc = new Votecancel();
		$s = array();
		$c = array();
		if(isset($_POST["currkey"], $_POST["id"])){
			$cid = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$currkey = $p->enc_dec("decrypt", str_replace(" ", "+", $_POST["currkey"]));
			
			$values = array(":voterID" => $currkey, ":CandidateID" => $cid);
			$s[":ID"] = $currkey;
			$c[":ID"] = $cid;
			
			$vc->removeData("tbl_votehistory", true, "voterID = :voterID And CandidateID = :CandidateID", $values);
			
			if((int)$this->PrimeLoader($vc, $s, "VotePoints") > 0){
				$vc->updateData("tbl_persons", "VotePoints = VotePoints - 1", $s, true, "ID = :ID");
			}
				
			if((int)$this->PrimeLoader($vc, $c, "TotalVotes") > 0){
				$vc->updateData("tbl_persons", "TotalVotes = TotalVotes - 1", $c, true, "ID = :ID");
			}
			echo "Vote canceled";
		}
	}
	
	function PrimeLoader($vc, $values, $key){
		$query = $vc->LoadChoices("tbl_persons", "*", true, "Where ID = :ID", null, $values);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row[$key];
	}
}