<?php

session_start();
if (!$_SESSION['perso_iduser'])
    die();
if (substr($_SESSION['perso_droituser'],1,1) <= '5')
{
    echo "<script language='JavaScript'>\n
    document.location.replace('../index.php');
    </script>\n";
    die();
}
?>

<html>
<head>
<title> Cr�ation immobili�re </title>
<head>
<body>

<?php

  include("../include/config.php");

  $nomproduit = addslashes(trim($_POST['nomproduit']));
  $proprietaire = addslashes(trim($_POST['proprietaire']));
  $description = addslashes(trim($_POST['description']));
  $adresse = addslashes(trim($_POST['adresse']));
  $province = addslashes(trim($_POST['province']));
  $image = addslashes(trim($_POST['image']));
  $typeproduit = addslashes(trim($_POST['typeproduit']));
  $nbunite = addslashes(trim($_POST['nbunite']));
  $idunite = addslashes(trim($_POST['idunite']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $sql = "SELECT eco_pays.idpays,eco_pays.devise FROM eco_pays,eco_entreprise ";
  $sql .= "WHERE eco_entreprise.identreprise = '$province' AND eco_entreprise.idpays = eco_pays.idpays ;";
  $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requ�te recherche pays");
  $num = @mysqli_num_rows($res) or die("<br> Le pays n'existe pas !!!");
  $produit = mysqli_fetch_array($res);

  $idpays = $produit['idpays'];
  $devise = $produit['devise'];

  $sql = "SELECT occupe FROM eco_immo ";
  $sql .= "WHERE eco_immo.idproprio = '$proprietaire' AND occupe = '1' ;";
  $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche pays");
  $num = @mysqli_num_rows($res) or $occupe = '1';
  $produit = mysqli_fetch_array($res);

  if ($num == 1)
	  $occupe = '0';


      // Possession

      $sql = "INSERT INTO eco_possession (idpossession,idpossesseur,idproduit,datehachat,nomproduit,typeproduit,image,description,nbunite,idunite,datehmaj,prixachat,devise) ";
      $sql .= "VALUES (NULL,'$proprietaire','0',NOW(),'$nomproduit','$typeproduit','$image','$description','$nbunite','$idunite',NOW(),'0','$devise');";
      $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete d'insertion d'une nouvelle possession (addimmo) !!!");
      $idpossession = mysql_insert_id();

      // Immobilier

      $sql = "INSERT INTO eco_immo (idpossession,idproprio,occupe,idlocataire,prix,devise,prime,datemaj,province,adresse_immo) ";
      $sql .= "VALUES ('$idpossession','$proprietaire','$occupe',0,0,'$devise',0,NOW(),'$province','$adresse');";
      $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete immo (addimmo) !!!");

  echo "<script language=\"JavaScript\"> document.location.replace(\"../add_immo.php\");</script>";

?>

</body>
</html>
