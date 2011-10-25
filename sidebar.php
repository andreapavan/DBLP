<?php
if (isset($_POST["button-logout"])) {
	logout();
}
if (isset($_POST["button-login"])) {
	if (checkUser($_POST["username"],$_POST["password"])) {
		loginUser($_POST["username"]);
	}
}
?>
<div id="login">
	<?php if(!checkSession()) { ?>
	<form method="post" id="form-login" action="myprofile.php">
		<input id="username-password-login" class="inputtextform" type="text" name="username" placeholder="Username"/></br>
		<input id="username-password-login" class="inputtextform" type="password" name="password" placeholder="Password"/></br>
		<input type="submit" name="button-login" value="Log In" id="button_login"/>
	</form>
	<div id="sign_up">
		<p>Non sei ancora registrato?</p>
		<a href="signup.php">SIGN UP</a>
	</div>
	<?php } else { ?>
	<p>Benvenuto <?php echo $_SESSION["user"];?></p>
	<form method="post" action="index.php">
		<input type="submit" name="button-logout" value="Log Out" id="button_logout"/>
	</form>
	<?php } ?>
</div>
