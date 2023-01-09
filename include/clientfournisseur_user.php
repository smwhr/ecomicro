<?php

$sql = "SELECT DISTINCTROW eco_pays.nompays,eco_pays.idpays,nomentreprise,eco_entreprise.identreprise,typeentreprise,quantite,nomunite,eco_unite.idunite FROM eco_pays,eco_user as a,eco_entreprise,eco_unite,eco_stock,eco_relation WHERE eco_pays.idpays = eco_entreprise.idpays AND eco_entreprise.identreprise = eco_stock.identreprise AND eco_stock.idunite = eco_unite.idunite AND (eco_entreprise.iduser = '$idjoueur' OR (( a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1 ) ) AND ( eco_entreprise.idpays = eco_relation.idpays2 ) AND  eco_relation.vision = '0' ) ) ORDER BY nompays,nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_CF_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_CF_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CF_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CF_NOMENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CF_IDENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CF_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CF_QUANTITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CF_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CF_IDUNITE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_CF_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="LIST_CF_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="LIST_CF_NOMENTREPRISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="LIST_CF_IDENTREPRISE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="LIST_CF_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="LIST_CF_QUANTITE[";
              echo $tmp,$count,"]=\"",$produit["quantite"],"\";";
              $tmp="LIST_CF_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomunite"]),"\";";
              $tmp="LIST_CF_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["idunite"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_CF_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CF_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CF_NOMENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CF_IDENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CF_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CF_QUANTITE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CF_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CF_IDUNITE = new Array(0);";
        echo $tmp;
}
?>







