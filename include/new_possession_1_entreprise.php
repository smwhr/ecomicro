<?php

$sql = "SELECT idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.typeproduit,a.libelle as libellea,a.typeequi,eco_possession.image,description,nbunite,b.libelle as libelleb,datehachat,eco_possession.etat, 'a' as pro, '' as adresse_immo, '' as province ";
$sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b ";
$sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur = '$entreprise' ";
$sql .= "AND eco_possession.typeproduit = a.typeproduit AND a.typeequi <> '20000' ";
$sql .= "UNION SELECT eco_possession.idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.typeproduit,a.libelle as libellea,a.typeequi,eco_possession.image,description,nbunite,b.libelle as libelleb,datehachat,eco_possession.etat, 'b' as pro, eco_immo.adresse_immo, eco_entreprise.nomentreprise as province ";
$sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b, eco_immo, eco_entreprise ";
$sql .= "WHERE (b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur <> '$entreprise' ";
$sql .= "AND eco_possession.typeproduit = a.typeproduit AND eco_entreprise.identreprise = province ";
$sql .= "AND eco_possession.idpossession = eco_immo.idpossession AND eco_immo.idlocataire = '$entreprise') ";
$sql .= "OR (b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur = '$entreprise' ";
$sql .= "AND eco_possession.typeproduit = a.typeproduit AND eco_entreprise.identreprise = province ";
$sql .= "AND eco_possession.idpossession = eco_immo.idpossession) ";
$sql .= "ORDER BY nomproduit;";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (DET_ENTRE_LPOSS_).");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_ENTRE_LPOSS_IDPOSS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_NOMTYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_TYPEEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_DESCRIPTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_DATEH = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_ETAT = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_PRO = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_ADR = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_LPOSS_ADR_PROVINCE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DET_ENTRE_LPOSS_IDPOSS[";
              echo $tmp,$count,"]=\"",$produit["idpossession"],"\";";
              $tmp="DET_ENTRE_LPOSS_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="DET_ENTRE_LPOSS_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="DET_ENTRE_LPOSS_NOMTYPE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libellea"]),"\";";
              $tmp="DET_ENTRE_LPOSS_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="DET_ENTRE_LPOSS_TYPEEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="DET_ENTRE_LPOSS_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="DET_ENTRE_LPOSS_DESCRIPTION[";
              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";
              $tmp="DET_ENTRE_LPOSS_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="DET_ENTRE_LPOSS_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelleb"]),"\";";
              $tmp="DET_ENTRE_LPOSS_DATEH[";
              echo $tmp,$count,"]=\"",$produit["datehachat"],"\";";
              $tmp="DET_ENTRE_LPOSS_ETAT[";
              echo $tmp,$count,"]=\"",$produit["etat"],"\";";
              $tmp="DET_ENTRE_LPOSS_PRO[";
              echo $tmp,$count,"]=\"",$produit["pro"],"\";";
              $tmp="DET_ENTRE_LPOSS_ADR[";
              echo $tmp,$count,"]=\"",$produit["adresse_immo"],"\";";
              $tmp="DET_ENTRE_LPOSS_ADR_PROVINCE[";
              echo $tmp,$count,"]=\"",$produit["province"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_ENTRE_LPOSS_IDPOSS = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_IDPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_NOMPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_TYPEEQUI = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_IMAGE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_DESCRIPTION = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_NBUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_DATEH = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_ETAT = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_PRO = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_LPOSS_ADR = new Array(0);";
        echo $tmp;
}
?>







