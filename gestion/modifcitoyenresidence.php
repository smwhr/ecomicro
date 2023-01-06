<?php



session_start();

if (!$_SESSION['perso_iduser']){

    die();

}



?>



<html>

<head>

<title> Modification d'une résidence pour un citoyen </title>

<head>

<body>



<?php



  include("../include/config.php");



  $userA = addslashes(trim($_POST['userA']));

  $residenceA = addslashes(trim($_POST['residence1']));





  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur

  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");



  $idjoueur = $_SESSION['perso_iduser'];



  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";

  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");

  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");



  // CTRL Autorisation

  if ($_SESSION['perso_droituser'] != '999')

  {

	  $paysjoueur = $_SESSION['perso_idpays'];

	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);

	  

	  $sql = "SELECT eco_entreprise.iduser FROM eco_entreprise, eco_user, eco_pays ";

	  $sql .= "WHERE (eco_entreprise.iduser = '$idjoueur' AND eco_entreprise.identreprise = '$identreA') ";

	  $sql .= "OR (eco_entreprise.identreprise = '$identreA' ";

	  $sql .= "AND eco_entreprise.idpays = '$paysjoueur' AND '$autojoueur' > '4') ;";

	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification1, désolé !!!");

	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification1 désolé !!!");

  }



  if ($residenceA > '0')

  {

     $sql = "UPDATE eco_immo SET occupe = '0' ";

     $sql .= "WHERE (idproprio = '$userA' AND idlocataire = '0') ";

     $sql .= "OR idlocataire = '$userA';";

     $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l administrateur de cette entreprise (immocitoyen1)");



     $sql = "UPDATE eco_immo SET occupe = '1' ";

     $sql .= "WHERE idpossession = '$residenceA';";

     $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l administrateur de cette entreprise (immocitoyen2)");

  }





  echo "<script language=\"JavaScript\"> document.location.replace(\"../detail_1_citoyen.php?citoyen=",$userA,"\");</script>";



?>



</body>

</html>

