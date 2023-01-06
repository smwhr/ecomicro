<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
<title> Cr�ation d'un citoyen </title>
<head>
<body>

<?php

  include("../include/config.php");

  $nomA = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['nomA']))));
  $emailA = addslashes(trim($_POST['emailA']));
  $loginA = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['loginA']))));
  $idpaysA = trim($_POST['idpaysA']);
  $pwdA = addslashes(trim($_POST['pwdA']));
  $deviseA = addslashes(trim($_POST['deviseA']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de donn�es -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> PB de vérification1, désolé !!!");
	  
	  if ($idpaysA != $paysjoueur)
	  	die("<br> PB de vérification2, désolé !!!");

	  $sql = "SELECT eco_user.iduser FROM eco_user, eco_pays WHERE eco_user.iduser = '$idjoueur' ";
	  $sql .= "AND eco_user.idpays = eco_pays.idpays AND eco_pays.devise = '$deviseA' ";
	  $sql .= "AND eco_pays.idpays = '$paysjoueur' ;";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification3, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification3, désolé !!!");

	  $sql = "SELECT eco_user.login FROM eco_user WHERE eco_user.login = '$loginA' ";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification4, désolé !!!");
	  $num = @mysqli_num_rows($res);
	  if ($num >0 )
	  	die("<br> Ce Login existe déjà, désolé !!!");
	  $sql = "SELECT eco_user.login FROM eco_user WHERE eco_user.nom = '$nomA' ";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification5, désolé !!!");
	  $num = @mysqli_num_rows($res);
	  if ($num >0 )
	  	die("<br> Ce nom existe déjà, désolé !!!");
	}

  $sql = "SELECT idmax FROM eco_max;";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du max id !!!");
  $num = @mysqli_num_rows($res) or die("PB recherche du max id !!!");
  $produit = mysqli_fetch_array($res);

  $newmax = $produit['idmax'] + 1;
  $sql = "UPDATE eco_max SET idmax = '$newmax';";
  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete d'incrémentation du max id...");

  $sql = "INSERT INTO eco_user (iduser,nom,email,login,pwd,datemaj,datecreation,idpays,datecnx) VALUES('$newmax','$nomA','$emailA','$loginA',DES_ENCRYPT('$pwdA'),NOW(),NOW(),'$idpaysA',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création citoyen impossible. Contactez l'administrateur");

  $sql = "INSERT INTO eco_banque (idcompte,idtitulaire,nomcpte,solde,devise) VALUES('','$newmax','$nomA',0,'$deviseA');";
  $res = @mysqli_query($conn, $sql) or die("Création compte impossible. Contactez l'administrateur");

  $idcpte = @mysql_insert_id();

  $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES('','$idcpte',0,0,'$deviseA','Initialisation',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création mvt impossible. Contactez l'administrateur");

  $sql = "INSERT INTO eco_fonction (idfonction,iduser,fonction,auto1,auto2,auto3) VALUES('','$newmax','CITOYEN','1','1','1');";
  $res = @mysqli_query($conn, $sql) or die("Création fonction impossible. Contactez l'administrateur");


  $sql = "SELECT emaileco FROM eco_pays WHERE idpays = '$idpaysA' ;";
  $res = @mysqli_query($conn, $sql)or die("<br> PB de rech pays, désolé !!!");
  $num = @mysqli_num_rows($res) or die("<br> PB de rech pays (newcitoyen), désolé !!!");
  $produit = mysqli_fetch_array($res);

$fct_mes_citoyen_emaileco = $produit['emaileco'];

$fct_mes_citoyen_type = "NEW";
$fct_mes_citoyen_nom = $nomA;
$fct_mes_citoyen_login = $loginA;
$fct_mes_citoyen_email = $emailA;

  // Envoi du message
  include("../include/fct_mes_citoyen.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../citoyen_detail.php\");</script>";

?>

</body>
</html>
