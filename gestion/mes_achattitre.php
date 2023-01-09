<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
<title> Message d'achat de titres </title>
<head>
<body>

<?php
  include("../include/config.php");

  $entreA = addslashes(trim($_POST['entreA']));
  $deviseA = addslashes(trim($_POST['deviseA']));
  $idcpte1 = addslashes(trim($_POST['idcpte1']));

  $tarif = addslashes(trim($_POST['tarif']));
  $nbunite = addslashes(trim($_POST['nbunite']));
  $idtitre = addslashes(trim($_POST['idtitre']));

  $deviseB = addslashes(trim($_POST['deviseB']));
  $entreB = addslashes(trim($_POST['entreB']));
  $idcpte2 = addslashes(trim($_POST['idcpte2']));

  $conn = @mysqli_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

    $sql = "SELECT iduser,nomentreprise FROM eco_entreprise WHERE identreprise = '$entreA';";
    $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requête recherche nom entreprise1");
    $num = @mysqli_num_rows($res);
    if ($num > 0){
	$produit = mysqli_fetch_array($res);
	$nomA = $produit['nomentreprise'];
	$directeur_entreA = $produit['iduser'];
    }
    else{
	$sql = "SELECT nom,iduser FROM eco_user WHERE iduser = '$entreA';";
	$res = @mysqli_query($conn, $sql)or die("<br> PB dans la requête recherche nom utilisateur 1");
	$num = @mysqli_num_rows($res);
	if ($num > 0){
		$produit = mysqli_fetch_array($res);
		$nomA = $produit['nom'];
		$directeur_entreA = $produit['iduser'];
	}
	else{
		$sql = "SELECT nompays, iduser FROM eco_pays WHERE idpays = '$entreA';";
		$res = @mysqli_query($conn, $sql)or die("<br> PB dans la requête recherche nom utilisateur 1");
		$num = @mysqli_num_rows($res) or die("<br> L'utilisateur 1 n'existe pas !!!");
		$produit = mysqli_fetch_array($res);
		$nomA = $produit['nompays'];
		$directeur_entreA = $produit['iduser'];
	}
    }

  $sql = "SELECT iduser, nomentreprise FROM eco_entreprise WHERE identreprise = '$entreB';";
  $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche nom entreprise2");
  $num = @mysqli_num_rows($res);
  if ($num > 0) {
    $produit = mysqli_fetch_array($res);
    $nomB = $produit['nomentreprise'];
    $directeur_entreB = $produit['iduser'];

    $sql = "SELECT email,nom FROM eco_user WHERE iduser = '$directeur_entreB';";
    $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche nom utilisateur 2");
    $num = @mysqli_num_rows($res);
    $produit = mysqli_fetch_array($res);

    $fct_mes_newmessage_nom = $produit['nom'];
    $fct_mes_newmessage_email = $produit['email'];
  }
  else {
    $sql = "SELECT email,nom,iduser FROM eco_user WHERE iduser = '$entreB';";
    $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche nom utilisateur 2");
    $num = @mysqli_num_rows($res);
    if ($num > 0){
      $produit = mysqli_fetch_array($res);
      $nomB = $produit['nom'];
      $directeur_entreB = $produit['iduser'];
      $fct_mes_newmessage_nom = $produit['nom'];
      $fct_mes_newmessage_email = $produit['email'];
    }
    else{
      $sql = "SELECT nompays,iduser FROM eco_pays WHERE idpays = '$entreB';";
      $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche nom utilisateur 2");
      $num = @mysqli_num_rows($res) or die("<br> L'utilisateur 1 n'existe pas !!!");
      $produit = mysqli_fetch_array($res);
      $nomB = $produit['nompays'];
      $directeur_entreB = $produit['iduser'];
      $tmp_iduser = $produit['iduser'];

      $sql = "SELECT email,nom FROM eco_user WHERE iduser = '$tmp_iduser';";
      $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche nom utilisateur 2 dir");
      $num = @mysqli_num_rows($res);
      $produit = mysqli_fetch_array($res);

      $fct_mes_newmessage_nom = $produit['nom'];
      $fct_mes_newmessage_email = $produit['email'];
    }
  }

  $sql = "SELECT nomentreprise FROM eco_entreprise WHERE identreprise = '$idtitre';";
  $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche nom entreprise2");
  $num = @mysqli_num_rows($res);
  $produit = mysqli_fetch_array($res);
  $nomtitre = $produit['nomentreprise'];

  // Recherche du Taux de Change
  $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";
  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche du taux de change (mes_achatstock) !!!");
  $num = @mysqli_num_rows($res) or die("Le taux de change n'existe pas !!!");
  $produit = mysqli_fetch_array($res);
  $taux = $produit['taux'];

  $tarif_unit = $tarif * $taux;
  $tarif_total = $tarif_unit * $nbunite;

    $libelletransaction = "Proposition d'achat de " . $nbunite . " titres  de " . $nomtitre . " au tarif unitaire de " . $tarif_unit . " " . $deviseB . " (" . $tarif . " " . $deviseA . ") par " . $nomA . " à " . $nomB;
    $libelletransaction .= ". Le compte destinataire du total (" . $tarif_total . " " . $deviseB . ") est le n° : " . $idcpte2;
    $libelletransaction = addslashes($libelletransaction);

   $datatransaction = $idcpte1 . "|" . $idcpte2 . "|" . $entreA . "|" . $entreB . "|" . $nbunite . "|" . $idtitre . "|" . $tarif;

   $objet = "VENTE_TITRE";
    $origine = $directeur_entreA;
    $destinataire = $directeur_entreB;

  $tt=time();
  $mois=date("m",$tt);
  $jour=date("d",$tt);
  $date=date("Y",$tt);
  $date_propo = $date . "-" . $mois . "-" . $jour;

  $tt += (5 * 24 * 3600);
  $mois=date("m",$tt);
  $jour=date("d",$tt);
  $date=date("Y",$tt);
  $date_expir = $date . "-" . $mois . "-" . $jour;

  $sql = "INSERT INTO eco_message (idmsg,origine,destinataire,objet,libelle,reponse,datepropo,dateexpir,data) VALUES (NULL,'$origine','$destinataire','$objet','$libelletransaction','',NOW(),'$date_expir','$datatransaction')";
  $res = mysqli_query($conn, $sql) or die("Erreur dans la requete d'insertion du message (mes_achatstock) !!!");

  // Envoi du message
  include("../include/fct_mes_newmessage.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../achat_titre.php\");</script>";

?>
</body>
</html>