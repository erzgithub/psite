<?php 
class SetcandidateController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function setCandidate(){
		if(isset($_POST["currkey"])){
			$currkey = filter_var($_POST["currkey"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$values = array(":ID" => $currkey);
			$fields = "isCandidate = -1";
			$this->PrimeControl($fields, $values, "set");
		}
	}
	
	function PrimeControl($fields, $values, $key){
		$sc = new Setcandidate();
		$sc->updateData("tbl_persons", $fields, $values, true, "ID = :ID");
		if($key == "set"){
			echo "This record has been set as candidate";
		}else{
			echo "This record has been reset";
		}
	}
	
	function Reset(){
		if(isset($_POST["currkey"])){
			$currkey = filter_var($_POST["currkey"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$values = array(":ID" => $currkey);
			$fields = "isCandidate = 0";
			$this->PrimeControl($fields, $values, "reset");
		}
	}
}