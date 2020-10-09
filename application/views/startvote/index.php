<?php 
	$session->start();
				
/*	if(!$session->isValid(5)){
		$session->forget();
	}
				
	echo $session->get("valid.email");
	echo $session->get("valid.id");
	*/
	
	if($session->get("valid.email") == null && $session->get("valid.id") == null){
		header("Location:". BASE_PATH);
		exit(0);
	}
	 
?>
<div id="wtag"><span>Welcome &nbsp;<?php echo $fullname ?></span>
	<div><span>Total Candidates:&nbsp;<?php echo $totalcandidates ?> &nbsp;/</span>&nbsp;Vote Points Left:<span id="vp"><?php echo $VotePoints ?> &nbsp;</span></div>
</div>


		<div id="r1">
			<a href='javascript:void(0)' id='btnProceed'>CAST VOTE</a>
		</div>

		<span id="curkey"><?php echo $currkey ?></span>
			<div id="container">
				
			</div> 
			
<?php echo $html->includeJS("vscript") ?>
<?php echo $html->includeCss("candidate") ?>