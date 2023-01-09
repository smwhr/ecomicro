<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Action Achat de produit </title>
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

  if (($objet == "VENTE_PRODUIT") && ($reponse == "A"))
  {
    //  $datatransaction = $idcpte1 . "|" . $idcpte2 . "|" . $entreA . "|" . $entreB . "|" . $nbprod . "|" . $idprod . "|" . $nbunite . "|" . $idunite . "|" . $tarif;
    //  $datatransaction .= $province . "|" . $regroupement . "|" . $type . "|" . $adresse;
    //   100001|100002|1|2|1|1|8|80006|10

    $tab_data = explode("|",$data);

        $idcpte1 = $tab_data[0];
        $idcpte2 = $tab_data[1];
        $entreA = $tab_data[2];
        $entreB = $tab_data[3];
        $nbprod = $tab_data[4];
        $idprod = $tab_data[5];
        $nbunite = $tab_data[6];
        $idunite = $tab_data[7];
        $tarif = $tab_data[8];

        $province = $tab_data[9];
        $regroupement = $tab_data[10];
        $type = $tab_data[11];
        $adresse = $tab_data[12];

      // D�but contr�les
      //----------------

      // Recherche du stock initial vendeur
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$entreB' AND idunite = '$idunite';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (achatproduit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de stock (achatproduit) !!!");
      $produit = mysqli_fetch_array($res);

      $new_quantite = $produit['quantite'] - ($nbunite * $nbprod);
      if ($new_quantite < 0 )
        die ("Pas assez de stock...");

      // Recherche info du compte d'origine
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte1';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche du compte 1 (achatproduit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 1 (achatproduit) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseA = $produit['devise'];
      $soldeA = $produit['solde'];

      // Recherche info du compte destinataire
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte2';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche du compte 2 (achatproduit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 2 (achatproduit) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseB = $produit['devise'];
      $soldeB = $produit['solde'];

      $tarif_total_ht = $tarif * $nbprod;

      // Recherche info id 1
      $sql = "SELECT nomentreprise,idpays,iduser FROM eco_entreprise WHERE identreprise = '$entreA';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche entreprise 1 (achatproduit) !!!");
      if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une entreprise
      {
          $sql = "SELECT nom,idpays,iduser FROM eco_user WHERE iduser = '$entreA';";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche user 1 (achatproduit) !!!");
          if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une personne ...
          {
            $sql = "SELECT nompays,idpays,iduser FROM eco_pays WHERE idpays = '$entreA';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche pays 1 (achatproduit) !!!");
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
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche entreprise 2 (achatproduit) !!!");
      if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une entreprise
      {
          $sql = "SELECT nom,idpays,iduser FROM eco_user WHERE iduser = '$entreB';";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche user 2 (achatproduit) !!!");
          if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une personne ...
          {
            $sql = "SELECT nompays,idpays,iduser FROM eco_pays WHERE idpays = '$entreB';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche pays 2 (achatproduit) !!!");
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

      // Recherche info produit
      $sql = "SELECT nomproduit,typeproduit,image,description FROM eco_production WHERE idproduit = '$idprod';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche typeproduit (achatproduit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de typeproduit (achatproduit) !!!");
      $produit = mysqli_fetch_array($res);

      $type_prod = $produit['typeproduit'];
      $prod_libelle = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomproduit']));
      $image = $produit['image'];
      $description = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['description']));

$fct_mes_vente_libtype_prod = $prod_libelle;


      $sql = "SELECT emaileco FROM eco_pays WHERE idpays = '$idpaysB';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche paysB (achatproduit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de paysB (achatproduit) !!!");
      $produit = mysqli_fetch_array($res);

