<?php

$sql = "SELECT idpossession,entreprise.identreprise,entreprise.nomentreprise,possession.idproduit,possession.nomproduit,possession.image,description,nbunite,nomunite,datehachat FROM possession,unite,entreprise,user WHERE unite.idunite = possession.idunite AND possession.idpossesseur = entreprise.identreprise AND user.idpays = entreprise.idpays AND user.iduser = '$idjoueur' ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (POSSN_)");
$num = @mysqli_num_rows($res) or die("Les entreprises nationales n'ont aucune possession...");

if ($num !=0)
{
        $tmp="var tabPOSSN_IDPOSS = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabPOSSN_DATEH = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="tabPOSSN_IDPOSS[";
              echo $tmp,$count,"]=\"",$produit["idpossession"],"\";";
              $tmp="tabPOSSN_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="tabPOSSN_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="tabPOSSN_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="tabPOSSN_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="tabPOSSN_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="tabPOSSN_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="tabPOSSN_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="tabPOSSN_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomunite"]),"\";";
              $tmp="tabPOSSN_DATEH[";
              echo $tmp,$count,"]=\"",$produit["datehachat"],"\";";

              $count += 1;
        }
}

?>







