<?php 
class ResultController extends VanillaController{ 
	function index(){
		$p = new Procedures();
		$query = $this->Result->LoadChoices("tbl_persons", "*", true, "Where isCandidate < 0", "Order by TotalVotes DESC", null);
		$res = $this->Result;
		$this->set("query", $query);
		$this->set("p", $p);
		$this->set("res", $res);
	}
}
