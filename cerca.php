<?php include("functions.php"); ?>
<html>
	<head>
		<title>DBLP Computer Science Bibliography</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="jquery/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="jquery/css/flick/jquery-ui-1.8.16.custom.css"/>
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

					<!-- ***********************  AUTHOR *********************** -->
					
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

						<div id="moreAuthorsFilter">
							<input type="radio" name="primo_filtro" value="solo"> Solo
							<input type="radio" name="primo_filtro" value="altri" checked> Altri<br/>
							<input type="radio" name="secondo_filtro" value="and"> And
							<input type="radio" name="secondo_filtro" value="or" checked> Or<br/>
						</div>

					<!-- ***********************  TITLE *********************** -->
						
						<div class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-title">Title</label>
							</div>
							<input class="textform" id="input-title" name="input-title" type="text" placeholder="Inserisci titolo"/>
							<input id="add_remove_title" type="button" name="add_title" value="+" onclick="addTitle()"/>
						</div>

						<div id="title_1" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-title1">Title</label>
							</div>
							<input class="textform" id="input-title1" name="input-title1" type="text" placeholder="Inserisci titolo"/>
							<input id="add_remove_title" type="button" name="add_title" value="-" onclick="removeTitle(1)"/>
						</div>

						<div id="title_2" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-title2">Title</label>
							</div>
							<input class="textform" id="input-title2" name="input-title2" type="text" placeholder="Inserisci titolo"/>
							<input id="add_remove_title" type="button" name="add_title" value="-" onclick="removeTitle(2)"/>

						</div>

						<div id="title_3" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-title3">Title</label>
							</div>
							<input class="textform" id="input-title3" name="input-title3" type="text" placeholder="Inserisci titolo"/>
							<input id="add_remove_title" type="button" name="add_title" value="-" onclick="removeTitle(3)"/>
						</div>

						<div id="moreTitleFilter">
							<input type="radio" name="filtro_title" value="and"> And
							<input type="radio" name="filtro_title" value="or" checked> Or<br/>
						</div>

					<!-- ***********************  JOURNAL *********************** -->
	
						<div class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-journal">Journal</label>
							</div>
							<input class="textform" id="input-journal" name="input-journal" type="text" placeholder="Inserisci journal"/>
							<input id="add_remove_journal" type="button" name="add_journal" value="+" onclick="addJournal()"/>
						</div>

						<div id="journal_1" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-journal1">Journal</label>
							</div>
							<input class="textform" id="input-journal1" name="input-journal1" type="text" placeholder="Inserisci journal"/>
							<input id="add_remove_journal" type="button" name="add_journal" value="-" onclick="removeJournal(1)"/>
						</div>

						<div id="journal_2" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-journal2">Journal</label>
							</div>
							<input class="textform" id="input-journal2" name="input-journal2" type="text" placeholder="Inserisci journal"/>
							<input id="add_remove_journal" type="button" name="add_journal" value="-" onclick="removeJournal(2)"/>
						</div>

						<div id="journal_3" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-journal3">Journal</label>
							</div>
							<input class="textform" id="input-journal3" name="input-journal3" type="text" placeholder="Inserisci journal"/>
							<input id="add_remove_journal" type="button" name="add_journal" value="-" onclick="removeJournal(3)"/>
						</div>

					<!-- ***********************  CONFERENCE *********************** -->
						
						<div class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-conference">Conference</label>
							</div>
							<input class="textform" id="input-conference" name="input-conference" type="text" placeholder="Inserisci conference"/>
							<input id="add_remove_conference" type="button" name="add_conference" value="+" onclick="addConference()"/>
						</div>

						<div id="conference_1" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-conference1">Conference</label>
							</div>
							<input class="textform" id="input-conference1" name="input-conference1" type="text" placeholder="Inserisci conference"/>
							<input id="add_remove_conference" type="button" name="add_conference" value="-" onclick="removeConference(1)"/>
						</div>

						<div id="conference_2" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-conference2">Conference</label>
							</div>
							<input class="textform" id="input-conference2" name="input-conference2" type="text" placeholder="Inserisci conference"/>
							<input id="add_remove_conference" type="button" name="add_conference" value="-" onclick="removeConference(2)"/>
						</div>

						<div id="conference_3" class="formContent">
							<div id="labelText">
								<label class="labelText" for="input-conference3">Conference</label>
							</div>
							<input class="textform" id="input-conference3" name="input-conference3" type="text" placeholder="Inserisci conference"/>
							<input id="add_remove_conference" type="button" name="add_conference" value="-" onclick="removeConference(3)"/>
						</div>

					<!-- ***********************  MIN MAX YEAR *********************** -->
						
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

					<!-- ***********************  XSL CONVERSION *********************** -->
							
						<div id="select-conversion">
						<label id="conversion" for="conversion">Bibliography conversion</label>
							<select id="conversion" name="conversion">
								<option value="html">html</option>
								<option value="bibtex">BibTex</option>
								<option value="graphml">graphml</option>
								<option value="graphviz">graphviz</option>
						    </select>
						</div>
						
						<input type="submit" value="SEARCH" name="submit-search" id="submit-search" onclick="bloccaRicerche();"/>
					</form>
				<?php
			}else{
				header ("Location: index.php");
			}			
			?>
			</div>
		</div>
	<div id="waiting" class="popup_block">
		<span>Ricerca in corso...</span>
	</div>
	</body>
