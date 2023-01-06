<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Ouvrir Relation </title>
<head>
<body>

<?php

  include("../include/config.php");

  $idmsg = addslashes(trim($_POST['idmsg']));
  $reponse = addslashes(trim($_POST['reponse1']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> Seul le responsable est autorisé, désolé !!!");
	}

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

  if (($objet == "OUVRIR_RELATION") && ($reponse == "A"))
  {
    //    $datatransaction = $idpaysA . "|" . $idpaysB . "|" . $vision . "|" . $eco;
    //   100001|100002|1|0

    $tab_data = explode("|",$data);

        $idpaysA = $tab_data[0];
        $idpaysB = $tab_data[1];
        $vision = $tab_data[2];
        $eco = $tab_data[3];

$fct_mes_resp_type = 'O';
$fct_mes_resp_eco = $eco;

    $sql = "SELECT nompays FROM eco_pays WHERE idpays = '$idpaysA';";
    $res = @mysqli_query($conn, $sql) or die("<br> paysA  n'existe pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> paysA n'existe pas désolé !!!");
    $produit = mysqli_fetch_array($res);

$fct_mes_resp_pays = $produit['nompays'];

    $sql = "SELECT nompays,emaileco FROM eco_pays WHERE idpays = '$idpaysB';";
    $res = @mysqli_query($conn, $sql)or die("<br> paysB n'existe pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> paysB n'existe pas désolé !!!");
    $produit = mysqli_fetch_array($res);

$fct_mes_resp_paysB = $produit['nompays'];
$fct_mes_resp_emaileco = $produit['emaileco'];



    $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
    $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

    $sql = "UPDATE eco_relation SET  vision = '$vision', eco = '$eco', datemaj = NOW() WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB';";
    $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur.");

    $sql = "UPDATE eco_relation SET  vision = '$vision', eco = '$eco', datemaj = NOW() WHERE idpays1 = '$idpaysB' AND idpays2 = '$idpaysA';";
    $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur.");

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
