<?php 
class VanillaController{
	protected $_controller;
	protected $_action;
	protected $_template;
	
	public $doNotRenderHeader;
	public $render;
	
	function __construct($controller, $action){
		$model = ucfirst($controller);
		$this->_action = $action;
		$this->render = 1;
		//$this->doNotRenderHeader = 0;
		$this->$model = new $model;

		$this->_template = new Template($controller, $action);
	}
	
	function set($name, $value){
		$this->_template->set($name, $value);
	}
	
	function __destruct(){
		if($this->render){
			$this->_template->render($this->doNotRenderHeader);
		}
	}
}
?>