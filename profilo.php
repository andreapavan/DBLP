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
		<div id="contenuto_utente">
			<h1>The DBLP Computer Science Bibliography</h1>
			<h2>Search</h2>
		</div>
	</body>
</html>