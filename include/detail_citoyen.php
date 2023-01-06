<?php

$sql = "SELECT eco_user.iduser,eco_pays.nompays,eco_pays.idpays,eco_user.idpays as user_idpays,eco_user.inactif,eco_user.exclu,eco_user.nom,eco_user.email,eco_user.datecreation,eco_user.login,MIN(idcompte) as idcompte FROM eco_banque,eco_user,eco_pays,eco_user as a,eco_relation WHERE idtitulaire = eco_user.iduser AND (eco_user.idpays = eco_pays.idpays OR eco_user.idpaysaccueil = eco_pays.idpays) AND ( eco_user.iduser = '$idjoueur' OR ((a.iduser = '$idjoueur' AND ( a.idpays = eco_relation.idpays1 OR a.idpaysaccueil = eco_relation.idpays1) ) AND ( eco_user.idpays = eco_relation.idpays2 ) AND  eco_relation.vision = '0' )) GROUP BY eco_user.iduser,eco_pays.nompays,eco_pays.idpays,eco_user.nom,eco_user.email,datecreation,login ORDER BY eco_user.nom";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (DET_CIT_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_CIT_IDUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_IDPAYSUSER = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_INACTIF = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_EXCLU = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_NOM = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_EMAIL = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_DCREATE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_LOGIN = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_CIT_CPTE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DET_CIT_IDUSER[";
              echo $tmp,$count,"]=\"",$produit["iduser"],"\";";
              $tmp="DET_CIT_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="DET_CIT_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="DET_CIT_IDPAYSUSER[";
              echo $tmp,$count,"]=\"",$produit["user_idpays"],"\";";
              $tmp="DET_CIT_INACTIF[";
              echo $tmp,$count,"]=\"",$produit["inactif"],"\";";
              $tmp="DET_CIT_EXCLU[";
              echo $tmp,$count,"]=\"",$produit["exclu"],"\";";
              $tmp="DET_CIT_NOM[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nom"]),"\";";
              $tmp="DET_CIT_EMAIL[";
              echo $tmp,$count,"]=\"","Cf. détail","\";";
              $tmp="DET_CIT_DCREATE[";
              echo $tmp,$count,"]=\"",$produit["datecreation"],"\";";
              $tmp="DET_CIT_LOGIN[";
              echo $tmp,$count,"]=\"",$produit["login"],"\";";
              $tmp="DET_CIT_CPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_CIT_IDUSER = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_IDPAYSUSER = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_INACTIF = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_EXCLU = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_NOM = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_EMAIL = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_DCREATE = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_LOGIN = new Array(0);";
        echo $tmp;
        $tmp="var DET_CIT_CPTE = new Array(0);";
        echo $tmp;
}
?>







