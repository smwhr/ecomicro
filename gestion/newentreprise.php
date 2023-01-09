<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Cr�ation d'une entreprise </title>
<head>
<body>

<?php

  include("../include/config.php");

  $nomA = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['nomA']))));
  $typeA = trim($_POST['typeA']);
  $capaA = trim($_POST['capaA']);
  $idpaysA = trim($_POST['idpaysA']);
  $iduserA = trim($_POST['iduserA']);
  $propriA = trim($_POST['propriA']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

$fct_mes_entre_type = "N";
$fct_mes_entre_entreprise = stripslashes($nomA);

  $sql = "SELECT iduser FROM eco_user WHERE eco_user.iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!1");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!2");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> PB de vérification1, désolé !!!");
	  
	  if ($idpaysA != $paysjoueur)
	  	die("<br> PB de vérification2, désolé !!!");
	}

  $sql = "SELECT idmax FROM eco_max;";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du max id !!!");
  $num = @mysqli_num_rows($res) or die("PB recherche du max id !!!");
  $produit = mysqli_fetch_array($res);

  $newmax = $produit['idmax'] + 1;
  $sql = "UPDATE eco_max SET idmax = '$newmax';";
  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete d'incr�mentation du max id...");

  if (($typeA >= '10000') && ($typeA < '20000'))
     $capaAmens = 0;
  else
     $capaAmens = $capaA;
  $sql = "INSERT INTO eco_entreprise (identreprise,nomentreprise,typeentreprise,idpays,iduser,capacite,capacitemens,datecreation) VALUES('$newmax','$nomA','$typeA','$idpaysA','$iduserA','$capaA','$capaAmens',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création citoyen impossible. Contactez l'administrateur" . $sql . " - " . $res);

  $sql = "SELECT devise,emaileco FROM eco_pays WHERE idpays = '$idpaysA';";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche de la devise !!!");
  $num = @mysqli_num_rows($res) or die("PB recherche de la devise !!!");
  $produit = mysqli_fetch_array($res);
  $devise = $produit['devise'];

$fct_mes_entre_emaileco = $produit['emaileco'];

  $sql = "INSERT INTO eco_banque (idcompte,idtitulaire,nomcpte,solde,devise) VALUES('','$newmax','$nomA',0,'$devise');";
  $res = @mysqli_query($conn, $sql) or die("Création compte impossible. Contactez l'administrateur ");

  $idcpte = @mysql_insert_id();

  $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES('','$idcpte',0,0,'$devise','Initialisation',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création mvt impossible. Contactez l'administrateur");

  // Bourse
  $sql = "INSERT INTO eco_bourse (identreprise,idactionnaire,nbaction,datederniereope) VALUES('$newmax','$propriA','1000',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création bourse impossible. Contactez l'administrateur");

  $sql = "INSERT INTO eco_cotation (identreprise,nbtitre,cotation,devise,dernierecotation,evol3mois,evol12mois,datemaj) VALUES('$newmax','1000',10.00,'$devise',10.00,0,0,NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création cotation impossible. Contactez l'administrateur");

  // Dette
  $sql = "INSERT INTO eco_dette (identreprise,dette,devise,datemaj) VALUES('$newmax',0,'$devise',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création dette impossible. Contactez l'administrateur");

  // Envoi du message
  include("../include/fct_mes_entreprise.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../entreprise_detail.php\");</script>";

?>

</body>
</html>
