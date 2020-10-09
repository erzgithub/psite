<?php 
class PicController extends VanillaController{
	function __construct(){
		$this->doNotRenderHeader =1 ;
	}
	
	function picsettings(){
		echo "<div id='upcontainer'>";
			echo "<form enctype='multipart/form-data' id='pFile'>";
				echo "<div><label for='imagefile'>To update profile please select image</label>";
				echo "<div><input type='file' name='imagefile' multiple accept='image/*'/></div>";
				echo "<div><input type='hidden' name='MAX_FILE_SIZE'/></div>";
				echo "<div><input type='button' value='Upload' id='BtnUp'/></div>";
			echo "</form>";
		echo "</div>";
	}
}