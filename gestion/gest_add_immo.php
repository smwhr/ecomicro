<?php

echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur
mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");

$idjoueur = $_SESSION['perso_iduser'];
$citoyen = $idjoueur;
$tmp_echo = "var id_citoyen = " . $idjoueur . ";";
echo $tmp_echo;

include("include/info_user.php");

include("include/liste_entite.php");

include("include/liste_tout_typeprod.php");

echo "</script>";

mysqli_close($conn);

$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];

?>
