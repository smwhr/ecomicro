<?php



echo "<script language=\"javascript\" type=\"text/javascript\" >";


include("include/config.php");



$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur

mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");



$idjoueur = $_SESSION['perso_iduser'];



include("include/info_user.php");



include("include/produit_user.php");



include("include/entreprise_user_produit.php");



include("include/liste_typeproduit.php");



include("include/liste_unite.php");



include("include/liste_quiprodquoi.php");



include("include/liste_province.php");



echo "</script>";



mysqli_close($conn);



$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];



?>

