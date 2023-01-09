<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Modification d'un citoyen </title>
<head>
<body>

<?php

  include("../include/config.php");

  $nomA = addslashes(trim($_POST['nomA']));
  $emailA = addslashes(trim($_POST['emailA']));
  $loginA = addslashes(trim($_POST['loginA']));
  $idpaysA = addslashes(trim($_POST['idpaysA']));
  $pwdA = addslashes(trim($_POST['pwdA']));
  $iduserA = trim($_POST['iduserA']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

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

	  $sql = "SELECT iduser FROM eco_user ";
	  $sql .= "WHERE eco_user.idpays = '$paysjoueur' AND eco_user.iduser = '$iduserA' ;";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification3, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification3, désolé !!!");
	}

  if($pwdA == "")    // pas de modification du MDP
  {
    $sql = "UPDATE eco_user SET nom = '$nomA', email = '$emailA', login = '$loginA', idpays = '$idpaysA', datemaj = NOW() WHERE iduser = '$iduserA';";
    $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur ce citoyen");
  }
  else
  {
    $sql = "eco_UPDATE user SET nom = '$nomA', email = '$emailA', login = '$loginA', pwd = PASSWORD('$pwdA'), idpays = '$idpaysA', datemaj = NOW() WHERE iduser = '$iduserA';";
    $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur ce citoyen");
  }

  echo "<script language=\"JavaScript\"> document.location.replace(\"../citoyen_detail.php\");</script>";

?>

</body>
</html>
