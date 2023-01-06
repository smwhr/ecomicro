<?php

$sql = "SELECT identreprise,nomentreprise FROM eco_entreprise WHERE iduser = '$idjoueur'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (ENTREP_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var tabENTREP_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabENTREP_NOMENTRE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="tabENTREP_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="tabENTREP_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var tabENTREP_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var tabENTREP_NOMENTRE = new Array(0);";
        echo $tmp;
}
?>







