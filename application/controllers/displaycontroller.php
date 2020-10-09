<?php 
class DisplayController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function index(){
		$display = new Display();
		$p = new Procedures();
		if(isset($_GET["p"])){
			$id = str_replace(" ", "+", $_GET["p"]);
			$imageid = filter_var($p->enc_dec("decrypt", $id), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$values = array(":ID" => $imageid);
			if(is_numeric($imageid)){
				$query = $display->LoadChoices("tbl_profiles", "Image", true, "Where ImageID = :ID", null, $values);
				$row = $query->fetch(PDO::FETCH_ASSOC);
				header("Content-type: image/jpg");
				echo $row["Image"];
			}
		}
	}
}