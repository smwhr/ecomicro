<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Cr�ation d'un pays </title>
<head>
<body>

<?php

  include("../include/config.php");

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $nompays = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['nompays']))));
  $nomA = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['nomA']))));
  $emailA = addslashes(trim($_POST['emailA']));
  $loginA = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['loginA']))));
  $pwdA = trim($_POST['pwdA']);
  $mleco = addslashes(trim($_POST['mleco']));
  $devise = addslashes(trim($_POST['devise']));

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
	  	die("<br> PB de v�rification1, désolé !!!");

  // => Cr�ation

  // R�servation de l'identifiant du pays
  $sql = "SELECT idmax FROM eco_max;";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du max id !!!");
  $num = @mysqli_num_rows($res) or die("PB recherche du max id !!!");
  $produit = mysqli_fetch_array($res);

  $newmax_pays = $produit['idmax'] + 1;
  $sql = "UPDATE eco_max SET idmax = '$newmax_pays';";
  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete d'incrémentation du max id...");

  // Dirigeant

  // R�servation de l'identifiant du responsable
  $sql = "SELECT idmax FROM eco_max;";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du max id !!!");
  $num = @mysqli_num_rows($res) or die("PB recherche du max id !!!");
  $produit = mysqli_fetch_array($res);

  $newmax = $produit['idmax'] + 1;
  $sql = "UPDATE eco_max SET idmax = '$newmax';";
  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te d'incrémentation du max id...");

  // Cr�ation du dirigeant
  $sql = "INSERT INTO eco_user (iduser,nom,email,login,pwd,datemaj,datecreation,idpays) VALUES('$newmax','$nomA','$emailA','$loginA',DES_ENCRYPT('$pwdA'),NOW(),NOW(),'$newmax_pays');";
  $res = @mysqli_query($conn, $sql) or die("Création dirigeant impossible. Contactez l'administrateur");

  // Cr�ation du compte du dirigeant
  $sql = "INSERT INTO eco_banque (idcompte,idtitulaire,nomcpte,solde,devise) VALUES('','$newmax','$nomA',0,'$devise');";
  $res = @mysqli_query($conn, $sql) or die("Création compte dirigeant impossible. Contactez l'administrateur");

  $idcpte = @mysql_insert_id();

  $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES('','$idcpte',0,0,'$devise','Initialisation',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création mvt impossible. Contactez l'administrateur");

  // Cr�ation de la fonction de dirigeant
  $sql = "INSERT INTO eco_fonction (idfonction,iduser,fonction,auto1,auto2,auto3) VALUES('','$newmax','CITOYEN','1','5','1');";
  $res = @mysqli_query($conn, $sql) or die("Création fonction impossible. Contactez l'administrateur");

  // Pays

  // Cr�ation compte pays
  $nomcpte = "Tr�sor " . $nompays;
  $sql = "INSERT INTO eco_banque (idcompte,idtitulaire,nomcpte,solde,devise) VALUES('','$newmax_pays','$nomcpte',0,'$devise');";
  $res = @mysqli_query($conn, $sql) or die("Création compte pays impossible. Contactez l'administrateur");

  $idcpte = @mysql_insert_id();
  $sav_idcpte = $idcpte;

  $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES('','$idcpte',0,0,'$devise','Initialisation',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création mvt impossible. Contactez l'administrateur");

  // Cr�ation pays
  $sql = "INSERT INTO eco_pays (idpays,nompays,iduser,emaileco,devise,cptenat,datecreation) VALUES('$newmax_pays','$nompays','$newmax','$mleco','$devise','$idcpte',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création pays impossible. Contactez l'administrateur");


  // Cr�ation des relations
  $sql = "SELECT idpays FROM eco_pays WHERE idpays <> '$newmax_pays';";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de lecture des pays !!!");
  $num = @mysqli_num_rows($res);
  if ($num != 0)
  {
    while ($produit = mysqli_fetch_array($res))
    {
      $idpays_lu = $produit['idpays'];

      $sql1 = "INSERT INTO eco_relation (idpays1,idpays2,vision,eco,datemaj) VALUES('$idpays_lu','$newmax_pays','0','1',NOW());";
      $res1 = @mysqli_query($conn, $sql1) or die("Création relation. Contactez l'administrateur");

      $sql1 = "INSERT INTO eco_relation (idpays1,idpays2,vision,eco,datemaj) VALUES('$newmax_pays','$idpays_lu','0','1',NOW());";
      $res1 = @mysqli_query($conn, $sql1) or die("Création relation. Contactez l'administrateur");
    }
  }
  $sql1 = "INSERT INTO eco_relation (idpays1,idpays2,vision,eco,datemaj) VALUES('$newmax_pays','$newmax_pays','0','0',NOW());";
  $res1 = @mysqli_query($conn, $sql1) or die("Création relation. Contactez l'administrateur");

  // Cr�ation des taux
  $sql = "SELECT idpays,devise,nompays FROM eco_pays WHERE idpays <> '$newmax_pays';";
  $res = @mysqli_query($conn, $sql)or die("Erreur 'dans la requete de lecture des pays !!!");
  $num = @mysqli_num_rows($res);
  if ($num != 0)
  {
    while ($produit = mysqli_fetch_array($res))
    {
      $idpays_lu = $produit['idpays'];
      $devise_lu = $produit['devise'];
      $nompays_lu = $produit['nompays'];

      // Cr�ation compte pays lu en nouvelle devise
      $nomcpte = "Banque " . $nompays_lu . " en " . $devise;
      $sql1 = "INSERT INTO eco_banque (idcompte,idtitulaire,nomcpte,solde,devise) VALUES('','$idpays_lu','$nomcpte',0,'$devise');";
      $res1 = @mysqli_query($conn, $sql1) or die("Création compte impossible. Contactez l'administrateur");
      $idcpte_lu = @mysql_insert_id();

      $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES('','$idcpte_lu',0,0,'$devise','Initialisation',NOW());";
      $res1 = @mysqli_query($conn, $sql) or die("Création mvt impossible. Contactez l'administrateur");

      // Cr�ation compte pays cr�� en devise lu
      $nomcpte = "Banque " . $nompays . " en " . $devise_lu;
      $sql1 = "INSERT INTO eco_banque (idcompte,idtitulaire,nomcpte,solde,devise) VALUES('','$newmax_pays','$nomcpte',0,'$devise_lu');";
      $res1 = @mysqli_query($conn, $sql1) or die("Création compte impossible. Contactez l'administrateur");
      $idcpte = @mysql_insert_id();

      $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES('','$idcpte',0,0,'$devise_lu','Initialisation',NOW());";
      $res1 = @mysqli_query($conn, $sql) or die("Création mvt impossible. Contactez l'administrateur");


      $sql1 = "INSERT INTO eco_tauxchange (devise1,devise2,idpays1,taux,idcompte,datemaj) VALUES('$devise_lu','$devise','$idpays_lu','1','$idcpte_lu',NOW());";
      $res1 = @mysqli_query($conn, $sql1) or die("Création taux. Contactez l'administrateur");

      $sql1 = "INSERT INTO eco_tauxchange (devise1,devise2,idpays1,taux,idcompte,datemaj) VALUES('$devise','$devise_lu','$newmax_pays','1','$idcpte',NOW());";
      $res1 = @mysqli_query($conn, $sql1) or die("Création taux. Contactez l'administrateur");
    }
  }
  $sql1 = "INSERT INTO eco_tauxchange (devise1,devise2,idpays1,taux,idcompte,datemaj) VALUES('$devise','$devise','$newmax_pays','1','$sav_idcpte',NOW());";
  $res1 = @mysqli_query($conn, $sql1) or die("Création taux. Contactez l'administrateur");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../info_etat.php\");</script>";

?>

</body>
</html>
