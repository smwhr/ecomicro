<html>
<head>
<title> Envoi du mot de passe </title>
<head>
<body>

<?php

  include("../include/config.php");

  $login = addslashes(trim($_POST['login']));
  
  if ($login == "demo")
  	die("le mot de passe est : demo");

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $sql = "SELECT iduser,email,nom FROM eco_user WHERE login = '$login';";
  $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requête recherche email");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'existez pas !!!");
  $produit = mysqli_fetch_array($res);
  $nom = $produit['nom'];
  $iduser = $produit['iduser'];
  $email = $produit['email'];

  $new_pwd = "";
  $tab = "abcdefghijklmnopqrstuvwxyz0123456789";
  for ($ind01 = 1 ; $ind01 < 8 ; $ind01++)
  {
  	$pos_lettre = mt_rand(0,35);
  	$new_pwd .= substr($tab,$pos_lettre,1);
  }

  $sql = "UPDATE eco_user SET pwd = DES_ENCRYPT('$new_pwd'), datemaj = NOW() WHERE login = '$login';";
  $res = @mysqli_query($conn, $sql) or die("Màj impossible. Contactez l'administrateur ce citoyen");


  $sujet = "EcoMicro - Mot de passe";

  $corps = "Bonjour " . $nom . "\n\n" . "Vous avez demandé l'envoi d'un nouveau mot de passe vous permettant de vous connecter à EcoMicro.\n\n";
  $corps .= "Login : " . $login . "\n" . "Mot de passe : " . $new_pwd . "\n";
  $corps .= "\n\n";
  $corps .= "Si vous n'avez pas sollicité ce message, merci de le signaler à l'adresse suivante : <a href='http://forum.micromonde.net'>forum.micromonde.net</A>\n";
  $corps .= "\n\n";
  $corps .= "EcoMicro\n";

  $adr_origine = "From:martin_dutois@yahoo.fr";

//  echo $corps;
  mail($email,$sujet,$corps,$adr_origine);
?>

  <br>
  <br>
  Votre Mot de passe vient de vous être envoyé.
  <br>
  Si vous ne recevez rien d'ici 10 à 20 minutes, contactez le responsable de votre nation virtuelle.
  <br>

</body>
</html>
