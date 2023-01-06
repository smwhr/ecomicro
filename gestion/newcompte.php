<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Cr�ation d'un compte </title>
<head>
<body>

<?php

  include("../include/config.php");

  $nomcompte = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['nomcompte']))));
  $titulaire = trim($_POST['titulaire']);
  $devise = trim($_POST['devise']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'éxistez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'éxistez pas désolé !!!");

  $sql = "INSERT INTO eco_banque (idcompte,idtitulaire,solde,devise,nomcpte) VALUES('','$titulaire',0,'$devise','$nomcompte');";
  $res = @mysqli_query($conn, $sql) or die("Création compte impossible. Contactez l'administrateur");

  $idcpte = @mysql_insert_id();

  $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES('','$idcpte',0,0,'$devise','Initialisation',NOW());";
  $res = @mysqli_query($conn, $sql) or die("Création mvt impossible. Contactez l'administrateur");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../compte_gere.php?cpte=".$idcpte."\");</script>";

?>

</body>
</html>
