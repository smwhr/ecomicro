<?php

$sql = "SELECT DISTINCTROW nompays,eco_pays.idpays,eco_pays.iduser,emaileco,devise,cptenat FROM eco_pays ORDER BY nompays";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_PAYS_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var LIST_PAYS_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PAYS_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PAYS_IDUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PAYS_NOMUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PAYS_EMAILECO = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PAYS_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var LIST_PAYS_CPTENAT = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="LIST_PAYS_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="LIST_PAYS_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="LIST_PAYS_IDUSER[";
              echo $tmp,$count,"]=\"",$produit["iduser"],"\";";
              $tmp="LIST_PAYS_EMAILECO[";
              echo $tmp,$count,"]=\"",$produit["emaileco"],"\";";
              $tmp="LIST_PAYS_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="LIST_PAYS_CPTENAT[";
              echo $tmp,$count,"]=\"",$produit["cptenat"],"\";";

              $user = $produit["iduser"];
              $sql1 = "SELECT nom FROM eco_user WHERE iduser = '$user'";
              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te user (LIST_PAYS_)");
              $num1 = @mysqli_num_rows($res1);

              if ($num1 !=0)
              {
                $produit1 = mysqli_fetch_array($res1);
                $tmp="LIST_PAYS_NOMUSER[";
                echo $tmp,$count,"]=\"",stripslashes($produit1["nom"]),"\";";
              }
              else
              {
                $tmp="LIST_PAYS_NOMUSER[";
                echo $tmp,$count,"]=' ';";
              }

              $count += 1;
        }
}
else
{
        $tmp="var LIST_PAYS_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var LIST_PAYS_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var LIST_PAYS_IDUSER = new Array(0);";
        echo $tmp;
        $tmp="var LIST_PAYS_EMAILECO = new Array(0);";
        echo $tmp;
        $tmp="var LIST_PAYS_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var LIST_PAYS_CPTENAT = new Array(0);";
        echo $tmp;
        $tmp="var LIST_PAYS_NOMUSER = new Array(0);";
        echo $tmp;
}
?>







