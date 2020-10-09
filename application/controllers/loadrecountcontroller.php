<?php
class LoadrecountController extends VanillaController{ 
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function loadlist(){
		$p = new Procedures();
		$lr = new Loadrecount();
		$wc = false;
		$values = array();
		$condition = "Where isCandidate = 0";
		$list = $lr->LoadChoices("tbl_votehistory", "*", $wc ,$condition, "Order by VoterName ASC", $values);
		
		echo "<table id='tblrecount'>";
			echo "<thead>";
			  echo "<tr>";
					echo "<th></th>";
					echo "<th>VN</th>";
					echo "<th>CN</th>";
			  echo "</tr>";
			echo "</thead>";
			
			echo "<tbody>";
				while($row = $list->fetch(PDO::FETCH_ASSOC)){
					echo "<tr>";
					//	echo "<td><input type='checkbox' class'sc' id='" .$row["ID"] ."'/></td>";
						echo "<td><input type='button' class='rexec' id='rec" .$row["ID"] ."' value='exec'/></td>";
						echo "<td>" .ucwords($p->decodechar($row["VoterName"])) ."</td>";
						echo "<td>" .ucwords($p->decodechar($row["CandidateName"])) ."</td>";
					echo "</tr>";
				}
			echo "</tbody>";
	}
}