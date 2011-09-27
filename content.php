<?php if(curPageURL()=="http://46.137.24.65/myprofile.php") { ?>
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
						<input type="submit" name="buttone_conferma_modifica" value="Conferma Modifiche"/>
						<input type="submit" name="buttone_annulla_modifica" value="Annulla Modifiche"/>
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
<?php } else if (curPageURL()=="http://46.137.24.65/cerca.php") { ?>
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
			}
			$url="http://dblp.uni-trier.de/search/author?xauthor=";
			$author_search=$_POST["search"];
			//$a=explode(" ",$author_search);
			//print_r($a);
			//$author=$a[0]."$ ".$a[1]."$";
			//echo ($author);
			$url=$url.$author_search;
			$array_xml=simplexml_load_file($url);
			//print_r($array_xml);
			//echo (count($b));
			if ($author_search!="") {
				for ($i=0;$i<100;$i++) {
					$attr=$array_xml->author->$i->attributes();
					//print_r($attr);
					echo ("<li><a href="."http://dblp.uni-trier.de/rec/pers/".$attr["urlpt"]."/k>".$array_xml->author->$i."</a></li>");
				}
			}
		?>
	</div>
<?php } else if (curPageURL()=="http://46.137.24.65/pubblica.php") { ?>

	<?php echo "siamo in pubblica"; ?>

<?php } ?>


