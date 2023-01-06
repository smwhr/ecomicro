<?php

$sql = "SELECT DISTINCTROW nompays,eco_pays.idpays,eco_pays.iduser,adr_site,adr_forum,emaileco,devise,cptenat,drapeau FROM eco_pays ORDER BY nompays";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (ETAT_MEMBRE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var ETAT_MEMBRE_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_IDUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_NOMUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_ADRSITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_ADRFORUM = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_EMAILECO = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_DRAPEAU = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ETAT_MEMBRE_CPTENAT = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="ETAT_MEMBRE_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="ETAT_MEMBRE_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="ETAT_MEMBRE_IDUSER[";
              echo $tmp,$count,"]=\"",$produit["iduser"],"\";";
              $tmp="ETAT_MEMBRE_ADRSITE[";
              echo $tmp,$count,"]=\"",$produit["adr_site"],"\";";
              $tmp="ETAT_MEMBRE_ADRFORUM[";
              echo $tmp,$count,"]=\"",$produit["adr_forum"],"\";";
              $tmp="ETAT_MEMBRE_EMAILECO[";
              echo $tmp,$count,"]=\"",$produit["emaileco"],"\";";
              $tmp="ETAT_MEMBRE_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="ETAT_MEMBRE_CPTENAT[";
              echo $tmp,$count,"]=\"",$produit["cptenat"],"\";";
              $tmp="ETAT_MEMBRE_DRAPEAU[";
              echo $tmp,$count,"]=\"",$produit["drapeau"],"\";";

              $user = $produit["iduser"];
              $sql1 = "SELECT nom FROM eco_user WHERE iduser = '$user'";
              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te user (ETAT_MEMBRE_)");
              $num1 = @mysqli_num_rows($res1);

              if ($num1 !=0)
              {
                $produit1 = mysqli_fetch_array($res1);
                $tmp="ETAT_MEMBRE_NOMUSER[";
                echo $tmp,$count,"]=\"",stripslashes($produit1["nom"]),"\";";
              }
              else
              {
                $tmp="ETAT_MEMBRE_NOMUSER[";
                echo $tmp,$count,"]=' ';";
              }

              $count += 1;
        }
}
else
{
        $tmp="var ETAT_MEMBRE_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_IDUSER = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_ADRSITE = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_ADRFORUM = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_EMAILECO = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_CPTENAT = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_NOMUSER = new Array(0);";
        echo $tmp;
        $tmp="var ETAT_MEMBRE_DRAPEAU = new Array(0);";
        echo $tmp;
}
?>







