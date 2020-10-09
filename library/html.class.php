<?php 
class HTML{
	private $js = array();
	
	function sanitize($data){
		return mysql_real_escape_string($data);
	}
	
	function includeJs($filename){
		$data = "<script type='text/javascript' lang='javascript' src='" .BASE_PATH ."public/js/" .$filename .".js'></script>";
		return $data;
	}
	
	function includeCss($filename){
		$data = "<link rel='stylesheet' type='text/css' href='" .BASE_PATH ."public/css/" .$filename .".css'>";
		return $data;
	}
}
?>