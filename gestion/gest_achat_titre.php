<?php
echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur
@mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");

$idjoueur = $_SESSION['perso_iduser'];

include("include/info_user.php");
include("include/cpte_user.php");
include("include/achat_cpte_titre.php");
include("include/achat_titre.php");
include("include/taux_change.php");
include("include/liste_pays.php");
echo "</script>";

mysqli_close($conn);

$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];
?>

