<?php

$sql = "SELECT idpays, idpaysaccueil FROM eco_user WHERE iduser = '$idjoueur'";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te preparative MVTP_");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
   $produit = mysqli_fetch_array($res);

   $idpays = $produit["idpays"];
   $idpaysaccueil = $produit["idpaysaccueil"];

   $sql = "SELECT idmvt,eco_banque.idcompte,idtitulaire,montant,eco_mvtbanque.devise,dateheure,idcompteaux,commentaire FROM eco_banque,eco_entreprise,eco_mvtbanque WHERE eco_banque.idtitulaire = eco_entreprise.identreprise AND idpays = '$idpays' AND eco_mvtbanque.idcompte = eco_banque.idcompte UNION SELECT idmvt,eco_banque.idcompte,idtitulaire,montant,eco_mvtbanque.devise,dateheure,idcompteaux,commentaire FROM eco_banque,eco_mvtbanque,eco_user WHERE eco_user.iduser = eco_banque.idtitulaire AND eco_mvtbanque.idcompte = eco_banque.idcompte AND (idpays = '$idpays' OR idpaysaccueil = '$idpays') UNION SELECT idmvt,eco_banque.idcompte,idtitulaire,montant,eco_mvtbanque.devise,dateheure,idcompteaux,commentaire FROM eco_banque,eco_mvtbanque,eco_pays WHERE eco_pays.idpays = eco_banque.idtitulaire AND eco_mvtbanque.idcompte = eco_banque.idcompte AND eco_pays.idpays = '$idpays' ORDER BY dateheure DESC";

   $res = @mysqli_query($conn, $sql) or die("Probl�me dans la requ�te (MVTP_)");
   $num = @mysqli_num_rows($res);
}
if ($num !=0)
{
        $tmp="var MVTP_IDMVT = new Array(";
        echo $tmp, $num,");";
        $tmp="var MVTP_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var MVTP_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var MVTP_MONTANT = new Array(";
        echo $tmp, $num,");";
        $tmp="var MVTP_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var MVTP_DATEH = new Array(";
        echo $tmp, $num,");";
        $tmp="var MVTP_CPTEAUX = new Array(";
        echo $tmp, $num,");";
        $tmp="var MVTP_NOMCPTEAUX = new Array(";
        echo $tmp, $num,");";
        $tmp="var MVTP_COMMENT = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nom de l'auxiliaire
              $tmpcpte = $produit["idcompteaux"];
              $sql1 = "SELECT nomcpte FROM eco_banque WHERE idcompte = '$tmpcpte'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te (SELECT auxiliaire)");
              if (!($num1 = @mysqli_num_rows($res1)))
              {
                if ($tmpcpte == '999999')
                 $produit1["nomcpte"] = "Responsable";
                else if ($tmpcpte == '0')
                 $produit1["nomcpte"] = "Initialisation";
                else
                 $produit1["nomcpte"] = "Cpte supprim�";
              }
              else
                 $produit1 = mysqli_fetch_array($res1);

              $tmp="MVTP_IDMVT[";
              echo $tmp,$count,"]=\"",$produit["idmvt"],"\";";
              $tmp="MVTP_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="MVTP_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="MVTP_MONTANT[";
              echo $tmp,$count,"]=\"",$produit["montant"],"\";";
              $tmp="MVTP_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="MVTP_DATEH[";
              echo $tmp,$count,"]=\"",$produit["dateheure"],"\";";
              $tmp="MVTP_CPTEAUX[";
              echo $tmp,$count,"]=\"",$produit["idcompteaux"],"\";";
              $tmp="MVTP_NOMCPTEAUX[";
              echo $tmp,$count,"]=\"",stripslashes($produit1["nomcpte"]),"\";";
              $tmp="MVTP_COMMENT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["commentaire"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var MVTP_IDMVT = new Array(0);";
        echo $tmp;
        $tmp="var MVTP_NCPTE = new Array(0);";
        echo $tmp;
        $tmp="var MVTP_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var MVTP_MONTANT = new Array(0);";
        echo $tmp;
        $tmp="var MVTP_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var MVTP_DATEH = new Array(0);";
        echo $tmp;
        $tmp="var MVTP_CPTEAUX = new Array(0);";
        echo $tmp;
        $tmp="var MVTP_NOMCPTEAUX = new Array(0);";
        echo $tmp;
        $tmp="var MVTP_COMMENT = new Array(0);";
        echo $tmp;
}
?>







