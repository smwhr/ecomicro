<?php

session_start();
if (!$_SESSION['perso_iduser']){
    die();
}

?>

<html>
<head>
<title> Init des stocks </title>
<head>
<body>

<?php

  include("../include/config.php");

  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter à la base de données -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur
  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter à la base de données -- ");

  $idjoueur = $_SESSION['perso_iduser'];

  $idpays = 301;

	$sql = "SELECT identreprise,typeentreprise FROM eco_entreprise ";
	$sql .= "WHERE idpays = '$idpays' ";
	$sql .= "AND (typeentreprise = '10001' ";
	$sql .= "OR typeentreprise = '10002' ";
	$sql .= "OR typeentreprise = '10003' ";
	$sql .= "OR typeentreprise = '20002' ";
	$sql .= "OR typeentreprise = '20003' ";
	$sql .= "OR typeentreprise = '20004' ";
	$sql .= "OR typeentreprise = '20005' ";
	$sql .= "OR typeentreprise = '40000' ";
	$sql .= "OR typeentreprise = '50001'); ";

/*
typeentreprise 	libelle 										typeequi
10000 					Primaire 										10000
20000 					Secondaire 									20000
30000 					Tertiaire 									30000
90000 					Province 										90000
10001 					Mine 												10000
10002 					Ferme 											10000
10003 					Centrale Energ�tique 				10000
50001 					BTP 												50000
40000 					Retraitement 								40000
80000 					Organisme 									80000
30001 					M�dia 											30000
30002 					Transport 									30000
30003 					Divertissement 							30000
30004 					Centre d'�tude 							30000
30005 					Agence immobil�re 					30000
30006 					Tourisme 										30000
20002 					Constructeur de v�hicules 	20000
20003 					Fabrique d'objets 					20000
20004 					Fabrique de machines 				20000
20005 					Restaurant 									20000
20006 					Distillerie 								20000
50000 					Secondaire citoyen 					50000
30007 					Association 								30000

- Centrale Energ�tique : 10 PObjet + 5 PMachine
- Ferme : 15 PObjet + 5 PV�hicule
- Mine : 10 PMachine + 5 PV�hicule
- Fabrique d'Objet : 40 PMachine + 20 PV�hicule + 10 PAL + 20 PAlcool
- Fabrique de Machine : 50 PObjet + 10 PV�hicule + 5 PAL + 10 PAlcool
- Constructeur de V�hicule : 40 PObjet + 30 PMachine + 5 PAL + 10 PAlcool
- Restaurant : 10 PAlcool
- BTP : 30 PObjet + 20 PMachine + 30 PV�hicule + 5 PAL + 10 PAlcool
- Retraitement : 30 PMachine + 20 PV�hicule 
*/

	$res1 = @mysqli_query($conn, $sql) or die("Erreur dans la requête (InitStock Entrprise)");
	$num1 = @mysqli_num_rows($res1) or die ("Aucune entreprise");

  $ferme = 0;
  $mine = 0;
  $elec = 0;
  $mach = 0;
  $obj = 0;
  $vehi = 0;
  $resto = 0;
  $btp = 0;
  $retr = 0;

	while($produit1 = mysqli_fetch_array($res1))
	{
		$type = $produit1['typeentreprise'];
		$identre = $produit1['identreprise'];

echo("id : ".$identre." type : ".$type);

		if ($type == '10001')	// Ferme
		{
			//- Ferme : 15 PObjet + 5 PV�hicule
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30001';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche de la quantité (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30001','$identre',15);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete d'insertion d'une nouvelle quantité (Ferme 15 PObj) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 15;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30001';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (achatDéchets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30003';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantité (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30003','$identre',5);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (Ferme 5 PVeh) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 5;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30003';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
			  $ferme++;
		}
		if ($type == '10002')	// Mine
		{
			//- Mine : 10 PMachine + 5 PV�hicule
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30002';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30002','$identre',10);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (Ferme 10 PMach) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 10;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30002';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30003';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30003','$identre',5);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (Ferme 5 PVeh) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 5;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30003';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
        $mine++;
		}
		if ($type == '10003')	// Central Elec
		{
			//- Centrale Energ�tique : 10 PObjet + 5 PMachine
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30001';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30001','$identre',10);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (Ferme 10 PObj) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 10;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30001';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30002';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30002','$identre',5);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (Ferme 5 PMach) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 5;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30002';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
			  $elec++;
		}
		if ($type == '20002')	// Constructeur V�hi
		{
			//- Constructeur de V�hicule : 40 PObjet + 30 PMachine + 5 PAL + 10 PAlcool
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30001';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30001','$identre',40);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (ConstrVehi 40 PObj) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 40;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30001';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30002';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30002','$identre',30);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (ConstrVehi 30 PMach) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 30;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30002';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80005';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80005','$identre',5);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (ConstrVehi 5 PAL) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 5;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80005';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80009';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80009','$identre',10);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (ConstrVehi 10 PAlcool) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 10;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80009';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
        $vehi++;
		}
		if ($type == '20003')	// Fabrique Obj
		{
			//- Fabrique d'Objet : 40 PMachine + 20 PV�hicule + 10 PAL + 20 PAlcool
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30002';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30002','$identre',40);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (FabriObj 40 PMach) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 40;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30002';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30003';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30003','$identre',20);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (FabriObj 20 PVehi) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 20;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30003';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80005';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80005','$identre',10);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (FabriObj 10 PAL) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 10;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80005';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80009';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80009','$identre',20);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (FabriObj 20 PAlcool) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 20;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80009';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
        $obj++;
		}
		if ($type == '20004')	// Fabrique Mach
		{
			//- Fabrique de Machine : 50 PObjet + 10 PV�hicule + 5 PAL + 10 PAlcool
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30001';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30001','$identre',50);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (FabriMach 50 PObj) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 50;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30001';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30003';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30003','$identre',10);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (FabriMach 10 PVehi) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 10;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30003';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80005';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80005','$identre',5);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (FabriMach 5 PAL) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 5;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80005';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80009';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80009','$identre',10);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (FabriMach 10 PAlcool) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 10;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80009';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
        $mach++;
		}
		if ($type == '20005')	// Restau
		{
			//- Restaurant : 10 PAlcool
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80009';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80009','$identre',10);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (Restau 10 PAlcool) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 10;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80009';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
        $resto++;
		}
		if ($type == '40000')	// Retraitement
		{
			//- Retraitement : 30 PMachine + 20 PV�hicule 
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30002';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30002','$identre',30);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (Retrai 30 PMach) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 30;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30002';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30003';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30003','$identre',20);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (Retrai 20 PVehi) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 20;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30003';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
        $retr++;
		}
		if ($type == '50001')	// BTP
		{
			//- BTP : 30 PObjet + 20 PMachine + 30 PV�hicule + 5 PAL + 10 PAlcool
      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30001';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30001','$identre',30);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (BTP 30 PObj) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 30;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30001';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30002';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30002','$identre',20);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (BTP 20 PMach) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 20;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30002';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '30003';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('30003','$identre',30);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (BTP 30 PVehi) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 30;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '30003';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80005';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80005','$identre',5);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (BTP 5 PAL) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 5;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80005';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }

      $sql = "SELECT quantite FROM eco_stock WHERE identreprise = '$identre' AND idunite = '80009';";
      $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche de la quantit� (init1) !!!");
      if (!($num = @mysqli_num_rows($res)))
      {
        $sql = "INSERT INTO eco_stock (idunite,identreprise,quantite) VALUES ('80009','$identre',10);";
        $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'une nouvelle quantit� (BTP 10 PAlcool) !!!");
      }
      else
      {
        $produit = mysqli_fetch_array($res);

        $new_quantite = $produit['quantite'] + 10;
        $sql = "UPDATE eco_stock SET quantite = '$new_quantite' WHERE identreprise = '$identre' AND idunite = '80009';";
        $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le stock. (achatD�chets)");
      }
        $btp++;
		}

	}

echo ("ferme : ". $ferme);
echo ("<BR>mine : ". $mine);
echo ("<BR>elec : ". $elec);
echo ("<BR>obj : ". $obj);
echo ("<BR>mach : ". $mach);
echo ("<BR>vehi : ". $vehi);
echo ("<BR>resto : ". $resto);
echo ("<BR>retr : ". $retr);
echo ("<BR>btp : ". $btp);

?>

</body>
</html>