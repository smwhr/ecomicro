<?php

$sql = "SELECT typeentreprise,libelle FROM eco_typeentreprise WHERE typeequi = typeentreprise ORDER BY libelle";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_TYPEENTRE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_TYPEENTREEQUI_TYPEENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_TYPEENTREEQUI_LIBELLE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_TYPEENTREEQUI_TYPEENTRE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="LIST_TYPEENTREEQUI_LIBELLE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_TYPEENTREEQUI_TYPEENTRE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_TYPEENTREEQUI_LIBELLE = new Array(0);";
        echo $tmp;
}
?>







