<?php

$sql = "SELECT typeproduit,libelle FROM eco_typeproduit WHERE typeequi = typeproduit ORDER BY libelle";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_TYPEPRODEQUI_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_TYPEPRODEQUI_TYPEPROD = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_TYPEPRODEQUI_LIBELLE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_TYPEPRODEQUI_TYPEPROD[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="LIST_TYPEPRODEQUI_LIBELLE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_TYPEPRODEQUI_TYPEPROD = new Array(0);";
        echo $tmp;
        $tmp="var LIST_TYPEPRODEQUI_LIBELLE = new Array(0);";
        echo $tmp;
}
?>







