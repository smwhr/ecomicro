<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Créditer un compte </title>
<head>
<body>

<?php

  include("../include/config.php");

  $idcpte = mysqli_real_escape_string($conn, addslashes(trim($_POST['idcpte'])));
  $cred = mysqli_real_escape_string($conn, addslashes(trim($_POST['cred'])));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT eco_user.iduser,eco_pays.emaileco,eco_pays.devise FROM eco_user,eco_pays ";
  $sql .= "WHERE eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_pays.idpays ;";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");
  $produit = mysqli_fetch_array($res);
  $fct_mes_resp_emaileco = $produit['emaileco'];
  $joueur_devise = $produit['devise'];

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
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche du compte (cr�dit) !!!");
      $num = @mysqli_num_rows($res) or die("<br> Pas de compte (crédit) !!!");
      $produit = mysqli_fetch_array($res);

      $deviseA = $produit['devise'];
      $soldeA = $produit['solde'];

	  if ($joueur_devise != $deviseA)
	    die ("il ne s'agit pas de votre devise");

      $newsoldeA = $soldeA + $cred;

      $com = "Crédit administratif...";

  $fct_mes_resp_type = 'C';
  $fct_mes_resp_ncpte = $idcpte;
  $fct_mes_resp_montant = $cred;
  $fct_mes_resp_devise = $deviseA;

        // Transaction débitrice
        $sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte','999999','$cred','$deviseA','$com',NOW());";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete mvt (crédit) !!!");

        // Màj solde débité
        $sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde (crédit)");

  // Envoi du message
  include("../include/fct_mes_resp.php");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../info_cpte.php\");</script>";

?>

</body>
</html>
