<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=9">
		<title>PSITE</title>
		<?php
			echo $html->includeJs("jquery-2.0.3.min");
			echo $html->includeJs("jquery.redirect.min");
			echo $html->includeJs("base");
			
			echo $html->includeJs("script");
			echo $html->includeCss("navstyle");
			echo $html->includeCss("style");
		?>
	</head>
		<body>
		 <?php echo $html->includeJs("webcam") ?>
		  <div id="maincontainer">
			 <div id="navi">
				<nav id="mynav">
					<ul>
						<li><a href="<?php echo BASE_PATH;?>">Home</a></li>
						
				<!---->		<li><a href="<?php echo BASE_PATH ."registration"; ?>">Registration</a></li> 
						
						<li><a href="<?php echo BASE_PATH ."records"; ?>">Records</a></li>
						<!----><li><a href="<?php echo BASE_PATH ."raffle"; ?>">Raffle</a></li>
					</ul>
				</nav>
			</div>