$fct_mes_vente_emaileco = $produit['emaileco'];


      // Recherche info type produit
      $sql = "SELECT libelle,typeequi FROM eco_typeproduit WHERE typeproduit = '$type_prod';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche typeproduit (achatproduit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de typeproduit (achatproduit) !!!");
      $produit = mysqli_fetch_array($res);

      $type_prodequi = $produit['typeequi'];
      $type_prod_libelle = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['libelle']));

      if ($type_prodequi == '20000')
      {
        // info compl�mentaire
        $sql = "SELECT province,adresse FROM eco_immo_tmp WHERE idproduit = '$idprod';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche immo_tmp (achatproduit) !!!");
        $num = @mysqli_num_rows($res) or die("<br> Pas de immo_tmp (achatproduit) !!!");
        $produit = mysqli_fetch_array($res);

        $province = $produit['province'];
        $adresse = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['adresse']));
      }


      // Recherche info type mati�re
      $sql = "SELECT libelle FROM eco_typeproduit WHERE typeproduit = '$idunite';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche typeproduit (achatproduit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de typeproduit (achatproduit) !!!");
      $produit = mysqli_fetch_array($res);

      $type_unite_libelle = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['libelle']));


      // Recherche taxe
      $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '$type_prod';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achatproduit) !!!");
      if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau produit
      {
        $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '$type_prodequi';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achatproduit) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau equivalent produit
        {
            $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '00000';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achatproduit) !!!");
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
      }
      else
      {
        $produit = mysqli_fetch_array($res);
        $taxe = $produit['taxe'];
      }

      if ($idpaysB != $idpaysA)
      {
        $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '$type_prod';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achatproduit) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau produit
        {
          $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '$type_prodequi';";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achatproduit) !!!");
          if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau equivalent produit
          {
              $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '00000';";
              $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche taxe (achatproduit) !!!");
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
        else
        {
          $produit = mysqli_fetch_array($res);
          $taxe = $produit['taxe'] + $taxe;
        }
      }
      $tarif_total_ht = $tarif * $nbprod;

      if ($taxe > 0)
        $tarif_total_ttc = $tarif_total_ht * ($taxe + 1);
      else
        $tarif_total_ttc = $tarif_total_ht;

      $newsoldeA = $soldeA - $tarif_total_ttc;
      if ($newsoldeA < 0)
        die ("Solde acheteur insuffisant...");

      if ($taxe > 0)
        $tarif_total_taxe = $tarif_total_ht * $taxe;
      else
        $tarif_total_taxe = 0;


      // Recherche compte taxe et banque 1 si devise
      $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseA' AND idpays1 = '$idpaysA';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche compte taxe (achatproduit) !!!");
      if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
        die("Pas de compte associé à la taxe... contactez votre responsable");

      $produit = mysqli_fetch_array($res);
      $taxe_cpte_cred = $produit['idcompte'];

      // V�rification de la devise du compte
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$taxe_cpte_cred';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche devise compte taxe (achatproduit) !!!");
      if (!($num = @mysqli_num_rows($res)))  // pas compte taxe...
        die("Le compte associé à la Taxe n'existe pas... contactez votre responsable");

      $produit = mysqli_fetch_array($res);
      if ($deviseA != $produit['devise'])  // mauvaise devise compte taxe...
        die("La devise du compte associé à la Taxe n'est pas bonne... contactez votre responsable");

      $newsolde_cpte_taxe = $produit['solde'] + $tarif_total_taxe;


      // Recherche compte taux de change
      if ($deviseA != $deviseB)
      {
        $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseB' AND idpays1 = '$idpaysA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche compte taux (achatproduit) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de compte associé au Taux de change... contactez votre responsable");

        $produit = mysqli_fetch_array($res);
        $taux_cpte_deb = $produit['idcompte'];

        // V�rification de la devise et du solde du compte
        $sql = "SELECT solde,devise FROM eco_banque WHERE idcompte = '$taux_cpte_deb';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche devise compte taux (achatproduit) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas compte taux de change...
          die("Le compte associé au Taux de change n'existe pas... contactez votre responsable");

        $produit = mysqli_fetch_array($res);
        if ($deviseB != $produit['devise'])  // mauvaise devise compte taux de change...
          die("La devise du compte associé au Taux de change n'est pas bonne... contactez votre responsable");

        $solde_cpte_taux = $produit['solde'];

        // Recherche compte taux de change
        $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche compte taux (achatproduit) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de Taux de change... contactez votre responsable");

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


      // Immobilier
      if (($type_prodequi == '20000') && ($nbprod > 1))
          die("Un seul produit immobilier par vente.");



      // Fin contr�les
      //--------------


      $libelletransaction = "Achat par " . $nomA . " de " . $nbprod . " " . $prod_libelle . " ( " . $nbunite . " " . $type_unite_libelle . " ) ";
      $libelletransaction .= " à " . $nomB;
      $libelletransaction .= " (" . $province . ", " . $type . ", " . $adresse . ")";

      $libelletransactiontaxe = "Taxe : " . $libelletransaction;


      // => Stock / Possession
      //----------------------

      // Maj Stock vendeur
      $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$entreB' AND idunite = '$idunite';";
      $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (achatproduit)");

      // Ajout possession acheteur
      for ($i=0;$i<$nbprod;$i++)
      {
        $sql = "INSERT INTO eco_possession (idpossession,idpossesseur,idproduit,datehachat,nomproduit,typeproduit,image,description,nbunite,idunite,datehmaj,prixachat,devise) VALUES (NULL,'$entreA','$idprod',NOW(),'$prod_libelle','$type_prod','$image','$description','$nbunite','$idunite',NOW(),'$tarif','$deviseA');";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete d'insertion d'une nouvelle possession (achatproduit) !!!");
        $idpossession = mysql_insert_id();
      }


      // => Transactions
      //----------------

      // Taxe :(
      if ($tarif_total_taxe > 0)
      {
        // Transaction d�bitrice
        $tarif_total_taxe_neg = $tarif_total_taxe * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taxe_cpte_cred','$tarif_total_taxe_neg','$deviseA','$libelletransactiontaxe',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete débitrice taxe (achatproduit) !!!");

        // Transaction cr�ditrice
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$idcpte1','$tarif_total_taxe','$deviseA','$libelletransactiontaxe',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice taxe (achatproduit) !!!");
      }

      // Maj solde Taxe et Banque 1 si taux de change
      $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taxe' WHERE idcompte = '$taxe_cpte_cred';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te maj compte taxe (achatproduit) !!!");


      // Comptes utilisateurs :) et �ventuellement Taux de change

      if ($deviseA == $deviseB)   // Pas de taux de change
      {
        // Transaction d�bitrice
        $tarif_total_ht_neg = $tarif_total_ht * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$idcpte2','$tarif_total_ht_neg','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te d�bitrice (achatproduit) !!!");

        // Transaction cr�ditrice
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$idcpte1','$tarif_taux','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te cr�ditrice (achatproduit) !!!");

        // M�j solde d�bit�
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde Acheteur. (achatproduit)");

        // M�j solde cr�dit�
        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde Vendeur. (achatproduit)");
      }
      else
      {
        // Transactions : Acheteur -> Banque 1 - Banque 2 -> Vendeur (Banque 1 =aussi Banque Taxe)

        // Acheteur -> Banque 1 : mvts
        $tarif_total_ht_neg = $tarif_total_ht * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taxe_cpte_cred','$tarif_total_ht_neg','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d�bitrice Acheteur (achatproduit) !!!");

        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$idcpte1','$tarif_total_ht','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice Banque nationale (achatproduit) !!!");

        // Acheteur -> Banque 1 : solde Acheteur
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le solde solde Acheteur.");

        // Acheteur -> Banque 1 : solde Banque 1 d�j� fait avec Taxe


        // Banque 2 -> Vendeur : mvts
        $tarif_taux_neg = $tarif_taux * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$taux_cpte_deb','$tarif_taux','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te cr�ditrice Vendeur (achatproduit) !!!");

        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taux_cpte_deb','$idcpte2','$tarif_taux_neg','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete débitrice Banque 2 (achatproduit) !!!");

        // M�j solde cr�dit� vendeur
        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Vendeur. (achatproduit)");

        // M�j solde d�bit� banque taux
        $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taux' WHERE idcompte = '$taux_cpte_deb';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Banque 2. (achatproduit)");
      }

      // Maj Message
      $sql = "UPDATE eco_message SET reponse = '$reponse' WHERE idmsg = '$idmsg';";
      $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le message. (achatproduit)");


        // Immobilier
        if ($type_prodequi == '20000')
        {
                $sql = "INSERT INTO eco_immo (idpossession,idproprio,occupe,idlocataire,prix,devise,prime,datemaj,province,adresse_immo) VALUES ('$idpossession','$entreA',0,0,0,' ',0,NOW(),'$province','$adresse');";
                $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete immo (achatproduit) !!!");
        }

  // Envoi du message
  include("../include/fct_mes_vente.php");

  }
  else
  {
    // Maj Message
    $sql = "UPDATE eco_message SET reponse = '$reponse' WHERE idmsg = '$idmsg';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le message. (achatproduit)");
  }



  echo "<script language=\"JavaScript\"> document.location.replace(\"../messagerie.php\");</script>";

?>

</body>
</html>
