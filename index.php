<?php
include ("functions.php");
?>
<html>
	<head>
		<title>DBLP Computer Science Bibliography</title>
		 <link href="style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="universita">
			<div id="logo_uniud">
				<a href="www.uniud.it"><img src="logo_uniud.gif" alt="UNIUD"/></a>
			</div>
			<p>Universit&agrave degli studi di Udine</p>
		</div>
		<div id="intestazione">
			<div id="dblp_logo">
				<p>DBLP</p>
			</div>
			<p>Computer Science Bibliography</p>
		</div>
		<div id="menunavigazione">
			<span class="menu1"><a href="index.php">Index</a></span>
			<span class="menu2"><a href="registra.php">Registrazione</a></span>
			<span class="menu3"><a href="profilo.php">Profilo</a></span>
		</div>
		<div id="stato_sessione">
			<?php
				checkLogSession();
				$dati_utente=recoverInfo($_SESSION["user"]);
			?>
			<form method="post" action="index.php">
				<input type="submit" name="button-logout" value="Logout"/>
			</form>
		</div>
		<div id="login">
			<form method="post" action="profilo.php">
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
			<input type="submit" name="button-login" value="Log In"/>
			</form>
			<a href="record.php"><input type="button" name="registrati" value="Registrati"/></a><br/>
			<a href="recover.php">Password dimenticata?</a>
		</div>
			</body>
</html>