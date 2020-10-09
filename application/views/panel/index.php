<?php 
	if($session->get("login.string") == null){
		header("Location:" .BASE_PATH ."adminlogin");
		exit(0);
	}
?>
<div id="container">
		<div id="d1">
			<div>
				<span>Allow to Vote</span>
				<select id="atv">
					<?php  
								if($atv["SettingValue"] == 0){
									echo "<option>No</option>";
								}else{ 
									echo "<option>Yes</option>";
								}
					?>
				</select>
			</div>
				<br>
			<div>
				<span>Max vote points</span>
						<select id="mvp">
							<?php 
								if(!($mvp["SettingValue"] == null)){ echo "<option>" .$mvp["SettingValue"] ."</option>"; }
							?>
						</select>
			</div>
				<br>
		</div>
		
		<div id="d2">
			<div>
				<a href="<?php echo BASE_PATH ."totalvote/report" ?>">Print total Votes</a><br>
			</div>
			
			<div>
				<a href="<?php echo BASE_PATH ."totalvote/votehistory" ?>">Print vote history</a>
			</div>
			
			<div>
				<a href="<?php echo BASE_PATH ."result" ?>">Result</a>
			</div>
		</div>
		
		<div id="d3">
			<div>Allow to vote</div>
			<input type="text" id="txtID" placeholder="Input ID"/>
			<br>
			
			&nbsp;<input type="text" id="txtvsurname"/>
			
			<div id="txtresult"></div>
		</div>
		
		<div id="d4">
			<input type="button" id="btnapply" value="Apply"/>&nbsp;<a id="logout" href="<?php echo BASE_PATH ."logout/confirmlogout" ?>">Logout</a>
			<input type="button" name="applyall" value="Allow All to Vote" id="btnapplyall">
		</div>
</div>
 

<!--<div>
	<div>
		<input type="text" placeholder="Search"/>
	</div>
	<div class="voters">
	
	</div>
</div>  -->
<?php echo $html->includeJs("panel") ?>
<?php echo $html->includeCss("panel") ?>
