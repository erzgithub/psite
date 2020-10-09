<?php 
class SaveController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function SaveData(){
		 $p = new Procedures();
		 $s = new Save();
		 $fields = null;
		 $Signature = null;//$_POST["Signature"];
		 $p->sec_session_start();
		$ImageKey = isset($_SESSION["ImageKey"]) ? $p->Clean($_SESSION["ImageKey"]) : null;
		   if(isset($_POST["Signature"])){$SigData = explode(",", $_POST["Signature"]); $Signature = $SigData[1];}
		 
		 if(isset($_POST["FN"]) && isset($_POST["LN"])){
				if(isset($_POST["upsig"])){
					if($_POST["upsig"] == "true"){
						$values = array(":FirstName" => $p->Clean($_POST["FN"]),
										":LastName" => $p->Clean($_POST["LN"]),
										":Email" => $p->Clean($_POST["Email"]),
									/**/	":Gender" => $p->Clean($_POST["Gender"]),
										":Address" => $p->Clean($_POST["Address"]),
										":Contact" => $p->Clean($_POST["ContactNo"]),
										":Individual" => $p->Clean($_POST["Individual"]),
										":School" => $p->Clean($_POST["School"]),
										":Region" => $p->Clean($_POST["Region"]),
										":Institution" => $p->Clean($_POST["Institution"]),
										":ID" => filter_var($_POST["PK"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH),
										":Password" => $_POST["Password"],
										":Signature" => $Signature);
					}else{
						$values = array(":FirstName" => $p->Clean($_POST["FN"]),
										":LastName" => $p->Clean($_POST["LN"]),
										":Email" => $p->Clean($_POST["Email"]),
									/**/	":Gender" => $p->Clean($_POST["Gender"]),
										":Address" => $p->Clean($_POST["Address"]),
										":Contact" => $p->Clean($_POST["ContactNo"]),
										":Individual" => $p->Clean($_POST["Individual"]),
										":School" => $p->Clean($_POST["School"]),
										":Region" => $p->Clean($_POST["Region"]),
										":ID" => filter_var($_POST["PK"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH),
										":Institution" => $p->Clean($_POST["Institution"]));			
					}	
				}else{
					$values = array(":FirstName" => $p->Clean($_POST["FN"]),
										":LastName" => $p->Clean($_POST["LN"]),
										":Email" => $p->Clean($_POST["Email"]),
									/**/	":Gender" => $p->Clean($_POST["Gender"]),
										":Address" => $p->Clean($_POST["Address"]),
										":Contact" => $p->Clean($_POST["ContactNo"]),
										":Individual" => $p->Clean($_POST["Individual"]),
										":School" => $p->Clean($_POST["School"]),
										":Region" => $p->Clean($_POST["Region"]),
										":Password" => $_POST["Password"],
										":Institution" => $p->Clean($_POST["Institution"]),
										":Signature" => $Signature,
										":VotePoints" => 0,
										":TotalVotes" => 0,
										":isCandidate" => 0,
										":AllowedToVote" => 0,
										"hasVoted" => 0);
				}
							
			 if(!isset($_POST["PK"])){
				if($s->insertData("tbl_persons", "FirstName,LastName,Email,Address,CellphoneNo,Institutional,Individual,DateRegistered,Signature,Region,Gender,School,Password,VotePoints,TotalVotes,isCandidate,AllowedToVote,hasVoted",
								":FirstName,:LastName,:Email,:Address,:Contact,:Institution,:Individual,date(now()),:Signature,:Region,:Gender,:School,:Password,:VotePoints,:TotalVotes,:isCandidate,:AllowedToVote,:hasVoted", $values) > 0){
						echo "New Record Successfully Saved!";
					}
			 }else{
					if($_POST["upsig"] == "true"){
						$fields = "FirstName = :FirstName, LastName = :LastName"
										.",CellphoneNo = :Contact, Email = :Email, Address = :Address"
										.",School = :School, Password = :Password"
										.", Gender = :Gender, Region = :Region, Institutional = :Institution, Signature = :Signature, Individual = :Individual, Signature = :Signature";
					}else{
						$fields = "FirstName = :FirstName, LastName = :LastName"
										.",CellphoneNo = :Contact, Email = :Email, Address = :Address, School = :School"
										.", Gender = :Gender, Region = :Region, Institutional = :Institution, Individual = :Individual";
										
					}
					
				/**/$s->updateData("tbl_persons", $fields, $values, true, "ID = :ID");
					$this->updateVoteHistory($s, array(":CandidateName" => $p->Clean($_POST["FN"]) ." " .$p->Clean($_POST["LN"]), ":CandidateID" => filter_var($_POST["PK"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH)));
				
				echo "Successfully updated!";
			 }
		/*	$_SESSION["ImageKey"] = null;
			$_SESSION["IK"] = null;*/
		} 
	}
	
	function updateVoteHistory($s, $values){
			$s->updateData("tbl_votehistory", "CandidateName = :CandidateName", $values, true, "CandidateID = :CandidateID");
	}
	
}