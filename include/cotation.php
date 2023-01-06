<?php

$sql = "SELECT DISTINCTROW eco_entreprise.identreprise,eco_entreprise.nomentreprise,eco_pays.idpays,eco_pays.nompays,cotation,eco_cotation.devise,eco_cotation.dernierecotation,eco_cotation.datemaj ";
$sql .= "FROM eco_entreprise,eco_pays,eco_cotation ";
$sql .= "WHERE eco_entreprise.idpays = eco_pays.idpays AND eco_cotation.identreprise = eco_entreprise.identreprise ";
$sql .= "AND eco_entreprise.typeentreprise < '60000' ";

$sql .= "AND ( eco_entreprise.iduser = '$idjoueur' OR  eco_entreprise.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0')) "; 

//$sql .= "AND ( eco_entreprise.iduser = '$idjoueur' OR ((a.iduser = '$idjoueur' ";
//$sql .= "AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ) ";
//$sql .= "AND eco_entreprise.idpays = eco_relation.idpays2 AND  eco_relation.vision = '0' )) ";

$sql .= "ORDER BY eco_pays.nompays,eco_entreprise.nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (COT_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var COT_IDENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var COT_NOMENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var COT_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var COT_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var COT_COTATION = new Array(";
        echo $tmp, $num,");";
        $tmp="var COT_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var COT_DERNIERECOT = new Array(";
        echo $tmp, $num,");";
        $tmp="var COT_DATEMAJ = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="COT_IDENTREPRISE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="COT_NOMENTREPRISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="COT_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="COT_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="COT_COTATION[";
              echo $tmp,$count,"]=\"",$produit["cotation"],"\";";
              $tmp="COT_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="COT_DERNIERECOT[";
              echo $tmp,$count,"]=\"",$produit["dernierecotation"],"\";";
              $tmp="COT_DATEMAJ[";
              echo $tmp,$count,"]=\"",$produit["datemaj"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var COT_IDENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var COT_NOMENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var COT_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var COT_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var COT_COTATION = new Array(0);";
        echo $tmp;
        $tmp="var COT_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var COT_DERNIERECOT = new Array(0);";
        echo $tmp;
        $tmp="var COT_DATEMAJ = new Array(0);";
        echo $tmp;
}
?>







