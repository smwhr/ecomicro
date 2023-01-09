<?php

$sql = "SELECT eco_user.iduser,nom,eco_pays.idpays FROM eco_user,eco_pays WHERE eco_user.idpays = eco_pays.idpays OR eco_user.idpaysaccueil = eco_pays.idpays ORDER BY eco_pays.idpays,eco_user.nom";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (CIT_EMPLOI_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var CIT_EMPLOI_IDUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var CIT_EMPLOI_NOM = new Array(";
        echo $tmp, $num,");";
        $tmp="var CIT_EMPLOI_IDPAYS = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="CIT_EMPLOI_IDUSER[";
              echo $tmp,$count,"]=\"",$produit["iduser"],"\";";
              $tmp="CIT_EMPLOI_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";
              $tmp="CIT_EMPLOI_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var CIT_EMPLOI_IDUSER = new Array(0);";
        echo $tmp;
        $tmp="var CIT_EMPLOI_NOM = new Array(0);";
        echo $tmp;
        $tmp="var CIT_EMPLOI_IDPAYS = new Array(0);";
        echo $tmp;
}
?>







