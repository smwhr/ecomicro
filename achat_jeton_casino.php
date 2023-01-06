<?php
header('Access-Control-Allow-Origin: *');
/*
$etape = $_GET['etape'];

$quoi = $_GET['quoi'];
$nb = $_GET['nbjeton'];
$tarif = $_GET['tarif'];
$devise = $_GET['devise'];
$id = $_GET['id'];
$retour = $_GET['retour'];

if (($etape == "") && ($quoi == "")){
	etape = $_POST['etape'];

	$quoi = $_POST['quoi'];
	$nb = $_POST['nbjeton'];
	$tarif = $_POST['tarif'];
	$devise = $_POST['devise'];
	$id = $_POST['id'];
	$retour = $_POST['retour'];

	$etape = $_POST['etape'];
	$login = $_POST['a'];
	$mdp = $_POST['b'];
	$cpteDeb = $_POST['f'];
}
*/

$etape = $_GET['etape'];


$quoi = $_GET['quoi'];
$nb = $_GET['nbjeton'];
$tarif = $_GET['tarif'];
$devise = $_GET['devise'];
$id = $_GET['id'];
$retour = $_GET['retour'];

$etape = $_GET['etape'];
$login = $_GET['a'];
$mdp = $_GET['b'];
$cpteDeb = $_GET['f'];

if (($quoi == "" ) || ($devise == "" ) || ($tarif <= 0 ) || ($tarif > 10000 ) || ($nb <= 0 ) || ($nb > 1000 ) || ($id == "" ) || ($id == 0 ))
	die("Mauvais appel");
if ($etape > ""){
	if (($login == "" ) || ($mdp == "" ))
		die("Mauvais appel");
}
if ($etape == "2"){
	if (($cpteDeb <= 0 ) || ($cpteDeb > 200000 ))
		die("Mauvais appel");
}

$html = "";

if ($etape == ""){
		
	$html .= "<FORM action='http://micromonde.ecomicro.net/achat_jeton_casino.php' method='get'>";
		
	$html .= "<TABLE>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Login (Ecomicro)";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<INPUT type='text' value='' id='a' name='a'>";
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Mot de passe (Ecomicro)";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<INPUT type='password' value='' id='b' name='b'>";
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<INPUT type='hidden' value='".$quoi."' id='quoi' name='quoi'>".$quoi;
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Nb de jeton";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<INPUT type='hidden' value='".$nb."' id='nbjeton' name='nbjeton'>".$nb;
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Montant";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<INPUT type='hidden' value='".$tarif."' id='tarif' name='tarif'>".$tarif.$devise;
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD colspan=2>";
		$html .= "<INPUT type='submit' value='Connexion'/>";
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD colspan=2>";
		$html .= "<INPUT type='hidden' value='1' id='etape' name='etape'/>";
		$html .= "<INPUT type='hidden' value='".$id."' id='id' name='id'>";
		$html .= "<INPUT type='hidden' value='".$retour."' id='retour' name='retour'>";
		$html .= "<INPUT type='hidden' value='".$devise."' id='devise' name='devise'>";
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "</TABLE>";
	$html .= "</FORM>";
}
else if ($etape > ""){
	include("include/config.php");
	$id_bdd = @mysql_connect($host,$user,$pass) or die("Verif 9 - Impossible de se connecter");
	@mysqli_select_db($conn, $bdd) or die("Verif 10 - Impossible de se connecter à la base de données");

	$sql = "SELECT iduser, nom ";
	$sql .= "FROM eco_user ";
	$sql .= "WHERE login = '$login' AND pwd = DES_ENCRYPT('$mdp');";
	$resUser = @mysqli_query($conn, $sql) or die("Erreur au niveau de l'identification");
	$numUser = @mysqli_num_rows($resUser);

	if ($numUser < 1) die("Identification KO");

	$dataUser = mysqli_fetch_array($resUser);
	$iduser = $dataUser["iduser"];
}

