<?php

$sql = "SELECT eco_pays.idpays,eco_pays.nompays,sum(eco_banque.solde) as solde,eco_banque.devise, eco_user.iduser,eco_user.nom ";
$sql .= "FROM eco_pays,eco_banque,eco_user ";
$sql .= "WHERE eco_pays.idpays = eco_user.idpays AND eco_banque.idtitulaire = eco_user.iduser ";
$sql .= "GROUP BY eco_pays.idpays,eco_pays.nompays,eco_banque.devise, eco_user.iduser,eco_user.nom ";
$sql .= "ORDER BY solde DESC ";
$sql .= "LIMIT 0 , 5 ;";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (NV_GL_FI_CY_)");
$num = @mysqli_num_rows($res) or die("Aucun citoyen...");

if ($num !=0)
{
        $tmp="var NV_GL_FI_CY_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_CY_NOMPAYS = new Array(";
        echo $tmp, $num,");";
//        $tmp="var NV_GL_FI_CY_SOLDE = new Array(";
//        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_CY_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_CY_ID = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_CY_NOM = new Array(";
        echo $tmp, $num,");";
        
        
        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="NV_GL_FI_CY_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="NV_GL_FI_CY_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
//              $tmp="NV_GL_FI_CY_SOLDE[";
//              echo $tmp,$count,"]=\"",stripslashes($produit["solde"]),"\";";
              $tmp="NV_GL_FI_CY_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="NV_GL_FI_CY_ID[";
              echo $tmp,$count,"]=\"",stripslashes($produit["iduser"]),"\";";
              $tmp="NV_GL_FI_CY_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";

              $count += 1;
              if ($count == 5)
              	break;
        }
}

$sql = "SELECT eco_pays.idpays,eco_pays.nompays,sum(eco_banque.solde) as solde,eco_banque.devise, eco_entreprise.identreprise,eco_entreprise.nomentreprise ";
$sql .= "FROM eco_pays,eco_banque,eco_entreprise ";
$sql .= "WHERE eco_pays.idpays = eco_entreprise.idpays AND eco_banque.idtitulaire = eco_entreprise.identreprise AND typeentreprise < '80000' ";
$sql .= "GROUP BY eco_pays.idpays,eco_pays.nompays,eco_banque.devise, eco_entreprise.identreprise,eco_entreprise.nomentreprise ";
$sql .= "ORDER BY solde DESC ";
$sql .= "LIMIT 0 , 5 ;";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (NV_GL_FI_EN_)");
$num = @mysqli_num_rows($res) or die("Aucune entreprise...");

if ($num !=0)
{
        $tmp="var NV_GL_FI_EN_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_EN_NOMPAYS = new Array(";
        echo $tmp, $num,");";
//        $tmp="var NV_GL_FI_EN_SOLDE = new Array(";
//        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_EN_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_EN_ID = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_EN_NOM = new Array(";
        echo $tmp, $num,");";
        
        
        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="NV_GL_FI_EN_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="NV_GL_FI_EN_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
//              $tmp="NV_GL_FI_EN_SOLDE[";
//              echo $tmp,$count,"]=\"",stripslashes($produit["solde"]),"\";";
              $tmp="NV_GL_FI_EN_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="NV_GL_FI_EN_ID[";
              echo $tmp,$count,"]=\"",stripslashes($produit["identreprise"]),"\";";
              $tmp="NV_GL_FI_EN_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $count += 1;
              if ($count == 5)
              	break;
        }
}

$sql = "SELECT eco_pays.idpays,eco_pays.nompays,sum(eco_banque.solde) as solde,eco_banque.devise, eco_entreprise.identreprise,eco_entreprise.nomentreprise ";
$sql .= "FROM eco_pays,eco_banque,eco_entreprise ";
$sql .= "WHERE eco_pays.idpays = eco_entreprise.idpays AND eco_banque.idtitulaire = eco_entreprise.identreprise AND typeentreprise = '90000' ";
$sql .= "GROUP BY eco_pays.idpays,eco_pays.nompays,eco_banque.devise, eco_entreprise.identreprise,eco_entreprise.nomentreprise ";
$sql .= "ORDER BY solde DESC ";
$sql .= "LIMIT 0 , 5 ;";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (NV_GL_FI_PR_)");
$num = @mysqli_num_rows($res) or die("Aucune entreprise...");

if ($num !=0)
{
        $tmp="var NV_GL_FI_PR_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_PR_NOMPAYS = new Array(";
        echo $tmp, $num,");";
//        $tmp="var NV_GL_FI_PR_SOLDE = new Array(";
//        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_PR_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_PR_ID = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_PR_NOM = new Array(";
        echo $tmp, $num,");";
        
        
        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="NV_GL_FI_PR_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="NV_GL_FI_PR_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
//              $tmp="NV_GL_FI_PR_SOLDE[";
//              echo $tmp,$count,"]=\"",stripslashes($produit["solde"]),"\";";
              $tmp="NV_GL_FI_PR_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="NV_GL_FI_PR_ID[";
              echo $tmp,$count,"]=\"",stripslashes($produit["identreprise"]),"\";";
              $tmp="NV_GL_FI_PR_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $count += 1;
              if ($count == 5)
              	break;
        }
}

$sql = "SELECT eco_pays.idpays,eco_pays.nompays,sum(eco_banque.solde) as solde,eco_banque.devise ";
$sql .= "FROM eco_pays,eco_banque ";
$sql .= "WHERE eco_banque.devise = eco_pays.devise ";
$sql .= "GROUP BY eco_pays.idpays,eco_pays.nompays,eco_banque.devise ";
$sql .= "ORDER BY solde DESC ";
$sql .= "LIMIT 0 , 5 ;";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (NV_GL_FI_PY_)");
$num = @mysqli_num_rows($res) or die("Aucun pays...");

if ($num !=0)
{
        $tmp="var NV_GL_FI_PY_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_PY_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_PY_SOLDE = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_PY_DEVISE = new Array(";
        echo $tmp, $num,");";
        
        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="NV_GL_FI_PY_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="NV_GL_FI_PY_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="NV_GL_FI_PY_SOLDE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["solde"]),"\";";
              $tmp="NV_GL_FI_PY_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";

              $count += 1;
              if ($count == 5)
              	break;
        }
}

$sql = "SELECT eco_pays.idpays,eco_pays.nompays,sum(eco_cotation.cotation*eco_cotation.nbtitre) as solde,eco_cotation.devise ";
$sql .= "FROM eco_pays,eco_cotation ";
$sql .= "WHERE eco_cotation.devise = eco_pays.devise ";
$sql .= "GROUP BY eco_pays.idpays,eco_pays.nompays,eco_cotation.devise ";
$sql .= "ORDER BY solde DESC ";
$sql .= "LIMIT 0 , 5 ;";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (NV_GL_FI_TI_)");
$num = @mysqli_num_rows($res) or die("Aucun pays...");

if ($num !=0)
{
        $tmp="var NV_GL_FI_TI_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_TI_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_TI_SOLDE = new Array(";
        echo $tmp, $num,");";
        $tmp="var NV_GL_FI_TI_DEVISE = new Array(";
        echo $tmp, $num,");";
        
        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="NV_GL_FI_TI_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="NV_GL_FI_TI_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="NV_GL_FI_TI_SOLDE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["solde"]),"\";";
              $tmp="NV_GL_FI_TI_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";

              $count += 1;
              if ($count == 5)
              	break;
        }
}


?>







