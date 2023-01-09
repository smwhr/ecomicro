<?php

$sql = "SELECT eco_entreprise.identreprise,eco_entreprise.nomentreprise,eco_pays.idpays, eco_pays.nompays,cotation,eco_cotation.devise,dernierecotation,eco_cotation.datemaj ";
$sql .= "FROM eco_user,eco_entreprise,eco_pays,eco_cotation ";
$sql .= "WHERE eco_entreprise.idpays = eco_pays.idpays ";
$sql .= "AND eco_cotation.identreprise = eco_entreprise.identreprise AND eco_user.iduser = '$idjoueur' ";
$sql .= "AND eco_user.idpays = eco_entreprise.idpays ";
$sql .= "ORDER BY eco_pays.nompays,eco_entreprise.nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (BOURSE_)");
$num = @mysqli_num_rows($res);

if (($num !=0) && (substr($_SESSION['droituser'],2,1) >= 4))
{
        $tmp="var BOURSE_IDENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var BOURSE_NOMENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var BOURSE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var BOURSE_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var BOURSE_COTATION = new Array(";
        echo $tmp, $num,");";
        $tmp="var BOURSE_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var BOURSE_DERNIERECOT = new Array(";
        echo $tmp, $num,");";
        $tmp="var BOURSE_DATEMAJ = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="BOURSE_IDENTREPRISE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="BOURSE_NOMENTREPRISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="BOURSE_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="BOURSE_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="BOURSE_COTATION[";
              echo $tmp,$count,"]=\"",$produit["cotation"],"\";";
              $tmp="BOURSE_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="BOURSE_DERNIERECOT[";
              echo $tmp,$count,"]=\"",$produit["dernierecotation"],"\";";
              $tmp="BOURSE_DATEMAJ[";
              echo $tmp,$count,"]=\"",$produit["datemaj"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var BOURSE_IDENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var BOURSE_NOMENTREPRISE = new Array(0);";
        echo $tmp;
        $tmp="var BOURSE_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var BOURSE_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var BOURSE_COTATION = new Array(0);";
        echo $tmp;
        $tmp="var BOURSE_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var BOURSE_DERNIERECOT = new Array(0);";
        echo $tmp;
        $tmp="var BOURSE_DATEMAJ = new Array(0);";
        echo $tmp;
}
?>







