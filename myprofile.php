<?php include("functions.php"); ?>
<html>
	<head>
		<title>DBLP Computer Science Bibliography</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
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
				if (!checkSession()) {
					echo "<h1>Dati Errati, non sei loggato.</h1>";
				}else{
					$dati_user=getUserData($_SESSION["user"]);
					if (isset($_POST["edit_account"])) {?>
						<div id="modifica_account">
						<form name="form_modifica_account" method="post" action="myprofile.php">
							<table id="dati_profilo">
								<tr>
									<td>Nome:</td>
									<td><input class="inputtextform" type="text" name="nuovo_nome" value="<?php echo $dati_user[0];?>"/></td>
								</tr>
								<tr>
									<td>Cognome:</td>
									<td><input class="inputtextform" type="text" name="nuovo_cognome" value="<?php echo $dati_user[1];?>"/></td>
								</tr>
								<tr>
									<td>Username:</td>
									<td><input class="inputtextform" type="text" name="nuovo_username" value="<?php echo $dati_user[2];?>"/></td>
								</tr>
								<tr>
									<td>Email:</td>
									<td><input class="inputtextform" type="text" name="nuovo_email" value="<?php echo $dati_user[3];?>"/></td>
								</tr>
							</table>
							<input type="submit" name="bottone_conferma_modifica" value="Conferma Modifiche"/>
							<input type="button" name="bottone_annulla_modifica" value="Annulla Modifiche"/>
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
							<input type="submit" value="Delete Account" name="delete_account"/>
							<input type="submit" value="Edit Account" name="edit_account"/>
						</form>
					</div>
			<?php } ?>
	<?php } ?>
	<?php } else {
		header("Location: index.php");
		}?>
			</div>
		</div>
	</body>
</html>

<script language="javascript">

	function deleteAccount(id) {
		var x=confirm("Sei sicuro di voler cancellare l'account?");
		if (x==true) {
			alert("Account cancellato");
			document.getElementById("user-id").value=id;
			document.getElementById("button-delete").click();
		}else{
			alert("Operazione annullata");
		}	
	}

</script>