<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Modification d'un produit </title>
<head>
<body>

<?php

  include("../include/config.php");

  $nomproduit = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['nomproduit']))));
  $typeproduit1 = addslashes(trim($_POST['typeproduit1']));
  $image = addslashes(trim($_POST['image']));
  $description = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['description']))));
  $nbunite = trim($_POST['nbunite']);
  $idunite1 = trim($_POST['idunite1']);
  $idproduit = trim($_POST['idproduit']);
  $prix1 = trim($_POST['prix']);
  $deviseprix1 = trim($_POST['deviseprix']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  $from_url = $_SESSION['from_url'];
  $from_url = substr($from_url, strripos($from_url, "/"));

$fct_mes_prod_type = "";
$fct_mes_prod_produit = $nomproduit;

    $sql = "SELECT nomentreprise,emaileco,eco_entreprise.identreprise FROM eco_entreprise, eco_production, eco_pays ";
    $sql .= "WHERE eco_entreprise.identreprise = eco_production.identreprise ";
    $sql .= "AND eco_production.idproduit = '$idproduit' AND eco_entreprise.idpays = eco_pays.idpays;";
    $res = @mysqli_query($conn, $sql)or die("<br> entreprise n'existe pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> entreprise n'existe pas désolé !!!");
    $produit = mysqli_fetch_array($res);

		$entreprise = $produit['identreprise'];
$fct_mes_prod_entreprise = $produit['nomentreprise'];
$fct_mes_prod_emaileco = $produit['emaileco'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  $sql = "UPDATE eco_production SET nomproduit = '$nomproduit', typeproduit = '$typeproduit1', image = '$image', description = '$description', nbunite = '$nbunite', idunite = '$idunite1', prix = '$prix1', deviseprix = '$deviseprix1' WHERE idproduit = '$idproduit';";

  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur");

  // Envoi du message
//  include("../include/fct_mes_produit.php");

	$tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?entreprise=" . $entreprise . "');</script>";
	echo $tmp;


?>

</body>
</html>
