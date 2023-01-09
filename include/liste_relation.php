<?php

$sql = "SELECT a.nompays as nompays1,b.nompays as nompays2,idpays1,idpays2,vision,eco,datemaj FROM eco_relation,eco_pays as a,eco_pays as b WHERE a.idpays = idpays1 AND b.idpays = idpays2 ORDER BY a.nompays,b.nompays";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_REL_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_REL_NOMPAYS1 = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_REL_NOMPAYS2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_REL_IDPAYS1 = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_REL_IDPAYS2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_REL_VISION = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_REL_ECO = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_REL_DATEMAJ = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_REL_NOMPAYS1[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays1"]),"\";";
              $tmp="LIST_REL_NOMPAYS2[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays2"]),"\";";
              $tmp="LIST_REL_IDPAYS1[";
              echo $tmp,$count,"]=\"",$produit["idpays1"],"\";";
              $tmp="LIST_REL_IDPAYS2[";
              echo $tmp,$count,"]=\"",$produit["idpays2"],"\";";
              $tmp="LIST_REL_VISION[";
              echo $tmp,$count,"]=\"",$produit["vision"],"\";";
              $tmp="LIST_REL_ECO[";
              echo $tmp,$count,"]=\"",$produit["eco"],"\";";
              $tmp="LIST_REL_DATEMAJ[";
              echo $tmp,$count,"]=\"",$produit["datemaj"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var LIST_REL_NOMPAYS1 = new Array(0);";
        echo $tmp;
        $tmp="var LIST_REL_NOMPAYS2 = new Array(0);";
        echo $tmp;
        $tmp="var LIST_REL_IDPAYS1 = new Array(0);";
        echo $tmp;
        $tmp="var LIST_REL_IDPAYS2 = new Array(0);";
        echo $tmp;
        $tmp="var LIST_REL_VISION = new Array(0);";
        echo $tmp;
        $tmp="var LIST_REL_ECO = new Array(0);";
        echo $tmp;
        $tmp="var LIST_REL_DATEMAJ = new Array(0);";
        echo $tmp;
}
?>







