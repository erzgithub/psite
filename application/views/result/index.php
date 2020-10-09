<div id="rcontainer">
<?php 
	 
	echo "<ul id='list'>";
			
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				 
				echo "<li>";
						echo "<div class='dcontainer'>";
					/*	*/	echo "<div>";
									$count = $res->getRecordCount("tbl_profiles", "*", true, "Where imageID = :imageID", array(":imageID" => $row["ID"]));
									if($count == 1){
										echo "<img class='picture' src='" .BASE_PATH ."display?p=" .$p->enc_dec("encrypt", $row["ID"]) ."' width='70' height='70'/>";
									}else{ 
										echo "<img class='picture' src='" .BASE_PATH ."img/nophoto.png' width='70' height='70'/>";
									}
								
						echo "</div>";
	
							echo "<p class='tcname'>" .ucwords($p->decodechar($row["FirstName"])) ." " .ucwords($p->decodechar($row["LastName"])) ."</p>";
						
					echo "<div>";
							echo "<span class='tvotes'>Total Votes: <span class='tvotecount'>" .$row["TotalVotes"] ."</span></span>";
						echo "</div>";
						
						echo "</div>";
				echo "</li>";
			}
		echo "</ul>";
?>
</div>

<?php echo $html->includeCss("candidate") ?>
 