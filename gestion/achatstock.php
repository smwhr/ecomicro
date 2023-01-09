<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
<title> Action Achat de stock </title>
<head>
<body>

<?php

  include("../include/config.php");

  $idmsg = addslashes(trim($_POST['idmsg']));
  $reponse = addslashes(trim($_POST['reponse1']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données A -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données B -- ");

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

  if (($objet == "VENTE_STOCK") && ($reponse == "A")){
    //  $datatransaction = $idcpte1 . "|" . $idcpte2 . "|" . $entreA . "|" . $entreB . "|" . $nbunite . "|" . $idunite . "|" . $tarif;
    //   100001|100005|1|5|20|80005|10

    $tab_data = explode("|",$data);

        $idcpte1 = $tab_data[0];
        $idcpte2 = $tab_data[1];
        $entreA = $tab_data[2];
        $entreB = $tab_data[3];
        $nbunite = $tab_data[4];
        $idunite = $tab_data[5];
        $tarif = $tab_data[6];

      // Début contrôles
      //----------------

      // Recherche du stock initial vendeur
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$entreB' AND idunite = '$idunite';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche de la quantité (achatstock) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de stock (achatstock) !!!");
      $produit = mysqli_fetch_array($res);

      $new_quantite = $produit['quantite'] - $nbunite;
      if ($new_quantite < 0 )
        die ("Pas assez de stock...");

      // Recherche info du compte d'origine (acheteur)
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte1';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche du compte 1 (achatstock) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 1 (achatstock) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseA = $produit['devise'];
      $soldeA = $produit['solde'];

      // Recherche info du compte destinataire (vendeur)
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte2';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche du compte 2 (achatstock) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 2 (achatstock) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseB = $produit['devise'];
      $soldeB = $produit['solde'];

      $tarif_total_ht = $tarif * $nbunite;

      // Recherche info id 1
      $sql = "SELECT eco_entreprise.nomentreprise,eco_entreprise.idpays,eco_entreprise.iduser,eco_pays.devise FROM eco_entreprise, eco_pays WHERE eco_entreprise.identreprise = '$entreA' AND eco_entreprise.idpays = eco_pays.idpays;";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche entreprise 1 (achatstock) !!!");
      if (!($num = @mysqli_num_rows($res))) { // ce n'est pas une entreprise
          $sql = "SELECT eco_user.nom,eco_user.idpays,eco_user.iduser,eco_pays.devise FROM eco_user, eco_pays WHERE eco_user.iduser = '$entreA' AND eco_user.idpays = eco_pays.idpays;";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche user 1 (achatstock) !!!");
          if (!($num = @mysqli_num_rows($res))) { // ce n'est pas une personne ...
            $sql = "SELECT nompays,idpays,iduser,devise FROM eco_pays WHERE idpays = '$entreA';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche pays 1 (achatstock) !!!");
            if (!($num = @mysqli_num_rows($res)))  // ce n'est pas un pays, pd !!
              die ("l'acheteur n'existe pas !!");

            $produit = mysqli_fetch_array($res);
            $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nompays']));
            $idpaysA = $produit['idpays'];
            $iduserA = $produit['iduser'];
            $deviseAA = $produit['devise'];						// devise du pays de l'acheteur
          }
          else{
            $produit = mysqli_fetch_array($res);
            $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nom']));
            $idpaysA = $produit['idpays'];
            $iduserA = $produit['iduser'];
            $deviseAA = $produit['devise'];
          }
      }
      else{
          $produit = mysqli_fetch_array($res);
          $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomentreprise']));
          $idpaysA = $produit['idpays'];
          $iduserA = $produit['iduser'];
          $deviseAA = $produit['devise'];
      }

      // Recherche info id 2
      $sql = "SELECT eco_entreprise.nomentreprise,eco_entreprise.idpays,eco_entreprise.iduser,eco_pays.devise FROM eco_entreprise, eco_pays WHERE eco_entreprise.identreprise = '$entreB' AND eco_entreprise.idpays = eco_pays.idpays;";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche entreprise 2 (achatstock) !!!");
      if (!($num = @mysqli_num_rows($res))) { // ce n'est pas une entreprise
          $sql = "SELECT eco_user.nom,eco_user.idpays,eco_user.iduser,eco_pays.devise FROM eco_user,eco_pays WHERE eco_user.iduser = '$entreB' AND eco_user.idpays = eco_pays.idpays;";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche user 2 (achatstock) !!!");
          if (!($num = @mysqli_num_rows($res))) { // ce n'est pas une personne ...
            $sql = "SELECT nompays,idpays,iduser,devise FROM eco_pays WHERE idpays = '$entreB';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche pays 2 (achatstock) !!!");
            if (!($num = @mysqli_num_rows($res)))  // ce n'est pas un pays, pb !!
              die ("le vendeur n'existe pas !!");

            $produit = mysqli_fetch_array($res);
            $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nompays']));
            $idpaysB = $produit['idpays'];
            $iduserB = $produit['iduser'];
            $deviseBB = $produit['devise'];						// devise du pays du vendeur
          }
          else{
            $produit = mysqli_fetch_array($res);
            $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nom']));
            $idpaysB = $produit['idpays'];
            $iduserB = $produit['iduser'];
            $deviseBB = $produit['devise'];
          }
      }
      else{
          $produit = mysqli_fetch_array($res);
          $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomentreprise']));
          $idpaysB = $produit['idpays'];
          $iduserB = $produit['iduser'];
          $deviseBB = $produit['devise'];
      }

      // Recherche info type mati�re
      $sql = "SELECT libelle,typeequi FROM eco_typeproduit WHERE typeproduit = '$idunite';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche typeproduit (achatstock) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de typeproduit (achatstock) !!!");
      $produit = mysqli_fetch_array($res);

      $type_prodequi = $produit['typeequi'];
      $type_prod_libelle = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['libelle']));

