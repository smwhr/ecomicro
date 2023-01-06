<?php

$host = "localhost";
$user = "user";
$pass = "pass";
$bdd = "micromonde";

mysql_connect($host,$user,$pass) or die("Impossible de se connecter � la base de donn�es"); // Le @ ordonne a php de ne pas afficher de message d'erreur
mysqli_select_db($conn, $bdd) or die("Impossible de se connecter � la base de donn�es");

$sql = "SELECT * FROM eco_user;";

$res = mysqli_query($conn, $sql) or die("Erreur dans la requ�te");
$num = mysqli_num_rows($res);
$produit = mysqli_fetch_array($res);

die($res);
echo $num;
//echo $produit;


mysqli_close($conn);


?>
