<?php 
class ChoicesController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	function loadChoices(){
		$Choice = new Choices();
		$Ch = array();
		$query = $Choice->LoadChoices("tbl_regions", "*", false);
		while($row = $query->fetch(PDO::FETCH_BOTH)){
			array_push($Ch, $row[1]);
		}
		print_r(json_encode($Ch));
	}
}