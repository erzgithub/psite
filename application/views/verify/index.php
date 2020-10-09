<?php 

	 $row = $Verify->fetch(PDO::FETCH_ASSOC);
?>

<div id="verifycontainer">
	<div class="vwrapper">
		<?php if((int)$row["VotePoints"] <= 0 && $row["AllowedToVote"] < 0){?>
			<h1 class="line">Enter Password</h1>
		<?php }else{ 
			echo "<h1 class='line'></h1>";
			
		} ?>
	</div>
	
	<div id="vform">
		<span class="verifyer" id="verifyer"><?php echo $row["ID"] ?></span>
		<span class="forname"><?php echo ucwords($p->decodechar($row["FirstName"])) ." " .ucwords($p->decodechar($row["LastName"])) ?></span>
	</div>
	
	<div id="cbutton">
		
	</div>
</div>
	<?php if(((int)$row["hasVoted"]) < 0){
				echo "You are not allowed to vote twice";
			}else{
	?>
	
	<?php if($row["Individual"] == "Member" && (int)$row["AllowedToVote"] < 0) {?>
		<div id="ic">
			<div id="d1">
				<input type="password" id="txtemailverify"/>
			</div>

			<div id="d2">
				 <span><a href='javascript:void(0)' id='btnverify' class="button">Enter</a></span>
			</div>
		</div>
		<?php  }else{ echo "You are not allowed to vote"; } ?>
	<?php } ?>
		
<?php echo $html->includeCss("vote") ?>
