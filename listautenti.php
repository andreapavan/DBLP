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
				<span class="menu4"><a href="history.php">History</a></span>
				<span class="menu5"><a href="myfiles.php">MyFiles</a></span>
				<?php }
				if ($_SESSION["user"]=="admin") {?>
				<span class="menu5 selected5"><a href="listautenti.php">Lista Utenti</a></span>
				<?php } 
				?>
			</div>
			
			
			<div id="content">
			<?php 
			if ($_SESSION["user"]=="admin") {
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
					<td><?php if($username=="admin") { ?>
						<span>---</span>
						<?php } else { ?>
						<input type="image" src="img/button_delete.gif" width="20" height="20" onclick="deleteAccount(<?php echo $id; ?>);"/>
						<?php } ?>
					</td>
				</tr>
				<?php 
				}?>
				</tbody>
			</table>
			
			<form id="form_delete" method="post">
				<input type="hidden" name="user-id" id="user-id" value=""/>
				<input type="submit" name="button-delete" value="" id="button-delete"/>
			</form>
			<?php
			}else{
				header ("Location: index.php");
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