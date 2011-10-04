<?php if(curPageURL()=="http://46.137.24.65/myprofile.php" && isset($_SESSION["user"])) { ?>
	<?php
		if (!checkSession()) {
			echo "<h1>Dati Errati, non sei loggato.</h1>";
		}else{
			$dati_user=getUserData($_SESSION["user"]);?>
			<?php if (isset($_POST["edit_account"])) {?>
				<div id="modifica_account">
					<form name="form_modifica_account" method="post" action="myprofile.php">
						<table id="dati_vecchi">
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
						<table id="dati_nuovi">
							<tr>
								<td>Nuovo Nome:</td>
								<td><input class="inputtextform" type="text" name="nuovo_nome"/></td>
							</tr>
							<tr>
								<td>Nuovo Cognome:</td>
								<td><input class="inputtextform" type="text" name="nuovo_cognome"/></td>
							</tr>
							<tr>
								<td>Nuovo Username:</td>
								<td><input class="inputtextform" type="text" name="nuovo_username"/></td>
							</tr>
							<tr>
								<td>Nuova Email:</td>
								<td><input class="inputtextform" type="text" name="nuovo_email"/></td>
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
						<tr>
							<td>ID:</td>
							<td><?php echo $dati_user[4];?></td>
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
	<div id="cerca_autore">
		<h2>Ricerca Autore</h2>
		<form method="post" id="search" action="cerca.php">
			<input type="text" class="inputtextform" name="search"/>
			<input type="submit" value="Search" class="submitbutton" name="submit-button-search" id="submit-search"/>
		</form>
	</div>
	<div id="risultati_ricerca">
		<?php
			if (isset($_POST["submit-button-search"])) {
				echo ("<h2>Risultati ricerca per: ".$_POST["search"]."</h2>");
			$url="http://dblp.uni-trier.de/search/author?xauthor=";
			$author_search=$_POST["search"];
			$url=$url.$author_search;
			$array_xml=simplexml_load_file($url);
			}
			if ($author_search!="") {
				for ($i=0;$i<100;$i++) {
					$attr=$array_xml->author->$i->attributes();
					echo ("<li><a href="."http://dblp.uni-trier.de/rec/pers/".$attr["urlpt"]."/k>".$array_xml->author->$i."</a></li>");
				}
			}
		?>
	</div>
<?php } else if (curPageURL()=="http://46.137.24.65/pubblica.php" && isset($_SESSION["user"])) { ?>

	<?php echo "siamo in pubblica"; ?>

<?php } else if (curPageURL()=="http://46.137.24.65/listautenti.php" && isset($_SESSION["user"])) { ?>

	<?php
		if (isset($_POST["button-delete"])) {
			cancellaAccount($_POST["user-id"]);
		}
	?>

	<table id="tabella_utenti">
		<thead>
			<tr><th>Username</th><th>Nome</th><th>Cognome</th><th>Email</th></tr>
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
			<input type="image" src="button_delete.gif" width="20" height="20"id="delete_<?php echo $id; ?>" onclick="deleteAccount(<?php echo $id;?>);"/>
		</td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
	
	<form id="form_delete" method="post">
		<input type="hidden" name="user-id" id="user-id" value=""/>
		<input type="submit" name="button-delete" value="" id="button-delete"/>
	</form>

<?php } else if (curPageURL()=="http://46.137.24.65/index.php"||curPageURL()=="http://46.137.24.65") { ?>
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
<?php } else { ?>
	<h1><font color="red">ATTENZIONE! Devi loggarti per accedere al contenuto.</font></h1>
<?php } ?>


