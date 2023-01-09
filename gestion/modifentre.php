<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Modification d'une entreprise </title>
<head>
<body>

<?php

  include("../include/config.php");

  $nomA = addslashes(trim($_POST['nomA']));
  $typeA = addslashes(trim($_POST['typeA']));
  $iduserA = addslashes(trim($_POST['iduserA']));
  $capaA = addslashes(trim($_POST['capaA']));
  $identreA = addslashes(trim($_POST['identreA']));
  $logoA = addslashes(trim($_POST['logoA']));
  $siteA = addslashes(trim($_POST['siteA']));

  $residenceA = addslashes(trim($_POST['residence1']));


  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  $from_url = $_SESSION['from_url'];
  $from_url = substr($from_url, strripos($from_url, "/"));

$fct_mes_entre_type = "M";
$fct_mes_entre_entreprise = stripslashes($nomA);

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')  {
    $paysjoueur = $_SESSION['perso_idpays'];
    $autojoueur = substr($_SESSION['perso_droituser'],1,1);

    $sql = "SELECT eco_entreprise.iduser FROM eco_entreprise, eco_user, eco_pays ";
    $sql .= "WHERE (eco_entreprise.iduser = '$idjoueur' AND eco_entreprise.identreprise = '$identreA') ";
    $sql .= "OR (eco_entreprise.identreprise = '$identreA' ";
    $sql .= "AND eco_entreprise.idpays = '$paysjoueur' AND '$autojoueur' > '4') ;";
    $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification1, désolé !!!");
    $num = @mysqli_num_rows($res) or die("<br> PB de vérification1 désolé !!!");
  }

  $sql = "UPDATE eco_entreprise SET nomentreprise = '$nomA', typeentreprise = '$typeA', ";
  $sql .= "iduser = '$iduserA', capacite = '$capaA', logo = '$logoA', site = '$siteA' ";
  $sql .= "WHERE identreprise = '$identreA';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l administrateur de cette entreprise");

  if ($residenceA == '0'){
     $sql = "UPDATE eco_immo SET occupe = '0' ";
     $sql .= "WHERE (idproprio = '$identreA' AND idlocataire = '0') ";
     $sql .= "OR idlocataire = '$identreA';";
     $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l administrateur de cette entreprise (immo0)");
  } else if ($residenceA > '0'){
     $sql = "UPDATE eco_immo SET occupe = '0' ";
     $sql .= "WHERE (idproprio = '$identreA' AND idlocataire = '0') ";
     $sql .= "OR idlocataire = '$identreA';";
     $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l administrateur de cette entreprise (immo1)");

     $sql = "UPDATE eco_immo SET occupe = '1' ";
     $sql .= "WHERE idpossession = '$residenceA';";
     $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l administrateur de cette entreprise (immo2)");
  }

  $sql = "SELECT emaileco FROM eco_entreprise,eco_pays ";
  $sql .= "WHERE eco_entreprise.identreprise = '$identreA' AND eco_entreprise.idpays = eco_pays.idpays ;";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche de l'entreprise !!!");
  $num = @mysqli_num_rows($res) or die("PB recherche de l'entreprise !!!");
  $produit = mysqli_fetch_array($res);

$fct_mes_entre_emaileco = $produit['emaileco'];

  // Envoi du message
  include("../include/fct_mes_entreprise.php");

	$tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?entreprise=" . $identreA . "');</script>";
	echo $tmp;

?>

</body>
</html>
