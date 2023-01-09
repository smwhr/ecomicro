<?php

$sql = "SELECT pays.nompays,pays.idpays,production.identreprise,entreprise.nomentreprise,idproduit,nomproduit,image,description,nbunite,nomunite,unite.idunite,tarif FROM entreprise,production,unite,pays WHERE entreprise.idpays = pays.idpays AND unite.idunite = production.idunite AND entreprise.identreprise = production.identreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (PROD_)");
$num = @mysqli_num_rows($res) or die("Aucun produit en fabrication...");

if ($num !=0)
{
        $tmp="var tabPROD_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_TARIF = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPROD_NBUSE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nb d'uilisation du produit
              $tmpprod = $produit["idproduit"];
              $sql1 = "SELECT count(*) as nbuse FROM possession WHERE idproduit = '$tmpprod'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te (SELECT auxiliaire 1)");
              $produit1 = mysqli_fetch_array($res1);

              $tmp="tabPROD_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="tabPROD_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="tabPROD_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="tabPROD_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="tabPROD_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="tabPROD_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="tabPROD_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="tabPROD_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="tabPROD_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="tabPROD_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomunite"]),"\";";
              $tmp="tabPROD_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["idunite"],"\";";
              $tmp="tabPROD_TARIF[";
              echo $tmp,$count,"]=\"",$produit["tarif"],"\";";
              $tmp="tabPROD_NBUSE[";
              echo $tmp,$count,"]=\"",$produit1["nbuse"],"\";";

              $count += 1;
        }
}

?>







