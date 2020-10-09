<?php 
class TotalRecordsController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function getTotal(){
		$tr = new TotalRecords();
		$b = false;
		$condition = null;
		$values = array();
		if(isset($_POST["PK"])){
			$condition = " Where FirstName Like '%' :PK  '%' Or LastName Like '%' :PK '%' Or School Like '%' :PK '%'";
			$values[":PK"] = $_POST["PK"];
			$b = true;
		}
		
		
		$count = $tr->getRecordCount("tbl_persons", "*", $b, $condition, $values);
		$present = $tr->getRecordCount("tbl_persons", "*", true, " Where DateRegistered is not null", null);
		
		echo "Total Records: " .$count ." / Total Present: " .$present;
	}
}