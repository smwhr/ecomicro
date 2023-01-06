<?php

$sql = "SELECT eco_entreprise.identreprise as id,eco_entreprise.nomentreprise as nom,eco_entreprise.idpays as pays, eco_pays.nompays, 'E' as type ";
$sql .= "FROM eco_entreprise, eco_pays ";
$sql .= "WHERE eco_entreprise.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 
$sql .= "AND eco_entreprise.iduser > 0 AND eco_entreprise.idpays = eco_pays.idpays ";
$sql .= "UNION SELECT eco_user.iduser as id,eco_user.nom as nom,eco_user.idpays as pays,eco_pays.nompays,'C' as type ";
$sql .= "FROM eco_user, eco_pays WHERE eco_user.inactif = '0' ";
$sql .= "AND eco_user.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 
$sql .= "AND eco_user.idpays = eco_pays.idpays ";
$sql .= "UNION SELECT eco_pays.idpays as id,eco_pays.nompays as nom,eco_pays.idpays as pays,eco_pays.nompays,'P' as type ";
$sql .= "FROM eco_pays ";
$sql .= "WHERE eco_pays.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 
$sql .= "ORDER BY nomPays, type, nom";

//$sql .= "eco_entreprise.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 


$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_PROPRI_)");
$num = @mysqli_num_rows($res) or die("C'est vide...");

if ($num !=0)
{
        $tmp="var LIST_PROPRI_ID = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PROPRI_NOM = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PROPRI_PAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PROPRI_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PROPRI_TYPE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_PROPRI_ID[";
              echo $tmp,$count,"]=\"",$produit["id"],"\";";
              $tmp="LIST_PROPRI_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";
              $tmp="LIST_PROPRI_PAYS[";
              echo $tmp,$count,"]=\"",$produit["pays"],"\";";
              $tmp="LIST_PROPRI_NOMPAYS[";
              echo $tmp,$count,"]=\"",$produit["nompays"],"\";";
              $tmp="LIST_PROPRI_TYPE[";
              echo $tmp,$count,"]=\"",$produit["type"],"\";";

              $count += 1;
        }
}

?>







