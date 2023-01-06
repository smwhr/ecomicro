<?php

echo "<script language=\"javascript\" type=\"text/javascript\" >";

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur
mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");

$idjoueur = $_SESSION['perso_iduser'];
$entreprise = addslashes(trim($_GET['entreprise']));
$tmp_echo = "var id_entreprise = " . $entreprise . ";";
echo $tmp_echo;

include("include/info_user.php");

include("include/new_detail_1_entreprise.php");

include("include/new_possession_1_entreprise.php");

include("include/new_cpte_1_entreprise.php");
	
include("include/new_titre_1_entreprise.php");
	
include("include/new_produit_1_entreprise.php");

include("include/new_quiprodquoi_1_entreprise.php");

//include("include/liste_province.php");

include("include/liste_province_totale.php");

include("include/liste_typeproduit.php");

include("include/liste_unite.php");

include("include/residence_1_entreprise.php");

include("include/liste_citoyen_direction.php");

include("include/liste_typeentreprise.php");

include("include/stock_1_entreprise.php");

include("include/produire_1_entreprise.php");

include("include/finance_1_entreprise.php");

$sql = "SELECT idpays ";
$sql .= "FROM eco_entreprise ";
$sql .= "WHERE eco_entreprise.identreprise = '$entreprise';";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (Consommer BES_ETAT).");
$num = @mysqli_num_rows($res) or die("petit pb... (Consommer BES_ETAT)");
$produit = mysqli_fetch_array($res);
$etat = $produit["idpays"];

include("include/besoin_1_etat.php");

echo "</script>";

mysqli_close($conn);

$_SESSION['from_url'] = $_SERVER['SCRIPT_NAME'];

?>
