<?php

$sql = "SELECT DISTINCTROW eco_pays.idpays,eco_pays.nompays,eco_production.identreprise,eco_entreprise.nomentreprise,idproduit,eco_typeproduit.typeproduit,eco_typeproduit.typeequi,nomproduit,image,description,nbunite,b.libelle as nomunite,b.typeproduit as idunite FROM eco_entreprise,eco_production,eco_typeproduit as b,eco_pays,eco_typeproduit,eco_user as a,eco_relation WHERE b.typeproduit = eco_production.idunite AND eco_entreprise.identreprise = eco_production.identreprise AND eco_entreprise.idpays = eco_pays.idpays AND eco_production.typeproduit = eco_typeproduit.typeproduit AND ( eco_entreprise.iduser = '$idjoueur' OR ((a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ) AND ( eco_entreprise.idpays = eco_relation.idpays2 ) AND  eco_relation.vision = '0' ))";

$res = @mysqli_query($conn, $sql) or die("Probl�me dans la requ�te (DET_PROD_).");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_PROD_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_TYPEPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_TYPEPRODUITEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_PROD_NBUSE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nb d'uilisation du produit
              $tmpprod = $produit["idproduit"];
              $sql1 = "SELECT count(*) as nbuse FROM eco_possession WHERE idproduit = '$tmpprod'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te (SELECT auxiliaire 1)");
              $produit1 = mysqli_fetch_array($res1);

              $tmp="DET_PROD_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="DET_PROD_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="DET_PROD_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="DET_PROD_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="DET_PROD_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="DET_PROD_TYPEPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="DET_PROD_TYPEPRODUITEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="DET_PROD_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="DET_PROD_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="DET_PROD_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="DET_PROD_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="DET_PROD_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomunite"]),"\";";
              $tmp="DET_PROD_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["idunite"],"\";";
              $tmp="DET_PROD_NBUSE[";
              echo $tmp,$count,"]=\"",$produit1["nbuse"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_PROD_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_NOMENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_IDPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_TYPEPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_TYPEPRODUITEQUI = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_NOMPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_IMAGE = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_DESCRIPTION = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_NBUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_IDUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_PROD_NBUSE = new Array(0);";
        echo $tmp;
}
?>







