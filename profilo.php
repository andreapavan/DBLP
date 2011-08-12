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
		<div id="divsearch">
			<h2>Ricerca Autore</h2>
			<form method="get" id="search" action="profilo.php">
				<input type="text" class="inputtextform" name="search"/>
				<input type="submit" value="Search" class="submitbutton" name="submit-button-search" id="submit-search"/>
			</form>
		</div>
		<div id="contenuto">
		<?php
			if (isset($_SESSION["user"])){
				if (isset($_GET["submit-button-search"])) {
				echo ("<h2>Risultati ricerca per: ".$_GET["search"]."</h2>");
				}
				$url="http://dblp.uni-trier.de/search/author?xauthor=";
				$author_search=$_GET["search"];
				//$a=explode(" ",$author_search);
				//print_r($a);
				//$author=$a[0]."$ ".$a[1]."$";
				//echo ($author);
				$url=$url.$author_search;
				$array_xml=simplexml_load_file($url);
				//echo (count($b));
				if ($author_search!="") {
					for ($i=0;$i<count($array_xml);$i++) {
						$attr=$array_xml->author->$i->attributes();
						//print_r($attr);
						echo ("<li><a href="."http://dblp.uni-trier.de/rec/pers/".$attr["urlpt"]."/xk>".$array_xml->author->$i."</a></li>");
					}
				}
			}else{
				echo "<h2>Devi loggarti per effettuare la ricerca degli autori! Vai al <a href='index.php'>Login</a></h2>";
			}	
			?>	
		</div>		
	</body>
</html>