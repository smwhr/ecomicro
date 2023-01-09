<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Action Achat de titres </title>
<head>
<body>

<?php

  include("../include/config.php");

  $idmsg = addslashes(trim($_POST['idmsg']));
  $reponse = addslashes(trim($_POST['reponse1']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT origine, destinataire,objet,libelle,datepropo,dateexpir,data,reponse FROM eco_message WHERE idmsg = '$idmsg';";
  $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche message");
  $num = @mysqli_num_rows($res) or die("<br> Le message n'existe pas !!!");
  $produit = mysqli_fetch_array($res);

  $origine = $produit['origine'];
  $destination = $produit['destinataire'];
  $objet = $produit['objet'];
  $libelle = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['libelle']));
  $datepropo = $produit['datepropo'];
  $dateexpir = $produit['dateexpir'];
  $data = $produit['data'];
  $reponse_av = $produit['reponse'];

  $fct_mes_vente_texte = $libelle;

   if ($reponse_av != "")
     die ("Message déjà répondu...");

  if (($objet == "VENTE_TITRE") && ($reponse == "A"))
  {
    //  $datatransaction = $idcpte1 . "|" . $idcpte2 . "|" . $entreA . "|" . $entreB . "|" . $nbunite . "|" . $idtitre . "|" . $tarif;
    //   100001|100005|1|5|20|80005|10

    $tab_data = explode("|",$data);

        $idcpte1 = $tab_data[0];
        $idcpte2 = $tab_data[1];
        $entreA = $tab_data[2];
        $entreB = $tab_data[3];
        $nbunite = $tab_data[4];
        $idtitre = $tab_data[5];
        $tarif = $tab_data[6];

      // D�but contr�les
      //----------------

      // Recherche du stock initial vendeur
      $sql = "SELECT nbaction FROM eco_bourse WHERE idactionnaire = '$entreB' AND identreprise = '$idtitre';";
      $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te de recherche de la nbaction (achattitre) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de stock (achatstock) !!!");
      $produit = mysqli_fetch_array($res);

      $new_nbaction = $produit['nbaction'] - $nbunite;
      if ($new_nbaction < 0 )
        die ("Pas assez d'actions...");

      // Recherche info du compte d'origine
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte1';";
      $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te de recherche du compte 1 (achattitre) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 1 (achattitre) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseA = $produit['devise'];
      $soldeA = $produit['solde'];

      // Recherche info du compte destinataire
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte2';";
      $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te de recherche du compte 2 (achattitre) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 2 (achattitre) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseB = $produit['devise'];
      $soldeB = $produit['solde'];

      $tarif_total_ht = $tarif * $nbunite;

      // Recherche info titre
      $sql = "SELECT nomentreprise FROM eco_entreprise WHERE identreprise = '$idtitre';";
      $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te de recherche entreprise idtitre (achattitre) !!!");
      $num = @mysqli_num_rows($res) or die("Erreur dans la requ�te de recherche entreprise idtitre (achattitre) !!!");
      $produit = mysqli_fetch_array($res);
      $nomtitre = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomentreprise']));

  $fct_mes_vente_libtype_prod = "Titres de " . $nomtitre;


      // Recherche info id 1
      $sql = "SELECT nomentreprise,idpays,iduser FROM eco_entreprise WHERE identreprise = '$entreA';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche entreprise 1 (achattitre) !!!");
      if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une entreprise
      {
          $sql = "SELECT nom,idpays,iduser FROM eco_user WHERE iduser = '$entreA';";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche user 1 (achattitre) !!!");
          if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une personne ...
          {
            $sql = "SELECT nompays,idpays,iduser FROM eco_pays WHERE idpays = '$entreA';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche pays 1 (achattitre) !!!");
            if (!($num = @mysqli_num_rows($res)))  // ce n'est pas un pays, pd !!
              die ("l'acheteur n'existe pas !!");

            $produit = mysqli_fetch_array($res);
            $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nompays']));
            $idpaysA = $produit['idpays'];
            $iduserA = $produit['iduser'];
          }
          else
          {
            $produit = mysqli_fetch_array($res);
            $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nom']));
            $idpaysA = $produit['idpays'];
            $iduserA = $produit['iduser'];
          }
      }
      else
      {
          $produit = mysqli_fetch_array($res);
          $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomentreprise']));
          $idpaysA = $produit['idpays'];
          $iduserA = $produit['iduser'];
      }

      // Recherche info id 2
      $sql = "SELECT nomentreprise,idpays,iduser FROM eco_entreprise WHERE identreprise = '$entreB';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche entreprise 2 (achattitre) !!!");
      if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une entreprise
      {
          $sql = "SELECT nom,idpays,iduser FROM eco_user WHERE iduser = '$entreB';";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche user 2 (achattitre) !!!");
          if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une personne ...
          {
            $sql = "SELECT nompays,idpays,iduser FROM eco_pays WHERE idpays = '$entreB';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche pays 2 (achattitre) !!!");
            if (!($num = @mysqli_num_rows($res)))  // ce n'est pas un pays, pd !!
              die ("le vendeur n'existe pas !!");

            $produit = mysqli_fetch_array($res);
            $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nompays']));
            $idpaysB = $produit['idpays'];
            $iduserB = $produit['iduser'];
          }
          else
          {
            $produit = mysqli_fetch_array($res);
            $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nom']));
            $idpaysB = $produit['idpays'];
            $iduserB = $produit['iduser'];
          }
      }
      else
      {
          $produit = mysqli_fetch_array($res);
          $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomentreprise']));
          $idpaysB = $produit['idpays'];
          $iduserB = $produit['iduser'];
      }

      $sql = "SELECT emaileco FROM eco_pays WHERE idpays = '$idpaysB';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche paysB (achattitre) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de paysB (achattitre) !!!");
      $produit = mysqli_fetch_array($res);

