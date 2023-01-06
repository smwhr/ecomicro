<?php



session_start();

if (!$_SESSION['perso_iduser']){

    die();

}



?>



<html>

<head>

<title> Suppression d'un type de produit </title>

<head>

<body>



<?php



  include("../include/config.php");



  $typeprod = addslashes(trim($_POST['typeprod']));



  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur

  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");



  $idjoueur = $_SESSION['perso_iduser'];



  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";

  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");

  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas !!!");



  if ($_SESSION['perso_droituser'] != '999')

	  	die("<br> PB de v�rification1, d�sol� !!!");



  $sql = "DELETE FROM eco_typeproduit WHERE typeproduit = '$typeprod';";

  $res = @mysqli_query($conn, $sql) or die("Suppression impossible. Contactez l'administrateur");



echo "<script language=\"JavaScript\"> document.location.replace(\"../type_produit.php\");</script>";



?>



</body>

</html>

