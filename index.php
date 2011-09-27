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
				<a href="http://www.uniud.it"><img src="logo_uniud.gif" alt="UNIUD"/></a>
			</div>
		</div>
		<div id="wrapper">
			<div id="sidebar">
				<?php include("sidebar.php");?>
			</div>
			<div id="menu">
				<span class="menu1 selected1"><a href="index.php">Home</a></span>
				<?php 
				session_start();
				if (isset($_SESSION["user"])) {?>
				<span class="menu2"><a href="myprofile.php">My Profile</a></span>
				<span class="menu3"><a href="cerca.php">Cerca</a></span>
				<span class="menu4"><a href="pubblica.php">Pubblica</a></span>
				<?php } ?>
			</div>
			<div id="content">
				<p>Benvenuti nella bibliografia del dipartimento di informatica.</p>
				<?php 
				if ((isset($_POST["button-confirm"]))&&(isUniqueEmail($_POST["email"]))){
					echo "<p>Complimenti, registrazione effettuata con successo.</p>";
					insertUser();
				}else{
					echo "<p>Indirizzo email gi&agrave utilizzato</p>";
				}
				?>
			</div>
		</div>
	</body>
</html>