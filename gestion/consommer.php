<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
    <title> Consommation de matière </title>
<head>
<body>

<?php

  include("../include/config.php");

  $identre = mysqli_real_escape_string($conn, addslashes(trim($_POST['identre'])));
  $idunite = mysqli_real_escape_string($conn, addslashes(trim($_POST['idunite'])));
  $nbdeduite = mysqli_real_escape_string($conn, addslashes(trim($_POST['nbdeduite'])));
  $besoin = mysqli_real_escape_string($conn, addslashes(trim($_POST['besoin'])));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  $from_url = $_SESSION['from_url'];
  $from_url = substr($from_url, strripos($from_url, "/"));

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999'){
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);

	  $sql = "SELECT identreprise FROM eco_entreprise ";
	  $sql .= "WHERE eco_entreprise.identreprise = '$identre' AND (eco_entreprise.iduser = '$idjoueur' ";
	  $sql .= "OR (eco_entreprise.idpays = '$paysjoueur' AND '$autojoueur' > '4')) ;";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification3 R !!!");
	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification3 N !!!");
  }

    // Recherche du stock initial
    $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '$idunite';";
    $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche de la quantité (conso) !!!");
    $num = @mysqli_num_rows($res);
    $produit = mysqli_fetch_array($res);

    $tmp_quantite = $produit['quantite'] - $nbdeduite;
    if ($tmp_quantite < 0 )
      die ("Pas assez de stock...");

$fct_mes_conso_quantite = $nbdeduite;

  $sql = "SELECT libelle FROM eco_typeproduit WHERE typeproduit = '$idunite';";
  $res = @mysqli_query($conn, $sql)or die("<br> typeproduit n'existe pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> typeproduit n'existe pas  !!!");
  $num = @mysqli_num_rows($res);
  $produit = mysqli_fetch_array($res);

$fct_mes_conso_unite = $produit['libelle'];

  $sql = "SELECT nomentreprise, emaileco, eco_entreprise.idpays FROM eco_entreprise,eco_pays ";
  $sql .= "WHERE identreprise = '$identre' AND eco_entreprise.idpays = eco_pays.idpays ;";
  $res = @mysqli_query($conn, $sql)or die("<br> identreprise n'existe pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> identreprise n'existe pas  !!!");
  $num = @mysqli_num_rows($res);
  $produit = mysqli_fetch_array($res);

  $idpays = $produit['idpays'];

$fct_mes_conso_nom = $produit['nomentreprise'];
$fct_mes_conso_emaileco = $produit['emaileco'];


  if (($besoin > '0') && ($idunite != '80008'))  // pas de PDt
  {
    // Recherche du stock initial des besoin
    $sql = "SELECT quantite FROM eco_besoin WHERE  idpays = '$idpays'  AND idtitulaire = '$besoin'  AND type = 'CONS' AND typeproduit = '$idunite';";
    $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche de la quantité (conso) !!!");
    $num = @mysqli_num_rows($res);
    $produit = mysqli_fetch_array($res);

    $new_quantite = $produit['quantite'] - $nbdeduite;
    if ($new_quantite < 0 )
      die ("Vous en consommez plus qu'il ne faut !!");

    // Maj Stock besoin
    $sql = "UPDATE eco_besoin SET quantite = '$new_quantite' WHERE idpays = '$idpays' AND idtitulaire = '$besoin' AND type = 'CONS' AND typeproduit = '$idunite';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le besoin. (conso besoin)");
  }

    // Maj Stock
    $sql = "UPDATE eco_stock SET quantite = '$tmp_quantite' WHERE identreprise = '$identre' AND idunite = '$idunite';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (conso)");


  // Envoi du message
  include("../include/fct_mes_conso.php");


	$tmp = "<script language='JavaScript'> document.location.replace('../" . $from_url . "?entreprise=" . $identre . "');</script>";
	echo $tmp;

?>

</body>
</html>
