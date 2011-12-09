<?php include("functions.php"); ?>
<html>
	<head>
		<title>DBLP Computer Science Bibliography</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
	</head>
	<body>
		<div id="intestazione">
			<div id="titolo">
				<div id="dblp_logo">
					<p>DBLP</p>
				</div>
				<p>Computer Science Bibliography</p>
			</div>
			<div id="logo_uniud">
				<a href="http://www.uniud.it"><img src="img/logo_uniud.gif" alt="UNIUD"/></a>
			</div>
		</div>
		<div id="wrapper">
			<div id="sidebar">
				<?php include("sidebar.php");?>
			</div>
			<div id="menu">
				<span class="menu1"><a href="index.php">Home</a></span>
				<?php
				session_start();
				if (isset($_SESSION["user"])) {?>
				<span class="menu2 selected2"><a href="myprofile.php">My Profile</a></span>
				<span class="menu3"><a href="cerca.php">Cerca</a></span>
				<span class="menu4"><a href="history.php">History</a></span>
				<span class="menu5"><a href="myfiles.php">MyFiles</a></span>
				<?php }
				if ($_SESSION["user"]=="admin") {?>
				<span class="menu5"><a href="listautenti.php">Lista Utenti</a></span>
				<?php } 
				?>
			</div>
			<div id="content">
			<?php
			if(isset($_SESSION["user"])) {
				$dati_user=getUserData($_SESSION["user"]);
				if (isset($_POST["bottone_conferma_modifica"])) {
					modifyUserData();
				}else if(isset($_POST["edit_account"])) {?>
					<div id="modifica_account">
					<form name="form_modifica_account" method="post" action="myprofile.php">
						<table id="dati_profilo">
							<tr>
								<td>Nome:</td>
								<td><input class="inputtextform" type="text" name="nuovo_nome" id="nome" autocomplete="off" onblur="checkNome(); checkForm();" value="<?php echo $dati_user[0];?>"/></td>
								<td><span class="statoform" id="invalid-nome">Valore non valido</span><span class="statoform" id="valid-nome">OK</span></td>
							</tr>
							<tr>
								<td>Cognome:</td>
								<td><input class="inputtextform" type="text" name="nuovo_cognome" id="cognome" autocomplete="off" onblur="checkCognome(); checkForm();" value="<?php echo $dati_user[1];?>"/></td>
								<td><span class="statoform" id="invalid-cognome">Valore non valido</span><span class="statoform" id="valid-cognome">OK</span></td>
							</tr>
							<tr>
								<td>Username:</td>
								<td><input class="inputtextform" type="text" name="nuovo_username" id="username" autocomplete="off" onblur="checkUsername(); checkForm();" value="<?php echo $dati_user[2];?>"/></td>
								<td><span class="statoform" id="invalid-username">Valore non valido. Solo lettere, numeri, e i segni . _ -</span><span class="statoform" id="valid-username">OK</span></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><input class="inputtextform" type="text" name="nuovo_email" id="email" autocomplete="off" onblur="checkEmail(); checkForm();" value="<?php echo $dati_user[3];?>"/></td>
								<td><span class="statoform" id="invalid-email">Valore non valido</span><span class="statoform" id="valid-email">OK</span></td>
							</tr>
							<tr>
								<td><input type="button" id="cambia_password" class="yes" value="Cambia Password"/></td>
							</tr>
							<div id="new_password">
								<tr id="new_password1">
									<td>Nuova Password:</td>
									<td><input class="inputtextform" type="password" name="nuovo_password" placeholder="Nuova password" id="password" onblur="checkPassword(); checkForm();"/></td>
									<td><span class="statoform" id="invalid-password">Min 6, Max 12 caratteri</span><span class="statoform" id="valid-password">OK</span></td>
								</tr>
								<tr id="new_password2">
									<td>Conferma Password:</td>
									<td><input class="inputtextform" type="password" name="nuovo_confirm_password" placeholder="Conferma password" id="confirmpassword" onkeyup="checkConfirmPassword(); checkForm();"/></td>
									<td><span class="statoform" id="invalid-confirmpassword">Le due password non coincidono</span><span class="statoform" id="valid-confirmpassword">OK</span>
								</tr>
							</div>
						</table>
						<input class="warning" type="submit" name="bottone_conferma_modifica" value="Conferma" id="bottone-conferma" disabled="disabled" onclick="checkForm();"/>
						<input class="confirmed" type="submit" name="bottone_annulla_modifica" value="Annulla"/>
					</form>
				</div>
				<?php
				}else{ 
				?>
				<div id="profilo_utente">
					<table id="dati_profilo">
						<tr>
							<td>Nome:</td>
							<td><?php echo $dati_user[0];?></td>			
						</tr>
						<tr>
							<td>Cognome:</td>
							<td><?php echo $dati_user[1];?></td>
						</tr>
						<tr>
							<td>Username:</td>
							<td><?php echo $dati_user[2];?></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><?php echo $dati_user[3];?></td>
						</tr>
					</table>
					
					<form method="post" id="edit_account" action="myprofile.php">
						<input type="submit" value="Edit Account" name="edit_account"/>
					</form>
				</div>
				<?php
				} 
				?>
			<?php
			}else{
				header("Location: index.php");
			}?>
			</div>
		</div>
	</body>
