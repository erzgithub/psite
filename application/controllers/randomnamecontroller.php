<?php 
class RandomNameController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	function RandomPick(){
		$rn = new RandomName();
		$p = new Procedures();
		
		$condition = "Where isPicked = 0 Or isPicked is null";
		$ch = $rn->LoadChoices("tbl_persons","*", true, $condition, "Order by rand() Limit 1;");
		$rowCount = $rn->getRecordCount("tbl_persons", "*", true, $condition);
		 if($rowCount > 0){
			$row = $ch->fetch(PDO::FETCH_BOTH);
				
				
				$qc = $rn->getRecordCount("tbl_profiles", "*", true, "Where ImageID = :ImageID", array(":ImageID" => $row["ID"]));	
				
				if((int)$qc > 0){
					$qp = $rn->LoadChoices("tbl_profiles", "*", true, "Where ImageID = :ImageID", null, array(":ImageID" => $row["ID"]));
					$rows = $qp->fetch(PDO::FETCH_ASSOC);
					echo "<div><img id='randpic' src='" .BASE_PATH ."display?p=" .$p->enc_dec("encrypt",$row["ID"]) ."' height='120' width='120'/></di>";
				} 
				
			//	echo "<div><img id='randpic' src='" .BASE_PATH ."picture/showimage?ik=" .$p->enc_dec("encrypt", $row[9]) ."' height='90' width='90'/></div>";
				echo "<div id='cname'>Name: " .ucwords($p->decodechar($row["FirstName"])) ." " .$p->decodechar($row["LastName"]) ." " ."</div>";
			echo "<div id='raffleid' style='display:none;'>" .$row[0] ."</div>" ."<p id='office'>School: " .$p->decodechar($row["School"]) ."</p>";
					//	."<p id='cf'> Classification: " .$row[7] ."</p>";
		 }else{
			echo "No more persons to pick";
		 }
	}
}