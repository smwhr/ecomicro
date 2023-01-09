<?php

$sql = "SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte2 as cpte, commentaire, periodicite, jour,'a' as type ";
$sql .= "FROM eco_banque, eco_entreprise, eco_tranperiodique, eco_user, eco_user as a ";
$sql .= "WHERE eco_banque.idtitulaire = eco_entreprise.identreprise ";
$sql .= "AND eco_tranperiodique.idcpte1 = eco_banque.idcompte ";
$sql .= "AND eco_entreprise.iduser = eco_user.iduser ";
$sql .= "AND eco_user.idpays = a.idpays ";
$sql .= "AND a.iduser = '$idjoueur' ";

$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte2 as cpte, commentaire, periodicite, jour,'a' as type ";
$sql .= "FROM eco_banque, eco_tranperiodique, eco_user, eco_user as a ";
$sql .= "WHERE eco_tranperiodique.idcpte1 = eco_banque.idcompte ";
$sql .= "AND eco_banque.idtitulaire = eco_user.iduser ";
$sql .= "AND eco_user.idpays = a.idpays ";
$sql .= "AND a.iduser = '$idjoueur' ";

$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte2 as cpte, commentaire, periodicite, jour,'a' as type ";
$sql .= "FROM eco_banque, eco_tranperiodique, eco_pays, eco_user ";
$sql .= "WHERE eco_tranperiodique.idcpte1 = eco_banque.idcompte ";
$sql .= "AND eco_banque.idtitulaire = eco_pays.idpays ";
$sql .= "AND eco_pays.idpays = eco_user.idpays ";
$sql .= "AND eco_user.iduser = '$idjoueur'";

$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte1 as cpte, commentaire, periodicite, jour,'b' as type ";
$sql .= "FROM eco_banque, eco_entreprise, eco_tranperiodique, eco_user, eco_user as a ";
$sql .= "WHERE eco_banque.idtitulaire = eco_entreprise.identreprise ";
$sql .= "AND eco_tranperiodique.idcpte2 = eco_banque.idcompte ";
$sql .= "AND eco_entreprise.iduser = eco_user.iduser ";
$sql .= "AND eco_user.idpays = a.idpays ";
$sql .= "AND a.iduser = '$idjoueur' ";

$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte1 as cpte, commentaire, periodicite, jour,'b' as type ";
$sql .= "FROM eco_banque, eco_tranperiodique, eco_user, eco_user as a ";
$sql .= "WHERE eco_tranperiodique.idcpte2 = eco_banque.idcompte ";
$sql .= "AND eco_banque.idtitulaire = eco_user.iduser ";
$sql .= "AND eco_user.idpays = a.idpays ";
$sql .= "AND a.iduser = '$idjoueur' ";

$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte1 as cpte, commentaire, periodicite, jour,'b' as type ";
$sql .= "FROM eco_banque, eco_tranperiodique, eco_pays, eco_user WHERE eco_tranperiodique.idcpte2 = eco_banque.idcompte ";
$sql .= "AND eco_banque.idtitulaire = eco_pays.idpays ";
$sql .= "AND eco_pays.idpays = eco_user.idpays ";
$sql .= "AND eco_user.iduser = '$idjoueur'";

//SELECT eco_entreprise.identreprise FROM eco_entreprise, eco_bourse WHERE idactionnaire = '1' AND eco_entreprise.identreprise = eco_bourse.identreprise AND eco_bourse.nbaction > ( eco_bourse.nbactiontotal /2 ) ) OR eco_entreprise.iduser = '1' ) AND eco_mvtbanque.idcompte = eco_banque.idcompte UNION SELECT idmvt, eco_banque.idcompte, idtitulaire, montant, eco_mvtbanque.devise, dateheure, idcompteaux, commentaire FROM eco_banque, eco_mvtbanque WHERE eco_mvtbanque.idcompte = eco_banque.idcompte AND eco_banque.idtitulaire = '1' ORDER BY dateheure DESC
$res = @mysqli_query($conn, $sql) or die("Problème dans la requête (MVTP_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var TRANSAC_IDTRANSAC = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_MONTANT = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_CPTE2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_NOMCPTE2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_COMMENT = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_FREQ = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSAC_JOUR = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nom de l'auxiliaire
              $tmpcpte = $produit["cpte"];
              $sql1 = "SELECT nomcpte FROM eco_banque WHERE idcompte = '$tmpcpte'";
              $res1 = @mysqli_query($conn, $sql1) or die("Problème dans la requête (SELECT auxiliaire)");
              if (!($num1 = @mysqli_num_rows($res1)))
                 $produit1["nomcpte"] = "Cpte supprimé";
              else
                 $produit1 = mysqli_fetch_array($res1);

              $tmp="TRANSAC_IDTRANSAC[";
              echo $tmp,$count,"]=\"",$produit["idtransac"],"\";";
              $tmp="TRANSAC_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="TRANSAC_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="TRANSAC_MONTANT[";
              echo $tmp,$count,"]=\"",$produit["montant"],"\";";
              $tmp="TRANSAC_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="TRANSAC_CPTE2[";
              echo $tmp,$count,"]=\"",$produit["cpte"],"\";";
              $tmp="TRANSAC_NOMCPTE2[";
              echo $tmp,$count,"]=\"",stripslashes($produit1["nomcpte"]),"\";";
              $tmp="TRANSAC_COMMENT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["commentaire"]),"\";";
              $tmp="TRANSAC_TYPE[";
              echo $tmp,$count,"]=\"",$produit["type"],"\";";

              if ($produit["periodicite"] == '1')
                  $freq = 'Mensuel';
              else if ($produit["periodicite"] == '2')
                  $freq = 'Bimestriel';
              else if ($produit["periodicite"] == '3')
                  $freq = 'Trimestriel';
              else
                  $freq = 'A supprimer...';

              $tmp="TRANSAC_FREQ[";
              echo $tmp,$count,"]=\"",$freq,"\";";

              if ($produit["jour"] == '1')
                  $jour = 'Début de mois';
              else if ($produit["jour"] == '2')
                  $jour = 'Milieu de mois';
              else if ($produit["jour"] == '3')
                  $jour = 'Fin de mois';
              else
                  $jour = 'A supprimer...';

              $tmp="TRANSAC_JOUR[";
              echo $tmp,$count,"]=\"",$jour,"\";";

              $count += 1;
        }
}
else
{
        $tmp="var TRANSAC_IDTRANSAC = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_NCPTE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_CPTE2 = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_NOMCPTE2 = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_COMMENT = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_FREQ = new Array(0);";
        echo $tmp;
        $tmp="var TRANSAC_JOUR = new Array(0);";
        echo $tmp;
}
?>


