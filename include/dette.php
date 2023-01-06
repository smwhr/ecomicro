<?php

$sql = "SELECT eco_entreprise.identreprise,eco_entreprise.nomentreprise,eco_pays.idpays, eco_pays.nompays,dette,eco_dette.devise,eco_dette.datemaj ";
$sql .= "FROM eco_entreprise,eco_pays,eco_dette ";
$sql .= "WHERE eco_entreprise.idpays = eco_pays.idpays ";
$sql .= "AND eco_dette.identreprise = eco_entreprise.identreprise AND eco_entreprise.typeentreprise < '60000' ";
$sql .= "ORDER BY eco_pays.nompays,eco_entreprise.nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete (DETTE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DETTE_IDENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DETTE_NOMENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DETTE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DETTE_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DETTE_DETTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DETTE_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DETTE_DATEMAJ = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DETTE_IDENTREPRISE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="DETTE_NOMENTREPRISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="DETTE_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="DETTE_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="DETTE_DETTE[";
              echo $tmp,$count,"]=\"",$produit["dette"],"\";";
              $tmp="DETTE_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="DETTE_DATEMAJ[";
              echo $tmp,$count,"]=\"",$produit["datemaj"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DETTE_IDENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var DETTE_NOMENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var DETTE_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var DETTE_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var DETTE_DETTE = new Array(0);";
        echo $tmp;
        $tmp="var DETTE_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var DETTE_DATEMAJ = new Array(0);";
        echo $tmp;
}
?>







