<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Action Transaction Administrateur </title>
<head>
<body>

<?php

  include("../include/config.php");


  $montant = trim($_POST['montant']);
  $com = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['com']))));
  $idcpte1 = trim($_POST['idcpte1']);
  $idpaysA = trim($_POST['idpaysA']);
  $idcpte2 = trim($_POST['idcpte2']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> PB de vérification1, !!!");
	  
	  if ($idpaysA != $paysjoueur)
	  	die("<br> PB de vérification2, !!!");
	}

  if (isset($_POST['desuite']))
  {
      // D�but contr�les
      //----------------

      // Recherche info du compte d'origine
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte1';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du compte 1 (achatstock) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 1 (transaction) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseA = $produit['devise'];
      $soldeA = $produit['solde'];

      // Recherche info du compte destinataire
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte2';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du compte 2 (achatstock) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 2 (transaction) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseB = $produit['devise'];
      $soldeB = $produit['solde'];


      $newsoldeA = $soldeA - $montant;
      if ($newsoldeA < 0)
        die ("Solde acheteur insuffisant...");


      // Recherche comptes et taux de change
      if ($deviseA != $deviseB)
      {
        // Recherche compte taux de change devise A
        $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseA' AND idpays1 = '$idpaysA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (transaction) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de compte associé au Taux de change... contactez votre responsable (transaction)");

        $produit = mysqli_fetch_array($res);
        $taux_cpte_cre = $produit['idcompte'];

        // Recherche compte taux de change devise B
        $sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseB' AND idpays1 = '$idpaysA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (transaction) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de compte associé au Taux de change... contactez votre responsable (transaction)");

        $produit = mysqli_fetch_array($res);
        $taux_cpte_deb = $produit['idcompte'];

        // V�rification de la devise et du solde du compte A
        $sql = "SELECT solde,devise FROM eco_banque WHERE idcompte = '$taux_cpte_cre';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche devise compte taux (transaction) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas compte taux de change...
          die("Le compte associé au Taux de change n'existe pas... contactez votre responsable");

        $produit = mysqli_fetch_array($res);
        if ($deviseA != $produit['devise'])  // mauvaise devise compte taux de change...
          die("La deviseA du compte associé au Taux de change n'est pas bonne... contactez votre responsable");

        $solde_cpte_taux_cre = $produit['solde'];

        // V�rification de la devise et du solde du compte B
        $sql = "SELECT solde,devise FROM eco_banque WHERE idcompte = '$taux_cpte_deb';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche devise compte taux (transaction) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas compte taux de change...
          die("Le compte associé au Taux de change n'existe pas... contactez votre responsable");

        $produit = mysqli_fetch_array($res);
        if ($deviseB != $produit['devise'])  // mauvaise devise compte taux de change...
          die("La deviseB du compte associé au Taux de change n'est pas bonne... contactez votre responsable");

        $solde_cpte_taux_deb = $produit['solde'];

        // Recherche taux de change
        $sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte taux (transaction) !!!");
        if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...
          die("Pas de Taux de change...");

        $produit = mysqli_fetch_array($res);
        $taux = $produit['taux'];

        $tarif_taux = $montant * $taux;

        if ($tarif_taux > $solde_cpte_taux_deb)  // solde compte taux de change insuffisant...
          die("Le solde du compte associé au Taux de change est insuffisant... contactez votre responsable");

        $newsolde_cpte_taux_deb = $solde_cpte_taux_deb - $tarif_taux;

        $newsolde_cpte_taux_cre = $solde_cpte_taux_cre + $montant;

      }
      else
        $tarif_taux = $montant;

      $newsoldeB = $soldeB + $tarif_taux;


      // Fin contr�les
      //--------------


      $libelletransaction = "Transaction : " . $idcpte1 . " -> " . $idcpte2 . " de " . $montant;
      $libelletransaction .= " ** " . $deviseA . " -> " . $deviseB;
      $libelletransaction .= " ** " . $com;


      // => Transactions
      //----------------


      if ($deviseA == $deviseB)   // Pas de taux
      {
        // Transaction d�bitrice
        $montant_neg = $montant * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$idcpte2','$montant_neg','$deviseA','$com',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete débitrice (transaction) !!!");

        // Transaction cr�ditrice
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$idcpte1','$montant','$deviseB','$com',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete créditrice (transaction) !!!");

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
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete débitrice Acheteur (transaction) !!!");

        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taux_cpte_cre','$idcpte1','$montant','$deviseA','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete créditrice Banque nationale (transaction) !!!");

        // Acheteur -> Banque 1 : solde Acheteur
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde solde Acheteur. (transaction)");

        // Acheteur -> Banque 1 : solde Banque 1
        $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taux_cre' WHERE idcompte = '$taux_cpte_cre';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde solde Acheteur. (transaction)");


        // Banque 2 -> Vendeur : mvts
        $tarif_taux_neg = $tarif_taux * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$taux_cpte_deb','$tarif_taux','$deviseB','$com',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete créditrice Vendeur (transaction) !!!");

        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taux_cpte_deb','$idcpte2','$tarif_taux_neg','$deviseB','$libelletransaction',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete débitrice Banque 2 (transaction) !!!");

        // M�j solde cr�dit�
        $sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Vendeur. (transaction)");

        // M�j solde d�bit�
        $sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taux_deb' WHERE idcompte = '$taux_cpte_deb';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Banque 2. (transaction)");
      }

  }

  if (isset($_POST['periodique']))
  {

  $jour = addslashes(trim($_POST['periode']));
  $periodicite = addslashes(trim($_POST['frequence']));

      // D�but contr�les
      //----------------

      // Recherche info du compte d'origine
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte1';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du compte 1 (achatstock) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte 1 periodique (transaction) !!!");
      $produit = mysqli_fetch_array($res);
      $deviseA = $produit['devise'];

      // => Transactions
      //----------------

      $sql = "INSERT INTO eco_tranperiodique (idtransac,idcpte1,montant,devise,idcpte2,commentaire,periodicite,jour,datedebut) VALUES (NULL,'$idcpte1','$montant','$deviseA','$idcpte2','$com','$periodicite','$jour',NOW());";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete insert transac periodique (transaction) !!!");

  }


  echo "<script language=\"JavaScript\"> document.location.replace(\"../transaction.php\");</script>";

?>

</body>
</html>