</html>
<script>
	
	$(document).ready(function() {
		checkNome();
		checkCognome();
		checkUsername();
		checkEmail();
		checkForm();
	});

	function checkForm() {
		if ($('#cambia_password').hasClass('yes')) {
			if ($('#nome').hasClass('ok') & ($('#cognome').hasClass('ok')) & $('#email').hasClass('ok') & $('#username').hasClass('ok')) {
				$('#bottone-conferma').removeAttr('disabled');
				$('#bottone-conferma').addClass('confirmed');
				$('#bottone-conferma').removeClass('warning');
			}else{
				$('#bottone-conferma').attr('disabled','true');
				$('#bottone-conferma').addClass('warning');
				$('#bottone-conferma').removeClass('confirmed');
			}
		}else if ($('#cambia_password').hasClass('no')) {
			if ($('#nome').hasClass('ok') & ($('#cognome').hasClass('ok')) & $('#email').hasClass('ok') & $('#username').hasClass('ok') & $('#password').hasClass('ok') & $('#confirmpassword').hasClass('ok')) {
				$('#bottone-conferma').removeAttr('disabled');
				$('#bottone-conferma').addClass('confirmed');
				$('#bottone-conferma').removeClass('warning');
			}else{
				$('#bottone-conferma').attr('disabled','true');
				$('#bottone-conferma').addClass('warning');
				$('#bottone-conferma').removeClass('confirmed');
			}
		}
	}
	
	$('#cambia_password').click(function() {
		$('#new_password1').toggle();
		$('#new_password2').toggle();
		if ($('#cambia_password').hasClass('yes')) {
			$('#cambia_password').removeClass('yes');
			$('#cambia_password').addClass('no');
		}else{
			$('#cambia_password').addClass('yes');
			$('#cambia_password').removeClass('no');
		}
		checkForm();
	});
		
	function checkNome() {
		var expRegNome = /^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/;
		var nome = document.getElementById('nome').value;
		if (expRegNome.test(nome)){
			document.getElementById('valid-nome').style.color='green';
			document.getElementById('valid-nome').style.display='block';
			document.getElementById('invalid-nome').style.display='none';
			$('#nome').addClass('ok');
		}else{
			document.getElementById('invalid-nome').style.display='block';
			document.getElementById('valid-nome').style.display='none';
			$('#nome').removeClass('ok');
		}
	}

	function checkCognome() {
		var expRegCognome = /^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/;
		var cognome = document.getElementById('cognome').value;
		if (expRegCognome.test(cognome)){
			document.getElementById('valid-cognome').style.color='green';
			document.getElementById('valid-cognome').style.display='block';
			document.getElementById('invalid-cognome').style.display='none';
			$('#cognome').addClass('ok');
		}else{
			document.getElementById('invalid-cognome').style.display='block';
			document.getElementById('valid-cognome').style.display='none';
			$('#cognome').removeClass('ok');
		}
	}

	function checkUsername() {
		var expRegUsername = /^([a-zA-Z0-9\.\_\-])+$/;
		var username = document.getElementById('username').value;
		if (expRegUsername.test(username)){
			document.getElementById('valid-username').style.color='green';
			document.getElementById('valid-username').style.display='block';
			document.getElementById('invalid-username').style.display='none';
			$('#username').addClass('ok');
		}else{
			document.getElementById('invalid-username').style.display='block';
			document.getElementById('valid-username').style.display='none';
			$('#username').removeClass('ok');
		}
	}

	function checkPassword() {
		var expRegPassword = /^[a-zA-Z0-9\_\*\-\+\!\?\,\:\;\.\xE0\xE8\xE9\xF9\xF2\xEC\x27]{6,12}$/;
		var password = document.getElementById('password').value;
		if (expRegPassword.test(password)){
			document.getElementById('valid-password').style.color='green';
			document.getElementById('valid-password').style.display='block';
			document.getElementById('invalid-password').style.display='none';
			$('#password').addClass('ok');
		}else{
			document.getElementById('invalid-password').style.display='block';
			document.getElementById('valid-password').style.display='none';
			$('#password').removeClass('ok');
		}
	}

	function checkEmail() {
		var expRegEmail = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		var email = document.getElementById('email').value;
		if (expRegEmail.test(email)){
			document.getElementById('valid-email').style.color='green';
			document.getElementById('valid-email').style.display='block';
			document.getElementById('invalid-email').style.display='none';
			$('#email').addClass('ok');
		}else{
			document.getElementById('invalid-email').style.display='block';
			document.getElementById('valid-email').style.display='none';
			$('#email').removeClass('ok');
		}
	}

	function checkConfirmPassword() {
		var password = document.getElementById('password').value;
		var confirmpassword = document.getElementById('confirmpassword').value;
		if (password===confirmpassword & password!=''){
			document.getElementById('valid-confirmpassword').style.color='green';
			document.getElementById('valid-confirmpassword').style.display='block';
			document.getElementById('invalid-confirmpassword').style.display='none';
			$('#confirmpassword').addClass('ok');
		}else{
			document.getElementById('invalid-confirmpassword').style.display='block';
			document.getElementById('valid-confirmpassword').style.display='none';
			$('#confirmpassword').removeClass('ok');
		}
	}
</script>