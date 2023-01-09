<?php

$sql = "SELECT a.typeentreprise,a.libelle,a.typeequi,b.libelle as libelleequi FROM eco_typeentreprise as a,eco_typeentreprise as b WHERE a.typeequi = b.typeentreprise ORDER BY a.libelle";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_TYPEENTRE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_TYPEENTRE_TYPEENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_TYPEENTRE_LIBELLE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_TYPEENTRE_TYPEEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_TYPEENTRE_LIBELLEEQUI = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_TYPEENTRE_TYPEENTRE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="LIST_TYPEENTRE_LIBELLE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";
              $tmp="LIST_TYPEENTRE_TYPEEQUI[";
              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";
              $tmp="LIST_TYPEENTRE_LIBELLEEQUI[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelleequi"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_TYPEENTRE_TYPEENTRE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_TYPEENTRE_LIBELLE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_TYPEENTRE_TYPEEQUI = new Array(0);";
        echo $tmp;
        $tmp="var LIST_TYPEENTRE_LIBELLEEQUI = new Array(0);";
        echo $tmp;
}
?>







