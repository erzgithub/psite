<?php 
class BreakOutController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function Attend($id){
		$p = new Procedures();
		$bo = new BreakOut();
		$fields = "DateRegistered = date(now())";
		$values = array(":DateRegistered" => "date(now())");
		$bo->updateData("tbl_persons", $fields, null, true, "ID = " .$id);
		echo "This Record Attended Successfully";
	}
	
	function Reset($id){
		$bo = new BreakOut();
		$fields = "DateRegistered = null";
		$bo->updateData("tbl_persons", $fields, null, true, "ID = ". $id);
		echo "This Record has been Reset";
	}
}