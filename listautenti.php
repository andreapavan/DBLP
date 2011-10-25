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
				<span class="menu1"><a href="index.php">Home</a></span>
				<?php
				session_start();
				if (isset($_SESSION["user"])) {?>
				<span class="menu2"><a href="myprofile.php">My Profile</a></span>
				<span class="menu3"><a href="cerca.php">Cerca</a></span>
				<span class="menu4"><a href="history.php">History</a></span>
				<?php }
				if ($_SESSION["user"]=="admin") {?>
				<span class="menu5 selected5"><a href="listautenti.php">Lista Utenti</a></span>
				<?php } 
				?>
			</div>
			<div id="content">
				<?php include("content.php"); ?>	
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