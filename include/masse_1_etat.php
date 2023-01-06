<?php
// ts les cptes de l'�tat du responsable
$sql = "SELECT devise,nompays FROM eco_pays WHERE idpays = '$etat'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te preparative MASS_");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
   $produit = mysqli_fetch_array($res);

   $devise = $produit["devise"];

   $tmp="var RAPP_NOMPAYS = '";
   echo $tmp, stripslashes($produit["nompays"]),"';";
   $tmp="var RAPP_DEVISE = '";
   echo $tmp, stripslashes($produit["devise"]),"';";

   $sql = "SELECT sum(solde) as total FROM eco_banque WHERE devise = '$devise'";

   $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te MASS_");
   $num = @mysqli_num_rows($res);

   if ($num !=0)
   {
        $produit = mysqli_fetch_array($res);

        $tmp="var MASS_TTMASSE = ";
        echo $tmp, $produit["total"],";";
   }
   else
   {
        $tmp="var MASS_TTMASSE = '';";
        echo $tmp;
   }

   $sql = "SELECT sum(solde) as total FROM eco_banque WHERE devise = '$devise' ";
   $sql .= "AND idtitulaire IN (SELECT identreprise FROM eco_entreprise WHERE idpays <> '$etat' ";
   $sql .= "UNION SELECT iduser FROM eco_user WHERE idpays <> '$etat' ";
   $sql .= "UNION SELECT idpays FROM eco_pays WHERE idpays <> '$etat')";

   $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te MASS_");
   $num = @mysqli_num_rows($res);
   if ($num !=0)
   {
        $produit = mysqli_fetch_array($res);
        $tmp="var MASS_TTDEVISE = ";
        if ($produit["total"] > 0)
            echo $tmp, $produit["total"],";";
        else
            echo $tmp, "0",";";
   }
   else
   {
        $tmp="var MASS_TTDEVISE = '0';";
        echo $tmp;
   }

}
else
{
   $tmp="var MASS_TTMASSE = '';";
   echo $tmp;
   $tmp="var MASS_TTDEVISE = '';";
   echo $tmp;
   $tmp="var RAPP_NOMPAYS = '';";
   echo $tmp;
   $tmp="var RAPP_DEVISE = '';";
   echo $tmp;
}

?>







