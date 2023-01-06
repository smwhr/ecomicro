<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die("Votre session est HS...");
}
?>

<html>
<head>
    <title> Produire </title>
<head>
<body>

<?php

  include("../include/config.php");

  $facteur = addslashes(trim($_POST['facteur']));
  $prodfini = addslashes(trim($_POST['prodfini']));
  $type = addslashes(trim($_POST['type']));
  $identre = addslashes(trim($_POST['identre']));
  $nbresA = addslashes(trim($_POST['nbresA']));
  $nbmatA = addslashes(trim($_POST['nbmatA']));

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  $from_url = $_SESSION['from_url'];
  $from_url = substr($from_url, strripos($from_url, "/"));

  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999')
  {
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  
	  $sql = "SELECT identreprise FROM eco_entreprise, eco_pays WHERE eco_entreprise.identreprise = '$identre' ";
	  $sql .= "AND (eco_entreprise.iduser = '$idjoueur' ";
	  $sql .= "OR (eco_entreprise.idpays = '$paysjoueur' AND '$autojoueur' > '4')); ";
	  $res = @mysqli_query($conn, $sql)or die("<br> PB de vérification1, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> PB de vérification1, désolé !!!");
	}

  $sql = "SELECT typeentreprise,capacite FROM eco_entreprise WHERE identreprise = '$identre';";
  $res = @mysqli_query($conn, $sql)or die("<br> PB dans la requete recherche entreprise");
  $num = @mysqli_num_rows($res) or die("<br> L'entreprise n'existe pas !!!");
  $produit = mysqli_fetch_array($res);

  $typeentreprise = $produit['typeentreprise'];
  $capacite = $produit['capacite'];


  // Recherche nb et cout de l'historique du mois
  $tt=time();
  $mois=date("m",$tt);

  $sql = "SELECT devise FROM eco_banque WHERE idtitulaire = '$identre' ORDER BY idcompte ASC;";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche compte (produire) !!!");
  $num = @mysqli_num_rows($res) or die("Pas de compte (produire) !!!");
  $produit = mysqli_fetch_array($res);
  $devise = $produit['devise'];

  $sql = "SELECT nb,cout,datemaj FROM eco_histo WHERE identreprise = '$identre' AND mois = '$mois' AND idunite = '$prodfini' AND action = '2';";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche de histo (produire) !!!");
  $num = @mysqli_num_rows($res);
  if ($num > 0){
      $produit = mysqli_fetch_array($res);

      $nb = $produit['nb'];
      $cout = $produit['cout'];
      $date = $produit['datemaj'];
      if (substr($date,2,2) != date("y",$tt)){
      	$nb = 0;
        $cout = 0;
      }
  }
  else{
      $sql = "INSERT INTO eco_histo (idhisto,identreprise,mois,idunite,action,nb,cout,devise,qualite,datemaj) VALUES (NULL,'$identre','$mois','$prodfini','2','0','0','$devise','0',NOW())";
      $res = mysqli_query($conn, $sql) or die("Erreur dans la requete ins1 histo (produire) !!!");

      $nb = 0;
      $cout = 0;
  }

  // ressource
  $prix_res = 0;
  if ($nbresA > 0){
    $sql = "SELECT typeproduire,idres,nbres FROM eco_produire WHERE typeentreprise = '$type' AND idproduitfini = '$prodfini' AND typeproduire = '2';";
    $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche de ressource (produire) !!!");
    $num = @mysqli_num_rows($res) or die("Pas de règle de production (res), bizarre... (produire) !!!");

    while ($produit = mysqli_fetch_array($res)){

        $typeproduire = $produit['typeproduire'];
        $idres = $produit['idres'];
        $nbres = $produit['nbres'];

        $sql1 = "SELECT quantite,prixrevient,devise,qualite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '$idres';";
        $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requete de recherche ressource (produire) !!!");
        $num1 = @mysqli_num_rows($res1) or die("Pas de ressource... (produire) !!!");

        $produit1 = mysqli_fetch_array($res1);
        $quantite1 = $produit1['quantite'];
        $prixrevient1 = $produit1['prixrevient'];
        $devise1 = $produit1['devise'];
        $qualite1 = $produit1['qualite'];

        $prix_res = ($prix_res + ($prixrevient1 * ($nbres * $facteur)));

        if ($quantite1 < ($nbres * $facteur))
          die ("Pas assez de ressource...");

        $new_quantite = $quantite1 - ($nbres * $facteur);

        if ($new_quantite == 0)
	        $sql1 = "UPDATE eco_stock SET quantite = '$new_quantite', prixrevient = '0', datemaj = NOW() WHERE identreprise = '$identre' AND idunite = '$idres';";
				else
  	      $sql1 = "UPDATE eco_stock SET quantite = '$new_quantite', datemaj = NOW() WHERE identreprise = '$identre' AND idunite = '$idres';";
        $res1 = @mysqli_query($conn, $sql1)or die("Erreur dans la requete de maj ressource (produire) !!!");
    }
  }

  // materiaux
  $prix_mat = 0;
  if ($nbmatA > 0){
    $sql = "SELECT typeproduire,idres,nbres FROM eco_produire WHERE typeentreprise = '$type' AND idproduitfini = '$prodfini' AND typeproduire = '3';";
    $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche de matériaux (produire) !!!");
    $num = @mysqli_num_rows($res) or die("Pas de règle de production (mat), bizarre... (produire) !!!");

    while ($produit = mysqli_fetch_array($res)){

        $typeproduire = $produit['typeproduire'];
        $idres = $produit['idres'];
        $nbres = $produit['nbres'];

        $sql1 = "SELECT quantite,prixrevient,devise,qualite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '$idres';";
        $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requete de recherche matériaux 2 (produire) !!!");
        $num1 = @mysqli_num_rows($res1) or die("Pas de matériaux... (produire) !!!");

        $produit1 = mysqli_fetch_array($res1);
        $quantite1 = $produit1['quantite'];
        $prixrevient1 = $produit1['prixrevient'];
        $devise1 = $produit1['devise'];
        $qualite1 = $produit1['qualite'];

        $prix_mat = ($prix_mat + ($prixrevient1 * ($nbres * $facteur)));

        if ($quantite1 < ($nbres * $facteur))
          die ("Pas assez de matériaux...");

        $new_quantite = $quantite1 - ($nbres * $facteur);

        if ($new_quantite == 0)
	        $sql1 = "UPDATE eco_stock SET quantite = '$new_quantite', prixrevient = '0', datemaj = NOW() WHERE identreprise = '$identre' AND idunite = '$idres';";
  	    else
  	      $sql1 = "UPDATE eco_stock SET quantite = '$new_quantite', datemaj = NOW() WHERE identreprise = '$identre' AND idunite = '$idres';";
        $res1 = @mysqli_query($conn, $sql1)or die("Erreur dans la requete de maj matériaux (produire) !!!");
    }
  }

  // productions
  $sql = "SELECT typeproduire,idres,nbres FROM eco_produire WHERE typeentreprise = '$type' AND idproduitfini = '$prodfini' AND typeproduire = '1';";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche de produire (produire) !!!");
  $num = @mysqli_num_rows($res) or die("Pas de règle de production (prod), bizarre... (produire) !!!");

  $prix_prod = 0;

  while ($produit = mysqli_fetch_array($res)){

      $typeproduire = $produit['typeproduire'];
      $idres = $produit['idres'];
      $nbres = $produit['nbres'];

      $sql1 = "SELECT quantite,prixrevient,devise,qualite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '$idres';";
      $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requ�te de recherche ressource (produire) !!!");
      $num1 = @mysqli_num_rows($res1);
      if ($num1 == 1){
          $produit1 = mysqli_fetch_array($res1);
          $quantite1 = $produit1['quantite'];
          $prixrevient1 = $produit1['prixrevient'];
          $devise1 = $produit1['devise'];
          $qualite1 = $produit1['qualite'];

          $prix_prod = (($prix_res + $prix_mat) + ($prixrevient1 * $quantite1)) / ($quantite1 + ($nbres * $facteur));

          $new_quantite = $quantite1 + ($nbres * $facteur);

          $sql1 = "UPDATE eco_stock SET quantite = '$new_quantite', prixrevient = $prix_prod, datemaj = NOW() WHERE identreprise = '$identre' AND idunite = '$idres';";
          $res1 = @mysqli_query($conn, $sql1)or die("Erreur dans la requete de maj ressource (produire) !!!");
      }
      else{
          $prix_prod = ($prix_res + $prix_mat) / ($nbres * $facteur);

          $new_quantite = ($nbres * $facteur);

          $sql = "INSERT INTO eco_stock (identreprise,idunite,quantite,prixrevient,devise,qualite,datemaj) VALUES ('$identre','$idres','$new_quantite','$prix_prod','$devise','0',NOW())";
          $res = mysqli_query($conn, $sql) or die("Erreur dans la requete ins stock (produire) !!!");
      }

      if ($idres == $prodfini){
          $cout = (($nb * $cout) + ($prix_prod * $new_quantite)) / ($new_quantite + $nb);
          $nb = $nb + ($nbres * $facteur);
      }
  }

  // l'historique
  $sql = "UPDATE eco_histo SET nb = '$nb', cout = '$cout', datemaj = NOW() WHERE identreprise = '$identre' AND mois = '$mois' AND idunite = '$prodfini' AND action = '2';";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de maj de histo (produire) !!!");


	$tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?entreprise=" . $identre . "');</script>";
	echo $tmp;

?>

</body>
</html>
