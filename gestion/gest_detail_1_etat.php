<?php
echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter à la base de données"); // Le @ ordonne a php de ne pas afficher de message d'erreur
@mysqli_select_db($conn, $bdd) or die("Impossible de se connecter à la base de données");

$idjoueur = $_SESSION['perso_iduser'];
$etat = addslashes(trim($_GET['etat']));

echo "var etat = ",$etat,";";

include("include/info_user.php");
include("include/cpte_nation.php");
include("include/detail_1_etat.php");
include("include/stock_1_etat.php");
include("include/besoin_1_etat.php");
include("include/liste_citoyen.php");
include("include/liste_typeentreprise.php");
include("include/liste_pays_etat.php");
include("include/liste_entreprise_1_etat.php");

echo "</script>";

mysqli_close($conn);

$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];

?>