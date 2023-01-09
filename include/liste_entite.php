<?php

$sql = "SELECT '1' as type,eco_pays.idpays,eco_pays.nompays,eco_pays.idpays as id,eco_pays.nompays as nom, '00000' as typeente FROM eco_pays ";
$sql .= "UNION SELECT '2' as type,eco_pays.idpays,eco_pays.nompays,eco_entreprise.identreprise as id,eco_entreprise.nomentreprise as nom, typeentreprise as typeente FROM eco_entreprise,eco_pays ";
$sql .= "WHERE eco_entreprise.idpays = eco_pays.idpays ";
$sql .= "UNION SELECT '3' as type,eco_pays.idpays,eco_pays.nompays,eco_user.iduser as id,eco_user.nom as nom, '00000' as typeente FROM eco_user,eco_pays ";
$sql .= "WHERE eco_user.idpays = eco_pays.idpays ";
$sql .= "ORDER BY type, nompays, nom ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (ENTITE_)");
$num = @mysqli_num_rows($res) or die("Aucune entit�...");

if ($num !=0)
{
        $tmp="var ENTITE_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ENTITE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ENTITE_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ENTITE_ID = new Array(";
        echo $tmp, $num,");";
        $tmp="var ENTITE_NOM = new Array(";
        echo $tmp, $num,");";
        $tmp="var ENTITE_TYPEENTE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="ENTITE_TYPE[";
              echo $tmp,$count,"]=\"",$produit["type"],"\";";
              $tmp="ENTITE_IDPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["idpays"]),"\";";
              $tmp="ENTITE_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="ENTITE_ID[";
              echo $tmp,$count,"]=\"",stripslashes($produit["id"]),"\";";
              $tmp="ENTITE_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";
              $tmp="ENTITE_TYPEENTE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["typeente"]),"\";";

              $count += 1;
        }
}

?>







