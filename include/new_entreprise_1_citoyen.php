<?php

$sql = "SELECT identreprise,nomentreprise ";
$sql .= "FROM eco_entreprise ";
$sql .= "WHERE iduser = '$citoyen' ";
$sql .= "ORDER BY nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (DET_CIT_LENTRE_).");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_CIT_LENTRE_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_LENTRE_NOMENTRE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DET_CIT_LENTRE_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="DET_CIT_LENTRE_NOMENTRE[";
              echo $tmp,$count,"]=\"",$produit["nomentreprise"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_CIT_LENTRE_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_LENTRE_NOMENTRE = new Array(0);";
        echo $tmp;
}
?>







