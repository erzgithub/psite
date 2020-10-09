<?php 
class LoadhostController extends VanillaController{ 
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function loadhost($id){
		$p = new Procedures();
		$lh = new Loadhost();
		 
		if($id == null){
			//header("Location:" .BASE_PATH);
			exit(0);
		}
		
		$ID = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		  
		$query = $lh->LoadChoices("tbl_persons", "*", true, "Where (FirstName Like '%' :Key '%' Or LastName Like '%' :Key '%' Or ID Like '%' :Key '%') And isCandidate < 0", null, array(":Key" => $ID));
		$row = $query->fetch(PDO::FETCH_ASSOC);
		echo "<span id='filterhost'>" .$row["ID"] ."</span>" ."." ."<span id='hostfn'>" .ucwords($p->decodechar($row["FirstName"])) ." " .ucwords($p->decodechar($row["LastName"]));
	}
	
	function repaintscore($id){
		$p = new Procedures();
		$lh = new Loadhost();
		$ID = filter_var($id, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$trow = $this->tracerecord($lh, "tbl_votehistory", "*", "Where ID = :ID", array(":ID" => $ID));
		$hostid = isset($_POST["hostkey"]) ? filter_var($_POST["hostkey"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH) : null;
		//check existing
		$ce = $lh->countDuplicates("tbl_votehistory", "*", true, "voterID = :voterID And CandidateID = :CandidateID", array(":voterID" => $trow["voterID"], ":CandidateID" => $hostid), "voterID");
		//echo $trow["voterID"] ."/" .$hostid;
		 
		if($ce["c"] == null){
			/**/
			$checkexists = $lh->getRecordCount("tbl_persons", "*", true, "Where ID = :ID", array(":ID" => $hostid));
			if($checkexists == 1){
				/**/		$hrow = $this->gethostname($lh, array(":ID" => $hostid));
				
				$this->updateCounts($lh, "tbl_persons", "TotalVotes = TotalVotes - 1", "ID = :ID", array(":ID" => $trow["CandidateID"]));
				$this->updateCounts($lh, "tbl_persons", "TotalVotes = TotalVotes + 1", "ID = :ID", array(":ID" => $hostid));
				
				$lh->updateData("tbl_votehistory", "CandidateID = :CandidateID, CandidateName = :CandidateName", array(
										":CandidateID" => $hrow["ID"],
										":CandidateName" => $hrow["FirstName"] ." " .$hrow["LastName"],
										":ID" => $ID
									), true, "ID = :ID");
							echo "Execute successfully";
			}else{ 
				echo 1;
				return false;
				exit(0);
			}
		
		}else{
			//duplicate exists
			echo 0;
		}
	}
	
	function tracerecord($lh, $tablename, $field, $condition, $value){
		$query = $lh->LoadChoices($tablename, $field, true, $condition, null, $value);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	function updateCounts($lh, $tablename, $fieldname, $condition = null, $array){
		$lh->updateData($tablename, $fieldname, $array, true, $condition);
	}
	
	function gethostname($lh, $array){
		$query = $lh->LoadChoices("tbl_persons", "*", true, "Where ID = :ID", null, $array);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
}