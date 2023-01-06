<?php

$sql = "SELECT identreprise,nomentreprise FROM entreprise,user WHERE user.iduser = '$idjoueur' AND user.idpays = entreprise.idpays";

$res = @mysqli_query($conn, $sql) or die("Probl�me dans la requ�te (ENTREN_)");
$num = @mysqli_num_rows($res) or die("Aucune entreprise nationale !!");

if ($num !=0)
{
        $tmp="var tabENTREN_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabENTREN_NOMENTRE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="tabENTREN_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="tabENTREN_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $count += 1;
        }
}

?>







