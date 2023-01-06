<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>
<html>
<head>
    <title> Modification d'une Relation </title>
<head>
<body>

<?php
  include("../include/config.php");

  $vision = trim($_POST['vision']);
  $eco = trim($_POST['eco']);
  $idpaysA = trim($_POST['idpaysA']);
  $idpaysB = trim($_POST['idpaysB']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  

  if ($_SESSION['perso_droituser'] != '999')  {
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
			die("<br> PB lors de la vérification1...");
	
	  $sql = "SELECT iduser FROM eco_user ";
	  $sql .= "WHERE eco_user.iduser = '$idjoueur' AND idpays = '$idpaysA' ;";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB lors de la vérification2...");
	  $num = @mysqli_num_rows($res) or die("<br> PB lors de la vérification2...");
	}

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'éxistez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'éxistez pas désolé !!!");

$fct_mes_resp_type = 'F';
$fct_mes_resp_eco = $eco;

    $sql = "SELECT nompays FROM eco_pays WHERE idpays = '$idpaysA';";
    $res = @mysqli_query($conn, $sql)or die("<br> paysA n'éxiste pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> paysA n'éxiste pas désolé !!!");
    $produit = mysqli_fetch_array($res);

$fct_mes_resp_pays = $produit['nompays'];

    $sql = "SELECT nompays,emaileco FROM eco_pays WHERE idpays = '$idpaysB';";
    $res = @mysqli_query($conn, $sql)or die("<br> paysB n'éxiste pas !!!");
    $num = @mysqli_num_rows($res) or die("<br> paysB n'éxiste pas désolé !!!");
    $produit = mysqli_fetch_array($res);

$fct_mes_resp_paysB = $produit['nompays'];
$fct_mes_resp_emaileco = $produit['emaileco'];

  if ($vision == '1')
    $eco = '1';

  $sql = "SELECT vision, eco FROM eco_relation WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB';";
  $res = @mysqli_query($conn, $sql) or die("Rech impossible. Contactez l'administrateur.");
  $produit = mysqli_fetch_array($res);
  
    if ((($produit['vision'] == 1) && ($vision == 0)) || (($produit['eco'] == 1) && ($eco == 0)))
      die("<br> Modification directe interdite...");

  $sql = "UPDATE eco_relation SET  vision = '$vision', eco = '$eco', datemaj = NOW() WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur.");

  $sql = "UPDATE eco_relation SET  vision = '$vision', eco = '$eco', datemaj = NOW() WHERE idpays1 = '$idpaysB' AND idpays2 = '$idpaysA';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur.");

  // Envoi du message
  include("../include/fct_mes_resp.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../relation_etat.php\");</script>";

?>
</body>
</html>
