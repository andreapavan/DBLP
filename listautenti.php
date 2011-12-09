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
				if (isset($_SESSION["user"]))
				{?>
				<span class="menu2"><a href="myprofile.php">My Profile</a></span>
				<span class="menu3"><a href="cerca.php">Cerca</a></span>
				<span class="menu4"><a href="history.php">History</a></span>
				<span class="menu5"><a href="myfiles.php">MyFiles</a></span>
				<?php
				}
				if ($_SESSION["user"]=="admin")
				{
				?>
				<span class="menu5 selected5"><a href="listautenti.php">Lista Utenti</a></span>
				<?php
				} 
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
						<!--<input id="#?w=500" rel="popup_delete" class="poplight" type="button" value="cancella"/>-->
						<!--<input type="image" src="img/button_delete.gif" width="20" height="20" onclick="deleteAccount(<?php echo $id; ?>);"/>-->
						<a href="#?w=300" rel="popup_delete" class="poplight" onclick="setDeleteAccount(<?php echo $id; ?>);">Cancella</a>
						<!-- onclick="deleteAccount(<?php echo $id; ?>);"-->
						<?php } ?>
					</td>
				</tr>
				<?php 
				}
				?>
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
		<div id="popup_delete" class="popup_block">
			<p>Sei sicuro di voler cancellare l'account?</p>
			<input type="button" id="confirmDelete" value="OK"/>
			<input type="button" id="undoDelete" value="Annulla"/>
		</div>
	</body>
</html>

<script>
	
	function setDeleteAccount(id) {
		document.getElementById("user-id").value=id;
	}
	
	$('#confirmDelete').click(function() {
		document.getElementById("button-delete").click();
	});

	$('#undoDelete').click(function() {
		document.getElementById("user-id").value='';
	});

	$('a.poplight[href^=#]').click(function() {
	    var popID = $(this).attr('rel'); //Get Popup Name
	    var popURL = $(this).attr('href'); //Get Popup href to define size

	    //Pull Query & Variables from href URL
	    var query= popURL.split('?');
	    var dim= query[1].split('&');
	    var popWidth = dim[0].split('=')[1]; //Gets the first query string value

	    //Fade in the Popup and add close button
	    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="img/window-close.png" width="40" height="40" class="btn_close" title="Close Window" alt="Close" /></a>');

	    //Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
	    var popMargTop = ($('#' + popID).height() + 80) / 2;
	    var popMargLeft = ($('#' + popID).width() + 80) / 2;

	    //Apply Margin to Popup
	    $('#' + popID).css({
	        'margin-top' : -popMargTop,
	        'margin-left' : -popMargLeft
	    });

	    //Fade in Background
	    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
	    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 

	    return false;
	});

	//Close Popups and Fade Layer
	$('a.close, #fade,#undoDelete,#confirmDelete').live('click', function() { //When clicking on the close or fade layer...
	    $('#fade , .popup_block').fadeOut(function() {
	        $('#fade, a.close').remove();  //fade them both out
	    });
	    return false;
	});

</script>