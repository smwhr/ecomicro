<?php

$sql = "SELECT identreprise,nomentreprise ";
$sql .= "FROM eco_entreprise ";
$sql .= "WHERE eco_entreprise.iduser = '$idjoueur' ";
$sql .= "AND ((eco_entreprise.typeentreprise >= '10000' AND eco_entreprise.typeentreprise < '30000') ";
$sql .= "OR (eco_entreprise.typeentreprise >= '50000' AND eco_entreprise.typeentreprise < '60000')) ";
//eco_bourse.nbactiontotal /2 ) ) ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (ENTRE_USER_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var ENTRE_USER_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ENTRE_USER_NOMENTRE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="ENTRE_USER_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="ENTRE_USER_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var ENTRE_USER_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var ENTRE_USER_NOMENTRE = new Array(0);";
        echo $tmp;
}
?>







