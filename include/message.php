<?php

$sql = "SELECT idmsg,origine,destinataire,objet,libelle,reponse,datepropo,dateexpir,data ";
$sql .= "FROM eco_message ";
$sql .= "WHERE destinataire = '$idjoueur' OR origine = '$idjoueur' ";
$sql .= "ORDER BY datepropo DESC";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (MSG_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var MSG_IDMSG = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_IDORIGINE = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_NOMORIGINE = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_IDDEST = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_NOMDEST = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_OBJET = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_LIBELLE = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_REPONSE = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_DATEPROPO = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_DATEEXPIR = new Array(";
        echo $tmp, $num,");";
        $tmp="var MSG_DATA = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="MSG_IDMSG[";
              echo $tmp,$count,"]=\"",$produit["idmsg"],"\";";
              $tmp="MSG_IDORIGINE[";
              echo $tmp,$count,"]=\"",$produit["origine"],"\";";
              $id = $produit["origine"];

              $sql1 = "SELECT nom from eco_user WHERE iduser = '$id'";
              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te user (MSG_)");
              $num1 = @mysqli_num_rows($res1);
              if ($num1 == 1)
              {
                $produit1 = mysqli_fetch_array($res1);
                $tmp="MSG_NOMORIGINE[";
                echo $tmp,$count,"]=\"",stripslashes($produit1["nom"]),"\";";
              }
              else
              {
                $sql1 = "SELECT nomentreprise from eco_entreprise WHERE identreprise = '$id'";
                $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te entreprise (MSG_)");
                $num1 = @mysqli_num_rows($res1);
                if ($num1 == 1)
                {
                  $produit1 = mysqli_fetch_array($res1);
                  $tmp="MSG_NOMORIGINE[";
                  echo $tmp,$count,"]=\"",stripslashes($produit1["nomentreprise"]),"\";";
                }
                else
                {
                  $sql1 = "SELECT nompays from eco_pays WHERE idpays = '$id'";
                  $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te pays (MSG_)");
                  $num1 = @mysqli_num_rows($res1);
                  if ($num1 == 1)
                  {
                    $produit1 = mysqli_fetch_array($res1);
                    $tmp="MSG_NOMORIGINE[";
                    echo $tmp,$count,"]=\"",stripslashes($produit1["nompays"]),"\";";
                  }
                  else
                  {
                    $tmp="MSG_NOMORIGINE[";
                    echo $tmp,$count,"]=\"Inconnu !\";";
                  }
                }
              }

              $tmp="MSG_IDDEST[";
              echo $tmp,$count,"]=\"",$produit["destinataire"],"\";";
              $id = $produit["destinataire"];

              $sql1 = "SELECT nom from eco_user WHERE iduser = '$id'";
              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te user (MSG_)");
              $num1 = @mysqli_num_rows($res1);
              if ($num1 == 1)
              {
                $produit1 = mysqli_fetch_array($res1);
                $tmp="MSG_NOMDEST[";
                echo $tmp,$count,"]=\"",stripslashes($produit1["nom"]),"\";";
              }
              else
              {
                $sql1 = "SELECT nomentreprise from eco_entreprise WHERE identreprise = '$id'";
                $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te entreprise (MSG_)");
                $num1 = @mysqli_num_rows($res1);
                if ($num1 == 1)
                {
                  $produit1 = mysqli_fetch_array($res1);
                  $tmp="MSG_NOMDEST[";
                  echo $tmp,$count,"]=\"",stripslashes($produit1["nomentreprise"]),"\";";
                }
                else
                {
                  $sql1 = "SELECT nompays from eco_pays WHERE idpays = '$id'";
                  $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te pays (MSG_)");
                  $num1 = @mysqli_num_rows($res1);
                  if ($num1 == 1)
                  {
                    $produit1 = mysqli_fetch_array($res1);
                    $tmp="MSG_NOMDEST[";
                    echo $tmp,$count,"]=\"",stripslashes($produit1["nompays"]),"\";";
                  }
                  else
                  {
                    $tmp="MSG_NOMDEST[";
                    echo $tmp,$count,"]=\"Inconnu !\";";
                  }
                }
              }


              $tmp="MSG_OBJET[";
              echo $tmp,$count,"]=\"",$produit["objet"],"\";";
              $tmp="MSG_LIBELLE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";
              $tmp="MSG_REPONSE[";
              echo $tmp,$count,"]=\"",$produit["reponse"],"\";";
              $tmp="MSG_DATEPROPO[";
              echo $tmp,$count,"]=\"",$produit["datepropo"],"\";";
              $tmp="MSG_DATEEXPIR[";
              echo $tmp,$count,"]=\"",$produit["dateexpir"],"\";";
              $tmp="MSG_DATA[";
              echo $tmp,$count,"]=\"",$produit["data"],"\";";

              $count += 1;
        }
}
else
{
        $tmp="var MSG_IDMSG = new Array(0);";
        echo $tmp;
        $tmp="var MSG_IDORIGINE = new Array(0);";
        echo $tmp;
        $tmp="var MSG_NOMORIGINE = new Array(0);";
        echo $tmp;
        $tmp="var MSG_IDDEST = new Array(0);";
        echo $tmp;
        $tmp="var MSG_NOMDEST = new Array(0);";
        echo $tmp;
        $tmp="var MSG_OBJET = new Array(0);";
        echo $tmp;
        $tmp="var MSG_LIBELLE = new Array(0);";
        echo $tmp;
        $tmp="var MSG_REPONSE = new Array(0);";
        echo $tmp;
        $tmp="var MSG_DATEPROPO = new Array(0);";
        echo $tmp;
        $tmp="var MSG_DATEEXPIR = new Array(0);";
        echo $tmp;
        $tmp="var MSG_DATA = new Array(0);";
        echo $tmp;
}
?>







