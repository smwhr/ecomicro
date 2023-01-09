<?php

$sql = "SELECT pays.idpays,pays.nompays,production.identreprise,entreprise.nomentreprise,idproduit,nomproduit,image,description,nbunite,nomunite,unite.idunite FROM entreprise,production,unite,pays,user WHERE unite.idunite = production.idunite AND entreprise.identreprise = production.identreprise AND entreprise.idpays = pays.idpays AND user.idpays = pays.idpays AND user.iduser = '$idjoueur'";

$res = @mysqli_query($conn, $sql) or die("Probl�me dans la requ�te (PRODN_).");
$num = @mysqli_num_rows($res) or die("Aucun produit pour votre nation...");

if ($num !=0)
{
        $tmp="var tabPRODN_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPRODN_NBUSE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nb d'uilisation du produit
              $tmpprod = $produit["idproduit"];
              $sql1 = "SELECT count(*) as nbuse FROM possession WHERE idproduit = '$tmpprod'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te (SELECT auxiliaire 1)");
              $produit1 = mysqli_fetch_array($res1);

              $tmp="tabPRODN_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="tabPRODN_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="tabPRODN_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="tabPRODN_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="tabPRODN_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="tabPRODN_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="tabPRODN_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="tabPRODN_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="tabPRODN_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="tabPRODN_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomunite"]),"\";";
              $tmp="tabPRODN_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["idunite"],"\";";
              $tmp="tabPRODN_NBUSE[";
              echo $tmp,$count,"]=\"",$produit1["nbuse"],"\";";

              $count += 1;
        }
}

?>