if ($etape == "1"){
	if ($quoi == "CASINO")
		$cpte = 101080;

	$sql = "SELECT nomcpte ";
	$sql .= "FROM eco_banque ";
	$sql .= "WHERE idcompte = '$cpte' AND devise = '$devise';";
	$resCompte = @mysqli_query($conn, $sql) or die("Erreur dans la requète de recherche du compte crédité !!!");
	$numCompte = @mysqli_num_rows($resCompte);

	if ($numCompte < 1) die("Compte crédité KO");

	$dataCompte = mysqli_fetch_array($resCompte);
	$nomcpte = $dataCompte["nomcpte"];

	$sql = "SELECT idcompte, nomcpte, solde, devise ";
	$sql .= "FROM eco_banque ";
	$sql .= "WHERE idtitulaire = '$iduser' AND devise = '$devise' AND solde >= '$tarif';";
	$resCompteUser = @mysqli_query($conn, $sql) or die("Erreur dans la requète de recherche des comptes débités !!!");
	$numCompteUser = @mysqli_num_rows($resCompteUser);

	if ($numCompteUser < 1) die("Compte débiteur KO");
		
	$html .= "<FORM action='http://micromonde.ecomicro.net/achat_jeton_casino.php' method='get' >";
		
	$html .= "<TABLE>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Montant";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= $tarif . $devise;
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Compte débité";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<SELECT id='f' name='f'>";
		while ($dataCompteUser = mysqli_fetch_array($resCompteUser)){
		
			$html .= "<OPTION value='".$dataCompteUser['idcompte']."' >".$dataCompteUser['nomcpte']." (".$dataCompteUser['solde'].$dataCompteUser['devise'].")";
		
		}
		$html .= "</SELECT>";
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Compte crédité";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= $nomcpte . " (" . $cpte . ")";
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<INPUT type='hidden' value='".$quoi."' id='quoi' name='quoi'>".$quoi;
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Nb de jeton";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<INPUT type='hidden' value='".$nb."' id='nbjeton' name='nbjeton'>".$nb;
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD>";
		$html .= "Montant";
		$html .= "</TD>";
		$html .= "<TD>";
		$html .= "<INPUT type='hidden' value='".$tarif."' id='tarif' name='tarif'>".$tarif.$devise;
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD colspan=2>";
		$html .= "<INPUT type='submit' />";
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "<TR>";
		$html .= "<TD colspan=2>";
		$html .= "<INPUT type='hidden' value='".$login."' id='a' name='a'/>";
		$html .= "<INPUT type='hidden' value='".$mdp."' id='b' name='b'/>";
		$html .= "<INPUT type='hidden' value='".$id."' id='id' name='id'>";
		$html .= "<INPUT type='hidden' value='".$devise."' id='devise' name='devise'>";
		$html .= "<INPUT type='hidden' value='".$retour."' id='retour' name='retour'>";
		$html .= "<INPUT type='hidden' value='2' id='etape' name='etape'/>";
		$html .= "</TD>";
	$html .= "</TR>";
	$html .= "</TABLE>";
	$html .= "</FORM>";
}
else if ($etape == "2"){
	if ($quoi == "CASINO")
		$cpte = 101080;

	$sql = "SELECT nomcpte, solde ";
	$sql .= "FROM eco_banque ";
	$sql .= "WHERE idcompte = '$cpte' AND devise = '$devise';";
	$resCompte = @mysqli_query($conn, $sql) or die("Erreur dans la requète de recherche du compte crédité !!!");
	$numCompte = @mysqli_num_rows($resCompte);
	if ($numCompte < 1) die("Compte crédité KO");
	$dataCompte = mysqli_fetch_array($resCompte);
	$nomcpte = $dataCompte["nomcpte"];

	$sql = "SELECT nomcpte, solde, devise ";
	$sql .= "FROM eco_banque ";
	$sql .= "WHERE idtitulaire = '$iduser' AND devise = '$devise' AND solde >= '$tarif' AND idcompte = '$cpteDeb';";
	$resCompteUser = @mysqli_query($conn, $sql) or die("Erreur dans la requète de recherche des comptes débités !!!");
	$numCompteUser = @mysqli_num_rows($resCompteUser);
	if ($numCompteUser < 1) die("Compte débiteur KO");

	// Recherche taxe
	$sql = "SELECT taxe FROM eco_taxeimport WHERE idpays1 = '1' AND idpays2 = '1' AND typeproduit = '00000';";
	$resTaxe = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche taxe ");
	if (!($numTaxe = @mysqli_num_rows($resTaxe)))
		$taxe = 0;
	else {
		$dataTaxe = mysqli_fetch_array($resTaxe);
		$taxe = $dataTaxe['taxe'];
	}
	// Recherche compte taxe et banque 1 si devise
	$sql = "SELECT idcompte FROM eco_tauxchange WHERE devise2 = '$devise' AND idpays1 = '1';";
	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche compte taxe !!!");
	$dataCompteTaxe = mysqli_fetch_array($res);      
	$taxe_cpte_cred = $dataCompteTaxe['idcompte'];
	
	if ($taxe > 0)        
		$tarif_total_taxe = $tarif * $taxe;      
	else        
		$tarif_total_taxe = 0;

	$libelletransaction = "Achat par " . $dataUser["nom"] . " de " . $nb . " jetons de Casino pour un montant HT de " . $tarif;      
	$libelletransactiontaxe = "Taxe : " . $libelletransaction;      

	if ($tarif_total_taxe > 0) {
		// Transaction débitrice        
		$tarif_total_taxe_neg = $tarif_total_taxe * -1;
		$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$cpteDeb','$taxe_cpte_cred','$tarif_total_taxe_neg','$devise','$libelletransactiontaxe',NOW());";
		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete débitrice taxe ");
		// Transaction créditrice
		$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$taxe_cpte_cred','$cpteDeb','$tarif_total_taxe','$devise','$libelletransactiontaxe',NOW());";
		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete créditrice taxe ");
		// Maj solde Taxe et Banque 1 si taux de change
		$sql = "UPDATE eco_banque SET solde = solde + '$tarif_total_taxe' WHERE idcompte = '$taxe_cpte_cred';";
		$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete maj compte taxe ");
	}

	// Transaction débitrice
	$tarif_total_ht_neg = $tarif * -1;        
	$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$cpteDeb','$cpte','$tarif_total_ht_neg','$devise','$libelletransaction',NOW());";
	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete débitrice ");

	// Transaction créditrice
	$sql = "INSERT INTO eco_mvtbanque (idmvt,idcompte,idcompteaux,montant,devise,commentaire,dateheure) VALUES (NULL,'$cpte','$cpteDeb','$tarif','$devise','$libelletransaction',NOW());";
	$res = @mysqli_query($conn, $sql) or die("Erreur dans la requete créditrice");
	
	// Màj solde débité
	$sql = "UPDATE eco_banque SET solde = solde - '$tarif' WHERE idcompte = '$cpteDeb';";
	$res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Acheteur.");
	
	// Màj solde crédité
	$sql = "UPDATE eco_banque SET solde = solde + '$tarif' WHERE idcompte = '$cpte';";
	$res = @mysqli_query($conn, $sql) or die("<br> PB de màj le solde Vendeur.");

	//Maj du nb de jeton
	@mysql_close($id_bdd);
	@mysql_connect("localhost","prya","nationprya") or die("Verif 9 - Impossible de se connecter");
	@mysqli_select_db("nationprya") or die("Verif 18 - Impossible de se connecter à la base de données");
//	$sql = "UPDATE casino_membres SET jeton = jeton + '$nb' WHERE idmembre = '$id';";
//	$res = @mysqli_query($conn, $sql) or die("<br> PB de màj solde jeton casino.");
	$sql = "UPDATE a1_comprofiler SET cb_casinonbjeton = cb_casinonbjeton + '$nb' WHERE id = '$id';";
	$res = @mysqli_query($conn, $sql) or die("<br> PB de màj solde jeton CB.");

	$html = "Transaction effectuée.<BR><a href='".$retour."'>Retour</a>";
}	


echo $html;	

?>