<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>
<html>
<head>
    <title> Suppression d'une transaction périodique </title>
<head>

<body>

<?php
  include("../include/config.php");

  $idtransac = mysqli_real_escape_string($conn, addslashes(trim($_POST['idtransac'])));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'éxistez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'éxistez pas désolé !!!");

  $sql = "DELETE FROM eco_tranperiodique WHERE idtransac = '$idtransac';";
  $res = @mysqli_query($conn, $sql) or die("Suppression transac périodique impossible. Contactez l'administrateur");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../new_detail_1_citoyen.php?citoyen=".$idjoueur."\");</script>";
  $idjoueur = $_SESSION['perso_iduser'];

?>

</body>
</html>
