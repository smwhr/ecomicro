<?php

$sql = "SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte2 as cpte, commentaire, periodicite, jour,'a' as type ";
$sql .= "FROM eco_banque, eco_entreprise, eco_tranperiodique ";
$sql .= "WHERE eco_banque.idtitulaire = eco_entreprise.identreprise AND eco_tranperiodique.idcpte1 = eco_banque.idcompte ";
$sql .= "AND eco_entreprise.iduser = '$idjoueur' ";
$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte2 as cpte, commentaire, periodicite, jour,'a' as type ";
$sql .= "FROM eco_banque, eco_tranperiodique ";
$sql .= "WHERE eco_tranperiodique.idcpte1 = eco_banque.idcompte AND eco_banque.idtitulaire = '$idjoueur' ";
$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte2 as cpte, commentaire, periodicite, jour,'a' as type ";
$sql .= "FROM eco_banque, eco_tranperiodique, eco_pays ";
$sql .= "WHERE eco_tranperiodique.idcpte1 = eco_banque.idcompte AND eco_banque.idtitulaire = eco_pays.idpays ";
$sql .= "AND eco_pays.iduser = '$idjoueur' ";
$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte1 as cpte, commentaire, periodicite, jour,'b' as type ";
$sql .= "FROM eco_banque, eco_entreprise, eco_tranperiodique ";
$sql .= "WHERE eco_banque.idtitulaire = eco_entreprise.identreprise AND eco_tranperiodique.idcpte2 = eco_banque.idcompte ";
$sql .= "AND eco_entreprise.iduser = '$idjoueur' ";
$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte1 as cpte, commentaire, periodicite, jour,'b' as type ";
$sql .= "FROM eco_banque, eco_tranperiodique ";
$sql .= "WHERE eco_tranperiodique.idcpte2 = eco_banque.idcompte AND eco_banque.idtitulaire = '$idjoueur' ";
$sql .= "UNION SELECT idtransac, eco_banque.idcompte, idtitulaire, montant, eco_tranperiodique.devise, idcpte1 as cpte, commentaire, periodicite, jour,'b' as type ";
$sql .= "FROM eco_banque, eco_tranperiodique, eco_pays ";
$sql .= "WHERE eco_tranperiodique.idcpte2 = eco_banque.idcompte AND eco_banque.idtitulaire = eco_pays.idpays ";
$sql .= "AND eco_pays.iduser = '$idjoueur'";

//SELECT eco_entreprise.identreprise FROM eco_entreprise, eco_bourse WHERE idactionnaire = '1' AND eco_entreprise.identreprise = eco_bourse.identreprise AND eco_bourse.nbaction > ( eco_bourse.nbactiontotal /2 ) ) OR eco_entreprise.iduser = '1' ) AND eco_mvtbanque.idcompte = eco_banque.idcompte UNION SELECT idmvt, eco_banque.idcompte, idtitulaire, montant, eco_mvtbanque.devise, dateheure, idcompteaux, commentaire FROM eco_banque, eco_mvtbanque WHERE eco_mvtbanque.idcompte = eco_banque.idcompte AND eco_banque.idtitulaire = '1' ORDER BY dateheure DESC
$res = @mysqli_query($conn, $sql) or die("Probl�me dans la requ�te (MVTP_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var TRANSACP_IDTRANSAC = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_MONTANT = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_DEVISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_CPTE2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_NOMCPTE2 = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_COMMENT = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_FREQ = new Array(";
        echo $tmp, $num,");";
        $tmp="var TRANSACP_JOUR = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {

              // Recherche du nom de l'auxiliaire
              $tmpcpte = $produit["cpte"];
              $sql1 = "SELECT nomcpte FROM eco_banque WHERE idcompte = '$tmpcpte'";
              $res1 = @mysqli_query($conn, $sql1) or die("Probl�me dans la requ�te (SELECT auxiliaire)");
              if (!($num1 = @mysqli_num_rows($res1)))
                 $produit1["nomcpte"] = "Cpte supprim�";
              else
                 $produit1 = mysqli_fetch_array($res1);

              $tmp="TRANSACP_IDTRANSAC[";
              echo $tmp,$count,"]=\"",$produit["idtransac"],"\";";
              $tmp="TRANSACP_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="TRANSACP_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="TRANSACP_MONTANT[";
              echo $tmp,$count,"]=\"",$produit["montant"],"\";";
              $tmp="TRANSACP_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
              $tmp="TRANSACP_CPTE2[";
              echo $tmp,$count,"]=\"",$produit["cpte"],"\";";
              $tmp="TRANSACP_NOMCPTE2[";
              echo $tmp,$count,"]=\"",stripslashes($produit1["nomcpte"]),"\";";
              $tmp="TRANSACP_COMMENT[";
              echo $tmp,$count,"]=\"",stripslashes($produit["commentaire"]),"\";";
              $tmp="TRANSACP_TYPE[";
              echo $tmp,$count,"]=\"",$produit["type"],"\";";

              if ($produit["periodicite"] == '1')
                  $freq = 'Mensuel';
              else if ($produit["periodicite"] == '2')
                  $freq = 'Bimestriel';
              else if ($produit["periodicite"] == '3')
                  $freq = 'Trimestriel';
              else
                  $freq = 'A supprimer...';

              $tmp="TRANSACP_FREQ[";
              echo $tmp,$count,"]=\"",$freq,"\";";

              if ($produit["jour"] == '1')
                  $jour = 'D�but de mois';
              else if ($produit["jour"] == '2')
                  $jour = 'Milieu de mois';
              else if ($produit["jour"] == '3')
                  $jour = 'Fin de mois';
              else
                  $jour = 'A supprimer...';

              $tmp="TRANSACP_JOUR[";
              echo $tmp,$count,"]=\"",$jour,"\";";

              $count += 1;
        }
}
else
{
        $tmp="var TRANSACP_IDTRANSAC = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_NCPTE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_DEVISE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_CPTE2 = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_NOMCPTE2 = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_COMMENT = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_FREQ = new Array(0);";
        echo $tmp;
        $tmp="var TRANSACP_JOUR = new Array(0);";
        echo $tmp;
}
?>







