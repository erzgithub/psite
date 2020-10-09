<?php 
	if($session->get("login.string") == null){
		header("Location:" .BASE_PATH ."adminlogin");
		exit(0);
	}
?>
<div id="host">
	<div id="h1">
		<span>Host:</span> &nbsp; <input type="text" id="txthost"/>
	</div>
	
	<div id="h2">
			
	</div>
</div>

<br>
<div id="rcontainer">
	
</div>
<div id="res">

</div>
<?php echo $html->includeJs("recount") ?>
<?php echo $html->includeCss("recount") ?>