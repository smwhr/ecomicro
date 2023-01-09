<?php
// transaction

$sql = "SELECT DISTINCTROW idcompte,idtitulaire,eco_banque.devise,nomcpte ";
$sql .= "FROM eco_banque,eco_user ";
$sql .= "WHERE eco_user.iduser = eco_banque.idtitulaire AND eco_user.inactif = '0' ";

$sql .= "AND ( eco_user.iduser = '$idjoueur' OR  eco_user.idpays IN (SELECT idpays2 FROM eco_relation, eco_user as a where a.iduser = '$idjoueur' AND a.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0')) "; 

//$sql .= "AND ( a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ";
//$sql .= "AND eco_user.idpays = eco_relation.idpays2 ";
//$sql .= "AND eco_relation.vision = '0' AND  eco_relation.eco = '0' ) ";

$sql .= "UNION SELECT idcompte,idtitulaire,eco_banque.devise,nomcpte ";
$sql .= "FROM eco_banque,eco_entreprise ";
$sql .= "WHERE eco_banque.idtitulaire = eco_entreprise.identreprise ";

$sql .= "AND ( eco_entreprise.iduser = '$idjoueur' OR  eco_entreprise.idpays IN (SELECT idpays2 FROM eco_relation, eco_user where eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0')) "; 

//$sql .= "AND ( eco_entreprise.iduser = '$idjoueur' ";
//$sql .= "OR (a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ";
//$sql .= "AND eco_entreprise.idpays = eco_relation.idpays2 ";
//$sql .= "AND eco_relation.vision = '0' AND  eco_relation.eco = '0' )) ";

$sql .= "UNION SELECT idcompte,idtitulaire,eco_banque.devise,nomcpte ";
$sql .= "FROM eco_banque,eco_pays ";
$sql .= "WHERE eco_banque.idtitulaire = eco_pays.idpays ";

$sql .= "AND eco_pays.idpays IN (SELECT idpays2 FROM eco_relation, eco_user as a where a.iduser = '$idjoueur' AND a.idpays = eco_relation.idpays1 AND eco_relation.vision = '0' AND eco_relation.eco = '0') "; 

//$sql .= "AND ( a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ";
//$sql .= "AND eco_pays.idpays = eco_relation.idpays2 ";
//$sql .= "AND eco_relation.vision = '0' AND  eco_relation.eco = '0' ) ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te CPTE_TRANSAC_");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var CPTE_TRANSAC_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_TRANSAC_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_TRANSAC_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_TRANSAC_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_TRANSAC_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_TRANSAC_NOMCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_TRANSAC_DEVISE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              $id = $produit["idtitulaire"];

              $sql1 = "SELECT nompays FROM eco_pays WHERE idpays = '$id';";
              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te pays CPTE_TRANSAC_");
              $num1 = @mysqli_num_rows($res1);
              if ($num1 == 1)
              {
                $produit1 = mysqli_fetch_array($res1);
                $tmp="CPTE_TRANSAC_IDPAYS[";
                echo $tmp,$count,"]=\"",$id,"\";";
                $tmp="CPTE_TRANSAC_NOMPAYS[";
                echo $tmp,$count,"]=\"",stripslashes($produit1["nompays"]),"\";";

                $tmp="CPTE_TRANSAC_TYPE[";
                echo $tmp,$count,"]=\"A\";";
              }
              else
              {
                $sql1 = "SELECT nomentreprise,eco_pays.idpays,eco_pays.nompays FROM eco_entreprise,eco_pays WHERE identreprise = '$id' AND eco_entreprise.idpays = eco_pays.idpays;";
                $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te entreprise CPTE_TRANSAC_");
                $num1 = @mysqli_num_rows($res1);
                if ($num1 == 1)
                {
                  $produit1 = mysqli_fetch_array($res1);
                  $tmp="CPTE_TRANSAC_IDPAYS[";
                  echo $tmp,$count,"]=\"",$produit1["idpays"],"\";";
                  $tmp="CPTE_TRANSAC_NOMPAYS[";
                  echo $tmp,$count,"]=\"",stripslashes($produit1["nompays"]),"\";";

                  $tmp="CPTE_TRANSAC_TYPE[";
                  echo $tmp,$count,"]=\"B\";";
                }
                else
                {
                  $sql1 = "SELECT nom,eco_pays.idpays,eco_pays.nompays FROM eco_user,eco_pays WHERE eco_user.iduser = '$id' AND eco_user.idpays = eco_pays.idpays;";
                  $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te user CPTE_TRANSAC_");
                  $num1 = @mysqli_num_rows($res1);
                  if ($num1 == 1)
                  {
                    $produit1 = mysqli_fetch_array($res1);
                    $tmp="CPTE_TRANSAC_IDPAYS[";
                    echo $tmp,$count,"]=\"",$produit1["idpays"],"\";";
                    $tmp="CPTE_TRANSAC_NOMPAYS[";
                    echo $tmp,$count,"]=\"",stripslashes($produit1["nompays"]),"\";";

                    $tmp="CPTE_TRANSAC_TYPE[";
                    echo $tmp,$count,"]=\"C\";";
                  }
                  else               // ni pays, ni entreprise, ni user => on ignore
                  {
                    continue;
                  }
                }
              }

              $tmp="CPTE_TRANSAC_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="CPTE_TRANSAC_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="CPTE_TRANSAC_NOMCPTE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomcpte"]),"\";";
              $tmp="CPTE_TRANSAC_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var CPTE_TRANSAC_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_TRANSAC_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_TRANSAC_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_TRANSAC_NCPTE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_TRANSAC_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_TRANSAC_NOMCPTE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_TRANSAC_DEVISE = new Array(0);";
        echo $tmp;
}
?>







