<?php
include ("functions.php");
?>
<html>
	<head>
		<title>DBLP Computer Science Bibliography</title>
		 <link href="style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<form method="post" action="index.php">
		<input type="submit" name="button-logout" value="Logout"/>
	</form>
	<div id="intestazione">
		<div id="dblp_logo">
			<p>DBLP</p>
		</div>
		<p>Computer Science Bibliography</p>
	</div>
	<div id="menunavigazione">
		<span class="menu1"><a href="index.php">Index</a></span>
		<span class="menu2"><a href="registra.php">Registrazione</a></span>
		<span class="menu3"><a href="style.css">CSS</a></span>
		<span class="menu4"><a href="recover.php">Recover</a></span>
	</div>
	<?php
		if ((isset($_POST["button-confirm"]))&&(isUniqueEmail($_POST["email"]))){
			echo "Complimenti, registrazione effettuata con successo.";
		}else{
			echo "Indirizzo email gi&agrave utilizzato";
		}
	?>	
</body>
</html>