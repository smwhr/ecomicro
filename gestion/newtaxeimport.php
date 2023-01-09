<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>
<html>
<head>
<title> Création d'une taxe Import </title>
<head>
<body>

<?php

  include("../include/config.php");

  $taxe = trim($_POST['taxe']);
  $idpaysA = trim($_POST['idpaysA']);
  $idpaysB = trim($_POST['idpaysB']);
  $typeA = trim($_POST['typeA']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> PB de vérification1, désolé !!!");
	  
	  if ($idpaysA != $paysjoueur)
	  	die("<br> PB de vérification2, désolé !!!");

	  if ($taxe < 0 )
	  	die("<br> La taxe doit être positive, désolé !!!");
	}

$fct_mes_resp_type = 'TAXE';
$fct_mes_resp_taux = $taxe * 100;

   if ($idpaysA != $idpaysB)
   {
    $sql = "SELECT nompays FROM eco_pays WHERE idpays = '$idpaysB';";
    $res = @mysqli_query($conn, $sql)or die("<br> Vous n'�xistez pas !!!");
    $num = @mysqli_num_rows($res) or die($sql); 
//die("<br> Pays n'�xiste pas d�sol� !!!");
    $produit = mysqli_fetch_array($res);

    $fct_mes_resp_pays = $produit['nompays'];
   }
   else
    $fct_mes_resp_pays = "";

    $sql = "SELECT libelle FROM eco_typeproduit WHERE typeproduit = '$typeA';";
    $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> Typeproduit n'existe pas désolé !!!");
    $produit = mysqli_fetch_array($res);

$fct_mes_resp_typetaxe = $produit['libelle'];

  $sql = "SELECT eco_user.iduser,eco_pays.emaileco FROM eco_user,eco_pays ";
  $sql .= "WHERE eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_pays.idpays ;";
  $res = @mysqli_query($conn, $sql)or die($sql); 
//die("<br> Vous n'�xistez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");
  $produit = mysqli_fetch_array($res);
$fct_mes_resp_emaileco = $produit['emaileco'];

  $sql = "INSERT INTO eco_taxeimport (idpays1,idpays2,typeproduit,taxe,datemaj) VALUES('$idpaysA','$idpaysB','$typeA','$taxe',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Insertion impossible. Contactez ladministrateur");

  // Envoi du message
  include("../include/fct_mes_resp.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../taxe_import.php\");</script>";

?>

</body>
</html>