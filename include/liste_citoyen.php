<?php

$sql = "SELECT iduser,idpays,nom,login FROM eco_user WHERE inactif = 0 ORDER BY nom";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_CIT_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_CIT_IDUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CIT_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CIT_NOM = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_CIT_LOGIN = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_CIT_IDUSER[";
              echo $tmp,$count,"]=\"",$produit["iduser"],"\";";
              $tmp="LIST_CIT_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="LIST_CIT_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";
              $tmp="LIST_CIT_LOGIN[";
              echo $tmp,$count,"]=\"",$produit["login"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_CIT_IDUSER = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CIT_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CIT_NOM = new Array(0);";
        echo $tmp;
        $tmp="var LIST_CIT_LOGIN = new Array(0);";
        echo $tmp;
}
?>







