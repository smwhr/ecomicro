<?php
session_start();
if (!$_SESSION['perso_iduser']){
    die();
}
?>

<html>
<head>
<title> Modification d'une possession </title>
<head>
<body>

<?php

  include("../include/config.php");

  $etat = trim($_POST['etat']);
  $idpossession = trim($_POST['poss']);

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];
  $from_url = $_SESSION['from_url'];

  $sql = "SELECT iduser FROM eco_user WHERE iduser = '$idjoueur';";
  $res = @mysqli_query($conn, $sql)or die("<br>pb... Vous n'éxistez pas !!!");
  $num = @mysqli_num_rows($res) or die("<br> Vous n'éxistez pas désolé !!!");

  // CTRL data
  if (($etat != '0') AND ($etat != '1') AND ($etat != '2') AND ($etat != '3') AND ($etat != '4') AND ($etat != '8') AND ($etat != '9'))
  	die("<br> Vous n'est pas autorisé 1, désolé !!!");
  	
  // CTRL Autorisation
  if ($_SESSION['perso_droituser'] != '999'){
	  $paysjoueur = $_SESSION['perso_idpays'];
	  $autojoueur = substr($_SESSION['perso_droituser'],1,1);
	  $sql = "SELECT eco_possession.idpossesseur, eco_possession.etat FROM eco_possession, eco_entreprise, eco_user, eco_pays ";
	  $sql .= "WHERE (eco_possession.idpossession = '$idpossession' AND eco_possession.idpossesseur = eco_pays.idpays ";
	  $sql .= "AND eco_pays.idpays = '$paysjoueur' AND '$autojoueur' > '4') ";
	  $sql .= "OR (eco_possession.idpossession = '$idpossession' AND ((eco_possession.idpossesseur = eco_user.iduser ";
	  $sql .= "AND eco_user.idpays = '$paysjoueur') OR (eco_possession.idpossesseur = eco_entreprise.identreprise ";
	  $sql .= "AND eco_entreprise.idpays = '$paysjoueur')) AND '$autojoueur' > '4') ";
	  $sql .= "OR (eco_possession.idpossession = '$idpossession' AND (eco_possession.idpossesseur = '$idjoueur' ";
	  $sql .= "OR (eco_entreprise.iduser = '$idjoueur' AND eco_entreprise.identreprise = eco_possession.idpossesseur))) ";
	  $sql .= "UNION SELECT eco_possession.idpossesseur, eco_possession.etat FROM eco_possession, eco_entreprise, eco_user, eco_pays, eco_immo ";
	  $sql .= "WHERE eco_possession.idpossession = '$idpossession' AND eco_possession.idpossession = eco_immo.idpossession ";
	  $sql .= "AND eco_immo.idlocataire = '$idjoueur' ;";
	  $res = @mysqli_query($conn, $sql) or die("<br>pb... Vous n'est pas autorisé 2, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> Vous n'est pas autorisé 2, désolé !!!");
	  $produit = mysqli_fetch_array($res);
	  $old_etat = $produit['etat'];
	  $idpossesseur = $produit['idpossesseur'];
	}
  else{

	  $sql = "SELECT etat,idpossesseur FROM eco_possession ";
	  $sql .= "WHERE eco_possession.idpossession = '$idpossession' ";
	  $res = @mysqli_query($conn, $sql) or die("<br>pb... Vous n'est pas autorisé 2, désolé !!!");
	  $num = @mysqli_num_rows($res) or die("<br> Vous n'est pas autorisé 2, désolé !!!");
	  $produit = mysqli_fetch_array($res);
	  $old_etat = $produit['etat'];
	  $idpossesseur = $produit['idpossesseur'];
  }


  if (($etat != '9') && ($etat != '8')){
    $sql = "UPDATE eco_possession SET etat = '$etat', datehmaj = NOW() WHERE idpossession = '$idpossession';";
    $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre possession n'a pu être effectuée ! Veuillez contacter l'administrateur.");

    if (($old_etat == '3') && ($etat == '2')){
      $sql = "UPDATE eco_immo SET idlocataire = 0, datemaj = NOW() WHERE idpossession = '$idpossession';";
      $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre possession n'a pu être effectuée ! Veuillez contacter l'administrateur.");
    }
$from_url = substr($from_url, strripos($from_url, "/"));
    if ($from_url == "/possession_user.php")
      echo "<script language='JavaScript'> document.location.replace('../possession_user.php');</script>";
    else{
      if ($from_url == "/possession_gere.php")
        echo "<script language='JavaScript'> document.location.replace('../possession_gere.php');</script>";
      else{
        if ($from_url == "/new_detail_1_citoyen.php"){
          $tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?citoyen=" . $idpossesseur . "');</script>";
          echo $tmp;
        }
        else{
          if ($from_url == "/new_detail_1_entreprise.php"){
            $tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?entreprise=" . $idpossesseur . "');</script>";
            echo $tmp;
          }
                          else {
//                              die($from_url);
                              $tmp = "<script language='JavaScript'> document.location.replace('../vosdonnees.php');</script>";
                                echo $tmp;
                          }
      }
      }
    }
  }
  else{
	  if ($etat == '9'){
	  	$sql = "SELECT emaileco FROM eco_possession, eco_user, eco_pays ";
		  $sql .= "WHERE eco_possession.idpossession = '$idpossession' and eco_possession.idpossesseur = eco_user.iduser and eco_user.idpays = eco_pays.idpays";
		  $res = @mysqli_query($conn, $sql) or die("<br>pb... Vous n'est pas autorisé 2a, désolé !!!");
		  $num = @mysqli_num_rows($res) or die("<br> Vous n'est pas autorisé 2b, désolé !!!");
		  $produit = mysqli_fetch_array($res);
	$fct_mes_conso_emaileco = $produit['emaileco'];
	
	  	$sql = "SELECT nomproduit,nom FROM eco_possession, eco_user ";
		  $sql .= "WHERE eco_possession.idpossession = '$idpossession' and eco_possession.idpossesseur = eco_user.iduser ";
		  $res = @mysqli_query($conn, $sql) or die("<br>pb... Vous n'est pas autorisé 2c, désolé !!!");
		  $num = @mysqli_num_rows($res) or die("<br> Vous n'est pas autorisé 2d, désolé !!!");
		  $produit = mysqli_fetch_array($res);
	$fct_mes_conso_nom = $produit['nom'];
	$fct_mes_conso_nomproduit = $produit['nomproduit'];
	    
	    $sql = "INSERT into eco_possession_histo select * from eco_possession where idpossession = '$idpossession';";
	    $res = @mysqli_query($conn, $sql) or die("<br> histo a de votre possession n'a pu être effectuée ! Veuillez contacter l'administrateur.");
	    
	    $sql = "DELETE FROM eco_possession WHERE idpossession = '$idpossession';";
	    $res = @mysqli_query($conn, $sql) or die("<br> suppression a de votre possession n'a pu être effectuée ! Veuillez contacter l'administrateur.");
	    
	    // Envoi du message
	    include("../include/fct_mes_conso_user.php");
$from_url = substr($from_url, strripos($from_url, "/"));	
	    if ($from_url == "/possession_user.php")
	      echo "<script language='JavaScript'> document.location.replace('../possession_user.php');</script>";
	    else{
	      if ($from_url == "/possession_gere.php")
	        echo "<script language='JavaScript'> document.location.replace('../possession_gere.php');</script>";
	      else{
	        if ($from_url == "/new_detail_1_citoyen.php"){
	          $tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?citoyen=" . $idpossesseur . "');</script>";
	          echo $tmp;
	        }
	        else{
	          if ($from_url == "/new_detail_1_entreprise.php"){
	            $tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?entreprise=" . $idpossesseur . "');</script>";
	            echo $tmp;
	          }
                          else {
//                              die($from_url);
                              $tmp = "<script language='JavaScript'> document.location.replace('../vosdonnees.php');</script>";
                                echo $tmp;
                          }
	      	}
	      }
	    }
	  }
	  else{
	  	if ($etat == '8'){
		  	$sql = "SELECT emaileco FROM eco_possession, eco_entreprise, eco_pays ";
			  $sql .= "WHERE eco_possession.idpossession = '$idpossession' and eco_possession.idpossesseur = eco_entreprise.identreprise and eco_entreprise.idpays = eco_pays.idpays";
			  $res = @mysqli_query($conn, $sql) or die("<br>pb... Vous n'est pas autorisé 2e, désolé !!!");
			  $num = @mysqli_num_rows($res) or die("<br> Vous n'est pas autorisé 2f, désolé !!!");
			  $produit = mysqli_fetch_array($res);
		$fct_mes_conso_emaileco = $produit['emaileco'];
		
		  	$sql = "SELECT eco_possession.nomproduit,eco_entreprise.nomentreprise FROM eco_possession, eco_entreprise ";
			  $sql .= "WHERE eco_possession.idpossession = '$idpossession' and eco_possession.idpossesseur = eco_entreprise.identreprise ";
			  $res = @mysqli_query($conn, $sql) or die("<br>pb... Vous n'est pas autorisé 2g, désolé !!!");
			  $num = @mysqli_num_rows($res) or die("<br> Vous n'est pas autorisé 2h, désolé !!!");
			  $produit = mysqli_fetch_array($res);
		$fct_mes_conso_nom = $produit['nomentreprise'];
		$fct_mes_conso_nomproduit = $produit['nomproduit'];
		    
		    $sql = "INSERT into eco_possession_histo select * from eco_possession where idpossession = '$idpossession';";
		    $res = @mysqli_query($conn, $sql) or die("<br> histo i de votre possession n'a pu être effectuée ! Veuillez contacter l'administrateur.");
		    
		    $sql = "DELETE FROM eco_possession WHERE idpossession = '$idpossession';";
		    $res = @mysqli_query($conn, $sql) or die("<br> suppression j de votre possession n'a pu être effectuée ! Veuillez contacter l'administrateur.");
		    
		    // Envoi du message
		    include("../include/fct_mes_conso_user.php");
$from_url = substr($from_url, strripos($from_url, "/"));		
		    if ($from_url == "/possession_user.php")
		      echo "<script language='JavaScript'> document.location.replace('../possession_user.php');</script>";
		    else{
		      if ($from_url == "/possession_gere.php")
		        echo "<script language='JavaScript'> document.location.replace('../possession_gere.php');</script>";
		      else{
		        if ($from_url == "/new_detail_1_citoyen.php"){
		          $tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?citoyen=" . $idpossesseur . "');</script>";
		          echo $tmp;
		        }
		        else{
		          if ($from_url == "/new_detail_1_entreprise.php"){
		            $tmp = "<script language='JavaScript'> document.location.replace('.." . $from_url . "?entreprise=" . $idpossesseur . "');</script>";
		            echo $tmp;
		          }
                          else {
//                              die($from_url);
                              $tmp = "<script language='JavaScript'> document.location.replace('../vosdonnees.php');</script>";
                                echo $tmp;
                          }
		      	}
		      }
		    }
		  }
		}
  }



  
?>

</body>
</html>