$fct_mes_vente_libtype_prod = $type_prod_libelle;

      $sql = "SELECT emaileco FROM eco_pays WHERE idpays = '$idpaysB';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche paysB (achatproduit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de paysB (achatproduit) !!!");
      $produit = mysqli_fetch_array($res);

$fct_mes_vente_emaileco = $produit['emaileco'];

      $type_prod = $idunite;

      // Recherche taxe
      $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '$type_prod';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche taxe (achatstock) !!!");
      if (!($num = @mysqli_num_rows($res))) { // pas de taxe au niveau produit
        $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '$type_prodequi';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche taxe (achatstock) !!!");
        if (!($num = @mysqli_num_rows($res))) { // pas de taxe au niveau equivalent produit
          $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '80000';";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche taxe (achatstock) !!!");
          if (!($num = @mysqli_num_rows($res))) { // pas de taxe au niveau famille produit
            $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '00000';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche taxe (achatstock) !!!");
            if (!($num = @mysqli_num_rows($res))) { // pas de taxe du tout !
              $taxe = 0;
            }
            else{
              $produit = mysqli_fetch_array($res);
              $taxe = $produit['taxe'];
            }
          }
          else{
            $produit = mysqli_fetch_array($res);
            $taxe = $produit['taxe'];
          }
        }
        else{
          $produit = mysqli_fetch_array($res);
          $taxe = $produit['taxe'];
        }
      }
      else{
        $produit = mysqli_fetch_array($res);
        $taxe = $produit['taxe'];
      }

      if ($idpaysB != $idpaysA){
        $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '$type_prod';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche taxe (achatstock) !!!");
        if (!($num = @mysqli_num_rows($res))) { // pas de taxe au niveau produit
          $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '$type_prodequi';";
          $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche taxe (achatstock) !!!");
          if (!($num = @mysqli_num_rows($res))) { // pas de taxe au niveau equivalent produit
            $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '80000';";
            $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche taxe (achatstock) !!!");
            if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau famille produit
            {
              $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '00000';";
              $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche taxe (achatstock) !!!");
              if (!($num = @mysqli_num_rows($res))) { // pas de taxe du tout !
                $taxe = $taxe;
              }
              else{
                $produit = mysqli_fetch_array($res);
                $taxe = $produit['taxe'] + $taxe;
              }
            }
            else{
              $produit = mysqli_fetch_array($res);
              $taxe = $produit['taxe'] + $taxe;
            }
          }
          else{
            $produit = mysqli_fetch_array($res);
            $taxe = $produit['taxe'] + $taxe;
          }
        }
        else{
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

      if ($taxe > 0){
          $tarif_total_taxe = $tarif_total_ht * $taxe ;
      }
      else
        $tarif_total_taxe = 0;

      // Recherche compte taxe et banque 1 si devise
      $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseA' AND idpays1 = '$idpaysA';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche compte taxe (achatstock) !!!");
      if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
        die("Pas de compte associé à la taxe... contactez votre responsable (achatstock)");

      $produit = mysqli_fetch_array($res);
      $taxe_cpte_cred = $produit['idcompte'];

      // V�rification de la devise du compte
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$taxe_cpte_cred';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche devise compte taxe (achatstock) !!!");
      if (!($num = @mysqli_num_rows($res)))  // pas compte taxe...
        die("Le compte associé à la Taxe n'existe pas... contactez votre responsable (achatstock)");

      $produit = mysqli_fetch_array($res);
      if ($deviseA != $produit['devise'])  // mauvaise devise compte taxe...
        die("La devise du compte associé à la Taxe n'est pas bonne... contactez votre responsable (achatstock)");

      $newsolde_cpte_taxe = $produit['solde'] + $tarif_total_taxe;

      // Recherche compte taux de change
      if ($deviseA != $deviseB){
        $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseB' AND idpays1 = '$idpaysA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (achatstock) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de compte associé au Taux de change... contactez votre responsable (achatstock)");

        $produit = mysqli_fetch_array($res);
        $taux_cpte_deb = $produit['idcompte'];

        // V�rification de la devise et du solde du compte
        $sql = "SELECT solde,devise FROM eco_banque WHERE idcompte = '$taux_cpte_deb';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche devise compte taux (achatstock) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas compte taux de change...
          die("Le compte associé au Taux de change n'existe pas... contactez votre responsable");

        $produit = mysqli_fetch_array($res);
        if ($deviseB != $produit['devise'])  // mauvaise devise compte taux de change...
          die("La devise du compte associé au Taux de change n'est pas bonne... contactez votre responsable");

        $solde_cpte_taux = $produit['solde'];

        // Recherche taux de change
        $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (achatstock) !!!");
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


      $libelletransaction = "Achat par " . $nomA . " de " . $nbunite . " " . $type_prod_libelle;
      $libelletransaction .= " à " . $nomB;

      $libelletransactiontaxe = "Taxe : " . $libelletransaction;


      // => Stock
      //---------

      // Maj Stock vendeur
			// 1- l'histo de vente
		  $tt=time();
		  $mois=date("m",$tt);
		
		  $sql = "SELECT nb,cout,datemaj FROM eco_histo WHERE identreprise = '$entreB' AND mois = '$mois' AND idunite = '$idunite' AND action = '1';";
		  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche de histo (produire) !!!");
		  $num = @mysqli_num_rows($res);
		
		  if ($num > 0){
		      $produit = mysqli_fetch_array($res);
		
		      $nb = $produit['nb'];
		      $cout = $produit['cout'];
		      $date = $produit['datemaj'];
		      if (substr($date,2,2) != date("y",$tt)){
		      	$nb = 0;
		        $cout = 0;
		      }
		  }
		  else{
		      $sql = "INSERT INTO eco_histo (idhisto,identreprise,mois,idunite,action,nb,cout,devise,qualite,datemaj) VALUES (NULL,'$entreB','$mois','$idunite','1','0','0','$deviseBB','0',NOW())";
		      $res = mysqli_query($conn, $sql) or die("Erreur dans la requête ins1 histo (produire) !!!");
		
		      $nb = 0;
		      $cout = 0;
		  }

        // Recherche taux de change
        $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseBB' AND devise2 = '$deviseA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche compte taux (achatstock) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de Taux de change...");

        $produit = mysqli_fetch_array($res);
        $taux = $produit['taux'];

      $new_prixvente = (($tarif_total_ht * $taux) + ($cout * $nb)) / ($nb + $nbunite);
      $new_nb = $nb + $nbunite;
      
      $sql = "UPDATE eco_histo SET nb = '$new_nb', cout = '$new_prixvente', datemaj = NOW() WHERE identreprise = '$entreB' AND mois = '$mois' AND idunite = '$idunite' AND action = '1';";
		  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de maj de histo (produire) !!!");

			// 2- le stock
			if ($new_quantite == '0')
	      $sql = "UPDATE eco_stock SET quantite = '$new_quantite', prixrevient = '0', datemaj = NOW() WHERE identreprise = '$entreB' AND idunite = '$idunite';";
			else
	      $sql = "UPDATE eco_stock SET quantite = '$new_quantite', datemaj = NOW() WHERE identreprise = '$entreB' AND idunite = '$idunite';";
      $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (achatstock)");


      // Maj ou création Stock acheteur

        // Recherche taux de change
        $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseAA' AND devise2 = '$deviseA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche compte taux (achatstock) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de Taux de change...");

        $produit = mysqli_fetch_array($res);
        $taux = $produit['taux'];

      $sql = "SELECT quantite,prixrevient FROM eco_stock WHERE identreprise = '$entreA' AND idunite = '$idunite';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche de la quantité (achatstock) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $tarif_unitaire_ttc = ($tarif_total_ttc * $taux) / $nbunite;
        
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite,prixrevient,devise,datemaj) VALUES ('$idunite','$entreA','$nbunite','$tarif_unitaire_ttc','$deviseAA',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête d'insertion d'une nouvelle quantité (achatstock) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $px_quantite = $produit['quantite'];
        $quantite = $px_quantite;
        $px_prixrevient = $produit['prixrevient'];

        $new_quantite = $quantite + $nbunite;

				$new_prixrevient = (($tarif_total_ttc * $taux) + ($px_prixrevient * $px_quantite)) / ($px_quantite + $nbunite);

        $sql = "UPDATE eco_stock SET quantite = '$new_quantite', prixrevient = '$new_prixrevient', datemaj = NOW() WHERE identreprise = '$entreA' AND idunite = '$idunite';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (achatstock)");
      }


      // => Transactions
      //----------------

      // Taxe :(
      if ($tarif_total_taxe > 0)
      {
        // Transaction débitrice
        $tarif_total_taxe_neg = $tarif_total_taxe * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taxe_cpte_cred','$tarif_total_taxe_neg','$deviseA','$libelletransactiontaxe',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete débitrice taxe (achatproduit) !!!");

        // Transaction créditrice
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$idcpte1','$tarif_total_taxe','$deviseA','$libelletransactiontaxe',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete créditrice taxe (achatproduit) !!!");
      }

      // Maj solde Taxe et Banque 1 si taux de change
      $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taxe' WHERE idcompte = '$taxe_cpte_cred';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete maj compte taxe (achatproduit) !!!");


      // Comptes utilisateurs :) et éventuellement Taux de change

      if ($deviseA == $deviseB)   // Pas de taux
      {
        // Transaction débitrice
        $tarif_total_ht_neg = $tarif_total_ht * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$idcpte2','$tarif_total_ht_neg','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête débitrice (achatstock) !!!");

        // Transaction créditrice
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$idcpte1','$tarif_taux','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête créditrice (achatstock) !!!");

        // Màj solde débité
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Acheteur. (achatstock)");

        // Màj solde crédité
        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Vendeur. (achatstock)");
      }
      else
      {
        // Transactions : Acheteur -> Banque 1 - Banque 2 -> Vendeur

        // Acheteur -> Banque 1 : mvts (Banque 1 =aussi Banque Taxe)
        $tarif_total_ht_neg = $tarif_total_ht * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taxe_cpte_cred','$tarif_total_ht_neg','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête débitrice Acheteur (achatstock) !!!");

        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$idcpte1','$tarif_total_ht','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête créditrice Banque nationale (achatstock) !!!");

        // Acheteur -> Banque 1 : solde Acheteur
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde solde Acheteur.");

        // Acheteur -> Banque 1 : solde Banque 1 déjà fait avec Taxe


        // Banque 2 -> Vendeur : mvts
        $tarif_taux_neg = $tarif_taux * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$taux_cpte_deb','$tarif_taux','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête créditrice Vendeur (achatstock) !!!");

        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taux_cpte_deb','$idcpte2','$tarif_taux_neg','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête débitrice Banque 2 (achatstock) !!!");

        // Màj solde crédité
        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Vendeur. (achatstock)");

        // Màj solde débité
        $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taux' WHERE idcompte = '$taux_cpte_deb';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Banque 2. (achatstock)");
      }

      // Maj Message
      $sql = "UPDATE eco_message SET reponse = '$reponse' WHERE idmsg = '$idmsg';";
      $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le message. (achatstock)");

  // Envoi du message
  include("../include/fct_mes_vente.php");

  }
  else{
    // Maj Message
    $sql = "UPDATE eco_message SET reponse = '$reponse' WHERE idmsg = '$idmsg';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le message. (achatstock)");
  }


  echo "<script language=\"JavaScript\"> document.location.replace(\"../messagerie.php\");</script>";

?>

</body>
</html>
