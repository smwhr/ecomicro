<?php

$sql = "SELECT DISTINCTROW nompays,eco_pays.idpays,eco_pays.iduser,eco_pays.election,eco_pays.dateelection,emaileco,devise,cptenat,adr_site,adr_forum,drapeau,datecreation,controle_fiscal ";
$sql .= "FROM eco_pays WHERE idpays = '$etat'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (DET_PAYS_)");
$num = @mysqli_num_rows($res);

if ($num != 0)
{
        $produit = mysqli_fetch_array($res);

        $tmp="var DET_PAYS_NOMPAYS = '" . stripslashes($produit["nompays"]). "';";
        echo $tmp;
        $tmp="var DET_PAYS_IDPAYS = '" . $produit["idpays"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_IDUSER = '" . $produit["iduser"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_EMAILECO = '" . $produit["emaileco"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_DEVISE = '" . stripslashes($produit["devise"]). "';";
        echo $tmp;
        $tmp="var DET_PAYS_CPTENAT = '" . $produit["cptenat"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_ADRSITE = '" . $produit["adr_site"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_ADRFORUM = '" . $produit["adr_forum"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_DRAPEAU = '" . $produit["drapeau"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_DATECREATE = '" . $produit["datecreation"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_DATEELEC = '" . $produit["dateelection"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_ELECTION = '" . $produit["election"]. "';";
        echo $tmp;
        $tmp="var DET_PAYS_IDCF = '" . $produit["controle_fiscal"]. "';";
        echo $tmp;

              $user = $produit["iduser"];
              $sql1 = "SELECT nom FROM eco_user WHERE iduser = '$user'";
              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requête user (DET_PAYS_)");
              $num1 = @mysqli_num_rows($res1);

              if ($num1 !=0)
              {
                $produit1 = mysqli_fetch_array($res1);
                $tmp="var DET_PAYS_NOMUSER = '" . stripslashes($produit1["nom"]). "';";;
                echo $tmp;
              }
              else
              {
                $tmp="var DET_PAYS_NOMUSER = ' ';";;
                echo $tmp;
              }

              $cf = $produit["controle_fiscal"];
              $sql1 = "SELECT nom FROM eco_user WHERE iduser = '$cf'";
              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requête user2 (DET_PAYS_)");
              $num1 = @mysqli_num_rows($res1);

              if ($num1 !=0)
              {
                $produit1 = mysqli_fetch_array($res1);
                $tmp="var DET_PAYS_NOMCF = '" . stripslashes($produit1["nom"]). "';";;
                echo $tmp;
              }
              else
              {
                $tmp="var DET_PAYS_NOMCF = ' ';";;
                echo $tmp;
              }

}
else
{
        $tmp="var DET_PAYS_NOMPAYS = '';";
        echo $tmp;
        $tmp="var DET_PAYS_IDPAYS = '';";
        echo $tmp;
        $tmp="var DET_PAYS_IDUSER = '';";
        echo $tmp;
        $tmp="var DET_PAYS_ADRSITE = '';";
        echo $tmp;
        $tmp="var DET_PAYS_ADRFORUM = '';";
        echo $tmp;
        $tmp="var DET_PAYS_DRAPEAU = '';";
        echo $tmp;
        $tmp="var DET_PAYS_DATECREATE = '';";
        echo $tmp;
        $tmp="var DET_PAYS_EMAILECO = '';";
        echo $tmp;
        $tmp="var DET_PAYS_DEVISE = '';";
        echo $tmp;
        $tmp="var DET_PAYS_CPTENAT = '';";
        echo $tmp;
        $tmp="var DET_PAYS_NOMUSER = '';";
        echo $tmp;
        $tmp="var DET_PAYS_DATEELEC = '';";
        echo $tmp;
        $tmp="var DET_PAYS_ELECTION = '';";
        echo $tmp;
        $tmp="var DET_PAYS_IDCF = '';";
        echo $tmp;
        $tmp="var DET_PAYS_NOMCF = '';";
        echo $tmp;
}
?>







