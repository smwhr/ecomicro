<?php

$sql = "SELECT DISTINCTROW eco_possession.idpossession,eco_pays.idpays,eco_pays.nompays,eco_possession.idpossesseur as idposs,eco_entreprise.nomentreprise as nom,idproduit,eco_typeproduit.typeproduit,eco_typeproduit.typeequi,nomproduit,image,description,nbunite,b.libelle as nomunite,b.typeproduit as idunite ";
$sql .= "FROM eco_entreprise,eco_possession,eco_typeproduit as b,eco_pays,eco_typeproduit,eco_user as a,eco_relation ";
$sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_entreprise.identreprise = eco_possession.idpossesseur ";
$sql .= "AND eco_entreprise.iduser > '0' AND eco_possession.etat = '2' ";
$sql .= "AND eco_entreprise.idpays = eco_pays.idpays AND eco_possession.typeproduit = eco_typeproduit.typeproduit ";
$sql .= "AND ( eco_entreprise.iduser = '$idjoueur' OR ((a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ) AND eco_entreprise.idpays = eco_relation.idpays2 AND ( eco_relation.vision = '0' AND eco_relation.eco = '0'))) ";
$sql .= "UNION SELECT DISTINCTROW eco_possession.idpossession,eco_pays.idpays,eco_pays.nompays,eco_possession.idpossesseur as idposs,eco_user.nom as nom,idproduit,eco_typeproduit.typeproduit,eco_typeproduit.typeequi,nomproduit,image,description,nbunite,b.libelle as nomunite,b.typeproduit as idunite ";
$sql .= "FROM eco_user,eco_possession,eco_typeproduit as b,eco_pays,eco_typeproduit,eco_user as a,eco_relation ";
$sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_user.iduser = eco_possession.idpossesseur ";
$sql .= "AND eco_user.inactif = '0' AND eco_possession.etat = '2' ";
$sql .= "AND eco_user.idpays = eco_pays.idpays AND eco_possession.typeproduit = eco_typeproduit.typeproduit ";
$sql .= "AND ( eco_user.iduser = '$idjoueur' OR ((a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ) AND eco_user.idpays = eco_relation.idpays2 AND ( eco_relation.vision = '0' AND eco_relation.eco = '0')))";


$res = @mysqli_query($conn, $sql) or die("Probl�me dans la requ�te (ACHAT_LOC_).");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var ACHAT_LOC_IDPOSSESSION = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_IDPOSS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_NOM = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_TYPEPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_TYPEPRODUITEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_LOC_NBUSE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nb d'uilisation du produit
              $tmpprod = $produit["idproduit"];
              $sql1 = "SELECT count(*) as nbuse FROM eco_possession WHERE idproduit = '$tmpprod'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te (SELECT auxiliaire 1)");
              $produit1 = mysqli_fetch_array($res1);

              $tmp="ACHAT_LOC_IDPOSSESSION[";
              echo $tmp,$count,"]=\"",$produit["idpossession"],"\";";
              $tmp="ACHAT_LOC_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="ACHAT_LOC_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="ACHAT_LOC_IDPOSS[";
              echo $tmp,$count,"]=\"",$produit["idposs"],"\";";
              $tmp="ACHAT_LOC_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";
              $tmp="ACHAT_LOC_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="ACHAT_LOC_TYPEPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="ACHAT_LOC_TYPEPRODUITEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="ACHAT_LOC_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="ACHAT_LOC_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="ACHAT_LOC_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="ACHAT_LOC_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="ACHAT_LOC_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomunite"]),"\";";
              $tmp="ACHAT_LOC_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["idunite"],"\";";
              $tmp="ACHAT_LOC_NBUSE[";
              echo $tmp,$count,"]=\"",$produit1["nbuse"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var ACHAT_LOC_IDPOSSESSION = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_IDPOSS = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_NOM = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_IDPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_TYPEPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_TYPEPRODUITEQUI = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_NOMPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_IMAGE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_DESCRIPTION = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_NBUNITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_IDUNITE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_LOC_NBUSE = new Array(0);";
        echo $tmp;
}
?>







