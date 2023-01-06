<?php



echo "<script language=\"javascript\" type=\"text/javascript\" >";


include("../include/config.php");



$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur

mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");



$entreprise = addslashes(trim($_GET['entreprise']));

echo "var entre = ",$entreprise,";";



include("../include/detail_1_entreprise.php");



include("../include/possession_1_entreprise.php");



include("../include/residence_1_entreprise.php");



include("../include/liste_typeentreprise.php");



echo "</script>";



mysqli_close($conn);





?>

