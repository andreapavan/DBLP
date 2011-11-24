<?php include("functions.php");
session_start();
?>
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
				if (isset($_SESSION["user"])) {?>
				<span class="menu2"><a href="myprofile.php">My Profile</a></span>
				<span class="menu3"><a href="cerca.php">Cerca</a></span>
				<span class="menu4"><a href="history.php">History</a></span>
				<span class="menu5 selected5"><a href="myfiles.php">MyFiles</a></span>
				<?php }
				if ($_SESSION["user"]=="admin") {?>
				<span class="menu5"><a href="listautenti.php">Lista Utenti</a></span>
				<?php } 
				?>
			</div>
			<div id="content">
				<div id="lista_file">
				<h1>Lista File</h1>
					<?php
					$dir = "utenti/".$_SESSION["user"];
					if (is_dir($dir)) {
					    if ($dh = opendir($dir)) {
					        while (($file = readdir($dh)) !== false) {
					        $link = "http://46.137.24.65/utenti/".$_SESSION["user"]."/".$file;
					        ?>
					        	<p><a href="<?php echo $link ?>"><?php echo $file;?></a></p>
					        <?php
					        }
					        closedir($dh);
					    }
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>