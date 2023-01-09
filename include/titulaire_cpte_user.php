<?php

$sql = "SELECT identreprise as id,nomentreprise as nom ";
$sql .= "FROM eco_entreprise ";
$sql .= "WHERE eco_entreprise.iduser = '$idjoueur' ";
$sql .= "UNION SELECT idpays as id,nompays as nom ";
$sql .= "FROM eco_pays ";
$sql .= "WHERE eco_pays.iduser = '$idjoueur'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (TITU_CPTE_USER_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var TITU_CPTE_USER_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITU_CPTE_USER_NOMENTRE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="TITU_CPTE_USER_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["id"],"\";";
              $tmp="TITU_CPTE_USER_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var TITU_CPTE_USER_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var TITU_CPTE_USER_NOMENTRE = new Array(0);";
        echo $tmp;
}
?>







