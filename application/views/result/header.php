<!DOCTYPE html>
<html>
	<head>
		<?php echo $html->includeCss("reset") ?>
		<?php echo $html->includeCss("cheader") ?>
	</head>
		<body>
			<header>
				<div id="navcontainer">
					<nav>
						<ul class="menu">
							<li><a href="<?php echo BASE_PATH ?>">Home</a></li>
							<li id="sep"><a href="<?php echo BASE_PATH ."records" ?>">Records</a></li>
						</ul>
					</nav>
				</div>
			</header>