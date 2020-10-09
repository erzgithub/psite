<?php 
class AllowtovoteController extends VanillaController{ 
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function granted(){
		$atv = new Allowtovote();
	 
			if(isset($_POST["ID"])){
		/*if(isset($_POST["key"], $_POST["srn"], $_POST["ID"])){*/
			// echo $this->display($atv, array(":key" => $_POST["key"], ":surname" => $_POST["srn"]), ":ID" => $_POST["ID"]);
			echo $this->display($atv, array(":ID" => $_POST["ID"]), "ID");
		} 
	}
	
	function getname(){
		$atv = new Allowtovote();
		 
		if(isset($_POST["key"], $_POST["srn"], $_POST["ID"])){
			
			 $fn = $this->display($atv, array(":ID" => $_POST["ID"]), "FirstName");
			 $ln = $this->display($atv, array(":ID" => $_POST["ID"]), "LastName");
			 $isAllowed = $this->display($atv, array(":ID" => $_POST["ID"]), "AllowedToVote");
			 echo $fn ." " .$ln;
		/*	*/ echo "<div>";
				if((int)$isAllowed == 0){
					 echo "<input type='button' id='btnallow' value='Allow'/>";
				}else if((int)$isAllowed < 0){
					 echo "&nbsp;<input type='button' id='btnvcancel' value='Cancel'/>";
				}
			 echo "</div>";
		}
	}
	
	function display($atv, $values, $return){
	//	$condition = " Where FirstName Like '%' :key '%' And LastName Like '%' :surname '%'";
		$condition = " Where ID = :ID";
		$query = $atv->LoadChoices("tbl_persons", "*", true, $condition, null, $values);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row[$return];
	}
	
	function AllowThis($id){
		$atv = new Allowtovote();
		$cid = filter_var($id, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$this->updateATV($atv, array(":ID" => $cid, ":AllowedToVote" => -1));
		echo "This record has been allowed to vote";
	}
	
	function CancelThis($id){
		$atv = new Allowtovote();
		$cid = filter_var($id, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$this->updateATV($atv, array(":ID" => $cid, ":AllowedToVote" => 0));
		echo "This record has disabled to vote";
	}
	
	function updateATV($atv, $values){
		$condition = "ID = :ID";
		$atv->updateData("tbl_persons", "AllowedToVote = :AllowedToVote", $values, true, $condition);
	}
}