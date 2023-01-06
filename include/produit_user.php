<?php

$sql = "SELECT eco_production.identreprise,eco_entreprise.nomentreprise,idproduit,nomproduit,a.typeproduit,a.typeequi,image,description,nbunite,b.libelle,b.typeproduit as typeprodb ";
$sql .= "FROM eco_entreprise,eco_production,eco_typeproduit as a,eco_typeproduit as b ";
$sql .= "WHERE b.typeproduit = eco_production.idunite AND eco_entreprise.identreprise = eco_production.identreprise ";
$sql .= "AND eco_production.typeproduit = a.typeproduit AND eco_entreprise.iduser = '$idjoueur' ";
$sql .= "ORDER BY eco_entreprise.nomentreprise, nomproduit";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (PRODP_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var PRODP_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_TYPEEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODP_NBUSE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nb d'uilisation du produit
              $tmpprod = $produit["idproduit"];
              $sql1 = "SELECT count(*) as nbuse FROM eco_possession WHERE idproduit = '$tmpprod'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te (SELECT auxiliaire 1)");
              $produit1 = mysqli_fetch_array($res1);

              $tmp="PRODP_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="PRODP_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="PRODP_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="PRODP_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="PRODP_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="PRODP_TYPEEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="PRODP_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="PRODP_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="PRODP_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="PRODP_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";
              $tmp="PRODP_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["typeprodb"],"\";";
              $tmp="PRODP_NBUSE[";
              echo $tmp,$count,"]=\"",$produit1["nbuse"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var PRODP_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_NOMENTRE = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_IDPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_NOMPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_TYPEEQUI = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_IMAGE = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_DESCRIPTION = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_NBUNITE = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_IDUNITE = new Array(0);";
        echo $tmp;
        $tmp="var PRODP_NBUSE = new Array(0);";
        echo $tmp;
}
?>







