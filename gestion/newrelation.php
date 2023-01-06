<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
<title> Création d'une relation </title>
<head>
<body>

<?php

  include("../include/config.php");

  $vision = trim($_POST['vision']);
  $eco = trim($_POST['eco']);
  $idpaysA = trim($_POST['idpaysA']);
  $idpaysB = trim($_POST['idpaysB']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> PB de vérification1, désolé !!!");
	  
	  if ($idpaysA != $paysjoueur)
	  	die("<br> PB de vérification2, désolé !!!");
	}

  $sql = "INSERT INTO eco_relation (idpays1,idpays2,vision,eco,datemaj) VALUES('$idpaysA','$idpaysB','$vision','$eco',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Insertion impossible. Contactez ladministrateur");

echo "<script language=\"JavaScript\"> document.location.replace(\"../relation_etat.php\");</script>";

?>

</body>
</html>
