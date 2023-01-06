<?php

$sql = "SELECT eco_entreprise.identreprise,eco_entreprise.nomentreprise,typeentreprise,quantite,eco_typeproduit.libelle,eco_typeproduit.typeproduit,eco_typeproduit.typeequi ";
$sql .= "FROM eco_entreprise,eco_typeproduit,eco_stock ";
$sql .= "WHERE eco_entreprise.identreprise = eco_stock.identreprise ";
$sql .= "AND eco_stock.idunite = eco_typeproduit.typeproduit AND eco_entreprise.idpays = '$etat' ";
$sql .= "AND eco_stock.quantite > 0 ";
$sql .= "ORDER BY nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (DET_STOC_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_STOC_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_STOC_NOMENTRE = new Array(";
        echo $tmp, $num,");";
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
              $tmp="DET_STOC_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="DET_STOC_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
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
        $tmp="var DET_STOC_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_STOC_NOMENTRE = new Array(0);";
        echo $tmp;
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







