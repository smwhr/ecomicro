<?php

$sql = "SELECT DISTINCTROW eco_pays.idpays,eco_pays.nompays,eco_production.identreprise,eco_entreprise.nomentreprise,idproduit,eco_typeproduit.typeproduit,eco_typeproduit.typeequi,nomproduit,image,description,nbunite,b.libelle as nomunite,b.typeproduit as idunite, eco_production.prix, eco_production.deviseprix ";
$sql .= "FROM eco_entreprise,eco_production,eco_typeproduit as b,eco_pays,eco_typeproduit ";
$sql .= "WHERE b.typeproduit = eco_production.idunite AND eco_entreprise.identreprise = eco_production.identreprise ";
$sql .= "AND eco_entreprise.iduser > '0' ";
$sql .= "AND eco_entreprise.idpays = eco_pays.idpays AND eco_production.typeproduit = eco_typeproduit.typeproduit ";
$sql .= "AND eco_entreprise.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 

//$sql .= "AND a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1 ) AND eco_entreprise.idpays = eco_relation.idpays2 AND eco_relation.vision = '0' AND eco_relation.eco = '0' ";

$res = @mysqli_query($conn, $sql) or die("Problème dans la requête (ACHAT_PROD_).");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var ACHAT_PROD_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_TYPEPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_TYPEPRODUITEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_PRIX = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_DEVISEPRIX = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_PROD_NBUSE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nb d'uilisation du produit
              $tmpprod = $produit["idproduit"];
              $sql1 = "SELECT count(*) as nbuse FROM eco_possession WHERE idproduit = '$tmpprod'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requête (SELECT auxiliaire 1)");
              $produit1 = mysqli_fetch_array($res1);

              $tmp="ACHAT_PROD_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="ACHAT_PROD_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="ACHAT_PROD_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="ACHAT_PROD_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="ACHAT_PROD_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="ACHAT_PROD_TYPEPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="ACHAT_PROD_TYPEPRODUITEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="ACHAT_PROD_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="ACHAT_PROD_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="ACHAT_PROD_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="ACHAT_PROD_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="ACHAT_PROD_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomunite"]),"\";";
              $tmp="ACHAT_PROD_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["idunite"],"\";";
              $tmp="ACHAT_PROD_PRIX[";
              echo $tmp,$count,"]=\"",$produit["prix"],"\";";
              $tmp="ACHAT_PROD_DEVISEPRIX[";
              echo $tmp,$count,"]=\"",$produit["deviseprix"],"\";";
              $tmp="ACHAT_PROD_NBUSE[";
              echo $tmp,$count,"]=\"",$produit1["nbuse"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var ACHAT_PROD_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_NOMENTRE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_IDPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_TYPEPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_TYPEPRODUITEQUI = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_NOMPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_IMAGE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_DESCRIPTION = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_NBUNITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_IDUNITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_PRIX = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_DEVISEPRIX = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_PROD_NBUSE = new Array(0);";
        echo $tmp;
}
?>







