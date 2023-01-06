<?php

$sql = "SELECT idactionnaire,eco_entreprise.identreprise,eco_entreprise.nomentreprise,eco_pays.idpays,eco_pays.nompays,nbaction,datederniereope FROM eco_entreprise,eco_pays,eco_bourse WHERE idactionnaire = '$citoyen' AND eco_entreprise.idpays = eco_pays.idpays AND eco_bourse.identreprise = eco_entreprise.identreprise ORDER BY eco_pays.nompays,eco_entreprise.nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (TITRE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var TITRE_IDENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITRE_NOMENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITRE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITRE_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITRE_IDACTIONNAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITRE_NOMACTIONNAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITRE_NBACTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITRE_NBTOTACTION = new Array(";
        echo $tmp, $num,");";
        $tmp="var TITRE_DATEMAJ = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="TITRE_IDENTREPRISE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="TITRE_NOMENTREPRISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="TITRE_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="TITRE_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="TITRE_IDACTIONNAIRE[";
              echo $tmp,$count,"]=\"",$produit["idactionnaire"],"\";";
              $tmp="TITRE_NBACTION[";
              echo $tmp,$count,"]=\"",$produit["nbaction"],"\";";
              $tmp="TITRE_DATEMAJ[";
              echo $tmp,$count,"]=\"",$produit["datederniereope"],"\";";

              $idactionnaire = $produit["idactionnaire"];
              $identreprise = $produit["identreprise"];

               $sql1 = "SELECT nom FROM eco_user WHERE eco_user.iduser = '$idactionnaire' ";
                $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te rech user (TITRE_)");
                $num1 = @mysqli_num_rows($res1);
                if ($num1 !=0)
                {
                   $produit1 = mysqli_fetch_array($res1);
                   $tmp="TITRE_NOMACTIONNAIRE[";
                   echo $tmp,$count,"]=\"",stripslashes($produit1["nom"]),"\";";
                }
                else
                {
                     $tmp="TITRE_NOMACTIONNAIRE[";
                     echo $tmp,$count,"]=\"Nom inconnu\";";
                }

               $sql1 = "SELECT sum(nbaction) as nbaction FROM eco_bourse WHERE eco_bourse.identreprise = '$identreprise'";
                $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te rech user (TITRE_)");
                $num1 = @mysqli_num_rows($res1);
                if ($num1 !=0)
                {
                   $produit1 = mysqli_fetch_array($res1);
                   $tmp="TITRE_NBTOTACTION[";
                   echo $tmp,$count,"]=\"",$produit1["nbaction"],"\";";
                }
                else
                {
                     $tmp="TITRE_NBTOTACTION[";
                     echo $tmp,$count,"]=\"???\";";
                }

              $count += 1;
        }
}
else
{
        $tmp="var TITRE_IDENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var TITRE_NOMENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var TITRE_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var TITRE_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var TITRE_IDACTIONNAIRE = new Array(0);";
        echo $tmp;
        $tmp="var TITRE_NOMACTIONNAIRE = new Array(0);";
        echo $tmp;
        $tmp="var TITRE_NBACTION = new Array(0);";
        echo $tmp;
        $tmp="var TITRE_NBTOTACTION = new Array(0);";
        echo $tmp;
        $tmp="var TITRE_DATEMAJ = new Array(0);";
        echo $tmp;
}
?>







