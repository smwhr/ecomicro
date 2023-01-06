<?php
echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter à la base de données"); // Le @ ordonne a php de ne pas afficher de message d'erreur
@mysqli_select_db($conn, $bdd) or die("Impossible de se connecter à la base de données");

$idjoueur = $_SESSION['perso_iduser'];

include("include/info_user.php");
include("include/cpte.php");
include("include/mvt_cpte.php");
include("include/transac_cpte.php");

echo "</script>";

mysqli_close($conn);
$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];
?>