<?php
   session_start();

include("include/config.php");

$login = addslashes(trim($_POST['login']));
$password = addslashes(trim($_POST['password']));
$retour = $_POST['retour'];

$conn = mysqli_connect($host,$user,$pass) or die("Verif 9 - Impossible de se connecter");
mysqli_select_db($conn, $bdd) or die("Verif 10 - Impossible de se connecter a la base de donnée");

$sql = "SELECT eco_user.idpays,eco_user.iduser,eco_user.login FROM eco_user WHERE eco_user.login='$login' AND eco_user.pwd= '$password'";

$res = @mysqli_query($conn, $sql) or die("Verif 14 - Impossible de selectionner");

$num = @mysqli_num_rows($res);

//if ($login != "dutois")
//die("Site indisponible pour maintenance...");

if ($num == 1 ){
    $iduser = @mysqli_fetch_array($res);

    $_SESSION['perso_iduser'] = $iduser["iduser"];
    $_SESSION['perso_login'] = $iduser["login"];
    $_SESSION['perso_idpays'] = $iduser["idpays"];

    $idjoueur = $iduser["iduser"];
    $idjoueur_tmp = $iduser["iduser"];
    $sql = "SELECT MAX(auto1) as auto1,MAX(auto2) as auto2,MAX(auto3) as auto3 FROM eco_fonction WHERE iduser='$idjoueur'";
    $res = @mysqli_query($conn, $sql) or die("Verif 28 - Impossible de selectionner la fonction");
    $num = @mysqli_num_rows($res) or die("Aucune fonction, contacter l'administrateur.");
    $iddroit = @mysqli_fetch_array($res);

    $tmp = str_pad($iddroit["auto1"],2,$iddroit["auto2"]);
    $tmp = str_pad($tmp,3,$iddroit["auto3"]);
    $_SESSION['perso_droituser'] = $tmp;

    if (!isset($retour)){
        $retour = "http://micromonde.ecomicro.net";
    }

    $sql = "UPDATE eco_user SET datecnx = NOW(), inactif = 0 WHERE iduser = '$idjoueur';";
    $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre profil n'a pu être effectuée ! Veuillez contacter l'administrateur.");

    include("include/trt_connexion.php");
//echo "Apres trt de connexion";

	// traceIP
$tmptmp = $_SESSION['perso_login'];
$id = $_SERVER["REMOTE_ADDR"];
$sql = "INSERT INTO eco_cnx (id_cnx,IP,date_cnx,ecran) VALUES (NULL,'$id',NOW(),'$tmptmp');";
	$res = @mysqli_query($conn, $sql) or die("Erreur de connexion...");


    mysqli_close($conn);
   $tmp = "new_detail_1_citoyen.php?citoyen=" . $idjoueur_tmp;
    echo "<script language='JavaScript'>
    document.location.replace('$tmp');
    </script>";
}
else
{
    mysqli_close($conn);

    echo "<script language='JavaScript'>
    document.location.replace('./formulaire.php?retour=$retour');
    </script>";
}

?>
