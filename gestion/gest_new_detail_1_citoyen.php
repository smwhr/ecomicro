<?php

echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur
mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");

$idjoueur = $_SESSION['perso_iduser'];
$citoyen = addslashes(trim($_GET['citoyen']));
$tmp_echo = "var id_citoyen = " . $citoyen . ";";
echo $tmp_echo;

include("include/info_user.php");

include("include/new_detail_1_citoyen.php");

include("include/new_possession_1_citoyen.php");

include("include/new_entreprise_1_citoyen.php");

include("include/new_cpte_1_citoyen.php");
	
include("include/new_titre_1_citoyen.php");
	

echo "</script>";

mysqli_close($conn);

$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];

?>
