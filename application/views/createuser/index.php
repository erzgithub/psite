<div>
	<h1>Register</h1>
	
	<form action="<?php echo BASE_PATH ."regsave/register" ?>" method="POST" name="registration_form">
		Username:<input type="text" name="username" id="txtuser"/><br>
		Password:<input type="password" name="password" id="txtpassword"/><br>
		<input type="button" value="Register" id="btnreg"/>
	</form>
</div>

<?php echo $html->includeJs("sha512") ?>
<?php echo $html->includeJs("forms") ?>
<?php echo $html->includeJs("rscript") ?>