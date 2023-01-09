<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Définir Taux </title>
<head>
<body>

<?php

  include("../include/config.php");

  $idmsg = addslashes(trim($_POST['idmsg']));
  $reponse = addslashes(trim($_POST['reponse1']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT origine, destinataire,objet,libelle,datepropo,dateexpir,data,reponse FROM eco_message WHERE idmsg = '$idmsg';";
  $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche message");
  $num = @mysqli_num_rows($res) or die("<br> Le message n'existe pas !!!");
  $produit = mysqli_fetch_array($res);

  $origine = $produit['origine'];
  $destination = $produit['destinataire'];
  $objet = $produit['objet'];
  $libelle = $produit['libelle'];
  $datepropo = $produit['datepropo'];
  $dateexpir = $produit['dateexpir'];
  $data = $produit['data'];
  $reponse_av = $produit['reponse'];


  if ($reponse_av != "")
     die ("Message déjà répondu...");

  if (($objet == "DEFINIR_TAUX") && ($reponse == "A"))
  {
    //  $datatransaction = $deviseA . "|" . $deviseB . "|" . $idcpte . "|" . $taux;
    //   $$|P�|100001|1.4

    $tab_data = explode("|",$data);

        $deviseA = $tab_data[0];
        $deviseB = $tab_data[1];
        $idcpte = $tab_data[2];
        $taux = $tab_data[3];

$fct_mes_resp_type = 'T';
$fct_mes_resp_taux = $taux;

  $sql = "SELECT nompays FROM eco_pays WHERE devise = '$deviseA';";
  $res = @mysqli_query($conn, $sql)or die("<br> Recherche devise ko !!!");
  $num = @mysqli_num_rows($res) or die("<br> Recherche devise ko !!!");
  $produit = mysqli_fetch_array($res);

$fct_mes_resp_pays = $produit['nompays'];



  $sql = "SELECT eco_user.iduser,eco_pays.emaileco FROM eco_user,eco_pays ";
  $sql .= "WHERE eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_pays.idpays ;";
    $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");
  $produit = mysqli_fetch_array($res);
$fct_mes_resp_emaileco = $produit['emaileco'];


  $taux = round($taux,2);

  $sql = "UPDATE eco_tauxchange SET taux = '$taux', idcompte = '$idcpte', datemaj = NOW() WHERE devise1 = '$deviseA' AND devise2 = '$deviseB';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur ce citoyen");

  $tauxopp = 1 / $taux;
  $tauxopp = round($tauxopp,2);

  $sql = "UPDATE eco_tauxchange SET taux = '$tauxopp', datemaj = NOW() WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur ce citoyen");


    // Maj Message
    $sql = "UPDATE eco_message SET reponse = '$reponse' WHERE idmsg = '$idmsg';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le message. (achatproduit)");

	  // Envoi du message
	  include("../include/fct_mes_resp.php");

  }


  echo "<script language=\"JavaScript\"> document.location.replace(\"../messagerie.php\");</script>";

?>

</body>
</html>
