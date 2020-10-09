<?php 
class TotalvoteController extends VanillaController{ 
	 function report(){
		$fields = "FirstName,LastName,Gender,School,Region,Email,CellphoneNo,TotalVotes";
		$query = $this->Totalvote->LoadChoices("tbl_persons", $fields, false, null, "Order by TotalVotes DESC", null);
		$this->set("query", $query);
	 }
	 
	 function votehistory(){
		 $fields = "VoterName,CandidateName";
		$query = $this->Totalvote->LoadChoices("tbl_votehistory", $fields, false, null, "Order by VoterName ASC", null);
		$this->set("query", $query);
	 }
}