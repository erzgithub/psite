<?php 
class ProfileController extends VanillaController{
	 
	function index(){
		$p = new Procedures();
		$values = array();
		$key = $p->Clean(str_replace(" ", "+", $_GET["p"]));
	/*	//echo $p->enc_dec("decrypt", $key);
		/**/
		$id = $p->enc_dec("decrypt", $key);
		$values[":ID"] = $id;
		 $this->Profile->getRecordCount("tbl_persons", "*", true, "Where ID = :ID", $values);
		 $pr = $this->Profile->LoadChoices("tbl_persons", "*", true, "Where ID = :ID", null, $values);
		 $Pr = $this->Profile->LoadChoices("tbl_persons", "*", true, "Where ID = :ID", null, $values);
		 
		 $exists = $this->Profile->getRecordCount("tbl_profiles", "*", true, "Where ImageID = :ID", $values);
		 
		 $password = $this->isPasswordExists($this->Profile, $values);
		 
		
		 $this->set("exists", $exists);
		 $this->set("p", $p);
		 $this->set("Pr", $Pr);
		 $this->set("key", $id);
		 $this->set("password", $password);
		/* $this->Profile->set("Profile", $profile);
		 $this->Profile->set("Pr", $pr);
		 */
		 /*
		 $row = $pr->fetch(PDO::FETCH_BOTH);
		  echo "<div style='width:260px; height:210px;border: 1px solid #000; text-align: center; vertical-align:middle; display:table-cell; margin-left: 47px; line-height:20%;'>";
			echo "<span style='padding: 0; font: 45px normal Verdana, sans-serif;'>" .$row[1]  ."</span>";
			echo "<br>";
			 echo "<span style='font: 25px normal Verdana, sans-serif;margin-top:5px;'>" .$row[2] ."</span>";
			 echo "<div style='font: 25px normal Verdana, sans-serif;margin-top:5px;'>" .$row[3] ."</div>"; 
			 echo "</div>";
			 */
	}
	
	function isPasswordExists($profile, $values){
		$query = $profile->LoadChoices("tbl_persons", "*", true, "Where ID = :ID", null, $values);
		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row["Password"];
	}
}