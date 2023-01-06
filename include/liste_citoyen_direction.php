<?php

$sql = "SELECT eco_user.iduser,eco_user.idpays,eco_user.nom,eco_pays.nompays,eco_user.login ";
$sql .= "FROM eco_user, eco_pays WHERE eco_user.inactif = '0' ";
$sql .= "AND eco_user.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 
$sql .= "AND eco_user.idpays = eco_pays.idpays ";
$sql .= "ORDER BY eco_pays.nompays, eco_user.nom";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_CIT_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_CIT_IDUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CIT_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CIT_NOM = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CIT_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CIT_LOGIN = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_CIT_IDUSER[";
              echo $tmp,$count,"]=\"",$produit["iduser"],"\";";
              $tmp="LIST_CIT_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="LIST_CIT_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";
              $tmp="LIST_CIT_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="LIST_CIT_LOGIN[";
              echo $tmp,$count,"]=\"",$produit["login"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_CIT_IDUSER = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CIT_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CIT_NOM = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CIT_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CIT_LOGIN = new Array(0);";
        echo $tmp;
}
?>







