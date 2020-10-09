<?php 
class CandidateController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function LoadList(){
		$list = new Candidate();
		$p = new Procedures();
		$query = $list->LoadChoices("tbl_persons", "*", true, "Where isCandidate < 0", "Order by LastName ASC", null);
		$values = array();
		$val = array();
		$countprofile = 0;
		$name;
		$classname = null;
		
		$currkey = isset($_POST["currkey"]) ? filter_var($p->enc_dec("decrypt", str_replace(" ", "+", $_POST["currkey"])), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH) : null;
		
		echo "<ul id='list'>";
		
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$values[":ID"] = $row["ID"];
			$val[":cID"] = $row["ID"];
			$val[":ID"] = $currkey;
			$countprofile = $list->getRecordCount("tbl_profiles", "*", true, "Where ImageID = :ID", $values);

			$countexists = $list->getRecordCount("tbl_votehistory", "*", true, "Where CandidateID = :cID And voterID = :ID", $val);
			
			if($countexists == 1){
				$name = "Cancel";
				$classname = " cancel";
			}else{
				$name = "Vote";
				$classname = null;
			}
			
			echo "<li>";
				echo "<div class='dcontainer'>";
					if($countprofile == 1){
						echo "<div class='piccontainer'><img class='picture' src='" .BASE_PATH ."display?p=" .$p->enc_dec("encrypt", $row["ID"]) ."' width='70' height='70'/>" ."</div>";
					}else{ 
						echo "<div class='piccontainer'><img class='picture' src='" .BASE_PATH ."img/nophoto.png' width='70' height='70'/></div>";
					}
					echo "<p class='cname'>"
								.ucwords($p->decodechar($row["FirstName"])) ." " .ucwords($p->decodechar($row["LastName"]))
							."</p>";
					
					echo "<div class='school" .$row["ID"] ." school sc'>";
							echo "<p>" .ucwords($p->decodechar($row["School"])) ."</p>";
							echo "<p>" .ucwords($p->decodechar($row["Region"])) ."</p>";
					echo "</div>";
				 
					
					echo 	"<div class='vcontrol'>"
								."<p><a href='javascript:void(0)' class='btnvote" .$classname ."' id='v" .$row["ID"] ."'>" .$name ."</a></p>" 
							."</div>"	;				
				 
				echo "</div>";
			echo "</li>";
	/*		if($countprofile == 1){
				echo "<li>"
						."<div class='dcontainer'>"
						."<div>"
						."<div class='piccontainer'><img class='picture' src='" .BASE_PATH ."display?p=" .$p->enc_dec("encrypt", $row["ID"]) ."' width='70' height='70'/>" ."</div>";		
				echo 	 "</div>";
				
			}else{ 
				echo "<li>"
						."<div class='dcontainer'>"
						."<div>"
						."<div class='piccontainer'><img class='picture' src='" .BASE_PATH ."img/nophoto.png' width='70' height='70'/></div></div>";
			}
			echo "<div>";
			echo "<span class='cname'>"
								.ucwords($p->decodechar($row["FirstName"])) ." " .ucwords($p->decodechar($row["LastName"]))
							."</span>";
			echo "<div>"
						."<p class='school'>" .ucwords($p->decodechar($row["School"])) ."</p>"
				 ."</div>";	
				 
			echo "</div>";
			
			echo 	"<div>"
						."<a href='javascript:void(0)' class='btnvote" .$classname ."' id='v" .$row["ID"] ."'>" .$name ."</a>" 
					."</div>"
					
					."</div>";
			echo "</li>";
			*/
		}
		
		echo "</ul>";
	}
}