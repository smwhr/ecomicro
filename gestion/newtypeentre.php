<?php



session_start();

if (!$_SESSION['perso_iduser']){

    die();

}



?>



<html>

<head>

<title> Cr�ation d'un type d'entreprise </title>

<head>

<body>



<?php



  include("../include/config.php");



  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur

  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");



  $idjoueur = $_SESSION['perso_iduser'];

  

  $typeentre = trim($_POST['typeentre']);

  $libelle = addslashes(trim($_POST['libelle']));

  $typeequi = trim($_POST['typeequi']);



  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";

  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");

  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");



  // CTRL Autorisation

  if ($_SESSION['perso_droituser'] != '999')

	  	die("<br> PB de vérification1, désolé !!!");



  if ($typeequi == '0')

    $typeequi = $typeentre;

  $sql = "INSERT INTO eco_typeentreprise (typeentreprise,libelle,typeequi) VALUES('$typeentre','$libelle','$typeequi');";

  $res = @mysqli_query($conn, $sql) or die("Insertion impossible. Contactez ladministrateur");



echo "<script language=\"JavaScript\"> document.location.replace(\"../type_entreprise.php\");</script>";



?>



</body>

</html>

