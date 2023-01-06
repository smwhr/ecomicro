<?php



$sql = "SELECT eco_immo.idpossession,eco_immo.province,eco_immo.adresse_immo,eco_immo.occupe,eco_entreprise.nomentreprise ";

$sql .= "FROM eco_immo, eco_entreprise ";

$sql .= "WHERE ((eco_immo.idproprio = '$citoyen' AND eco_immo.idlocataire = '0') ";

$sql .= "OR eco_immo.idlocataire = '$citoyen') ";

$sql .= "AND eco_immo.province = eco_entreprise.identreprise ;";



$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (RES_CIT_)");

$num = @mysqli_num_rows($res);





if ($num >= 1)

{

        $tmp="var RES_CIT_IDPOSSESSION = new Array(";

        echo $tmp, $num,");";

        $tmp="var RES_CIT_IDPROVINCE = new Array(";

        echo $tmp, $num,");";

        $tmp="var RES_CIT_ADRESSE = new Array(";

        echo $tmp, $num,");";

        $tmp="var RES_CIT_OCCUPE = new Array(";

        echo $tmp, $num,");";

        $tmp="var RES_CIT_LIBPROVINCE = new Array(";

        echo $tmp, $num,");";



        $count = 0;

        while($produit = mysqli_fetch_array($res))

        {

              $tmp="RES_CIT_IDPOSSESSION[";

              echo $tmp,$count,"]=\"",$produit["idpossession"],"\";";

              $tmp="RES_CIT_IDPROVINCE[";

              echo $tmp,$count,"]=\"",$produit["province"],"\";";

              $tmp="RES_CIT_ADRESSE[";

              echo $tmp,$count,"]=\"",stripslashes($produit["adresse_immo"]),"\";";

              $tmp="RES_CIT_OCCUPE[";

              echo $tmp,$count,"]=\"",$produit["occupe"],"\";";

              $tmp="RES_CIT_LIBPROVINCE[";

              echo $tmp,$count,"]=\"",$produit["nomentreprise"],"\";";



              $count++;

        }



}

else

{

        $tmp="var RES_CIT_IDPOSSESSION = new Array(0);";

        echo $tmp;

        $tmp="var RES_CIT_IDPROVINCE = new Array(0);";

        echo $tmp;

        $tmp="var RES_CIT_ADRESSE = new Array(0);";

        echo $tmp;

        $tmp="var RES_CIT_OCCUPE = new Array(0);";

        echo $tmp;

        $tmp="var  RES_CIT_LIBPROVINCE = new Array(0);";

        echo $tmp;

}

?>















