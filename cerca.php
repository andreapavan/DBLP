<?php include("functions.php"); ?>
<html>
	<head>
		<title>DBLP Computer Science Bibliography</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
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
				<span class="menu3 selected3"><a href="cerca.php">Cerca</a></span>
				<span class="menu4"><a href="history.php">History</a></span>
				<span class="menu5"><a href="myfiles.php">MyFiles</a></span>
				<?php }
				if ($_SESSION["user"]=="admin") {?>
				<span class="menu5"><a href="listautenti.php">Lista Utenti</a></span>
				<?php } 
				?>
			</div>
			<div id="content">
			<?php if(isset($_SESSION["user"])) {
			include "query.php"
			?>
				<h2>Ricerca Pubblicazioni</h2>
					<form id="search-form" method="post" action="cerca.php">
					
						<div class="formContent">
							<div id="labelText">
								<label id="author_0" for="input-author">Autore</label>
							</div>
							<input class="textform" id="input-author" name="input-author" type="text" placeholder="Inserisci autore"/>
							<input id="add_remove_author" type="button" name="add_author" value="+" onclick="addAuthor()"/>
						</div>
						
						<div id="author_1" class="formContent">
							<div id="labelText">
								<label for="input-author1">Autore</label>
							</div>
							<input class="textform" id="input-author1" name="input-author1" type="text" placeholder="Inserisci autore"/>
							<input id="add_remove_author" type="button" name="add_author" value="-" onclick="removeAuthor(1)"/>
						</div>
						
						<div id="author_2" class="formContent">
							<div id="labelText">
								<label for="input-author2">Autore</label>
							</div>
							<input class="textform" id="input-author2" name="input-author2" type="text" placeholder="Inserisci autore"/>
							<input id="add_remove_author" type="button" name="add_author" value="-" onclick="removeAuthor(2)"/>
						</div>
						
						<div id="author_3" class="formContent">	
							<div id="labelText">
								<label for="input-author3">Autore</label>
							</div>
							<input class="textform" id="input-author3" name="input-author3" type="text" placeholder="Inserisci autore"/>
							<input id="add_remove_author" type="button" name="add_author" value="-" onclick="removeAuthor(3)"/>
						</div>
						
						<div id="exact_match" class="formContent">
							<input type="checkbox" name="exact_match" value="yes"> Match esatto</input></br>
						</div>
						
						<div id="only_these_author">
							<input type="checkbox" name="only_these_author" value="yes"> Cerca solo pubblicazioni con questi autori</input></br>
						</div>
						
						<div class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-title">Title</label>
							</div>
							<input class="textform" id="input-title" name="input-title" type="text" placeholder="Inserisci titolo"/>
						</div>
	
						<div class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-journal">Journal</label>
							</div>
							<input class="textform" id="input-journal" name="input-journal" type="text" placeholder="Inserisci journal"/>
						</div>
						
						<div class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-conference">Conference</label>
							</div>
							<input class="textform" id="input-conference" name="input-conference" type="text" placeholder="Inserisci conference"/>
						</div>
						
						<div class="formContent">
							<div id="labelText">	
								<label class="labelText" for="minYear">Min Year</label>
							</div>
							<input class="textform" id="minYear" name="minYear" type="text"/>
						</div>
						
						<div class="formContent">
							<div id="labelText">
								<label class="labelText" for="maxYear">Max Year</label>
							</div>
							<input class="textform" id="maxYear" name="maxYear" type="text"/>
						</div>
							
						<div id="select-conversion">
						<label id="conversion" for="conversion">Bibliography conversion</label>
							<select id="conversion" name="conversion">
								<option value="html">html</option>
								<option value="bibtex">BibTex</option>
								<option value="graphml">graphml</option>
								<option value="graphviz">graphviz</option>
						    </select>
						</div>
						
						<input type="submit" value="SEARCH" name="submit-search" id="submit-search"/>
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

<script>
var i=1;
function addAuthor() {
	document.getElementById('exact_match').style.display='none';
	document.getElementById('only_these_author').style.display='block';
	if (i!=4) {
		$('#author_'+i).slideToggle('slow');
		
		i++;
	}
}

function removeAuthor(id) {
	if(i!=1) {
		$('#author_'+id).slideToggle('slow');
		i--;
	}
	if (i==1) {
		document.getElementById('exact_match').style.display='block';
		document.getElementById('only_these_author').style.display='none';
	}
}
</script>