<?php if(curPageURL()=="http://46.137.24.65/myprofile.php" && isset($_SESSION["user"])) { ?>
	<?php
		if (!checkSession()) {
			echo "<h1>Dati Errati, non sei loggato.</h1>";
		}else{
			$dati_user=getUserData($_SESSION["user"]);?>
			<?php if (isset($_POST["edit_account"])) {?>
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
			<?php }else{ ?>
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
<?php } else if (curPageURL()=="http://46.137.24.65/cerca.php" && isset($_SESSION["user"])) { ?>
	<?php include ("search.php"); ?>
<?php } else if (curPageURL()=="http://46.137.24.65/history.php" && isset($_SESSION["user"])) { ?>

	<?php
	if (isset($_POST["cancella_history"])) {
		deleteHistory($_SESSION["user"]);
	}
	?>
	
	<table id="tabella_ricerche">
		<thead>
			<tr><th>Ricerca</th><th>Data</th><th>Ora</th></tr>
		</thead>
		<tbody>
		<?php
		$utente_corrente=$_SESSION["user"];
		$connetti=mysql_connect('localhost','root','andreapavan1989');
		$sql="SELECT autore,data,ora FROM progetto.ricerche WHERE username='$utente_corrente'";
		$query=mysql_query($sql,$connetti);
		while ($values=mysql_fetch_array($query)) {
			$autore=$values["autore"];
			$data=$values["data"];
			$ora=$values["ora"];
		?>	
		<tr>
		<td><?php echo $autore; ?></td>
		<td><?php echo $data; ?></td>
		<td><?php echo $ora; ?></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
	<form method="post" action="">
		<input type="submit" name="cancella_history" value="Cancella History"/>
	</form>
	
<?php } else if (curPageURL()=="http://46.137.24.65/listautenti.php" && ($_SESSION["user"])=="admin") { ?>

	<?php
		if (isset($_POST["button-delete"])) {
			cancellaAccount($_POST["user-id"]);
		}
	?>

	<table id="tabella_utenti">
		<thead>
			<tr><th>Username</th><th>Nome</th><th>Cognome</th><th>Email</th><th>Cancella Account</th></tr>
		</thead>
		<tbody>
		<?php
		$connetti=mysql_connect('localhost','root','andreapavan1989');
		$sql="SELECT username,nome,cognome,email,id FROM progetto.utenti";
		$query= mysql_query($sql, $connetti);
		while ($values=mysql_fetch_array($query)) {
			$username=$values["username"];
			$nome=$values["nome"];
			$cognome=$values["cognome"];
			$email=$values["email"];
			$id=$values["id"];
		?>	
		<tr>
		<td><?php echo $username; ?></td>
		<td><?php echo $nome; ?></td>
		<td><?php echo $cognome; ?></td>
		<td><?php echo $email; ?></td>
		<td>
			<input type="image" src="button_delete.gif" width="20" height="20" id="delete_<?php echo $id; ?>" onclick="deleteAccount(<?php echo $id;?>);"/>
		</td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
	
	<form id="form_delete" method="post">
		<input type="hidden" name="user-id" id="user-id" value=""/>
		<input type="submit" name="button-delete" value="" id="button-delete"/>
	</form>

<?php } else if (curPageURL()=="http://46.137.24.65/index.php"||curPageURL()=="http://46.137.24.65/") { ?>
	<p>Benvenuti nella bibliografia del dipartimento di informatica</p>
	
	<?php
	if (isset($_POST["button-confirm"])) {
		if (isUniqueEmail($_POST["email"])) {
			insertUser();
			echo "<p>Complimenti, registrazione effettuata con successo.</p>";
		}else{
			echo "<p>Indirizzo email gi&agrave utilizzato</p>";
		}
	}
	?>
<?php } else {
		header("Location: index.php");
} ?>


