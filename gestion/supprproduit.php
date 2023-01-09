<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Suppression d'un produit </title>
<head>
<body>

<?php

  include("../include/config.php");

  $idproduit = addslashes(trim($_POST['idproduit']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de donnees -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de donnees -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  $from_url = $_SESSION['from_url'];
  $from_url = substr($from_url, strripos($from_url, "/"));

    $sql = "SELECT eco_entreprise.identreprise FROM eco_entreprise, eco_production, eco_pays ";
    $sql .= "WHERE eco_entreprise.identreprise = eco_production.identreprise ";
    $sql .= "AND eco_production.idproduit = '$idproduit' AND eco_entreprise.idpays = eco_pays.idpays;";
    $res = @mysqli_query($conn, $sql)or die("<br> entreprise n'existe pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> entreprise n'existe pas  !!!");
    $produit = mysqli_fetch_array($res);

		$entreprise = $produit['identreprise'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  $sql = "DELETE FROM eco_production WHERE idproduit = '$idproduit';";
  $res = @mysqli_query($conn, $sql) or die("Suppr impossible. Contactez l'administrateur.");

  $sql = "DELETE FROM eco_immo_tmp WHERE idproduit = '$idproduit';";
  $res = @mysqli_query($conn, $sql) or die("Suppr impossible. Contactez l'administrateur.");

	$tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?entreprise=" . $entreprise . "');</script>";
	echo $tmp;

?>

</body>
</html>
