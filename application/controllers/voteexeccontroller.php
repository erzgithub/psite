<?php 
class VoteexecController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function verifyvote(){
		$p = new Procedures();
		$ve = new Voteexec();
		$currkey;
		$id;
		$values = array();
		$uservalue = array();
		$votepoints = 0;
		
		$mvpq = $ve->LoadChoices("tbl_settings", "SettingValue", true, "Where SettingName = 'MaxVotePoints'", null, null);
		$mvpr = $mvpq->fetch(PDO::FETCH_ASSOC);
		$maxcount = (int)$mvpr["SettingValue"];
		$votepoints = 0;
		
		
		if(isset($_POST["currkey"], $_POST["ac"])){
			$ac = explode(",", $_POST["ac"]);
			$count = count(array_filter($ac));
				$currkey = $p->enc_dec("decrypt", str_replace(" ", "+", $_POST["currkey"]));
				$vp1 = array(":ID" => $currkey);
			/*	*/$vp = $this->RecordHistory($ve, $vp1);
				$votepoints = (int)$vp["VotePoints"];
				$vp = ($maxcount - $votepoints);
				if($count > $vp){
					echo 0;
				}else{
						if(!is_numeric($currkey)){
							echo "Invalid ID";
						}else{
							$uservalue[":ID"] = $currkey;
								if($count > 0){
									for($i = 0; $i < $count; $i++){
											$values[":ID"] = filter_var($ac[$i], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);//str_replace("v", "", $ac[$i]);
										//	$ve->updateData("tbl_persons", "TotalVotes = 0", $values, true, "ID = :ID");
											$ve->updateData("tbl_persons", "TotalVotes = TotalVotes + 1", $values, true, "ID = :ID");
											
											  $row = $this->RecordHistory($ve, $values);
											  $voter = $this->RecordHistory($ve, $uservalue);
												$votehistory = array(":voterID" => $voter["ID"],
																 ":VoterName" => $voter["FirstName"] ." " .$voter["LastName"],
																 ":CandidateID" => $row["ID"],
																 ":CandidateName" => $row["FirstName"] ." " .$row["LastName"]);
											
											$ve->insertData("tbl_votehistory", "voterID, VoterName, CandidateID, CandidateName", ":voterID, :VoterName, :CandidateID, :CandidateName", $votehistory);
								
									}
									//$ve->updateData("tbl_persons", "VP = 0", $uservalue, true, "ID = :ID");
									$ve->updateData("tbl_persons", "VotePoints = VotePoints + " .$count, $uservalue, true, "ID = :ID");
									
										
										$ve->updateData("tbl_persons", "hasVoted = -1", $uservalue, true, "ID = :ID");
								
									//echo "Successfully voted " .$count ." candidate(s)";
									echo -5;
								}else{ 
									echo -3;
								}
						}
				}
		}else{ 
			echo -1;
		}
	}
	
	function RecordHistory($ve, $values){
		$query = $ve->LoadChoices("tbl_persons", "*", true, "Where ID = :ID", null, $values);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
}