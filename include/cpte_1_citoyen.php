<?php

$sql = "SELECT idcompte,idtitulaire,solde,devise,nomcpte,eco_user.idpays ";
$sql .= "FROM eco_banque,eco_user ";
$sql .= "WHERE idtitulaire = '$citoyen' AND iduser = idtitulaire ";
$sql .= "UNION SELECT idcompte,idtitulaire,solde,devise,nomcpte,idpays ";
$sql .= "FROM eco_banque,eco_entreprise ";
$sql .= "WHERE eco_banque.idtitulaire = eco_entreprise.identreprise ";
$sql .= "AND eco_entreprise.iduser = '$citoyen'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te CPTEP_");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var CPTEP_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTEP_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTEP_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTEP_NOMCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTEP_SOLDE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTEP_DEVISE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="CPTEP_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="CPTEP_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="CPTEP_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="CPTEP_NOMCPTE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomcpte"]),"\";";
              $tmp="CPTEP_SOLDE[";
              echo $tmp,$count,"]=\"",$produit["solde"],"\";";
              $tmp="CPTEP_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var CPTEP_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var CPTEP_NCPTE = new Array(0);";
        echo $tmp;
        $tmp="var CPTEP_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var CPTEP_NOMCPTE = new Array(0);";
        echo $tmp;
        $tmp="var CPTEP_SOLDE = new Array(0);";
        echo $tmp;
        $tmp="var CPTEP_DEVISE = new Array(0);";
        echo $tmp;
}
?>







