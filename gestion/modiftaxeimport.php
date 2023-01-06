<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
<title> Modification d'une taxe Import </title>
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
	}

$fct_mes_resp_type = 'TAXE';
$fct_mes_resp_taux = $taxe * 100;

   if ($idpaysA != $idpaysB)
   {
    $sql = "SELECT nompays FROM eco_pays WHERE idpays = '$idpaysB';";
    $res = @mysqli_query($conn, $sql)or die("<br> Le pays n'existe pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> Pays n'existe pas désolé !!!");
    $produit = mysqli_fetch_array($res);

    $fct_mes_resp_pays = $produit['nompays'];
   }
   else
    $fct_mes_resp_pays = "";

    $sql = "SELECT libelle FROM eco_typeproduit WHERE typeproduit = '$typeA';";
    $res = @mysqli_query($conn, $sql)or die("<br> Le Type Produit n'existe pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> Typeproduit n'existe pas désolé !!!");
    $produit = mysqli_fetch_array($res);

$fct_mes_resp_typetaxe = $produit['libelle'];


  $sql = "SELECT eco_user.iduser,eco_pays.emaileco FROM eco_user,eco_pays ";
  $sql .= "WHERE eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_pays.idpays ;";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!! ");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");
  $produit = mysqli_fetch_array($res);
$fct_mes_resp_emaileco = $produit['emaileco'];

  $sql = "UPDATE eco_taxeimport SET  taxe = '$taxe', datemaj = NOW() WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '$typeA';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur.");

  // Envoi du message
  include("../include/fct_mes_resp.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../taxe_import.php\");</script>";

?>
</body>
</html>