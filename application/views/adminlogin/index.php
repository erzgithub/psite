<div>
	<span>Login</span>
		<form action="<?php echo BASE_PATH .'checklogin/verify' ?>" method="POST" name="login_form">
			Username: &nbsp; <input type="text" name="txtuser" id="txtuser"/><br>
			Password: &nbsp; <input type="password" name="txtpassword" id="txtpassword"/>
			<a href="javascript:void(0)" id="btnlogin">Login</a>&nbsp;<a href="<?php echo BASE_PATH ?>">Home</a>
		</form>
</div>
<?php echo $html->includeJs("sha512") ?>
<?php echo $html->includeJs("forms") ?>
<?php echo $html->includeJs("lscript") ?>