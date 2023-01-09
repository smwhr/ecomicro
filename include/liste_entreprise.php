<?php

$sql = "SELECT identreprise,nomentreprise FROM eco_entreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (ENTRE_)");
$num = @mysqli_num_rows($res) or die("Aucune entreprise...");

if ($num !=0)
{
        $tmp="var tabENTRE_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabENTRE_NOMENTRE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="tabENTRE_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="tabENTRE_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $count += 1;
        }
}

?>







