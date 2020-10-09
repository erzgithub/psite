<?php 
class FrameController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function index(){
		$Db = new Database();
		$p = new Procedures();
		$key = $p->enc_dec("decrypt", $p->Clean(str_replace(" ", "+", $_GET["p"])));
		 
		/**/$Db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$sql = "Select PersonSign From tbl_persons Where EmailAddress = '" .$key ."'";
		$stmt = $Db->prepare($sql);
		$stmt->execute();
		
		$stmt->bindColumn(1, $SignPic, PDO::PARAM_LOB);
		$stmt->fetch(PDO::FETCH_BOUND);
		header("Content-Type: image/png");
		 
		echo $SignPic;
	}
}