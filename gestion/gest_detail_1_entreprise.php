<?php
echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur
@mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");

$idjoueur = $_SESSION['perso_iduser'];
$entreprise = addslashes(trim($_GET['entreprise']));

echo "var entre = ",$entreprise,";";

include("include/info_user.php");

include("include/detail_1_entreprise.php");

include("include/possession_1_entreprise.php");

include("include/stock_1_entreprise.php");

include("include/produire_1_entreprise.php");

include("include/residence_1_entreprise.php");

include("include/liste_citoyen.php");

include("include/liste_typeentreprise.php");

echo "</script>";

mysqli_close($conn);

$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];

?>