<?php

$sql = "SELECT DISTINCTROW nomentreprise,typeentreprise,quantite,eco_typeproduit.libelle,eco_typeproduit.typeproduit,eco_typeproduit.typeequi ";
$sql .= "FROM eco_entreprise,eco_typeproduit,eco_stock,eco_pays,eco_user as a,eco_relation ";
$sql .= "WHERE eco_pays.idpays = eco_entreprise.idpays AND eco_entreprise.identreprise = eco_stock.identreprise ";
$sql .= "AND eco_stock.idunite = eco_typeproduit.typeproduit AND ( eco_entreprise.iduser = '$idjoueur' ";
$sql .= "OR ((a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ) ";
$sql .= "AND ( eco_entreprise.idpays = eco_relation.idpays2 ) AND  eco_relation.vision = '0' )) ";
$sql .= "AND eco_entreprise.identreprise = '$entreprise' ";
$sql .= "ORDER BY nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (DET_STOC_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_STOC_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_STOC_QUANTITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_STOC_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_STOC_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_STOC_IDUNITEEQUI = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DET_STOC_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="DET_STOC_QUANTITE[";
              echo $tmp,$count,"]=\"",$produit["quantite"],"\";";
              $tmp="DET_STOC_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="DET_STOC_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";
              $tmp="DET_STOC_IDUNITEEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_STOC_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var DET_STOC_QUANTITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_STOC_IDUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_STOC_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_STOC_IDUNITEEQUI = new Array(0);";
        echo $tmp;
}
?>







