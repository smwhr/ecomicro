<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>



<html>
<head>
    <title> Suppression d'un compte </title>
<head>

<body>

<?php
  include("../include/config.php");

  $idcpte = mysqli_real_escape_string($conn, addslashes(trim($_POST['idcpte'])));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'éxistez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'éxistez pas désolé !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999'){
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);

	  $sql = "SELECT idcompte FROM eco_banque,eco_user, eco_entreprise WHERE eco_banque.idcompte = '$idcpte' ";
	  $sql .= "AND ((eco_banque.idtitulaire = '$paysjoueur' AND '$autojoueur' > '4') ";
	  $sql .= "OR (eco_banque.idtitulaire = eco_user.iduser AND eco_user.idpays = '$paysjoueur' AND '$autojoueur' > '4') ";
	  $sql .= "OR (eco_banque.idtitulaire = eco_entreprise.identreprise AND eco_entreprise.idpays = '$paysjoueur' AND '$autojoueur' > '4') ";
	  $sql .= "OR (eco_banque.idtitulaire = eco_entreprise.identreprise AND eco_entreprise.iduser = '$idjoueur') ";
	  $sql .= "OR eco_banque.idtitulaire = '$idjoueur' );";

	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification1, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification1, désolé !!!");
    }

  // V�rif Compte Etat
  $sql = "SELECT devise1 FROM eco_tauxchange WHERE idcompte = '$idcpte';";
  $res = @mysqli_query($conn, $sql)or die("<br> Pb dans la verif du cpte");
  $num = @mysqli_num_rows($res);

  if ($num > 0)
    die("<br> Ce compte est utilisé comme compte d'état. Suppression impossible.");

  // Vérif
  $sql = "SELECT eco_banque.idtitulaire ";
  $sql .= "FROM eco_banque, eco_user ";
  $sql .= "WHERE eco_banque.idcompte = '$idcpte' ";
  $sql .= "AND eco_banque.idtitulaire = eco_user.iduser ";
  $sql .= "AND 1 = ( SELECT count(a.idcompte) ";
  $sql .= "FROM eco_banque as a ";
  $sql .= "WHERE a.idtitulaire = eco_user.iduser ";
  $sql .= "GROUP BY a.idtitulaire) ";

  $res = @mysqli_query($conn, $sql)or die("<br> Pb dans la verif du cpte (user)");
  $num = @mysqli_num_rows($res);

  if ($num > 0)
    die("<br> Ce compte est le dernier compte de son propriétaire (user).");

  $sql = "SELECT eco_banque.idtitulaire ";
  $sql .= "FROM eco_banque, eco_entreprise ";
  $sql .= "WHERE eco_banque.idcompte = '$idcpte' ";
  $sql .= "AND eco_banque.idtitulaire = eco_entreprise.identreprise ";
  $sql .= "AND 1 = ( SELECT count(a.idcompte) ";
  $sql .= "FROM eco_banque as a ";
  $sql .= "WHERE a.idtitulaire = eco_entreprise.identreprise ";
  $sql .= "GROUP BY a.idtitulaire) ";

  $res = @mysqli_query($conn, $sql)or die("<br> Pb dans la verif du cpte (entreprise)");
  $num = @mysqli_num_rows($res);

  if ($num > 0)
    die("<br> Ce compte est le dernier compte de son propriétaire (entreprise).");

  $sql = "SELECT eco_banque.idtitulaire ";
  $sql .= "FROM eco_banque, eco_pays ";
  $sql .= "WHERE eco_banque.idcompte = '$idcpte' ";
  $sql .= "AND eco_banque.idtitulaire = eco_pays.idpays ";
  $sql .= "AND 1 = ( SELECT count(a.idcompte) ";
  $sql .= "FROM eco_banque as a ";
  $sql .= "WHERE a.idtitulaire = eco_pays.idpays ";
  $sql .= "GROUP BY a.idtitulaire) ";

  $res = @mysqli_query($conn, $sql)or die("<br> Pb dans la verif du cpte (pays)");
  $num = @mysqli_num_rows($res);

  if ($num > 0)
    die("<br> Ce compte est le dernier compte de son propriétaire (pays).");

  $sql = "SELECT eco_pays.cptenat ";
  $sql .= "FROM eco_pays ";
  $sql .= "WHERE eco_pays.cptenat = '$idcpte' ";

  $res = @mysqli_query($conn, $sql)or die("<br> Pb dans la verif du cpte (pays nat)");
  $num = @mysqli_num_rows($res);

  if ($num > 0)
    die("<br> Ce compte est le compte principal d'un pays.");

  $sql = "DELETE FROM eco_tranperiodique WHERE idcpte1 = '$idcpte' OR idcpte2 = '$idcpte';";
  $res = @mysqli_query($conn, $sql) or die("Suppression transac périodique impossible. Contactez l'administrateur");

  $sql = "DELETE FROM eco_banque WHERE idcompte = '$idcpte';";
  $res = @mysqli_query($conn, $sql) or die("Suppression compte impossible. Contactez l'administrateur");

  $sql = "DELETE FROM eco_mvtbanque WHERE idcompte = '$idcpte';";
  $res = @mysqli_query($conn, $sql) or die("Suppression mvt banque impossible. Contactez l'administrateur");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../new_detail_1_citoyen.php?citoyen=".$idjoueur."\");</script>";
?>

</body>
</html>
