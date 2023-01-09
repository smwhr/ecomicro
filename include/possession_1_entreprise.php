<?php
/*
$sql = "SELECT idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.libelle as libellea,a.typeproduit,a.typeequi,eco_possession.image,nbunite,b.libelle as libelleb,datehachat ";
$sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b ";
$sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur = '$entreprise' ";
$sql .= "AND eco_possession.typeproduit = a.typeproduit";
*/
$sql = "SELECT eco_possession.idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.libelle as libellea, a.typeproduit,a.typeequi,eco_possession.image,nbunite,b.libelle as libelleb,datehachat, 'a' as pro  ";

$sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b ";

$sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur = '$entreprise' ";
$sql .= "AND eco_possession.typeproduit = a.typeproduit ";

$sql .= "UNION SELECT eco_possession.idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.libelle as libellea, a.typeproduit,a.typeequi,eco_possession.image,nbunite,b.libelle as libelleb,datehachat, 'b' as pro  ";

$sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b, eco_immo ";

$sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur <> '$entreprise' ";
$sql .= "AND eco_possession.typeproduit = a.typeproduit ";
$sql .= "AND eco_possession.idpossession = eco_immo.idpossession AND eco_immo.idlocataire = '$entreprise' ";

$sql .= "ORDER BY nomproduit";



$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (POSSP_).");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var POSSP_IDPOSS = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_IDPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_NOMPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_NOMTYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_TYPEEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_IMAGE = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_NBUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_NOMUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_DATEH = new Array(";
        echo $tmp, $num,");";
        $tmp="var POSSP_PRO = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="POSSP_IDPOSS[";
              echo $tmp,$count,"]=\"",$produit["idpossession"],"\";";
              $tmp="POSSP_IDPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";
              $tmp="POSSP_NOMPRODUIT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";
              $tmp="POSSP_NOMTYPE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libellea"]),"\";";
              $tmp="POSSP_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="POSSP_TYPEEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="POSSP_IMAGE[";
              echo $tmp,$count,"]=\"",$produit["image"],"\";";
              $tmp="POSSP_NBUNITE[";
              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";
              $tmp="POSSP_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelleb"]),"\";";
              $tmp="POSSP_DATEH[";
              echo $tmp,$count,"]=\"",$produit["datehachat"],"\";";
              $tmp="POSSP_PRO[";
              echo $tmp,$count,"]=\"",$produit["pro"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var POSSP_IDPOSS = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_IDPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_NOMPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_TYPEEQUI = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_IMAGE = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_DESCRIPTION = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_NBUNITE = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_NOMUNITE = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_DATEH = new Array(0);";
        echo $tmp;
        $tmp="var POSSP_PRO = new Array(0);";
        echo $tmp;
}
?>







