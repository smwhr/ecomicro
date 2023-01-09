<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>
<html>
<head>
<title> Modification d'un type d'entreprise </title>
<head>
<body>

<?php

  include("../include/config.php");

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  
  $libelle = addslashes(trim($_POST['libelle']));
  $typeequi = trim($_POST['typeequi']);
  $typeentre = trim($_POST['typeentre']);

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
	  	die("<br> Vous n'êtes pas autorisé, désolé !!!");
	
  $sql = "UPDATE eco_typeentreprise SET libelle = '$libelle', typeequi = '$typeequi' WHERE typeentreprise = '$typeentre';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez ladministrateur");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../type_entreprise.php\");</script>";

?>

</body>
</html>