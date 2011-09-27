<?php
if (isset($_POST["button-logout"])) {
	session_start();
	session_destroy();
}
if (isset($_POST["button-login"])) {
	if (checkUser($_POST["username"],$_POST["password"])) {
		loginUser($_POST["username"]);
	}
}
?>
<div id="login">
	<?php if(!checkSession()) { ?>
	<form method="post" action="myprofile.php">
		<table id="indexlogin">
			<tr>
				<td>Username:</td>
				<td><input class="inputtextform" type="text" name="username"/></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input class="inputtextform" type="password" name="password"/></td>
			</tr>
		</table>
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
