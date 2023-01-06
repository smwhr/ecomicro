<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Modification d'un etat </title>
<head>
<body>

<?php

  include("../include/config.php");

  $iduser = addslashes(trim($_POST['iduser']));
  $idpays = addslashes(trim($_POST['idpays']));
  $drapeau = addslashes(trim($_POST['drapeau']));
  $site = addslashes(trim($_POST['site']));
  $forum = addslashes(trim($_POST['forum']));
  $mleco = addslashes(trim($_POST['mleco']));
  $chef = addslashes(trim($_POST['chef']));
  $cf = addslashes(trim($_POST['cf']));
  $cptenat = addslashes(trim($_POST['cptenat']));

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
	  
	  if ($idpays != $paysjoueur)
	  	die("<br> PB de vérification2, désolé !!!");
	}

$fct_mes_resp_type = "E";
$fct_mes_resp_email_new = $mleco;

    $sql = "SELECT emaileco, controle_fiscal FROM eco_pays WHERE idpays = '$idpays';";
    $res = @mysqli_query($conn, $sql)or die("<br> entreprise n'existe pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> entreprise n'existe pas désolé !!!");
    $produit = mysqli_fetch_array($res);
    
    $cf_old = $produit['controle_fiscal'];

$fct_mes_resp_email_old = $produit['emaileco'];


  if ($iduser != $chef)
  {
    $sql = "DELETE FROM eco_fonction WHERE iduser = '$iduser' AND auto2 = '5';";
    $res = @mysqli_query($conn, $sql)or die("<br> Erreur dans la suppression d'une fonction !!!");

    $sql = "INSERT INTO eco_fonction (idfonction,iduser,fonction,auto1,auto2,auto3) VALUES('','$chef','ETAT','1','5','1');";
    $res = @mysqli_query($conn, $sql) or die("Création fonction impossible. Contactez l'administrateur");
  }

  // Controleur fiscal
  if ($cf_old != 0)
  {
  	$sql = "DELETE FROM eco_fonction WHERE iduser = '$cf_old' AND auto2 = '4';";
  	$res = @mysqli_query($conn, $sql)or die("<br> Erreur dans la suppression d'une fonction2 !!!");
  }
  $sql = "INSERT INTO eco_fonction (idfonction,iduser,fonction,auto1,auto2,auto3) VALUES('','$cf','ETAT','1','4','1');";
  $res = @mysqli_query($conn, $sql) or die("Création fonction2 impossible. Contactez l'administrateur");

  $sql = "UPDATE eco_pays SET drapeau = '$drapeau',iduser = '$chef',controle_fiscal = '$cf',emaileco = '$mleco',adr_site = '$site', adr_forum = '$forum', cptenat = '$cptenat' WHERE idpays = '$idpays';";
  $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre pays n'a pu être effectuée ! Veuillez contacter l'administrateur.");


  // Envoi du message
  if ($fct_mes_resp_email_new != $fct_mes_resp_email_old)
     include("../include/fct_mes_resp.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../info_etat.php\");</script>";


?>

</body>
</html>
