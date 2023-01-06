<?php

$sql = "SELECT eco_pays.idpays,nompays,identreprise,nomentreprise,eco_typeentreprise.typeentreprise,libelle,eco_entreprise.iduser,eco_user.nom,capacite ";
$sql .= "FROM eco_entreprise,eco_user,eco_user as a, eco_pays,eco_typeentreprise,eco_relation ";
$sql .= "WHERE eco_user.iduser = eco_entreprise.iduser AND eco_pays.idpays = eco_entreprise.idpays ";
$sql .= "AND eco_typeentreprise.typeentreprise = eco_entreprise.typeentreprise ";
$sql .= "AND a.iduser = '$idjoueur' ";
$sql .= "AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ";
$sql .= "AND  eco_entreprise.idpays = eco_relation.idpays2 ";
$sql .= "AND  eco_relation.vision = '0' ";
$sql .= "UNION SELECT eco_pays.idpays,nompays,identreprise,nomentreprise,eco_typeentreprise.typeentreprise,libelle,'' as iduser,'' as nom,capacite ";
$sql .= "FROM eco_entreprise,eco_user as a, eco_pays,eco_typeentreprise,eco_relation ";
$sql .= "WHERE eco_entreprise.iduser = '0' AND eco_pays.idpays = eco_entreprise.idpays ";
$sql .= "AND eco_typeentreprise.typeentreprise = eco_entreprise.typeentreprise ";
$sql .= "AND a.iduser = '$idjoueur' ";
$sql .= "AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ";
$sql .= "AND eco_entreprise.idpays = eco_relation.idpays2 ";
$sql .= "AND  eco_relation.vision = '0' ";
$sql .= "ORDER BY nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Problème dans la requête (DET_ENTRE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_ENTRE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_IDENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_TYPEEQUI = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_NOMTYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_IDUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_NOMUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_CAPACITE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DET_ENTRE_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="DET_ENTRE_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="DET_ENTRE_IDENTRE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="DET_ENTRE_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="DET_ENTRE_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $type = $produit["typeentreprise"];

              $sql1 = "SELECT  typeequi FROM eco_typeentreprise WHERE  typeentreprise = '$type'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te recher type �quivalent (DET_ENTRE_)");
              $num1 = @mysqli_num_rows($res1);
              $produit1 = mysqli_fetch_array($res1);

              $tmp="DET_ENTRE_TYPEEQUI[";
              echo $tmp,$count,"]=\"",$produit1["typeequi"],"\";";


              $tmp="DET_ENTRE_NOMTYPE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";
              $tmp="DET_ENTRE_IDUSER[";
              echo $tmp,$count,"]=\"",$produit["iduser"],"\";";
              $tmp="DET_ENTRE_NOMUSER[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";
              $tmp="DET_ENTRE_CAPACITE[";
              echo $tmp,$count,"]=\"",$produit["capacite"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_ENTRE_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_IDENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_TYPEEQUI = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMTYPE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_IDUSER = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMUSER = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_CAPACITE = new Array(0);";
        echo $tmp;
}
?>







