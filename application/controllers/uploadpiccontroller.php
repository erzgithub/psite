<?php 
class UploadpicController extends VanillaController{ 
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function savepic(){
		$p = new Procedures();
		$up = new Uploadpic();
		$values = array();
		
		if(is_uploaded_file($_FILES["imagefile"]["tmp_name"]) && 
				getimagesize($_FILES["imagefile"]["tmp_name"])){
			$size = getimagesize($_FILES["imagefile"]["tmp_name"]);
			$type = $size["mime"];
			$currid = isset($_POST["imageID"]) ? $p->enc_dec("decrypt", str_replace(" ", "+", $_POST["imageID"])) : null;
			$imageid = filter_var($currid, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$img = fopen($_FILES["imagefile"]["tmp_name"], "rb");
			$size = $size[3];
			$name = $_FILES["imagefile"]["name"];
			$maxsize = 2000000;
			
			$values[":ID"] = $imageid;
			
			$count = $up->getRecordCount("tbl_profiles", "*", true, "Where imageID = :ID", $values);
			
			
		/**/	if($_FILES["imagefile"]["size"] < $maxsize){
				$uppic = new Uploadpic();
				
				if($count == 0){
					$stmt = $uppic->insertProfile("tbl_profiles", "ImageID, Image", "?,?");
					$stmt->bindParam(1, $imageid);
					$stmt->bindParam(2, $img, PDO::PARAM_LOB);
					$stmt->execute();
				}else{
					$stmt = $uppic->updateProfile("tbl_profiles", "ImageID = ?, Image = ?", true, "ImageID = ?");
					$stmt->bindParam(1, $imageid);
					$stmt->bindParam(2, $img, PDO::PARAM_LOB);
					$stmt->bindParam(3, $imageid);
					$stmt->execute();
				}
				
				echo "Profile successfully updated refresh the page to see the effect";
			} 
		}
	}
}