<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $html->includeJs("jquery-2.0.3.min") ?>
		<?php echo $html->includeJs("base") ?>
		<?php echo $html->includeCss("cheader") ?>
		<?php echo $html->includeCss("reset") ?>
	</head>
		<body>
			<header>
				<!----><div id="navcontainer">
					<nav>
						<ul class="menu">
							<li><a href="<?php echo BASE_PATH ?>">Home</a></li>
							<li id="sep"><a href="<?php echo BASE_PATH ."records" ?>">Records</a></li>
						</ul>
					</nav>
				</div>
			</header>