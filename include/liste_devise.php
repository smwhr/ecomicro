<?php

$sql = "SELECT devise,idpays,nompays FROM eco_pays GROUP BY devise ORDER BY devise,idpays,nompays";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_DEVISE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_DEVISE_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_DEVISE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_DEVISE_NOMPAYS = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_DEVISE_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="LIST_DEVISE_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="LIST_DEVISE_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_DEVISE_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_DEVISE_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var LIST_DEVISE_NOMPAYS = new Array(0);";
        echo $tmp;
}
?>







