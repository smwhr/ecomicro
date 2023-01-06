<?php

$sql = "SELECT eco_pays.idpays,nompays,nomentreprise,eco_entreprise.identreprise,typeentreprise,quantite,eco_typeproduit.libelle,eco_typeproduit.typeproduit,eco_typeproduit.typeequi ";
$sql .= "FROM eco_entreprise,eco_typeproduit,eco_stock,eco_pays ";
$sql .= "WHERE eco_pays.idpays = eco_entreprise.idpays AND eco_entreprise.identreprise = eco_stock.identreprise AND eco_stock.idunite = eco_typeproduit.typeproduit AND eco_entreprise.iduser > '0' ";
$sql .= "AND eco_entreprise.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 
//$sql .= "AND a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1 ) AND eco_entreprise.idpays = eco_relation.idpays2 AND  eco_relation.vision = '0' AND eco_relation.eco = '0' ";
$sql .= "ORDER BY nomentreprise";

/*
$sql = "SELECT eco_pays.idpays,nompays,nomentreprise,eco_entreprise.identreprise,typeentreprise,quantite,eco_typeproduit.libelle,eco_typeproduit.typeproduit,eco_typeproduit.typeequi ";
$sql .= "FROM eco_entreprise,eco_typeproduit,eco_stock,eco_pays,eco_user as a,eco_relation ";
$sql .= "WHERE eco_pays.idpays = eco_entreprise.idpays AND eco_entreprise.identreprise = eco_stock.identreprise AND eco_stock.idunite = eco_typeproduit.typeproduit AND eco_entreprise.iduser > '0' ";
$sql .= "AND a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1 ) AND eco_entreprise.idpays = eco_relation.idpays2 AND  eco_relation.vision = '0' AND eco_relation.eco = '0' ";
$sql .= "ORDER BY nomentreprise";
*/

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (ACHAT_STOC_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var ACHAT_STOC_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_STOC_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_STOC_NOMENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_STOC_IDENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_STOC_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_STOC_QUANTITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_STOC_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_STOC_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_STOC_IDUNITEEQUI = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="ACHAT_STOC_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="ACHAT_STOC_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="ACHAT_STOC_NOMENTREPRISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="ACHAT_STOC_IDENTREPRISE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="ACHAT_STOC_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="ACHAT_STOC_QUANTITE[";
              echo $tmp,$count,"]=\"",$produit["quantite"],"\";";
              $tmp="ACHAT_STOC_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="ACHAT_STOC_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";
              $tmp="ACHAT_STOC_IDUNITEEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var ACHAT_STOC_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_STOC_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_STOC_NOMENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_STOC_IDENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_STOC_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_STOC_QUANTITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_STOC_IDUNITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_STOC_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_STOC_IDUNITEEQUI = new Array(0);";
        echo $tmp;
}
?>







