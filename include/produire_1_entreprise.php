<?php

$sql = "SELECT DISTINCTROW idproduitfini,eco_produire.typeentreprise,eco_produire.typeproduire,eco_typeproduit.libelle as libelleprod,idres,nbres ";
$sql .= "FROM eco_produire,eco_typeproduit,eco_typeentreprise,eco_entreprise ";
$sql .= "WHERE eco_produire.typeentreprise = eco_typeentreprise.typeentreprise AND eco_produire.idres = eco_typeproduit.typeproduit ";
$sql .= "AND (eco_typeentreprise.typeequi = eco_entreprise.typeentreprise  OR eco_typeentreprise.typeentreprise = eco_entreprise.typeentreprise) ";
$sql .= "AND  eco_entreprise.identreprise = '$entreprise'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (PRODUIRE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var PRODUIRE_IDPRODFINI = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODUIRE_LIBPROD = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODUIRE_TYPEPRODUIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODUIRE_TYPEENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODUIRE_IDRES = new Array(";
        echo $tmp, $num,");";
        $tmp="var PRODUIRE_NBRES = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="PRODUIRE_IDPRODFINI[";
              echo $tmp,$count,"]=\"",$produit["idproduitfini"],"\";";
              $tmp="PRODUIRE_LIBPROD[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelleprod"]),"\";";
              $tmp="PRODUIRE_TYPEENTRE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="PRODUIRE_TYPEPRODUIRE[";
              echo $tmp,$count,"]=\"",$produit["typeproduire"],"\";";
              $tmp="PRODUIRE_IDRES[";
              echo $tmp,$count,"]=\"",$produit["idres"],"\";";
              $tmp="PRODUIRE_NBRES[";
              echo $tmp,$count,"]=\"",$produit["nbres"],"\";";

              $count += 1;
        }
        
}
else
{
        $tmp="var PRODUIRE_IDPRODFINI = new Array(0);";
        echo $tmp;
        $tmp="var PRODUIRE_LIBPROD = new Array(0);";
        echo $tmp;
        $tmp="var PRODUIRE_TYPEENTRE = new Array(0);";
        echo $tmp;
        $tmp="var PRODUIRE_TYPEPRODUIRE = new Array(0);";
        echo $tmp;
        $tmp="var PRODUIRE_IDRES = new Array(0);";
        echo $tmp;
        $tmp="var PRODUIRE_NBRES = new Array(0);";
        echo $tmp;
}
?>







