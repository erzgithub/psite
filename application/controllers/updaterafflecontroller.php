<?php 
class UpdateRaffleController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	function UpdateThis(){
		$ur = new UpdateRaffle();
		$ID = filter_var($_POST["ID"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$picked = array(":Picked" => -1);
		$ur->updateData("tbl_persons", "isPicked = :Picked", $picked, true, "ID = " .$ID);
	}
	
	function ResetRaffle(){
		$ur = new UpdateRaffle();
		$picked = array(":Picked" => 0);
		$ur->updateData("tbl_persons", "isPicked = :Picked", $picked, false, null);
		echo "Raffle has been reset";
	}
}