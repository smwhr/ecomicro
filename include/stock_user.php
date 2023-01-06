<?php

$sql = "SELECT nompays,eco_pays.idpays,nomentreprise,eco_entreprise.identreprise,typeentreprise,quantite,eco_typeproduit.libelle,eco_typeproduit.typeproduit ";
$sql .= "FROM eco_pays,eco_entreprise,eco_typeproduit,eco_stock ";
$sql .= "WHERE eco_pays.idpays = eco_entreprise.idpays AND eco_entreprise.identreprise = eco_stock.identreprise ";
$sql .= "AND eco_stock.idunite = eco_typeproduit.typeproduit  AND eco_entreprise.iduser = '$idjoueur' ";
$sql .= "ORDER BY nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (STOCK_GERE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var STOCK_GERE_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var STOCK_GERE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var STOCK_GERE_NOMENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var STOCK_GERE_IDENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var STOCK_GERE_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var STOCK_GERE_QUANTITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var STOCK_GERE_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var STOCK_GERE_NOMUNITE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="STOCK_GERE_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="STOCK_GERE_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="STOCK_GERE_NOMENTREPRISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="STOCK_GERE_IDENTREPRISE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="STOCK_GERE_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="STOCK_GERE_QUANTITE[";
              echo $tmp,$count,"]=\"",$produit["quantite"],"\";";
              $tmp="STOCK_GERE_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="STOCK_GERE_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var STOCK_GERE_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var STOCK_GERE_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var STOCK_GERE_NOMENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var STOCK_GERE_IDENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var STOCK_GERE_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var STOCK_GERE_QUANTITE = new Array(0);";
        echo $tmp;
        $tmp="var STOCK_GERE_IDUNITE = new Array(0);";
        echo $tmp;
        $tmp="var STOCK_GERE_NOMUNITE = new Array(0);";
        echo $tmp;
}
?>







