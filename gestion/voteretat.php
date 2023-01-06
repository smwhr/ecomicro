<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Voter Election responsable </title>
<head>
<body>

<?php

  include("../include/config.php");

  $iduser = addslashes(trim($_POST['iduser']));
  $idpays = addslashes(trim($_POST['idpays']));
  $chef = addslashes(trim($_POST['chef']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT nom FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);

	  if ($idpays != $paysjoueur)
	  	die("<br> PB de v�rification1, d�sol� !!!");
  }

   $sql = "UPDATE eco_user SET election = 1,resp = '$chef' WHERE iduser = '$idjoueur';";
   $res = @mysqli_query($conn, $sql) or die("<br> Vote ko ! Veuillez contacter l'administrateur.");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../info_etat.php\");</script>";

?>

</body>
</html>
