<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Cr�ation d'un produit </title>
<head>
<body>

<?php

  include("../include/config.php");

  $nomproduit = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['nomproduit']))));
  $typeproduit1 = trim($_POST['typeproduit1']);
  $image = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['image']))));
  $description = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['description']))));
  $nbunite = trim($_POST['nbunite']);
  $idunite1 = trim($_POST['idunite1']);
  $entre1 = trim($_POST['entre1']);
  $prix1 = trim($_POST['prix']);
  $deviseprix1 = trim($_POST['deviseprix']);

  $province = trim($_POST['province']);
  $adresse = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['adresse']))));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  $from_url = $_SESSION['from_url'];
  $from_url = substr($from_url, strripos($from_url, "/"));

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  
	  $sql = "SELECT identreprise FROM eco_entreprise WHERE eco_entreprise.identreprise = '$entre1' ";
	  $sql .= "AND eco_entreprise.iduser = '$idjoueur' ";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification1, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification1, désolé !!!");
	}

$fct_mes_prod_type = "";
$fct_mes_prod_produit = $nomproduit;

    $sql = "SELECT nomentreprise,emaileco,typeentreprise FROM eco_entreprise,eco_pays ";
    $sql .= "WHERE identreprise = '$entre1' AND eco_entreprise.idpays = eco_pays.idpays ;";
    $res = @mysqli_query($conn, $sql)or die("<br> entreprise n'existe pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> entreprise n'existe pas désolé !!!");
    $produit = mysqli_fetch_array($res);

    $typeentreprise = $produit['typeentreprise'];



$fct_mes_prod_entreprise = $produit['nomentreprise'];
$fct_mes_prod_emaileco = $produit['emaileco'];


  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  $sql = "INSERT INTO eco_production (idproduit,identreprise,nomproduit,typeproduit,image,description,nbunite,idunite, prix, deviseprix) VALUES('','$entre1','$nomproduit','$typeproduit1','$image','$description','$nbunite','$idunite1', '$prix1', '$deviseprix1');";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez ladministrateur");
  $idproduit = mysql_insert_id();

   if ($typeentreprise == '50001')
   {
       $sql = "INSERT INTO eco_immo_tmp (idproduit,province,adresse) VALUES ('$idproduit','$province','$adresse');";
       $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête immo_tmp (newproduit) !!!");
   }


  // Envoi du message
//  include("../include/fct_mes_produit.php");


	$tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?entreprise=" . $entre1 . "');</script>";
	echo $tmp;


?>

</body>
</html>
