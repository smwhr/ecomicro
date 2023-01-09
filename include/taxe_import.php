<?php

$sql = "SELECT eco_taxeimport.idpays1,a.nompays as nompays1,eco_taxeimport.idpays2,b.nompays as nompays2,eco_taxeimport.typeproduit,eco_typeproduit.typeequi,taxe ";
$sql .= "FROM eco_taxeimport,eco_pays as a, eco_pays as b,eco_typeproduit,eco_relation ";
$sql .= "WHERE eco_taxeimport.idpays1 = a.idpays AND eco_taxeimport.idpays2 = b.idpays ";
$sql .= "AND eco_typeproduit.typeproduit = eco_taxeimport.typeproduit AND eco_relation.idpays1 = eco_taxeimport.idpays1 ";
$sql .= "AND eco_relation.idpays2 = eco_taxeimport.idpays2 AND vision = '0' ";
$sql .= "ORDER BY nompays1,nompays2,eco_taxeimport.typeproduit";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (TAXE_IMPORT_)");
$num = @mysqli_num_rows($res);

if ($num != 0)
{
        $tmp="var TAXE_IMPORT_IDPAYS1 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TAXE_IMPORT_NOMPAYS1 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TAXE_IMPORT_IDPAYS2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TAXE_IMPORT_NOMPAYS2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TAXE_IMPORT_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TAXE_IMPORT_TYPEEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var TAXE_IMPORT_TAXE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="TAXE_IMPORT_IDPAYS1[";
              echo $tmp,$count,"]=\"",$produit["idpays1"],"\";";
              $tmp="TAXE_IMPORT_NOMPAYS1[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays1"]),"\";";
              $tmp="TAXE_IMPORT_IDPAYS2[";
              echo $tmp,$count,"]=\"",$produit["idpays2"],"\";";
              $tmp="TAXE_IMPORT_NOMPAYS2[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays2"]),"\";";
              $tmp="TAXE_IMPORT_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="TAXE_IMPORT_TYPEEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="TAXE_IMPORT_TAXE[";
              echo $tmp,$count,"]=\"",$produit["taxe"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var TAXE_IMPORT_IDPAYS1 = new Array(0);";
        echo $tmp;
        $tmp="var TAXE_IMPORT_NOMPAYS1 = new Array(0);";
        echo $tmp;
        $tmp="var TAXE_IMPORT_IDPAYS2 = new Array(0);";
        echo $tmp;
        $tmp="var TAXE_IMPORT_NOMPAYS2 = new Array(0);";
        echo $tmp;
        $tmp="var TAXE_IMPORT_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var TAXE_IMPORT_TYPEEQUI = new Array(0);";
        echo $tmp;
        $tmp="var TAXE_IMPORT_TAXE = new Array(0);";
        echo $tmp;
}
?>







