<?php


      // Recherche info du compte d'origine
      $sql = "SELECT idtransac,idcpte1,montant,devise,idpays,idcpte2,commentaire,periodicite,jour,dateprochain ";
      $sql .= "FROM eco_tranperiodique;";

      $result = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche transac periodique (trtcnx) !!!");
      $num = @mysqli_num_rows($result);
      if ($num > 0)
      {

        $count = 0;
	while($produit = mysqli_fetch_array($result))
        {
        	$idtransac = $produit["idtransac"];
        	$periodicite = $produit["periodicite"];
        	$jour = $produit["jour"];
        	$dateprochain = $produit["dateprochain"];

                if ($dateprochain <= $date_jour)
                {
                  $montant = $produit["montant"];
                  $com = $produit["commentaire"];
                  $idcpte1 = $produit["idcpte1"];
                  $idpaysA = $produit["idpays"];
                  $idcpte2 = $produit["idcpte2"];

                  $idjoueur = $_SESSION['perso_iduser'];

                      // D�but contr�les
                      //----------------

                      // Recherche info du compte d'origine
                      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte1';";
                      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du compte 1  (trtcnx) !!!");
                      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 1  (trtcnx) !!!");
                      $produit = mysqli_fetch_array($res);
                      $deviseA = $produit['devise'];
                      $soldeA = $produit['solde'];

                      // Recherche info du compte destinataire
                      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte2';";
                      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche du compte 2 (achatstock) !!!");
                      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 2  (trtcnx) !!!");
                      $produit = mysqli_fetch_array($res);
                      $deviseB = $produit['devise'];
                      $soldeB = $produit['solde'];


                    $newsoldeA = $soldeA - $montant;
                    if ($newsoldeA < 0)
                      continue;

                      // Recherche comptes et taux de change
                      if ($deviseA != $deviseB)
                      {
                        // Recherche compte taux de change devise A
                        $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseA' AND idpays1 = '$idpaysA';";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (transaction) !!!");
                        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
                          continue;

                        $produit = mysqli_fetch_array($res);
                        $taux_cpte_cre = $produit['idcompte'];

                        // Recherche compte taux de change devise B
                        $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseB' AND idpays1 = '$idpaysA';";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (transaction) !!!");
                        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
                          continue;

                        $produit = mysqli_fetch_array($res);
                        $taux_cpte_deb = $produit['idcompte'];

                        // V�rification de la devise et du solde du compte A
                        $sql = "SELECT solde,devise FROM eco_banque WHERE idcompte = '$taux_cpte_cre';";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche devise compte taux (transaction) !!!");
                        if (!($num = @mysqli_num_rows($res)))  // pas compte taux de change...
                          continue;

                        $produit = mysqli_fetch_array($res);
                        if ($deviseA != $produit['devise'])  // mauvaise devise compte taux de change...
                          continue;

                        $solde_cpte_taux_cre = $produit['solde'];

                        // V�rification de la devise et du solde du compte B
                        $sql = "SELECT solde,devise FROM eco_banque WHERE idcompte = '$taux_cpte_deb';";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche devise compte taux (transaction) !!!");
                        if (!($num = @mysqli_num_rows($res)))  // pas compte taux de change...
                          continue;

                        $produit = mysqli_fetch_array($res);
                        if ($deviseB != $produit['devise'])  // mauvaise devise compte taux de change...
                          continue;

                        $solde_cpte_taux_deb = $produit['solde'];

                        // Recherche taux de change
                        $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (transaction) !!!");
                        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
                          continue;

                        $produit = mysqli_fetch_array($res);
                        $taux = $produit['taux'];

                        $tarif_taux = $montant * $taux;

                        if ($tarif_taux > $solde_cpte_taux_deb)  // solde compte taux de change insuffisant...
                          continue;

                        $newsolde_cpte_taux_deb = $solde_cpte_taux_deb - $tarif_taux;

                        $newsolde_cpte_taux_cre = $solde_cpte_taux_cre + $montant;

                      }
                      else
                        $tarif_taux = $montant;

                      $newsoldeB = $soldeB + $tarif_taux;


                      // Fin contr�les
                      //--------------


                      $libelletransaction = "Périodique : " . $idcpte1 . " -> " . $idcpte2 . " de " . $montant;
                      $libelletransaction .= " ** " . $deviseA . " -> " . $deviseB;
                      $libelletransaction .= " ** " . $com;


                      // => Transactions
                      //----------------


                      if ($deviseA == $deviseB)   // Pas de taux
                      {
                        // Transaction d�bitrice
                        $montant_neg = $montant * -1;
                        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$idcpte2','$montant_neg','$deviseA','$com',NOW());";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te débitrice (transaction) !!!");

                        // Transaction cr�ditrice
                        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$idcpte1','$montant','$deviseB','$com',NOW());";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te créditrice (transaction) !!!");

                        // M�j solde d�bit�
                        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
                        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Acheteur. (transaction)");

                        // M�j solde cr�dit�
                        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
                        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Vendeur. (transaction)");
                      }
                      else
                      {
                        // Transactions : Acheteur -> Banque 1 - Banque 2 -> Vendeur

                        // Acheteur -> Banque 1 : mvts
                        $montant_neg = $montant * -1;
                        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taux_cpte_cre','$montant_neg','$deviseA','$com',NOW());";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d�bitrice Acheteur (transaction) !!!");

                        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taux_cpte_cre','$idcpte1','$montant','$deviseA','$libelletransaction',NOW());";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice Banque nationale (transaction) !!!");

                        // Acheteur -> Banque 1 : solde Acheteur
                        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
                        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde solde Acheteur. (transaction)");

                        // Acheteur -> Banque 1 : solde Banque 1
                        $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taux_cre' WHERE idcompte = '$taux_cpte_cre';";
                        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde solde Acheteur. (transaction)");


                        // Banque 2 -> Vendeur : mvts
                        $tarif_taux_neg = $tarif_taux * -1;
                        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$taux_cpte_deb','$tarif_taux','$deviseB','$com',NOW());";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice Vendeur (transaction) !!!");

                        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taux_cpte_deb','$idcpte2','$tarif_taux_neg','$deviseB','$libelletransaction',NOW());";
                        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d�bitrice Banque 2 (transaction) !!!");

                        // M�j solde cr�dit�
                        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
                        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde Vendeur. (transaction)");

                        // M�j solde d�bit�
                        $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taux_deb' WHERE idcompte = '$taux_cpte_deb';";
                        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde Banque 2. (transaction)");
                      }


                      // M�j solde eco_tranperiodique
    
                      $mois0 = substr($dateprochain,5,2) + $periodicite;
                      $annee0 = substr($dateprochain,0,4);
                      $jour0 = substr($dateprochain,8,2);
                      if ($mois0 > 12)
                      {
                      	$mois0 = $mois0 - 12;
                      	$annee0++;
                      }

                      if ($mois0 < 10)
                         $mois0 = "0" . $mois0;

                      $dateprochain = $annee0 . "-" . $mois0 . "-" . $jour0;

                      $sql1 = "UPDATE eco_tranperiodique SET dateprochain = '$dateprochain' WHERE idtransac = '$idtransac';";
                      $res1 = @mysqli_query($conn, $sql1) or die("<br> PB de màj transac periodique. (transaction)");

                  }

        }
      }






?>

