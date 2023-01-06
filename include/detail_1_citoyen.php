<?php
$sql = "SELECT eco_user.iduser,nompays,eco_pays.idpays,exclu,nom,email,eco_user.datecreation,inactif,idpaysaccueil,portrait ";
$sql .= "FROM eco_user,eco_pays ";
$sql .= "WHERE eco_user.iduser = '$citoyen' AND eco_user.idpays = eco_pays.idpays";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (DET_CIT_)");
$num = @mysqli_num_rows($res);

if ($num == 1)
{
        $produit = mysqli_fetch_array($res);

              $tmp="var DET_CIT_IDUSER=\"";
              echo $tmp,$produit["iduser"],"\";";

              $tmp="var DET_CIT_NOMPAYS=\"";
              echo $tmp,stripslashes($produit["nompays"]),"\";";

              $tmp="var DET_CIT_IDPAYS=\"";
              echo $tmp,$produit["idpays"],"\";";

              $tmp="var DET_CIT_EXCLU=\"";
              echo $tmp,$produit["exclu"],"\";";

              $tmp="var DET_CIT_NOM=\"";
              echo $tmp,stripslashes($produit["nom"]),"\";";

              $tmp="var DET_CIT_EMAIL=\"";
              echo $tmp,$produit["email"],"\";";

              $tmp="var DET_CIT_DCREATE=\"";
              echo $tmp,$produit["datecreation"],"\";";

              $tmp="var DET_CIT_INACTIF=\"";
              echo $tmp,$produit["inactif"],"\";";

              $tmp="var DET_CIT_IDACCUEIL=\"";
              echo $tmp,$produit["idpaysaccueil"],"\";";

              $tmp="var DET_CIT_PORTRAIT=\"";
              echo $tmp,$produit["portrait"],"\";";

              $idpaysaccueil = $produit["idpaysaccueil"];

              if ($idpaysaccueil != '0')
              {
                $sql1 = "SELECT nompays FROM eco_pays WHERE idpays = '$idpaysaccueil'";
                $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requête rech pays accueil (DET_CIT_)");

                $num1 = @mysqli_num_rows($res1);
                if ($num == 1)
                {
                        $produit1 = mysqli_fetch_array($res1);
                        $tmp="var DET_CIT_NOMACCUEIL=\"";
                        echo $tmp,stripslashes($produit1["nompays"]),"\";";
                }
                else
                {
                        $tmp="var DET_CIT_NOMACCUEIL = ''";
                        echo $tmp;
                }
              }
              else
              {
                      $tmp="var DET_CIT_NOMACCUEIL = ''";
                      echo $tmp;
              }
}
else
{
        $tmp="var DET_CIT_IDUSER = '';";
        echo $tmp;
        $tmp="var DET_CIT_NOMPAYS = '';";
        echo $tmp;
        $tmp="var DET_CIT_IDPAYS = '';";
        echo $tmp;
        $tmp="var DET_CIT_EXCLU = '';";
        echo $tmp;
        $tmp="var DET_CIT_NOM = '';";
        echo $tmp;
        $tmp="var DET_CIT_EMAIL = '';";
        echo $tmp;
        $tmp="var DET_CIT_DCREATE = '';";
        echo $tmp;
        $tmp="var DET_CIT_INACTIF = '';";
        echo $tmp;
        $tmp="var DET_CIT_IDACCUEIL = '';";
        echo $tmp;
        $tmp="var DET_CIT_NOMACCUEIL = '';";
        echo $tmp;
}
?>