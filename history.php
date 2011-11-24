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
				<span class="menu2"><a href="myprofile.php">My Profile</a></span>
				<span class="menu3"><a href="cerca.php">Cerca</a></span>
				<span class="menu4 selected4"><a href="history.php">History</a></span>
				<span class="menu5"><a href="myfiles.php">MyFiles</a></span>
				<?php }
				if ($_SESSION["user"]=="admin") {?>
				<span class="menu5"><a href="listautenti.php">Lista Utenti</a></span>
				<?php } 
				?>
			</div>
			<div id="content">
			<?php if(isset($_SESSION["user"])) {
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
					<?php 
					}?>
					</tbody>
				</table>
				<form method="post" action="">
					<input type="submit" name="cancella_history" value="Cancella History"/>
				</form>
			
			<?php
			}else{
			header ("Location: index.php");
			}
			?>
			</div>
		</div>
	</body>
</html>