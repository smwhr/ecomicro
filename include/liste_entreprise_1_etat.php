<?php

$sql = "SELECT identreprise,nomentreprise FROM eco_entreprise ";
$sql .= "WHERE idpays = '$etat'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (ENTRE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var ENTRE_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ENTRE_NOMENTRE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="ENTRE_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="ENTRE_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var ENTRE_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var ENTRE_NOMENTRE = new Array(0);";
        echo $tmp;
}
?>







