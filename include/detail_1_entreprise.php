<?php

$sql = "SELECT DISTINCTROW eco_pays.idpays,nompays,identreprise,nomentreprise,eco_typeentreprise.typeentreprise,libelle,eco_entreprise.iduser,capacite,capacitemens,site,logo FROM eco_entreprise,eco_typeentreprise,eco_pays WHERE eco_pays.idpays = eco_entreprise.idpays AND eco_typeentreprise.typeentreprise = eco_entreprise.typeentreprise AND eco_entreprise.identreprise = '$entreprise'";

$res = @mysqli_query($conn, $sql) or die("Probl�me dans la requ�te (DET_ENTRE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $produit = mysqli_fetch_array($res);

              $tmp="var DET_ENTRE_IDPAYS";
              echo $tmp,"=\"",$produit["idpays"],"\";";
              $tmp="var DET_ENTRE_NOMPAYS";
              echo $tmp,"=\"",$produit["nompays"],"\";";
              $tmp="var DET_ENTRE_IDENTRE";
              echo $tmp,"=\"",$produit["identreprise"],"\";";
              $tmp="var DET_ENTRE_NOMENTRE";
              echo $tmp,"=\"",$produit["nomentreprise"],"\";";
              $tmp="var DET_ENTRE_TYPE";
              echo $tmp,"=\"",$produit["typeentreprise"],"\";";
              $tmp="var DET_ENTRE_NOMTYPE";
              echo $tmp,"=\"",$produit["libelle"],"\";";
              $tmp="var DET_ENTRE_CAPACITE";
              echo $tmp,"=\"",$produit["capacite"],"\";";
              $tmp="var DET_ENTRE_CAPACITEMENS";
              echo $tmp,"=\"",$produit["capacitemens"],"\";";
              $tmp="var DET_ENTRE_SITE";
              echo $tmp,"=\"",$produit["site"],"\";";
              $tmp="var DET_ENTRE_LOGO";
              echo $tmp,"=\"",$produit["logo"],"\";";
              $tmp="var DET_ENTRE_IDUSER";
              echo $tmp,"=\"",$produit["iduser"],"\";";

              $iduser = $produit["iduser"];

              $sql1 = "SELECT nom FROM eco_user WHERE iduser = '$iduser'";

              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te user (DET_ENTRE_)");
              $num1 = @mysqli_num_rows($res1);
              if ($num1 == 1)
              {

                $produit1 = mysqli_fetch_array($res1);
                $tmp="var DET_ENTRE_NOMUSER";
                echo $tmp,"=\"",stripslashes($produit1["nom"]),"\";";
              }
              else
              {
                $tmp="var DET_ENTRE_NOMUSER";
                echo $tmp,"=\"Poste disponible\";";
              }

              $tt = time();
              $mois = date("m",$tt);
              $annee = date("y",$tt);
              $sql1 = "SELECT nb as conso FROM eco_histo WHERE identreprise = '$entreprise' AND action = '2' AND mois = '$mois' AND SUBSTR(datemaj,3,2) = '$annee';";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te histo (DET_ENTRE_)");
              $num1 = @mysqli_num_rows($res1);
              if ($num1 == 1)
              {
                $produit1 = mysqli_fetch_array($res1);
                $tmp="var DET_ENTRE_CAPACITECONSO";
                echo $tmp,"=\"",$produit1["conso"],"\";";
              }
              else
              {
                $tmp="var DET_ENTRE_CAPACITECONSO";
                echo $tmp,"='0';";
              }

}
else
{
        $tmp="var DET_ENTRE_IDPAYS = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMPAYS = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_IDENTRE = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMENTRE = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_TYPE = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMTYPE = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_IDUSER = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMUSER = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_CAPACITE = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_CAPACITEMENS = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_CAPACITECONSO = '';";
        echo $tmp;
}
?>







