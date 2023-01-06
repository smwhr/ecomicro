<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
    <title> Modification d'une dette </title>
<head>
<body>

<?php
  include("../include/config.php");

  $entre = trim($_POST['entre']);
  $dette = trim($_POST['dette']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT idpays FROM eco_entreprise WHERE identreprise = '$entre';";
  $res = @mysqli_query($conn, $sql)or die("<br> L'entreprise n'existe pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> L'entreprise n'existe désolé !!!");


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
  }

  $sql = "UPDATE eco_dette SET  dette = '$dette', datemaj = NOW() WHERE identreprise = '$entre';";
  $res = @mysqli_query($conn, $sql) or die("Màj dette impossible. Contactez l'administrateur.");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../dette.php\");</script>";

?>

</body>
</html>