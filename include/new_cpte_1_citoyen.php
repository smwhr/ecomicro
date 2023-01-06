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

if (($num !=0) && (($citoyen == $idjoueur) || ($_SESSION['perso_droituser'] == '999')))
{
        $tmp="var DET_CIT_CPT_IDCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_CPT_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_CPT_NOMCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_CPT_SOLDE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_CPT_DEVISE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DET_CIT_CPT_IDCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="DET_CIT_CPT_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="DET_CIT_CPT_NOMCPTE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomcpte"]),"\";";
              $tmp="DET_CIT_CPT_SOLDE[";
              echo $tmp,$count,"]=\"",$produit["solde"],"\";";
              $tmp="DET_CIT_CPT_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_CIT_CPT_IDCPTE = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_CPT_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_CPT_NOMCPTE = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_CPT_SOLDE = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_CPT_DEVISE = new Array(0);";
        echo $tmp;
}
?>







