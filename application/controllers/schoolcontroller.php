<?php 
class SchoolController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function loadSchool(){
		$p = new Procedures();
		$school = new School();
		
		if(isset($_POST["school"])){
			$id = filter_var($_POST["school"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$values = array(":ID" => $id);
			$query = $school->LoadChoices("tbl_persons", "*", true, "Where ID = :ID", null, $values);
			$row = $query->fetch(PDO::FETCH_BOTH);
			echo $row["School"];
		}else{ 
			echo "nothing";
		}
	}
}