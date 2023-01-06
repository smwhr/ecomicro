<?php

$sql = "SELECT nomentreprise,eco_entreprise.identreprise,nbaction ";
$sql .= "FROM eco_bourse,eco_entreprise ";
$sql .= "WHERE idactionnaire = '$citoyen' AND eco_entreprise.identreprise = eco_bourse.identreprise ANd nbaction > 0 ";
$sql .= "ORDER BY nbaction";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te DET_CIT_TITRE_");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_CIT_TITRE_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_TITRE_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_TITRE_NB = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DET_CIT_TITRE_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="DET_CIT_TITRE_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="DET_CIT_TITRE_NB[";
              echo $tmp,$count,"]=\"",$produit["nbaction"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_CIT_TITRE_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_TITRE_NOMENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_TITRE_NB = new Array(0);";
        echo $tmp;
}
?>







