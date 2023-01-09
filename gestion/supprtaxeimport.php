<?php



session_start();

if (!$_SESSION['perso_iduser']){

    die();

}



?>



<html>

<head>

<title> Suppression d'une taxe </title>

<head>

<body>



<?php



  include("../include/config.php");



  $idpaysA = addslashes(trim($_POST['idpaysA']));

  $idpaysB = addslashes(trim($_POST['idpaysB']));

  $typeA = addslashes(trim($_POST['typeA']));



  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur

  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");



  $idjoueur = $_SESSION['perso_iduser'];



  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";

  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'�xistez pas !!!");

  $num = @mysqli_num_rows($res) or die("<br> Vous n'�xistez pas d�sol� !!!");



  if ($_SESSION['perso_droituser'] != '999')

  {

	  $paysjoueur = $_SESSION['perso_idpays'];

	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);

	  if ($autojoueur < '5')

	  	die("<br> PB de vérification1!!!");

	  

	  if ($idpaysA != $paysjoueur)

	  	die("<br> PB de vérification2!!!");

	}



  $sql = "DELETE FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND  typeproduit = '$typeA';";

  $res = @mysqli_query($conn, $sql) or die("Suppr impossible. Contactez l'administrateur.");



echo "<script language=\"JavaScript\"> document.location.replace(\"../taxe_import.php\");</script>";



?>



</body>

</html>

