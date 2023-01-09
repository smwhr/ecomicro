<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Election responsable </title>
<head>
<body>

<?php

  include("../include/config.php");

  $iduser = mysqli_real_escape_string($conn, addslashes(trim($_POST['iduser'])));
  $idpays = mysqli_real_escape_string($conn, addslashes(trim($_POST['idpays'])));
  $dateelec = mysqli_real_escape_string($conn, addslashes(trim($_POST['dateelec'])));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT nom,emaileco FROM eco_user,eco_pays ";
  $sql .= "WHERE eco_user.iduser = '$idjoueur' AND eco_pays.idpays = eco_user.idpays ;";
  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");
  $produit = mysqli_fetch_array($res);
  $nom_elec = $produit["nom"];
  $fct_mes_election_emaileco = $produit["emaileco"];

	// CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];

	  if ($paysjoueur != $idpays)
			die("<br> PB lors de la vérification1...");
	
  }

  $tt=time();
  $tt -= (30 * 24 * 3600);
  $mois=date("m",$tt);
  $jour=date("d",$tt);
  $date=date("Y",$tt);
  $date_propo = $date . "-" . $mois . "-" . $jour;

  $tt=time();
  $tt += (7 * 24 * 3600);
  $mois=date("m",$tt);
  $jour=date("d",$tt);
  $date=date("Y",$tt);
  $date_expir = $date . "-" . $mois . "-" . $jour;

  if ($date_propo > $dateelec)          // on peut voter
  {

  $fct_mes_election_type = "";
  $fct_mes_election_nom_elec = $nom_elec;

      $sql = "SELECT iduser FROM eco_user WHERE idpays = '$idpays';";
      $res = @mysqli_query($conn, $sql)or die("<br> aucun citoyen pb !!!");
      $num = @mysqli_num_rows($res) or die("<br> aucun citoyen désolé !!!");

  	while($produit = mysqli_fetch_array($res))
      {
        $iduser_pays = $produit["iduser"];

//        $sql = "DELETE FROM eco_fonction WHERE iduser = '$iduser_pays' AND auto2 = '5';";
//        $res = @mysqli_query($conn, $sql)or die("<br> Erreur dans la suppression d'une fonction !!!");

        $sql1 = "UPDATE eco_user SET election = 0,resp = 0 WHERE iduser = '$iduser_pays';";
        $res1 = @mysqli_query($conn, $sql1) or die("<br> Màj n'a pu être effectuée ! Veuillez contacter l'administrateur.");
      }

    $sql = "UPDATE eco_pays SET dateelection = '$date_expir',election = '1' WHERE idpays = '$idpays';";
    $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre pays n'a pu être effectuée ! Veuillez contacter l'administrateur.");

    // Envoi du message
    include("../include/fct_mes_election.php");
  }

  echo "<script language=\"JavaScript\"> document.location.replace(\"../info_etat.php\");</script>";

?>

</body>
</html>
