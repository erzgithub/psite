<?php 
class IdPrintController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader = 1;
	}
	
	function Profile(){
		 
		if(isset($_POST["FN"], $_POST["LN"], $_POST["CN"])){
			 echo "<div style='width:260px; height:210px;border: 1px solid #000; text-align: center; vertical-align:middle; display:table-cell; margin-left: 47px; line-height:20%;'>";
			echo "<span style='padding: 0; font: 45px normal Verdana, sans-serif;'>" .$_POST["FN"]  ."</span>";
			echo "<br>";
			 echo "<span style='font: 25px normal Verdana, sans-serif;margin-top:5px;'>" .$_POST["LN"] ."</span>";
			 echo "<div style='font: 25px normal Verdana, sans-serif;margin-top:5px;'>" .$_POST["CN"] ."</div>"; 
			 echo "</div>";
		}else{
			if(isset($_GET["FN"], $_GET["LN"], $_GET["CN"])){
				echo "<div style='width:260px; height:210px;border: 1px solid #000; text-align: center; vertical-align:middle; display:table-cell; margin-left: 47px; line-height:50%;'>";
				echo "<span style='padding: 0; font: 45px normal Verdana, sans-serif;'>" .$_GET["FN"]  ."</span>";
				echo "<br>";
				 echo "<span style='font: 25px normal Verdana, sans-serif;margin-top:5px;'>" .$_GET["LN"] ."</span>";
				 echo "<div style='font: 25px normal Verdana, sans-serif;margin-top:5px;'>" .$_GET["CN"] ."</div>"; 
				 echo "</div>";
				 echo "</div>";
			}
		}
	}
}