<?php 
class CaptureController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function getImage($currkey){
		 /**/  $p = new Procedures();
				$c = new Capture();
				$imageid = $currkey;
				$picture = file_get_contents("php://input");
			echo $imageid;
		if(isset($picture)){
			$count = $c->getRecordCount("tbl_profiles", "*", true, "Where ImageID = :ImageID", array(":ImageID" => $imageid));
			
		/**/if($count == 1){
				$stmt = $c->updateProfile("tbl_profiles", "ImageID = ?, Image = ?", true, "ImageID = ?");
				$stmt->bindParam(1, $imageid);
				$stmt->bindParam(2, $picture, PDO::PARAM_LOB);
				$stmt->bindParam(3, $imageid);
				$stmt->execute(); 
			}else{ 
				$stmt = $c->insertProfile("tbl_profiles", "ImageID, Image", "?,?");
				$stmt->bindParam(1, $imageid);
				$stmt->bindParam(2, $picture, PDO::PARAM_LOB);
				$stmt->execute();
				 
			} 
		}
	}
}