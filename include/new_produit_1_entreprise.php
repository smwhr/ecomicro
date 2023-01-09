<?php

$sql = "SELECT eco_production.identreprise,eco_entreprise.nomentreprise,idproduit,nomproduit,a.typeproduit,a.typeequi,image,description,nbunite,b.libelle,b.typeproduit as typeprodb,eco_production.prix ";
$sql .= "FROM eco_entreprise,eco_production,eco_typeproduit as a,eco_typeproduit as b ";
$sql .= "WHERE b.typeproduit = eco_production.idunite AND eco_entreprise.identreprise = eco_production.identreprise ";
$sql .= "AND eco_production.typeproduit = a.typeproduit AND eco_entreprise.identreprise = '$entreprise' ";
$sql .= "ORDER BY nomproduit";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (DET_ENTRE_PROD_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_ENTRE_PROD_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_TYPEEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_PRIX = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_PROD_NBUSE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nb d'uilisation du produit
              $tmpprod = $produit["idproduit"];
              $sql1 = "SELECT count(*) as nbuse FROM eco_possession WHERE idproduit = '$tmpprod'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te (SELECT auxiliaire 1 DET_ENTRE_PROD_)");
              $produit1 = mysqli_fetch_array($res1);

              $tmp="DET_ENTRE_PROD_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="DET_ENTRE_PROD_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="DET_ENTRE_PROD_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="DET_ENTRE_PROD_TYPEEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="DET_ENTRE_PROD_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="DET_ENTRE_PROD_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="DET_ENTRE_PROD_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="DET_ENTRE_PROD_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";
              $tmp="DET_ENTRE_PROD_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["typeprodb"],"\";";
              $tmp="DET_ENTRE_PROD_PRIX[";
              echo $tmp,$count,"]=\"",$produit["prix"],"\";";
              $tmp="DET_ENTRE_PROD_NBUSE[";
              echo $tmp,$count,"]=\"",$produit1["nbuse"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_ENTRE_PROD_IDPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_NOMPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_TYPEEQUI = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_IMAGE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_DESCRIPTION = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_NBUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_IDUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_PRIX = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_PROD_NBUSE = new Array(0);";
        echo $tmp;
}
?>







