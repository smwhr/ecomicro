<?php
// ts les cptes de l'�tat du responsable
$sql = "SELECT idpays, idpaysaccueil FROM eco_user WHERE iduser = '$idjoueur'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête preparative CPTEP_");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
   $produit = mysqli_fetch_array($res);

   $idpays = $produit["idpays"];
   $idpaysaccueil = $produit["idpaysaccueil"];

   $sql = "SELECT idcompte,idtitulaire,solde,devise,nomcpte,eco_user.idpays,'a' as type,inactif ";
   $sql .= "FROM eco_banque,eco_user ";
   $sql .= "WHERE iduser = idtitulaire ";
   $sql .= "AND (idpays = '$idpays' OR idpaysaccueil = '$idpays') ";
   $sql .= "UNION SELECT idcompte,idtitulaire,solde,devise,nomcpte,idpays,'b' as type,'0' as inactif ";
   $sql .= "FROM eco_banque,eco_entreprise ";
   $sql .= "WHERE eco_banque.idtitulaire = eco_entreprise.identreprise ";
   $sql .= "AND idpays = '$idpays' ";
   $sql .= "UNION SELECT idcompte,idtitulaire,solde,eco_pays.devise,nomcpte,idpays,'c' as type,'0' as inactif ";
   $sql .= "FROM eco_banque, eco_pays ";
   $sql .= "WHERE eco_banque.idtitulaire = idpays ";
   $sql .= "AND idpays = '$idpays' ";
   $sql .= "ORDER BY idcompte";

   $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête CPTEP_");
   $num = @mysqli_num_rows($res);
}

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
        $tmp="var CPTEP_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTEP_INACTIF = new Array(";
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
              $tmp="CPTEP_TYPE[";
              echo $tmp,$count,"]=\"",$produit["type"],"\";";
              $tmp="CPTEP_INACTIF[";
              echo $tmp,$count,"]=\"",$produit["inactif"],"\";";

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
        $tmp="var CPTEP_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var CPTEP_INACTIF = new Array(0);";
        echo $tmp;
}
?>