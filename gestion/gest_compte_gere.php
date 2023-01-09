<?php

echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur
mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");

$idjoueur = $_SESSION['perso_iduser'];


$look_cpte = trim($_GET['cpte']);
if ($look_cpte != '')
{
	$look_tmp = "var look_cpte = " . $look_cpte . "; ";
	echo $look_tmp;
}
else
{
	$look_tmp = "var look_cpte = 0; ";
	echo $look_tmp;
}

include("include/info_user.php");

include("include/cpte_user.php");

include("include/mvt_cpte_user.php");

include("include/transac_cpte_user.php");

include("include/titulaire_cpte_user.php");

include("include/liste_devise.php");

echo "</script>";

mysqli_close($conn);

$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];

?>
