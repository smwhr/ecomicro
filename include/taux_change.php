<?php

$sql = "SELECT devise1,devise2,taux,a.idpays as idpays1,a.nompays as nompays1,b.idpays as idpays2,b.nompays as nompays2,idcompte ";
$sql .= "FROM eco_tauxchange, eco_pays as a, eco_pays as b ";
$sql .= "WHERE a.devise = eco_tauxchange.devise1 AND  b.devise = eco_tauxchange.devise2 ";
$sql .= "ORDER BY nompays1,nompays2";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (TX_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var TX_DEVISE1 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TX_DEVISE2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TX_TAUX = new Array(";
        echo $tmp, $num,");";
        $tmp="var TX_IDPAYS1 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TX_NOMPAYS1 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TX_IDPAYS2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TX_NOMPAYS2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TX_CPTE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="TX_DEVISE1[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise1"]),"\";";
              $tmp="TX_DEVISE2[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise2"]),"\";";
              $tmp="TX_TAUX[";
              echo $tmp,$count,"]=\"",$produit["taux"],"\";";
              $tmp="TX_IDPAYS1[";
              echo $tmp,$count,"]=\"",$produit["idpays1"],"\";";
              $tmp="TX_NOMPAYS1[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays1"]),"\";";
              $tmp="TX_IDPAYS2[";
              echo $tmp,$count,"]=\"",$produit["idpays2"],"\";";
              $tmp="TX_NOMPAYS2[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays2"]),"\";";
              $tmp="TX_CPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var TX_DEVISE1 = new Array(0);";
        echo $tmp;
        $tmp="var TX_DEVISE2 = new Array(0);";
        echo $tmp;
        $tmp="var TX_TAUX = new Array(0);";
        echo $tmp;
        $tmp="var TX_IDPAYS1 = new Array(0);";
        echo $tmp;
        $tmp="var TX_NOMPAYS1 = new Array(0);";
        echo $tmp;
        $tmp="var TX_IDPAYS2 = new Array(0);";
        echo $tmp;
        $tmp="var TX_NOMPAYS2 = new Array(0);";
        echo $tmp;
        $tmp="var TX_CPTE = new Array(0);";
        echo $tmp;
}
?>