</html>

<script>
var j=1;
var i=1;
var z=1;
var y=1;

$('#submit-search').click(function() {
	$('body').append('<div id="fade"></div>');
	$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
	$('#waiting').fadeIn().css({ 'width': 200 });
	var popMargTop = ($('#waiting').height() + 80) / 2;
	var popMargLeft = ($('#waiting').width() + 80) / 2;
    $('#waiting').css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft,
        });
});

$(function() {
	var myTags = ["Alberto Policriti", "Angelo Montanari", "Carla Piazza", "Elio Toppano", "Giorgio Brajnik", "Paolo Omero", "Massimo Franceschet", "Ivan Scagnetto", "Vincenzo Della Mea", "Carlo Tasso", "Andrea Baruzzo", "Marino Miculan", "Antonina Dattolo", "Vito Roberto", "Luca Chittaro", "Linda Anticoli"];
	$("#input-author").autocomplete({source: myTags});
	$("#input-author1").autocomplete({source: myTags});
	$("#input-author2").autocomplete({source: myTags});
	$("#input-author3").autocomplete({source: myTags});
});

function bloccaRicerche() {
		$('#submit-search').hide();
}

// **************** AUTORE *******************

function addAuthor() {
	document.getElementById('exact_match').style.display='none';
	document.getElementById('moreAuthorsFilter').style.display='block';
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
		document.getElementById('moreAuthorsFilter').style.display='none';
	}
}

// **************** TITLE *******************

function addTitle() {
	document.getElementById('moreTitleFilter').style.display='block';
	if (j!=4) {
		$('#title_'+j).slideToggle('slow');
		j++;
	}
}
function removeTitle(id) {
	if(j!=1) {
		$('#title_'+id).slideToggle('slow');
		j--;
	}
	if (j==1) {
		document.getElementById('moreTitleFilter').style.display='none';
	}
}

// **************** JOURNAL *******************

function addJournal() {
	if (z!=4) {
		$('#journal_'+z).slideToggle('slow');
		z++;
	}
}
function removeJournal(id) {
	if(z!=1) {
		$('#journal_'+id).slideToggle('slow');
		z--;
	}
}

// **************** CONFERENCE *******************

function addConference() {
	if (y!=4) {
		$('#conference_'+y).slideToggle('slow');
		y++;
	}
}
function removeConference(id) {
	if(y!=1) {
		$('#conference_'+id).slideToggle('slow');
		y--;
	}
}

</script>