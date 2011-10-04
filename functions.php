<?php
$connetti=mysql_connect('localhost','root','andreapavan1989');

/*  ----------------------------------
	REGISTRAZIONE NUOVO UTENTE NEL DB
	----------------------------------
*/

function insertUser() {
	$nome=$_POST["nome"];
	$cognome=$_POST["cognome"];
	$email=$_POST["email"];
	$password=$_POST["password"];
	$password_cript=md5($password);
	$username=$_POST["username"];
	global $connetti;
	$sql="INSERT INTO progetto.utenti SET nome='$nome',cognome='$cognome',email='$email',password='$password_cript',username='$username'";
	$query=mysql_query($sql,$connetti);
	$message="Benvenuto, $nome $cognome. Grazie per esserti registrato.\n\nE-mail: $email\nUsername: $username\nPassword: $password";
	$headers="From: andreapavan89@gmail.com";
	mail($email,"Benvenuto in DBLP Bibliography",$message,$headers);
}

/*  ---------------------------------------------
	FUNZIONE PER CONTROLLO UTENTE
	
	La funzione checkUser permette di verfificare
	se l'utente è registrato nel database.
	Ritorna un valore booleano TRUE o FALSE.
	---------------------------------------------
*/

function checkUser($username,$password) {
	global $connetti;
	$password=md5($password);
	$sql_read = "SELECT nome,cognome FROM progetto.utenti WHERE username='$username' AND password='$password'";
	$query2=mysql_query($sql_read,$connetti);
	$array_result=mysql_fetch_row($query2);
	if ($array_result[0]==NULL) {
		return false;
	}else{
		return true;
	}
}

/*  --------------------------------------------------------
	FUNZIONI PER CONTROLLO EMAIL
	
	*	La funzione isUniqueEmail controlla se la mail è già
		stata utilizzata per la registrazione di un altro
		utente. Ritorna TRUE se l'indirizzo non è mai stato
		utilizzato.
	--------------------------------------------------------
*/

function isUniqueEmail($email) {
	global $connetti;
	$sql_controlla_mail="SELECT email FROM progetto.utenti WHERE email='$email'";
	$query_mail=mysql_query($sql_controlla_mail,$connetti);
	$risultato=mysql_fetch_row($query_mail);
	if ($risultato[0]== NULL) {
		return true;
	}else{
		return false;
	}
}

/*  --------------------------------------
	FUNZIONE RECUPERO INFORMAZIONI UTENTE 
	--------------------------------------
*/

function getUserData($username) {
	global $connetti;
	$sql_info="SELECT nome,cognome,username,email,id FROM progetto.utenti WHERE username='$username'";
	$query4=mysql_query($sql_info,$connetti);
	$array_result=mysql_fetch_row($query4);
	return $array_result;
}

/*  ---------------------
	MODIFICA DATI UTENTE
	---------------------
*/

function modifyUserData($user) {
	global $connetti;
	$nuovo_nome=$_POST["nuovo_nome"];
	$nuovo_cognome=$_POST["nuovo_cognome"];
	$nuovo_username=$_POST["nuovo_username"];
	$nuova_email=$_POST["nuovo_email"];
	$sql_modify="UPDATE progetto.utenti SET username='$nuovo_nome',nome='$nuovo_nome',cognome='$nuovo_cognome',email='$nuova_email' WHERE username='$user'";
	$query=mysql_query($sql_modify,$connetti);
}

function cancellaAccount($id) {
	global $connetti;
	$sql_delete="DELETE FROM progetto.utenti WHERE id='$id'";
	$query=mysql_query($sql_delete,$connetti);
}

/*
	-------------------
	CONTROLLI SESSIONE
	-------------------
*/

function logout() {
	session_start();
	session_destroy();
}

function loginUser($username) {
	session_start();
	$_SESSION["user"]=$username;
}

function checkSession() {
	session_start();
	if (isset($_SESSION["user"])) {
		return true;
	}else{
		return false;
	}
}

/*
	-------------
	URL CORRENTE
	-------------
*/

function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

?>

