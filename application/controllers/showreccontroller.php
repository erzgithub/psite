<?php 
class ShowRecController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function showrec(){
		$showRec = new ShowRec();
		$p = new Procedures();
		$Db = new Database();
		$Db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$values = array();
		$wC = isset($_POST["wC"]) ? $_POST["wC"] : 0;
		$Condition = null;
		$PK = null;
		$cW = false;
		
		$session = new SecureSessionHandler("americantechincorporated");
		session_set_save_handler($session, true);
		session_save_path(dirname(dirname(dirname(__FILE__))) ."\sessions");
		
		$session->start();
		
		if($wC == 1){
			$cW = true;
			//$PK = isset($_POST["Condition"]) ? filter_var($_POST["Condition"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH) : null;
			$PK = isset($_POST["Condition"]) ? filter_var($_POST["Condition"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH) : null;
			$Condition = " Where FirstName Like '%' :PK  '%' Or LastName Like '%' :PK '%' Or School Like '%' :PK '%'";
			$values[":PK"] = utf8_decode($PK);
		}
		
		$scount = $showRec->getRecordCount("tbl_settings", "*", true, "Where SettingName = 'AllowToVote'", null);
		$vcount = 0;
		
		if($scount == 1){
			$query = $showRec->LoadChoices("tbl_settings", "*", true, "Where SettingName = 'AllowToVote'", null, null);
			//$query2 = $showRec->LoadChoices("tbl_persons", "*", true, "Where AllowedToVote = -1", null, null);
			//$row2 = $query2->
			$row = $query->fetch(PDO::FETCH_BOTH);
			$vcount = $row["SettingValue"];
		}
		
		$Records = $showRec->LoadChoices("tbl_persons", "*", $cW, $Condition, "Order by ID ASC", $values);
		echo "<table id='members'>" 
				."<thead>"
					."<tr>";
				if($vcount < 0){echo "<th></th>";}
				if(!($session->get("login.string") == null)){
					echo	 "<th></th>"
							."<th></th>"
							 ."<th></th>"
							 ."<th></th>"
						//	 ."<th>Picture</th>"
						//	."<th>Delete</th>"
							."<th>Edit</th>";
				}else{ 
					echo "<th></th>"
							."<th></th>";
				}
					 
				echo	
						 
						 "<th>ID</th>"
						."<th>Fist Name</th>"
						."<th>Last Name</th>"
						."<th>School</th>"
						."<th>Contact Info.</th>"
						."<th>Region</th>"
						."<th>Date Registered</th>"
					."</tr>"
				."</thead>";
		
		echo "<tbody>";
		
					while($row = $Records->fetch(PDO::FETCH_BOTH)){
						 echo "<tr>";
							if($vcount < 0){echo "<td><a href='" .BASE_PATH ."verify?p=" .$p->enc_dec("encrypt", $row["ID"]) ."' class='voteclass' id='vlink" .$row["ID"] ."'>Start Vote</a></td>";}
								/**/echo "<td><input type='button' class='Reset' id='btnReset" .$row[0] ."' value='Reset(In)'/></td>";
								echo "<td><input type='button' class='In' id='btnIn" .$row[0] ."' value='In'/></td>";
							if(!($session->get("login.string") == null)){
								echo "<td><input type='button' class='res' id='res" .$row["ID"] ."' value='Reset'/></td>";
								echo "<td><input type='button' class='sc' id='sc" .$row["ID"] ."' value='Set as Candidate'/></td>";
							//	 echo "<td><img class='zm' id='z" .$row[0] ."' src='" .BASE_PATH ."picture/showimage?ik=" .$p->enc_dec("encrypt", $row[9]) ."' height='50' width='50'/></td>";
							//	echo "<td class='delete'><a href='javascript:void(0)'><img src='" .BASE_PATH ."img/delete.png' height='20' width='20' style='border:none;'/></a></td>";
								echo "<td class='edits'><a href='javascript:void(0)' class='edit' id='" .$row["ID"] ."'><img src='" .BASE_PATH ."img/edit.png' height='20' width='20' style='border:none;'/></a></td>";
							}
							echo "<td>" .$row["ID"] ."</td>";
							echo "<td class='vID'><a href='" .BASE_PATH ."profile?p=" .$p->enc_dec("encrypt",$row[0]) ."'>" .ucwords($p->decodechar($row["FirstName"])) ."</a></td>";
							echo "<td>" .ucwords($p->decodechar($row["LastName"]))."</td>";
							echo "<td>" .ucwords($p->decodechar($row["School"]))."</td>";
							 echo "<td>" .ucwords($p->decodechar($row["CellphoneNo"]))."</td>";
							echo "<td>" .ucwords($p->decodechar($row["Region"]))."</td>";
							echo "<td>" .ucwords($p->decodechar($row["DateRegistered"]))."</td>";
						echo "</tr>";
					}
		echo "</tbody>"
		     ."</table>";
	}
}