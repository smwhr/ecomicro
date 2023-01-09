<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Débiter un compte </title>
<head>
<body>

<?php

  include("../include/config.php");

  $idcpte = mysqli_real_escape_string($conn, addslashes(trim($_POST['idcpte'])));
  $deb = mysqli_real_escape_string($conn, addslashes(trim($_POST['deb'])));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT eco_user.iduser,eco_pays.emaileco FROM eco_user,eco_pays ";
  $sql .= "WHERE eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_pays.idpays ;";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");
  $produit = mysqli_fetch_array($res);
  $fct_mes_resp_emaileco = $produit['emaileco'];

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  if ($autojoueur < '5')
	  	die("<br> PB de vérification1, désolé !!!");
	}

      // Recherche info du compte destinataire
      $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du compte (débit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte (débit) !!!");
      $produit = mysqli_fetch_array($res);

      $deviseA = $produit['devise'];
      $soldeA = $produit['solde'];

      $newsoldeA = $soldeA - $deb;

      if ($newsoldeA < 0)
        die ("Solde acheteur insuffisant...");

      $com = "Débit administratif...";

  $fct_mes_resp_type = 'D';
  $fct_mes_resp_ncpte = $idcpte;
  $fct_mes_resp_montant = $deb;
  $fct_mes_resp_devise = $deviseA;


        // Transaction d�bitrice
        $deb_neg = $deb * -1;
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte','999999','$deb_neg','$deviseA','$com',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete créditrice (transaction) !!!");

        // M�j solde d�bit�
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Acheteur. (transaction)");

  // Envoi du message
  include("../include/fct_mes_resp.php");


  echo "<script language=\"JavaScript\"> document.location.replace(\"../info_cpte.php\");</script>";

?>

</body>
</html>
