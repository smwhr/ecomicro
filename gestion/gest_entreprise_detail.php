<?php
echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter à la base de données"); // Le @ ordonne a php de ne pas afficher de message d'erreur
@mysqli_select_db($conn, $bdd) or die("Impossible de se connecter à la base de données");

$idjoueur = $_SESSION['perso_iduser'];

include("include/info_user.php");
include("include/detail_entreprise.php");
include("include/liste_proprietaire.php");
include("include/liste_citoyen_direction.php");
include("include/liste_pays.php");
include("include/liste_typeentreprise.php");

echo "</script>";

mysqli_close($conn);

$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];

?>