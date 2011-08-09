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
		<span class="menu4"><a href="profilo.php">Profilo</a></span>
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
	<div id="formregistrazione">
		<h1>Registrazione</h1>
		<table>
			<form name="registrazione" method="post" action="confirm.php">
				<tr>
					<td>Nome:</td>
					<td><input class="inputtextform" type="text" name="nome" id="nome" autocomplete="off" onblur="checkNome();"/></td>
					<td><span class="statoform" id="invalid-nome">caratteri, lettere accentate apostrofo e un solo spazio fra le parole</span><span class="statoform" id="valid-nome">OK</span></td>
				</tr>
				<tr>
					<td>Cognome:</td>
					<td><input class="inputtextform" type="text" name="cognome" id="cognome" autocomplete="off" onblur="checkCognome();"/></td>
					<td><span class="statoform" id="invalid-cognome">caratteri, lettere accentate apostrofo e un solo spazio fra le parole</span><span class="statoform" id="valid-cognome">OK</span></td>
				</tr>
				<tr>
					<td>e-mail:</td>
					<td><input class="inputtextform" type="text" name="email" id="email" autocomplete="off" onblur="checkEmail();"/></td>
					<td><span class="statoform" id="invalid-email">Invalid value</span><span class="statoform" id="valid-email">OK</span></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input class="inputtextform" type="text" name="username" id="username" autocomplete="off" onblur="checkUsername();"/></td>
					<td><span class="statoform" id="invalid-username">Valore non valido. Si possono utilizzare solo lettere, numeri, e i segni . _ -</span><span class="statoform" id="valid-username">OK</span></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input class="inputtextform" type="password" name="password" id="password" onkeyup="checkPassword();"/></td>
					<td><span class="statoform" id="invalid-password">Min 6, max 12 di caratteri, numeri, _ * – + ! ? , : ; . e lettere accentate</span><span class="statoform" id="valid-password">OK</span></td>
				</tr>
				<tr>
					<td>Conferma Password:</td>
					<td><input class="inputtextform" type="password" name="confirmpassword" id="confirmpassword" onkeyup="checkConfirmPassword();"/></td>
					<td><span class="statoform" id="invalid-confirmpassword">Le due password non coincidono</span><span class="statoform" id="valid-confirmpassword">OK</span></td>
				</tr>
				<tr>
					<td><input class="submitbutton" type="submit" name="button-confirm" value="Conferma" id="bottone-conferma"/></td>
				</tr>
				
			</form>
		</table>
	</div>
	</body>
	
	<script language="javascript">
		
		function checkNome() {
			var expRegNome = /^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/;
			var nome = document.getElementById('nome').value;
			if (expRegNome.test(nome)){
				document.getElementById('valid-nome').style.color='green';
				document.getElementById('valid-nome').style.display='block';
				document.getElementById('invalid-nome').style.display='none';
			}else{
				document.getElementById('invalid-nome').style.display='block';
				document.getElementById('valid-nome').style.display='none';
			}
		}

		function checkCognome() {
			var expRegCognome = /^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/;
			var cognome = document.getElementById('cognome').value;
			if (expRegCognome.test(cognome)){
				document.getElementById('valid-cognome').style.color='green';
				document.getElementById('valid-cognome').style.display='block';
				document.getElementById('invalid-cognome').style.display='none';
			}else{
				document.getElementById('invalid-cognome').style.display='block';
				document.getElementById('valid-cognome').style.display='none';
			}
		}

		function checkUsername() {
			var expRegUsername = /^([a-zA-Z0-9\.\_\-])+$/;
			var username = document.getElementById('username').value;
			if (expRegUsername.test(username)){
				document.getElementById('valid-username').style.color='green';
				document.getElementById('valid-username').style.display='block';
				document.getElementById('invalid-username').style.display='none';
			}else{
				document.getElementById('invalid-username').style.display='block';
				document.getElementById('valid-username').style.display='none';
			}
		}

		function checkPassword() {
			var expRegPassword = /^[a-zA-Z0-9\_\*\-\+\!\?\,\:\;\.\xE0\xE8\xE9\xF9\xF2\xEC\x27]{6,12}$/;
			var password = document.getElementById('password').value;
			if (expRegPassword.test(password)){
				document.getElementById('valid-password').style.color='green';
				document.getElementById('valid-password').style.display='block';
				document.getElementById('invalid-password').style.display='none';
			}else{
				document.getElementById('invalid-password').style.display='block';
				document.getElementById('valid-password').style.display='none';
			}
		}

		function checkEmail() {
			var expRegEmail = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			var email = document.getElementById('email').value;
			if (expRegEmail.test(email)){
				document.getElementById('valid-email').style.color='green';
				document.getElementById('valid-email').style.display='block';
				document.getElementById('invalid-email').style.display='none';
			}else{
				document.getElementById('invalid-email').style.display='block';
				document.getElementById('valid-email').style.display='none';
			}
		}

		function checkConfirmPassword() {
			var password = document.getElementById('password').value;
			var confirmpassword = document.getElementById('confirmpassword').value;
			if (password===confirmpassword){
				document.getElementById('valid-confirmpassword').style.color='green';
				document.getElementById('valid-confirmpassword').style.display='block';
				document.getElementById('invalid-confirmpassword').style.display='none';
			}else{
				document.getElementById('invalid-confirmpassword').style.display='block';
				document.getElementById('valid-confirmpassword').style.display='none';
			}
		}
	</script>
</html>