<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>
<html>
<head>
<title> Message d'achat PA </title>
<head>
<body>

<?php

  include("../include/config.php");

  $entreA = addslashes(trim($_POST['entreA']));
  $deviseA = addslashes(trim($_POST['deviseA']));
  $idcpte1 = addslashes(trim($_POST['idcpte1']));

  $tarif = addslashes(trim($_POST['tarif']));
  $nbunite = addslashes(trim($_POST['nbunite']));
  $idunite = addslashes(trim($_POST['idunite']));
  $nomunite = addslashes(trim($_POST['nomunite']));
//  $nbprod = addslashes(trim($_POST['nbprod']));
  $idprod = addslashes(trim($_POST['idprod']));
  $nomprod = addslashes(trim($_POST['nomprod']));

  $deviseB = addslashes(trim($_POST['deviseB']));
  $entreB = addslashes(trim($_POST['entreB']));
  $idcpte2 = addslashes(trim($_POST['idcpte2']));

  $etat = addslashes(trim($_POST['etat']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");

  $idjoueur = $_SESSION['perso_iduser'];


	// CTRL data
  if ($_SESSION['perso_droituser'] != '999')
  {
	  if ($idjoueur != $entreA)
	  {
	    $sql = "SELECT idtitulaire FROM eco_entreprise,eco_banque ";
	    $sql .= "WHERE eco_entreprise.identreprise = '$entreA' AND eco_entreprise.iduser = '$idjoueur' ";
	    $sql .= "AND eco_entreprise.identreprise = eco_banque.idtitulaire AND eco_banque.idcompte = '$idcpte1' ";
	    $sql .= "AND eco_banque.devise = '$deviseA' ;";
	    $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete de vérification1...");
	    $num = @mysqli_num_rows($res) or die("<br> PB dans la requete de vérification1...");
		}
		else
	  {
	    $sql = "SELECT idtitulaire FROM eco_banque ";
	    $sql .= "WHERE eco_banque.idtitulaire = '$idjoueur' AND eco_banque.idcompte = '$idcpte1' ";
	    $sql .= "AND eco_banque.devise = '$deviseA' ;";
	    $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete de vérification2...");
	    $num = @mysqli_num_rows($res) or die($sql . "<br> PB dans la requete de vérification2...");
		}

		if ($tarif <= 0)
			die("<br> PB dans la requete de vérification3...");

    $sql = "SELECT idtitulaire FROM eco_entreprise,eco_banque ";
    $sql .= "WHERE eco_entreprise.identreprise = '$entreB' ";
    $sql .= "AND eco_entreprise.identreprise = eco_banque.idtitulaire AND eco_banque.idcompte = '$idcpte2' ";
    $sql .= "AND eco_banque.devise = '$deviseB' ;";
	  $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete de vérification4...");
	  $num = @mysqli_num_rows($res);
	  if ($num <= 0)
	  {
	    $sql = "SELECT idtitulaire FROM eco_banque,eco_user ";
	    $sql .= "WHERE eco_banque.idtitulaire = eco_user.iduser AND eco_banque.idcompte = '$idcpte2' ";
	    $sql .= "AND eco_banque.devise = '$deviseB' AND eco_user.iduser = '$entreB' ;";
	    $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete de vérification5...");
	    $num = @mysqli_num_rows($res) or die("<br> PB dans la requete de vérification5...");
	  }
	}


  if ($idjoueur != $entreA)
  {
    $sql = "SELECT iduser,nomentreprise FROM eco_entreprise WHERE identreprise = '$entreA';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete recherche nom entreprise1");
    $num = @mysqli_num_rows($res) or die("<br> L'entreprise n'existe pas !!!");
    $produit = mysqli_fetch_array($res);
    $nom = $produit['nomentreprise'];
    $directeur_entreA = $produit['iduser'];
  }
  else
  {
    $sql = "SELECT nom FROM eco_user WHERE iduser = '$entreA';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requ�te recherche nom utilisateur");
    $num = @mysqli_num_rows($res) or die("<br> L'utilisateur 1 n'existe pas !!!");
    $produit = mysqli_fetch_array($res);
    $nom = $produit['nom'];
    $directeur_entreA = $entreA;
  }

  $sql = "SELECT iduser, nomentreprise FROM eco_entreprise WHERE identreprise = '$entreB';";
  $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete recherche nom entreprise2");
  $num = @mysqli_num_rows($res);
  if ($num > 0)
 {
    $produit = mysqli_fetch_array($res);
    $nomvendeur = $produit['nomentreprise'];

   $directeur_entreB = $produit['iduser'];
  }
  else
  {
    $sql = "SELECT nom FROM eco_user WHERE iduser = '$entreB';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete recherche nom utilisateur");
    $num = @mysqli_num_rows($res) or die("<br> L'utilisateur 2 n'existe pas !!!");
    $produit = mysqli_fetch_array($res);
    $nomvendeur = $produit['nom'];
    $directeur_entreB = $entreB;
  }

  $sql = "SELECT nom, email FROM eco_user WHERE iduser = '$directeur_entreB';";
  $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete recherche nom entreprise2");
  $num = @mysqli_num_rows($res) or die("<br> Pas de nom pour le directeur de Entreprise 2!!!");
  $produit = mysqli_fetch_array($res);
      $fct_mes_newmessage_nom = $produit['nom'];
      $fct_mes_newmessage_email = $produit['email'];


  // Recherche du Taux de Change
  $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";
  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche du taux de change (mes_achatpa) !!!");
  $num = @mysqli_num_rows($res) or die("Le taux de change n'existe pas !!!");
  $produit = mysqli_fetch_array($res);
  $taux = $produit['taux'];

  $tarif_unit = $tarif * $taux;
  $tarif_total = $tarif_unit;

  if ($etat == '1')
  	$libelletransaction = $nom . " propose d'acheter d'occasion un(e) " . $nomprod . " au tarif HT de " . $tarif_unit . " " . $deviseB . " (" . $tarif . " " . $deviseA . ") à " . $nomvendeur;
  else
  	$libelletransaction = $nom . " propose de louer " . $nomprod . " au loyer mensuel HT de " . $tarif_unit . " " . $deviseB . " (" . $tarif . " " . $deviseA . ") à " . $nomvendeur;
  $libelletransaction .= ". Le compte destinataire est le n° : " . $idcpte2;
  $libelletransaction = addslashes($libelletransaction);

  $datatransaction = $idcpte1 . "|" . $idcpte2 . "|" . $entreA . "|" . $entreB . "|" . $idprod . "|" . $nbunite . "|" . $idunite . "|" . $tarif;


 if ($etat == '1')
	  $objet = "VENTE_OCCASION";
  else
	  $objet = "LOCATION";
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
  $res = mysqli_query($conn, $sql) or die("Erreur dans la requete d'insertion du message (mes_achatpa) !!!");

  // Envoi du message
  include("../include/fct_mes_newmessage.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../achat_pa.php\");</script>";

?>

</body>
</html>