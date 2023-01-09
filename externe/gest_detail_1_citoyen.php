<?php



echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("../include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur

mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");



$citoyen = addslashes(trim($_GET['citoyen']));



include("../include/detail_1_citoyen.php");



include("../include/possession_1_citoyen.php");



include("../include/residence_1_citoyen.php");



echo "</script>";



mysqli_close($conn);





?>

