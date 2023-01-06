<?php

$sql = "SELECT DISTINCTROW idactionnaire,eco_entreprise.identreprise,eco_entreprise.nomentreprise,eco_pays.idpays,eco_pays.nompays,nbaction,datederniereope ";
$sql .= "FROM eco_entreprise,eco_pays,eco_bourse ";
$sql .= "WHERE eco_entreprise.idpays = eco_pays.idpays AND eco_bourse.identreprise = eco_entreprise.identreprise ";
$sql .= "AND eco_entreprise.typeentreprise < '60000' ";

$sql .= "AND eco_entreprise.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 

//$sql .= "AND a.iduser = '$idjoueur' ";
//$sql .= "AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ";
//$sql .= "AND eco_entreprise.idpays = eco_relation.idpays2 AND  eco_relation.vision = '0'  AND  eco_relation.eco = '0' ";

$sql .= "ORDER BY eco_pays.nompays,eco_entreprise.nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (TITRE_)");
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

              $sql1 = "SELECT nomentreprise FROM eco_entreprise WHERE eco_entreprise.identreprise = '$idactionnaire' ";
              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requête rech entreprise (TITRE_)");
              $num1 = @mysqli_num_rows($res1);
              if ($num1 !=0)
              {
                 $produit1 = mysqli_fetch_array($res1);
                 $tmp="TITRE_NOMACTIONNAIRE[";
                 echo $tmp,$count,"]=\"",stripslashes($produit1["nomentreprise"]),"\";";
              }
              else
              {
                $sql1 = "SELECT nom FROM eco_user WHERE eco_user.iduser = '$idactionnaire' ";
                $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requête rech user (TITRE_)");
                $num1 = @mysqli_num_rows($res1);
                if ($num1 !=0)
                {
                   $produit1 = mysqli_fetch_array($res1);
                   $tmp="TITRE_NOMACTIONNAIRE[";
                   echo $tmp,$count,"]=\"",stripslashes($produit1["nom"]),"\";";
                }
                else
                {
                  $sql1 = "SELECT nompays FROM eco_pays WHERE eco_pays.idpays = '$idactionnaire' ";
                  $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requête rech user (TITRE_)");
                  $num1 = @mysqli_num_rows($res1);
                  if ($num1 !=0)
                  {
                     $produit1 = mysqli_fetch_array($res1);
                     $tmp="TITRE_NOMACTIONNAIRE[";
                     echo $tmp,$count,"]=\"",stripslashes($produit1["nompays"]),"\";";
                  }
                  else
                  {
                     $tmp="TITRE_NOMACTIONNAIRE[";
                     echo $tmp,$count,"]=\"Nom inconnu\";";
                  }
                }
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
        $tmp="var TITRE_DATEMAJ = new Array(0);";
        echo $tmp;
}
?>







