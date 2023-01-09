<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>
<html>
<head>
    <title> Message definition taux </title>
<head>
<body>
<?php
  include("../include/config.php");

  $taux = addslashes(trim($_POST['taux']));
  $idcpte = addslashes(trim($_POST['idcpte']));
  $deviseA = addslashes(trim($_POST['deviseA']));
  $deviseB = addslashes(trim($_POST['deviseB']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

    // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999'){
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
			die("<br> PB lors de la vérification1...");

	  $sql = "SELECT eco_user.iduser FROM eco_user,eco_pays ";
	  $sql .= "WHERE eco_user.iduser = '$idjoueur' AND eco_pays.devise = '$deviseA' ";
	  $sql .= "AND eco_user.idpays = eco_pays.idpays ;";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB lors de la vérification2...");
	  $num = @mysqli_num_rows($res) or die("<br> PB lors de la vérification2...");

	  if ($taux < 0)
			die("<br> PB lors de la vérification3...");
    }

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");


    $sql = "SELECT iduser,nompays FROM eco_pays WHERE devise = '$deviseA';";
    $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requête recherche nom pays1");
    $num = @mysqli_num_rows($res) or die("<br> L'entreprise n'existe pas !!!");
    $produit = mysqli_fetch_array($res);

    $nompaysA = $produit['nompays'];
    $directeur_paysA = $produit['iduser'];

    $sql = "SELECT iduser,nompays FROM eco_pays WHERE devise = '$deviseB';";
    $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requête recherche nom pays2");
    $num = @mysqli_num_rows($res) or die("<br> L'entreprise n'existe pas !!!");
    $produit = mysqli_fetch_array($res);

    $nompaysB = $produit['nompays'];
    $directeur_paysB = $produit['iduser'];

    $sql = "SELECT email,nom FROM eco_user WHERE iduser = '$directeur_paysB';";
    $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requête recherche nom utilisateur 2");
    $num = @mysqli_num_rows($res);
    $produit = mysqli_fetch_array($res);

      $fct_mes_newmessage_nom = $produit['nom'];
      $fct_mes_newmessage_email = $produit['email'];

  $tauxopp = 1 / $taux;
  $tauxopp = round($tauxopp,2);

  $libelletransaction = "Le responsable du pays " . $nompaysA . " propose de définir le taux de change";
  $libelletransaction .= " avec votre pays " . $nompaysB;
  $libelletransaction .= ", comme suit : " . $deviseA . " -> " . $deviseB . " : * " . $taux;
  $libelletransaction .= " et bien sur : " . $deviseB . " -> " . $deviseA . " : * " . $tauxopp;
  $libelletransaction = addslashes($libelletransaction);

  $datatransaction = $deviseA . "|" . $deviseB . "|" . $idcpte . "|" . $taux;

  $objet = "DEFINIR_TAUX";
  $origine = $directeur_paysA;
  $destinataire = $directeur_paysB;

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
  $res = mysqli_query($conn, $sql) or die("Erreur dans la requête d'insertion du message (mes_relation) !!!");

  // Envoi du message
  include("../include/fct_mes_newmessage.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../taux_change.php\");</script>";
?>

</body>
</html>