$fct_mes_vente_emaileco = $produit['emaileco'];

      $type_prod = '90000';			// 90000 : Titre

      // Recherche taxe
      $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '$type_prod';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achattitre) !!!");
      if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau produit
      {
        $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '00000';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achattitre) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taxe du tout !
        {
          $taxe = 0;
        }
        else
        {
          $produit = mysqli_fetch_array($res);
          $taxe = $produit['taxe'];
        }
      }
      else
      {
        $produit = mysqli_fetch_array($res);
        $taxe = $produit['taxe'];
      }

      if ($idpaysB != $idpaysA)
      {
        $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '$type_prod';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achattitre) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau produit
        {
          $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '00000';";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achattitre) !!!");
          if (!($num = @mysqli_num_rows($res)))  // pas de taxe du tout !
          {
            $taxe = $taxe;
          }
          else
          {
            $produit = mysqli_fetch_array($res);
            $taxe = $produit['taxe'] + $taxe;
          }
        }
        else
        {
          $produit = mysqli_fetch_array($res);
          $taxe = $produit['taxe'] + $taxe;
        }
      }
      $tarif_total_ht = $tarif * $nbunite;

      if ($taxe > 0)
        $tarif_total_ttc = $tarif_total_ht * ($taxe + 1);
      else
        $tarif_total_ttc = $tarif_total_ht;

      $newsoldeA = $soldeA - $tarif_total_ttc;
      if ($newsoldeA < 0)
        die ("Solde acheteur insuffisant...");

      if ($taxe > 0)
      {
          $tarif_total_taxe = $tarif_total_ht * $taxe ;
      }
      else
        $tarif_total_taxe = 0;

      // Recherche compte taxe et banque 1 si devise
      $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseA' AND idpays1 = '$idpaysA';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche compte taxe (achattitre) !!!");
      if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
        die("Pas de compte associé à la taxe... contactez votre responsable (achattitre)");

      $produit = mysqli_fetch_array($res);
      $taxe_cpte_cred = $produit['idcompte'];

      // V�rification de la devise du compte
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$taxe_cpte_cred';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche devise compte taxe (achattitre) !!!");
      if (!($num = @mysqli_num_rows($res)))  // pas compte taxe...
        die("Le compte associé à la Taxe n'existe pas... contactez votre responsable (achattitre)");

      $produit = mysqli_fetch_array($res);
      if ($deviseA != $produit['devise'])  // mauvaise devise compte taxe...
        die("La devise du compte associé à la Taxe n'est pas bonne... contactez votre responsable (achattitre)");

      $newsolde_cpte_taxe = $produit['solde'] + $tarif_total_taxe;

      // Recherche compte taux de change
      if ($deviseA != $deviseB)
      {
        $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseB' AND idpays1 = '$idpaysA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (achattitre) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de compte associé au Taux de change... contactez votre responsable (achattitre)");

        $produit = mysqli_fetch_array($res);
        $taux_cpte_deb = $produit['idcompte'];

        // V�rification de la devise et du solde du compte
        $sql = "SELECT solde,devise FROM eco_banque WHERE idcompte = '$taux_cpte_deb';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche devise compte taux (achattitre) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas compte taux de change...
          die("Le compte associé au Taux de change n'existe pas... contactez votre responsable");

        $produit = mysqli_fetch_array($res);
        if ($deviseB != $produit['devise'])  // mauvaise devise compte taux de change...
          die("La devise du compte associé au Taux de change n'est pas bonne... contactez votre responsable");

        $solde_cpte_taux = $produit['solde'];

        // Recherche taux de change
        $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (achattitre) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de Taux de change...");

        $produit = mysqli_fetch_array($res);
        $taux = $produit['taux'];

        $tarif_taux = $tarif_total_ht * $taux;

        if ($tarif_taux > $solde_cpte_taux)  // solde compte taux de change insuffisant...
          die("Le solde du compte associé au Taux de change est insuffisant... contactez votre responsable");

        $newsolde_cpte_taux = $solde_cpte_taux - $tarif_taux;

        // taux de change donc banque taxe = banque 1
        $newsolde_cpte_taxe = $newsolde_cpte_taxe + $tarif_total_ht;
      }
      else
        $tarif_taux = $tarif_total_ht;

      $newsoldeB = $soldeB + $tarif_taux;


      // Fin contr�les
      //--------------


      $libelletransaction = "Achat de " . $nbunite . " Titres de " . $nomtitre . " par " . $nomA;
      $libelletransaction .= " à " . $nomB;

      $libelletransactiontaxe = "Taxe : " . $libelletransaction;


      // => Titres
      //----------

      // Maj Stock vendeur
      $sql = "UPDATE eco_bourse SET nbaction = '$new_nbaction', datederniereope = NOW() WHERE identreprise = '$idtitre' AND idactionnaire = '$entreB';";
      $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (achattitre)");

      // Maj ou cr�ation Stock acheteur
      $sql = "SELECT nbaction FROM eco_bourse WHERE identreprise = '$idtitre' AND idactionnaire = '$entreA';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche de la quantit� (achattitre) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_bourse (identreprise,idactionnaire,nbaction,datederniereope) VALUES ('$idtitre','$entreA','$nbunite',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete d'insertion d'une nouvelle quantit� (achattitre) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_nbaction = $produit['nbaction'] + $nbunite;
        $sql = "UPDATE eco_bourse SET nbaction = '$new_nbaction', datederniereope = NOW() WHERE identreprise = '$idtitre' AND idactionnaire = '$entreA';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (achattitre)");
      }


      // => Transactions
      //----------------

      // Taxe :(
      if ($tarif_total_taxe > 0)
      {
        // Transaction d�bitrice
        $tarif_total_taxe_neg = $tarif_total_taxe * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taxe_cpte_cred','$tarif_total_taxe_neg','$deviseA','$libelletransactiontaxe',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d�bitrice taxe (achattitre) !!!");

        // Transaction cr�ditrice
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$idcpte1','$tarif_total_taxe','$deviseA','$libelletransactiontaxe',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice taxe (achattitre) !!!");
      }

      // Maj solde Taxe et Banque 1 si taux de change
      $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taxe' WHERE idcompte = '$taxe_cpte_cred';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te maj compte taxe (achattitre) !!!");

      // Comptes utilisateurs :) et �ventuellement Taux de change

      if ($deviseA == $deviseB)   // Pas de taux
      {
        // Transaction d�bitrice
        $tarif_total_ht_neg = $tarif_total_ht * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$idcpte2','$tarif_total_ht_neg','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d�bitrice (achattitre) !!!");

        // Transaction cr�ditrice
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$idcpte1','$tarif_taux','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice (achattitre) !!!");

        // M�j solde d�bit�
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde Acheteur. (achattitre)");

        // M�j solde cr�dit�
        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde Vendeur. (achattitre)");
      }
      else
      {
        // Transactions : Acheteur -> Banque 1 - Banque 2 -> Vendeur

        // Acheteur -> Banque 1 : mvts (Banque 1 =aussi Banque Taxe)
        $tarif_total_ht_neg = $tarif_total_ht * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taxe_cpte_cred','$tarif_total_ht_neg','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d�bitrice Acheteur (achattitre) !!!");

        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$idcpte1','$tarif_total_ht','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice Banque nationale (achattitre) !!!");

        // Acheteur -> Banque 1 : solde Acheteur
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde solde Acheteur.");

        // Acheteur -> Banque 1 : solde Banque 1 d�j� fait avec Taxe


        // Banque 2 -> Vendeur : mvts
        $tarif_taux_neg = $tarif_taux * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$taux_cpte_deb','$tarif_taux','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice Vendeur (achattitre) !!!");

        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taux_cpte_deb','$idcpte2','$tarif_taux_neg','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d�bitrice Banque 2 (achattitre) !!!");

        // M�j solde cr�dit�
        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde Vendeur. (achattitre)");

        // M�j solde d�bit�
        $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taux' WHERE idcompte = '$taux_cpte_deb';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde Banque 2. (achattitre)");
      }

      // Maj Message
      $sql = "UPDATE eco_message SET reponse = '$reponse' WHERE idmsg = '$idmsg';";
      $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le message. (achattitre)");

  // Envoi du message
  include("../include/fct_mes_vente.php");

  }
  else
  {
    // Maj Message
    $sql = "UPDATE eco_message SET reponse = '$reponse' WHERE idmsg = '$idmsg';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le message. (achattitre)");
  }


  echo "<script language=\"JavaScript\"> document.location.replace(\"../messagerie.php\");</script>";

?>

</body>
</html>
