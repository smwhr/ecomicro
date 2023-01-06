<?php

$sql = "SELECT typeproduit,libelle FROM eco_typeproduit ORDER BY libelle";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_TOUT_TYPEPROD_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_TOUT_TYPEPROD_TYPEPROD = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_TOUT_TYPEPROD_LIBELLE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_TOUT_TYPEPROD_TYPEPROD[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="LIST_TOUT_TYPEPROD_LIBELLE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_TOUT_TYPEPROD_TYPEPROD = new Array(0);";
        echo $tmp;
        $tmp="var LIST_TOUT_TYPEPROD_LIBELLE = new Array(0);";
        echo $tmp;
}
?>







