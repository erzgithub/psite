<?php 
class PictureController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function showImage(){
		$picture = new Picture();
		$p = new Procedures();
		$imageKey = isset($_GET["ik"]) ?  $p->enc_dec("decrypt", str_replace(" ", "+", $_GET["ik"])) : "";
		if(isset($_GET["ik"])){
			$values = array(":ImageKey" => $imageKey);
			$row = $picture->LoadChoices("tbl_images","Picture", true, "Where ImageKey = :ImageKey", null, $values);
			if($row->rowCount() == 1){
			/* */	$row->bindColumn(1, $ProfilePic, PDO::PARAM_LOB);
				$row->fetch(PDO::FETCH_BOUND);
				header("Content-Type: image/png");
				echo $ProfilePic; 
			 } else {
				echo BASE_PATH ."";
			 }
			  
		}
	}
}