<?php
$connetti=mysql_connect('localhost','root','root');

/*  --------------------------------------------
	FUNZIONE DI REGISTRAZIONE DELL'UTENTE NEL DB
	--------------------------------------------
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
	$message="
	<html>
		<body>
			<p>Benvenuto, $nome $cognome. Grazie per esserti registrato.</p>
			<p>I tuoi dati di registrazione:</p>
			<p>E-mail: $email</p>
			<p>Username: $username</p>
			<p>Password: $password</p>
			<p></p>
		</body>
	</html>
	";
	$headers = 'from: Andrea Pavan <andreapavan89@gmail.com>'."\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
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
	$sql_read = "SELECT nome,cognome FROM progetto.utenti WHERE username='$username'&&password='$password'";
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
		utente. Ritorna pertanto un valore booleano TRUE se
		l'indirizzo non è mai stato utilizzato.
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

/*  ------------------------------------------------
	FUNZIONE RECUPERO INFORMAZIONI UTENTE REGISTRATO
	------------------------------------------------
*/

function recoverInfo ($username) {
	global $connetti;
	$sql_info = "SELECT nome,cognome,username id FROM progetto.utenti WHERE username='$username'";
	$query4=mysql_query($sql_info,$connetti);
	$array_result=mysql_fetch_row($query4);
	return $array_result;
}

/*
	----------------------------------
	LOGIN, LOGOUT E CONTROLLO SESSIONE
	----------------------------------
*/

function checkLogSession() {
	if (isset($_POST["button-logout"])){
		session_start();
		session_destroy();
	}
	if (isset($_POST["button-login"])){
		$username=$_POST["username"];
		$password=$_POST["password"];
		if (checkUser($username,$password)){
			session_start();
			$_SESSION["user"]=$username;
		}else{
			echo "Dati errati";
		}
	}
	session_start();
	if (isset($_SESSION["user"])){
		echo "Benvenuto, ".$_SESSION["user"];
	}else{
		echo "Benvenuto, visitatore.";
	}
}
?>

