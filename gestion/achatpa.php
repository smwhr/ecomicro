<?php
session_start();
if (!$_SESSION['perso_iduser'])
{
	    die();
}
?>
<html>
	<head>
		<title> Action Achat petites annonces </title>
		<head>
			<body>
				<?php  
				  include("../include/config.php");
				  
				  $idmsg = addslashes(trim($_POST['idmsg']));
				  $reponse = addslashes(trim($_POST['reponse1']));
				    
				  @mysql_connect($host,$user,$pass) or die("<br>0- Impossible de se connecter � la base de donn�es -- "); // Le @ ordonne a php de ne pas afficher de message d'erreur  
				  @mysqli_select_db($conn, $bdd) or die("<br>0- Impossible de se connecter � la base de donn�es -- ");  
				  
				  $idjoueur = $_SESSION['perso_iduser'];  
				  
				  $sql = "SELECT origine, destinataire,objet,libelle,datepropo,dateexpir,data,reponse FROM eco_message WHERE idmsg = '$idmsg';";  
				  $res = @mysqli_query($conn, $sql) or die("<br> PB dans la requete recherche message");  
				  $num = @mysqli_num_rows($res) or die("<br> Le message n'existe pas !!!");  
				  $produit = mysqli_fetch_array($res);  
				  
				  $origine = $produit['origine'];  
				  $destination = $produit['destinataire'];  
				  $objet = $produit['objet'];  
				  $com = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['libelle']));  
				  $datepropo = $produit['datepropo'];  
				  $dateexpir = $produit['dateexpir'];  
				  $data = $produit['data'];  
				  $reponse_av = $produit['reponse'];

				  $fct_mes_vente_texte = $produit['libelle'];
				  
				  if ($reponse_av != "")     
				  	die ("Message déjà répondu...");  
				  
				  if (($objet == "VENTE_OCCASION") && ($reponse == "A"))  
				  {    
				  	//  $datatransaction = $idcpte1 . "|" . $idcpte2 . "|" . $entreA . "|" . $entreB . "|" . $idprod . "|" . $nbunite . "|" . $idunite . "|" . $tarif;    
				  	//   100001|100002|2|1|1|8|80006|10    
					  $tab_data = explode("|",$data);        
					  $idcpte1 = $tab_data[0];        
					  $idcpte2 = $tab_data[1];        
					  $entreA = $tab_data[2];        
					  $entreB = $tab_data[3];//        
					  $idprod = $tab_data[4];        
					  $nbunite = $tab_data[5];        
					  $idunite = $tab_data[6];        
					  $tarif = $tab_data[7];      

					  // Début contrôles      
					  //----------------      
	
					  // Recherche info du compte d'origine      
					  $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte1';";      
					  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche du compte 1 (achatpa) !!!");      
					  $num = @mysqli_num_rows($res) or die("<br> Pas de compte 1 (achatpa) !!!");      
					  $produit = mysqli_fetch_array($res);      
	
					  $deviseA = $produit['devise'];      
					  $soldeA = $produit['solde'];      
	
					  // Recherche info du compte destinataire      
					  $sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte2';";      
					  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche du compte 2 (achatpa) !!!");      
					  $num = @mysqli_num_rows($res) or die("<br> Pas de compte 2 (achatpa) !!!");      
					  $produit = mysqli_fetch_array($res);      
	
					  $deviseB = $produit['devise'];      
					  $soldeB = $produit['solde'];      
	
					  $tarif_total_ht = $tarif;      
	
					  // Recherche info id 1      
					  $sql = "SELECT nomentreprise,idpays,iduser FROM eco_entreprise WHERE identreprise = '$entreA';";      
					  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche entreprise 1 (achatpa) !!!");      
					  
					  if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une entreprise      
					  {          
						  $sql = "SELECT nom,idpays,iduser FROM eco_user WHERE iduser = '$entreA';";          
						  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche user 1 (achatpa) !!!");          
						  if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une personne ...          
						  {            
							  $sql = "SELECT nompays,idpays,iduser FROM eco_pays WHERE idpays = '$entreA';";            
							  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche pays 1 (achatpa) !!!");            
							  if (!($num = @mysqli_num_rows($res)))  // ce n'est pas un pays, pb !!              
								  die ("l'acheteur n'existe pas !!");            
							  $produit = mysqli_fetch_array($res);            
		
							  $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nompays']));            
							  $idpaysA = $produit['idpays'];            
							  $iduserA = $produit['iduser'];          
						  }          
						  else          
						  {            
							  $produit = mysqli_fetch_array($res);            
							  $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nom']));            
							  $idpaysA = $produit['idpays'];            
							  $iduserA = $produit['iduser'];          
						  }      
		  		  }      
					  else      
					  {          
						  $produit = mysqli_fetch_array($res);          
						  $nomA = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomentreprise']));          
						  $idpaysA = $produit['idpays'];          
						  $iduserA = $produit['iduser'];      
					  }      
			
					  // Recherche info id 2      
					  $sql = "SELECT nomentreprise,idpays,iduser FROM eco_entreprise WHERE identreprise = '$entreB';";      
					  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche entreprise 2 (achatpa) !!!");      
					  if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une entreprise      
					  {          
						  $sql = "SELECT nom,idpays,iduser FROM eco_user WHERE iduser = '$entreB';";          
						  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche user 2 (achatpa) !!!");          
				
						  if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une personne ...          
						  {            
							  $sql = "SELECT nompays,idpays,iduser FROM eco_pays WHERE idpays = '$entreB';";            
							  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche pays 2 (achatpa) !!!");            
					
							  if (!($num = @mysqli_num_rows($res)))  // ce n'est pas un pays, pb !!              
								  die ("le vendeur n'existe pas !!");            
	
							  $produit = mysqli_fetch_array($res);            
							  $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nompays']));            
							  $idpaysB = $produit['idpays'];            
							  $iduserB = $produit['iduser'];          
						  }          
						  else          
						  {            
					  		$produit = mysqli_fetch_array($res);            
							  $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nom']));            
							  $idpaysB = $produit['idpays'];            
							  $iduserB = $produit['iduser'];          
						  }      
					  }      
					  else      
					  {          
						  $produit = mysqli_fetch_array($res);          
						  $nomB = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomentreprise']));          
						  $idpaysB = $produit['idpays'];          
						  $iduserB = $produit['iduser'];      
						}      
					  
					  // Recherche info produit      
					  $sql = "SELECT nomproduit,typeproduit,image,description FROM eco_possession WHERE idpossession = '$idprod';";      
					  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche typeproduit (achatpa) !!!");      
					  $num = @mysqli_num_rows($res) or die("<br> Pas de typeproduit (achatpa) !!!");      
					  $produit = mysqli_fetch_array($res);      
					  
					  $type_prod = $produit['typeproduit'];      
					  $prod_libelle = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['nomproduit']));      
					  $image = $produit['image'];      
					  $description = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['description']));
					  
					  $fct_mes_vente_libtype_prod = $prod_libelle;      
					  
					  $sql = "SELECT emaileco FROM eco_pays WHERE idpays = '$idpaysB';";      
					  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche paysB (achatproduit) !!!");      
					  $num = @mysqli_num_rows($res) or die("<br> Pas de paysB (achatproduit) !!!");      
					  $produit = mysqli_fetch_array($res);
					  
					  $fct_mes_vente_emaileco = $produit['emaileco'];      
					  
					  // Recherche info type produit      
					  $sql = "SELECT libelle,typeequi FROM eco_typeproduit WHERE typeproduit = '$type_prod';";      
					  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche typeproduit (achatpa) !!!");      
					  $num = @mysqli_num_rows($res) or die("<br> Pas de typeproduit type produit (achatpa) !!!");      
					  $produit = mysqli_fetch_array($res);      
					  
					  $type_prodequi = $produit['typeequi'];      
					  $type_prod_libelle = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['libelle']));      
					  
					  // Recherche info type mati�re      
					  $sql = "SELECT libelle FROM eco_typeproduit WHERE typeproduit = '$idunite';";      
					  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche typeproduit (achatpa) !!!");      
					  $num = @mysqli_num_rows($res) or die("<br> Pas de typeproduit unite (achatpa) !!!");      
					  $produit = mysqli_fetch_array($res);      
					  
					  $type_unite_libelle = Str_replace( "\"", " ", Str_replace( "'", " ", $produit['libelle']));      
					  
					  // Recherche taxe      
					  $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '$type_prod';";      
					  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche taxe (achatpa) !!!");      
					  if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau produit      
					  {        
					  	$sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '$type_prodequi';";        
						  $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche taxe (achatpa) !!!");        
						  if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau equivalent produit        
						  {            
							  $sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysA' AND typeproduit = '00000';";            
						  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche taxe (achatpa) !!!");            
						  	
						  	if (!($num = @mysqli_num_rows($res)))  // pas de taxe du tout !            
						  	{              
						  		$taxe = 0;            
						  	}            
						  	else            
						  	{              
						  		$produit = mysqli_fetch_array($res);              
						  		$taxe = $produit['taxe'];            
						  	}        
						  }        
						  else        
						  {          
						  	$produit = mysqli_fetch_array($res);          
						  	$taxe = $produit['taxe'];        
						  }      
						}      
						else      
						{        
						 	$produit = mysqli_fetch_array($res);        
						 	$taxe = $produit['taxe'];      
						}      
						
						if ($idpaysB != $idpaysA)      
						{        
						 	$sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '$type_prod';";        
						 	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche taxe (achatpa) !!!");        
						  	
						 	if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau produit        
						 	{          
						  	$sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '$type_prodequi';";          
						  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche taxe (achatpa) !!!");          
						  	
						  	if (!($num = @mysqli_num_rows($res)))  // pas de taxe au niveau equivalent produit          
						  	{              
							  	$sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '$idpaysA' AND idpays2 = '$idpaysB' AND typeproduit = '00000';";              
						  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche taxe (achatpa) !!!");              
						  	
						  		if (!($num = @mysqli_num_rows($res)))  // pas de taxe du tout !              
						  		{                
						  			$taxe = $taxe;              
						  		}              
						  		else              
						  		{                
						  			$produit = mysqli_fetch_array($res);                
						  			$taxe = $produit['taxe'] + $taxe;              
						  		}          
						  	}          
						  	else          
						  	{            
						  		$produit = mysqli_fetch_array($res);            
						  		$taxe = $produit['taxe'] + $taxe;          
						  	}        
						 	}        
						 	else        
						 	{          
						  	$produit = mysqli_fetch_array($res);          
						  	$taxe = $produit['taxe'] + $taxe;        
						 	}      
						}      
						
						$tarif_total_ht = $tarif;      
						  	
						if ($taxe > 0)        
							$tarif_total_ttc = $tarif_total_ht * ($taxe + 1);      
						else        
							$tarif_total_ttc = $tarif_total_ht;      
						  	
						$newsoldeA = $soldeA - $tarif_total_ttc;      
						  	
						if ($newsoldeA < 0)        
							die ("Solde acheteur insuffisant...");      
						  	
						if ($taxe > 0)        
							$tarif_total_taxe = $tarif_total_ht * $taxe;      
						else        
							$tarif_total_taxe = 0;      
						  	
						// Recherche compte taxe et banque 1 si devise      
						$sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseA' AND idpays1 = '$idpaysA';";      
						$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche compte taxe (achatpa) !!!");      
						  	
				  	if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...        
				  		die("Pas de compte associé à la taxe... contactez votre responsable");      
	
				  	$produit = mysqli_fetch_array($res);      
	
				  	$taxe_cpte_cred = $produit['idcompte'];      
						  	
				  	// V�rification de la devise du compte      
				  	$sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$taxe_cpte_cred';";      
				  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche devise compte taxe (achatpa) !!!");      
	
				  	if (!($num = @mysqli_num_rows($res)))  // pas compte taxe...        
					  	die("Le compte associé à la Taxe n'existe pas... contactez votre responsable");      
		
				  	$produit = mysqli_fetch_array($res);      
		
				  	if ($deviseA != $produit['devise'])  // mauvaise devise compte taxe...        
				  		die("La devise du compte associé à la Taxe n'est pas bonne... contactez votre responsable");      
		
				  	$newsolde_cpte_taxe = $produit['solde'] + $tarif_total_taxe;      
		
				  	// Recherche compte taux de change      
				  	if ($deviseA != $deviseB)      
				  	{        
					  	$sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$deviseB' AND idpays1 = '$idpaysA';";        
					  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche compte taux (achatpa) !!!");        
		
					  	if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...          
						  		die("Pas de compte associé au Taux de change... contactez votre responsable");        
		
					  	$produit = mysqli_fetch_array($res);        
					  	
					  	$taux_cpte_deb = $produit['idcompte'];        
					  	
					  	// V�rification de la devise et du solde du compte        
					  	$sql = "SELECT solde,devise FROM eco_banque WHERE idcompte = '$taux_cpte_deb';";        
					  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche devise compte taux (achatpa) !!!");        
					  	
					  	if (!($num = @mysqli_num_rows($res)))  // pas compte taux de change...          
					  		die("Le compte associé au Taux de change n'existe pas... contactez votre responsable");        
					  	
					  	$produit = mysqli_fetch_array($res);        
					  	
					  	if ($deviseB != $produit['devise'])  // mauvaise devise compte taux de change...          
					  		die("La devise du compte associé au Taux de change n'est pas bonne... contactez votre responsable");        
					  	
					  	$solde_cpte_taux = $produit['solde'];        
					  	
					  	// Recherche compte taux de change        
					  	$sql = "SELECT taux FROM eco_tauxchange WHERE devise1 = '$deviseB' AND devise2 = '$deviseA';";        
					  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche compte taux (achatpa) !!!");        
					  	
					  	if (!($num = @mysqli_num_rows($res)))  // pas de taux de change...          
					  		die("Pas de Taux de change... contactez votre responsable");        
					  	
					  	$produit = mysqli_fetch_array($res);        
					  	
					  	$taux = $produit['taux'];        
					  	
					  	$tarif_taux = $tarif_total_ht * $taux;        
					  	
					  	if ($tarif_taux > $solde_cpte_taux)  // solde compte taux de change insuffisant...          
					  		die("Le solde du compte associé au Taux de change est insuffisant... contactez votre responsable");        
					  	
					  	$newsolde_cpte_taux = $solde_cpte_taux - $tarif_taux;        
					  	
					  	// taux de change donc banque taxe = banque 1        
					   	$newsolde_cpte_taxe = $newsolde_cpte_taxe + $tarif_total_ht;      
					  }
					  else        
					  	$tarif_taux = $tarif_total_ht;      
					  
					  $newsoldeB = $soldeB + $tarif_taux;      
					  	
					  // Fin contr�les      
					  //--------------      
					  	
					  $libelletransaction = "Achat par " . $nomA . " de 1 " . $prod_libelle . " ( " . $nbunite . " " . $type_unite_libelle . " ) ";      
					  $libelletransaction .= " à " . $nomB;      
					  	
					  $libelletransactiontaxe = "Taxe : " . $libelletransaction;      
					  	
					  // => Possession      
					  //----------------------      
					  	
					  // Maj Possession      
					  $sql = "UPDATE eco_possession SET etat = '0', idpossesseur = '$entreA' WHERE idpossession = '$idprod';";      
					  $res = @mysqli_query($conn, $sql) or die("<br> PB de màj le stock. (achatpa)");      
					  	
					  // => Transactions      
					  //----------------      
				  	
					  // Taxe :(      
					  if ($tarif_total_taxe > 0)      
					  {
					  	
					  	// Transaction d�bitrice        
					  	$tarif_total_taxe_neg = $tarif_total_taxe * -1;
					  	$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taxe_cpte_cred','$tarif_total_taxe_neg','$deviseA','$libelletransactiontaxe',NOW());";
					  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete débitrice taxe (achatpa) !!!");
					  	
					  	// Transaction cr�ditrice
					  	$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$idcpte1','$tarif_total_taxe','$deviseA','$libelletransactiontaxe',NOW());";
					  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete créditrice taxe (achatpa) !!!");
					  }
					  	
				  	// Maj solde Taxe et Banque 1 si taux de change
				  	$sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taxe' WHERE idcompte = '$taxe_cpte_cred';";
				  	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete maj compte taxe (achatpa) !!!");
				  	
				  	// Comptes utilisateurs :) et �ventuellement Taux de change
				  	if ($deviseA == $deviseB)   // Pas de taux de change
				  	{
				  	
				  		// Transaction d�bitrice        
				  		$tarif_total_ht_neg = $tarif_total_ht * -1;        
				  		$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$idcpte2','$tarif_total_ht_neg','$deviseA','$libelletransaction',NOW());";        
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete débitrice (achatpa) !!!");        
				  	
				  		// Transaction cr�ditrice        
				  		$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$idcpte1','$tarif_taux','$deviseB','$libelletransaction',NOW());";        
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete créditrice (achatpa) !!!");        
				  		
				  		// M�j solde d�bit�        
				  		$sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";        
				  		$res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Acheteur. (achatpa)");        
				  		
				  		// M�j solde cr�dit�        
				  		$sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";        
				  		$res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Vendeur. (achatpa)");      
				  	}      
				  	else      
				  	{        
			  			// Transactions : Acheteur -> Banque 1 - Banque 2 -> Vendeur (Banque 1 =aussi Banque Taxe)        
				  		// Acheteur -> Banque 1 : mvts        
				  		$tarif_total_ht_neg = $tarif_total_ht * -1;        
	
				  		$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte1','$taxe_cpte_cred','$tarif_total_ht_neg','$deviseA','$libelletransaction',NOW());";        
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete débitrice Acheteur (achatpa) !!!");        
				
				  		$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$idcpte1','$tarif_total_ht','$deviseA','$libelletransaction',NOW());";        
			  			$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete créditrice Banque nationale (achatpa) !!!");        
			  		
			  			// Acheteur -> Banque 1 : solde Acheteur        
			  			$sql = "UPDATE eco_banque SET solde = '$newsoldeA' WHERE idcompte = '$idcpte1';";        
				  		$res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde solde Acheteur.");        

				  		// Acheteur -> Banque 1 : solde Banque 1 d�j� fait avec Taxe        
				  		// Banque 2 -> Vendeur : mvts        
				  		$tarif_taux_neg = $tarif_taux * -1;        

				  		$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$idcpte2','$taux_cpte_deb','$tarif_taux','$deviseB','$libelletransaction',NOW());";        
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete créditrice Vendeur (achatpa) !!!");        
			  
			  			$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taux_cpte_deb','$idcpte2','$tarif_taux_neg','$deviseB','$libelletransaction',NOW());";        
			  			$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete débitrice Banque 2 (achatpa) !!!");        
			  		
			  			// M�j solde cr�dit� vendeur        
				  		$sql = "UPDATE eco_banque SET solde = '$newsoldeB' WHERE idcompte = '$idcpte2';";        
				  		$res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Vendeur. (achatpa)");        
			  		
				  		// M�j solde d�bit� banque taux        
				  		$sql = "UPDATE eco_banque SET solde = '$newsolde_cpte_taux' WHERE idcompte = '$taux_cpte_deb';";        
				  		$res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Banque 2. (achatpa)");      
			  		}        
				  		
				  	// Immobilier        
				  	if ($type_prodequi == '20000')        
				  	{                
				  		$sql = "UPDATE eco_immo SET idproprio = '$entreA', datemaj = NOW() WHERE idpossession = '$idprod';";                
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete immo (achatpa) !!!");        
				  	}  
				  }
				  else
				  {
					  if (($objet == "LOCATION") && ($reponse == "A"))  
					  {    
					  	//  $datatransaction = $idcpte1 . "|" . $idcpte2 . "|" . $entreA . "|" . $entreB . "|" . $idprod . "|" . $nbunite . "|" . $idunite . "|" . $tarif;    
					  	//   100001|100002|2|1|1|8|80006|10    
					  	$tab_data = explode("|",$data);        
					  
				  		$idcpte1 = $tab_data[0];        
				  		$idcpte2 = $tab_data[1];        
				  		$entreA = $tab_data[2];        
				  		$entreB = $tab_data[3];//        
				  		$idprod = $tab_data[4];        
				  		$nbunite = $tab_data[5];        
				  		$idunite = $tab_data[6];        
				  		$montant = $tab_data[7];  
	
				  		$jour = "1";  
				  		$periodicite = "1";      
					  		
				  		// D�but contr�les      
				  		//----------------      
					  		
				  		// Recherche info du compte d'origine      
				  		$sql = "SELECT devise,solde FROM eco_banque WHERE idcompte = '$idcpte1';";      
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche du compte 1 (achatpa location) !!!");      
				  		$num = @mysqli_num_rows($res) or die("<br> Pas de compte 1 periodique (achatpa location) !!!");      
				  		$produit = mysqli_fetch_array($res);      
				  		
				  		$deviseA = $produit['devise'];      
				  		
				  		// Recherche info id 1      
				  		$sql = "SELECT nomentreprise,idpays,iduser FROM eco_entreprise WHERE identreprise = '$entreA';";      
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche entreprise 1 (achatpa location) !!!");      
				  		if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une entreprise      
				  		{          
					  		$sql = "SELECT nom,idpays,iduser FROM eco_user WHERE iduser = '$entreA';";          
					  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche user 1 (achatpa location) !!!");          
	
					  		if (!($num = @mysqli_num_rows($res)))  // ce n'est pas une personne ...          
					  		{            
						  		$sql = "SELECT nompays,idpays,iduser FROM eco_pays WHERE idpays = '$entreA';";            
						  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche pays 1 (achatpa location) !!!");            
					  		
						  		if (!($num = @mysqli_num_rows($res)))  // ce n'est pas un pays, pd !!              
						  			die ("le bailleur n'existe pas !!");            
					  		
						  		$produit = mysqli_fetch_array($res);            
					  			$idpaysA = $produit['idpays'];          
					  		}          
					  		else          
					  		{            
					  			$produit = mysqli_fetch_array($res);            
					  			$idpaysA = $produit['idpays'];          
					  		}      
					  	}      
					  	else      
					  	{          
					  		$produit = mysqli_fetch_array($res);          
					  		$idpaysA = $produit['idpays'];      
					  	}      
					  		
				  		// => Transaction      
				  		//----------------      
				  		if ($jour == '1') $jourj = '01';      
				  		if ($jour == '2') $jourj = '15';      
				  		if ($jour == '3') $jourj = '31';          
				  		$t1 = time();      
				  		$moisj = date("m",$t1);      
				  		$datej = date("Y",$t1);      
				  		$date_jour = $datej . "-" . $moisj . "-" . $jourj;      
				  		$mois0 = substr($date_jour,5,2) + $periodicite;      
				  		if ($mois0 > 12)      
				  		{      	
				  			$mois0 = $mois0 - 12;      	
				  			$datej++;      
				  		}      
				  		if ($mois0 < 10)         
				  			$mois0 = "0" . $mois0;      
	
				  		$dateprochain = $datej . "-" . $mois0 . "-" . $jourj;      
				  		
				  		$sql = "INSERT INTO eco_tranperiodique (idtransac,idcpte1,montant,devise,idpays,idcpte2,commentaire,periodicite,jour,datedebut,dateprochain) VALUES (NULL,'$idcpte1','$montant','$deviseA','$idpaysA','$idcpte2','$com','$periodicite','$jour',NOW(),'$dateprochain');";      
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete insert transac periodique (achatpa location) !!!");      
				  		
				  		// Maj Possession      
				  		$sql = "UPDATE eco_possession SET etat = '3' WHERE idpossession = '$idprod';";      
				  		$res = @mysqli_query($conn, $sql) or die("<br> PB de màj possession. (achatpa location)");      
				  		
				  		// Maj Immo      
				  		$sql = "UPDATE eco_immo SET idlocataire = '$entreA', datemaj = NOW(), prix = '$montant', devise = '$deviseA' WHERE idpossession = '$idprod';";                
				  		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete immo (achatpa location) !!!");  
				  	}
					}				  		

			  	// Maj Message  
			  	$sql = "UPDATE eco_message SET reponse = '$reponse' WHERE idmsg = '$idmsg';";  
		  		$res = @mysqli_query($conn, $sql) or die("<br> PB de màj le message. (achatpa)");  
			  		
		  		// Envoi du message  
		  		include("../include/fct_mes_vente.php");  
		  		echo "<script language=\"JavaScript\"> 
		  		document.location.replace(\"../messagerie.php\");
		  		</script>";
?>
</body>
</html>