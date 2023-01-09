<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
    <title> Repondre à un besoin </title>
<head>
<body>

<?php

  include("../include/config.php");

  $idpays = addslashes(trim($_POST['idpays']));
  $idtitulaire = addslashes(trim($_POST['idtitulaire']));
  $type = addslashes(trim($_POST['type']));
  $typeproduit = addslashes(trim($_POST['typeproduit']));
  $quantite = addslashes(trim($_POST['quantite']));
  $identre = addslashes(trim($_POST['identre']));
  $nbdeduite = addslashes(trim($_POST['nbdeduite']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999'){
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> PB de vérification1, désolé !!!");
	  
	  if ($idpays != $paysjoueur)
	  	die("<br> PB de vérification2, désolé !!!");

	  $sql = "SELECT identreprise FROM eco_entreprise, eco_pays ";
	  $sql .= "WHERE eco_entreprise.identreprise = '$identre' AND eco_entreprise.idpays = '$paysjoueur' ;";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification3, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification3, désolé !!!");
  }

  if ($type == 'CONS'){
    // Recherche du stock initial
    $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '$typeproduit';";
    $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche de la quantité (besoin) !!!");
    $num = @mysqli_num_rows($res) or die("<br> Pas de stock (besoin) !!!");
    $produit = mysqli_fetch_array($res);

    $new_quantite = $quantite - $nbdeduite;
    if ($new_quantite < 0 )
      die ("Pas assez de stock...");

    $new_quantite = $produit['quantite'] - $nbdeduite;
    if ($new_quantite < 0 )
      die ("Pas assez de stock...");

    // Maj Stock
    $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '$typeproduit';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (besoin)");

    $new_quantite = $quantite - $nbdeduite;
    // Maj Stock
    $sql = "UPDATE eco_besoin SET quantite = '$new_quantite' WHERE idpays = '$idpays' AND idtitulaire = '$idtitulaire' AND type = '$type' AND typeproduit = '$typeproduit';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le besoin. (besoin)");
  }

  if ($type == 'PROD'){
    // Recherche du stock initial
    $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '$typeproduit';";
    $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche de la quantité (besoin) !!!");
    $num = @mysqli_num_rows($res);
    if ($num != 0){
      $produit = mysqli_fetch_array($res);
      $new_quantite = $produit['quantite'] + $nbdeduite;

      // Maj Stock
      $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '$typeproduit';";
      $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (besoin)");
    }
    else{
      $new_quantite = $nbdeduite;
      $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('$typeproduit','$identre','$new_quantite');";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete d'insertion d'une quantité (besoin) !!!");
    }

    $new_quantite = $quantite - $nbdeduite;
    // Maj Stock
    $sql = "UPDATE eco_besoin SET quantite = '$new_quantite' WHERE idpays = '$idpays' AND idtitulaire = '$idtitulaire' AND type = '$type' AND typeproduit = '$typeproduit';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le besoin. (besoin)");
  }

echo "<script language=\"JavaScript\"> document.location.replace(\"../detail_1_etat.php?etat=",$idpays,"\");</script>";

?>

</body>
</html>