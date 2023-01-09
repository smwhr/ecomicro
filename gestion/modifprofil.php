<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Modification du profil </title>
<head>
<body>

<?php

  include("../include/config.php");

  $login = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['login']))));
  $email = addslashes(trim($_POST['email']));
  $pwd = addslashes(trim($_POST['pwd']));
  //$nom = addslashes(trim($_POST['nom']));
  $nom = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($_POST['nom']))));
  $portrait = addslashes(trim($_POST['portrait']));

	  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
	  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");
	
	  $idjoueur = $_SESSION['perso_iduser'];
	
	  $sql = "SELECT iduser, login FROM eco_user WHERE iduser = '$idjoueur';";
	  $res = @mysqli_query($conn, $sql)or die("<br> Vous n'existez pas !!!");
	  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas désolé !!!");
    $produit = mysqli_fetch_array($res);
    $login_old = $produit['login'];
	
  if($login_old != "demo"){

	  if ($pwd == ""){    // pas de modification du MDP
	    $sql = "UPDATE eco_user SET portrait = '$portrait',nom = '$nom',login = '$login', email = '$email', datemaj = NOW() WHERE iduser = '$idjoueur';";
	    $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre profil n'a pu etre effectuée ! Le login ou le nom existe déjà.");
	  }
	  else {
	    $sql = "UPDATE eco_user SET portrait = '$portrait',nom = '$nom',login = '$login', email = '$email', pwd = DES_ENCRYPT('$pwd'), datemaj = NOW() WHERE iduser = '$idjoueur';";
	    $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre profil n'a pu etre effectuée ! Veuillez contacter l'administrateur.");
	  }

	}
echo "<script language=\"JavaScript\"> document.location.replace(\"../user_profile.php\");</script>";

?>

</body>
</html>
