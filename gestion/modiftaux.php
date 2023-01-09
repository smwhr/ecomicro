<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>
<html>
<head>
    <title> Modification d un taux de change </title>
<head>
<body>

<?php
  include("../include/config.php");


  $taux = trim($_POST['taux']);
  $idcpte = trim($_POST['idcpte']);
  $deviseA = trim($_POST['deviseA']);
  $deviseB = trim($_POST['deviseB']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT iduser, idpays FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> PB de vérification1, désolé !!!");
	  $produit = mysqli_fetch_array($res);
	  if ($produit['idpays'] != $paysjoueur)
	  	die("<br> PB de vérification2, désolé !!!");

	  $sql = "SELECT idcompte FROM eco_banque, eco_pays WHERE eco_banque.idcompte = '$idcpte' ";
	  $sql .= "AND eco_banque.idtitulaire = eco_pays.idpays AND eco_pays.devise = '$deviseA' ";
	  $sql .= "AND eco_pays.idpays = '$paysjoueur' ;";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification3, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification3, désolé !!!");
	}

  $sql = "UPDATE eco_tauxchange SET taux = '$taux', idcompte = '$idcpte', datemaj = NOW() WHERE devise1 = '$deviseA' AND devise2 = '$deviseB';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur ce citoyen");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../taux_change.php\");</script>";

?>

</body>
</html>