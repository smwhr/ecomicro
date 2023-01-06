<?php

$sql = "SELECT DISTINCTROW eco_histo.idunite ";
$sql .= "FROM eco_histo ";
$sql .= "WHERE eco_histo.identreprise = '$entreprise' ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête 1 (FINANCE_)");
$num = @mysqli_num_rows($res);

$nb_produitfini = $num;
$nb_ligne_produitfini = ($num * 2) + 1;

$tmp = "var FINANCE_HISTO = new Array(";
echo $tmp, $nb_ligne_produitfini,");";

$tmp = "for(var i=0; i < FINANCE_HISTO.length; i++)";
echo $tmp;
$tmp = "FINANCE_HISTO[i]=new Array(13);";
echo $tmp;

$tt = time();
$mois = date("m",$tt);
  
$tmp = "FINANCE_HISTO[0][1] = 'Janv';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][2] = 'Fevr';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][3] = 'Mars';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][4] = 'Avri';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][5] = 'Mai';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][6] = 'Juin';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][7] = 'Juil';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][8] = 'Aout';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][9] = 'Sept';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][10] = 'Oct';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][11] = 'Nov';";
echo $tmp;
$tmp = "FINANCE_HISTO[0][12] = 'Dec';";
echo $tmp;

$tmp = "FINANCE_HISTO[0][" . $mois . "] = FINANCE_HISTO[0][" . $mois . "] + '<BR>X';";
echo $tmp;


$sql = "SELECT DISTINCTROW eco_histo.idunite, eco_typeproduit.libelle, eco_histo.mois, eco_histo.action, eco_histo.nb, eco_histo.cout, eco_histo.devise ";
$sql .= "FROM eco_histo,eco_typeproduit ";
$sql .= "WHERE eco_histo.identreprise = '$entreprise' ";
$sql .= "AND eco_histo.idunite = eco_typeproduit.typeproduit ";
$sql .= "AND eco_histo.datemaj > DATE_FORMAT(NOW() - INTERVAL 11 MONTH, '%Y-%m-01') ";
$sql .= "ORDER BY eco_typeproduit.libelle, eco_histo.mois, eco_histo.action ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête 2 (FINANCE_) ".$sql);
$num = @mysqli_num_rows($res);

$tmp_nb1 = 0;
$tmp_nb2 = 0;
while($produit = mysqli_fetch_array($res)){
	if ($produit["idunite"] != $tmp_idunite){
		$tmp_idunite = $produit["idunite"];
		$tmp_nb1 = $tmp_nb2 + 1;
		$tmp = "FINANCE_HISTO[" . $tmp_nb1 . "][0] = 'Vente<BR>" . $produit["libelle"] . "';";
		echo $tmp;
		$tmp_nb2 = $tmp_nb1 + 1;
		$tmp = "FINANCE_HISTO[" . $tmp_nb2 . "][0] = 'Produit<BR>" . $produit["libelle"] . "';";
		echo $tmp;
  }

	if ($produit["action"] == '1')
		$tmp = "FINANCE_HISTO[" . $tmp_nb1 . "][" . $produit["mois"] . "] = '" . $produit["nb"] . "<BR>" . $produit["cout"] . " " . $produit["devise"] . "';";
	if ($produit["action"] == '2')
		$tmp = "FINANCE_HISTO[" . $tmp_nb2 . "][" . $produit["mois"] . "] = '" . $produit["nb"] . "<BR>" . $produit["cout"] . " " . $produit["devise"] . "';";
	echo $tmp;
}

// Valeur du stock

$sql = "SELECT DISTINCTROW eco_stock.idunite ";
$sql .= "FROM eco_stock ";
$sql .= "WHERE eco_stock.identreprise = '$entreprise' ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête 3 (FINANCE_)");
$num = @mysqli_num_rows($res);

$nb_ligne_stock = $num + 1;

$tmp = "var FINANCE_STOCK = new Array(";
echo $tmp, "3);";

$tmp = "for(var i=0; i < FINANCE_STOCK.length; i++)";
echo $tmp;
$tmp = "FINANCE_STOCK[i]=new Array(" . $nb_ligne_stock . ");";
echo $tmp;


$tmp = "FINANCE_STOCK[0][0] = ' ';";
echo $tmp;
$tmp = "FINANCE_STOCK[1][0] = 'Quantité';";
echo $tmp;
$tmp = "FINANCE_STOCK[2][0] = 'PR moyen';";
echo $tmp;


$sql = "SELECT DISTINCTROW eco_stock.idunite, eco_typeproduit.libelle, eco_stock.quantite, eco_stock.prixrevient, eco_stock.devise ";
$sql .= "FROM eco_stock,eco_typeproduit ";
$sql .= "WHERE eco_stock.identreprise = '$entreprise' ";
$sql .= "AND eco_stock.idunite = eco_typeproduit.typeproduit ";
$sql .= "ORDER BY eco_typeproduit.libelle ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te 4 (FINANCE_)");
$num = @mysqli_num_rows($res);

$tmp_nb1 = 0;
while($produit = mysqli_fetch_array($res))
{
	$tmp_nb1++;
	$tmp = "FINANCE_STOCK[0][" . $tmp_nb1 . "] = '" . $produit["libelle"] . "';";
	echo $tmp;
	$tmp = "FINANCE_STOCK[1][" . $tmp_nb1 . "] = '" . $produit["quantite"] . "';";
	echo $tmp;
	$tmp = "FINANCE_STOCK[2][" . $tmp_nb1 . "] = '" . $produit["prixrevient"] . " " . $produit["devise"] . "';";
	echo $tmp;
}


// Situation trésorerie des derniers mois

$sql = "SELECT eco_mvtbanque.idcompte, eco_banque.nomcpte, DATE_FORMAT(eco_mvtbanque.dateheure, '%Y-%m') as moisOrder, DATE_FORMAT(eco_mvtbanque.dateheure, '%M') as mois, sum(eco_mvtbanque.montant) as resultat, eco_mvtbanque.devise ";
$sql .= "FROM eco_mvtbanque, eco_banque ";
$sql .= "WHERE eco_banque.idtitulaire = '$entreprise' ";
$sql .= "AND eco_banque.idcompte = eco_mvtbanque.idcompte ";
$sql .= "AND eco_mvtbanque.dateheure > DATE_FORMAT(NOW() - INTERVAL 4 MONTH, '%Y-%m-01') ";
$sql .= "GROUP BY moisOrder, mois, devise, eco_mvtbanque.idcompte ";
$sql .= "ORDER BY moisOrder, idcompte ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête 4 (FINANCE_RESULTAT)");
$num = @mysqli_num_rows($res);

$nb_ligne_resultat = $num + 1;

$tmp = "var FINANCE_RESULTAT = new Array(" . $nb_ligne_resultat . ");";
echo $tmp;

$tmp = "for(var i=0; i < FINANCE_RESULTAT.length; i++)";
echo $tmp;
$tmp = "FINANCE_RESULTAT[i]=new Array(5);";
echo $tmp;


$tmp = "FINANCE_RESULTAT[0][0] = 'Compte';";
echo $tmp;
$tmp = "FINANCE_RESULTAT[0][1] = 'Libellé';";
echo $tmp;
$tmp = "FINANCE_RESULTAT[0][2] = 'Mois';";
echo $tmp;
$tmp = "FINANCE_RESULTAT[0][3] = 'Résultat';";
echo $tmp;
$tmp = "FINANCE_RESULTAT[0][4] = 'Devise';";
echo $tmp;


$tmp_nb1 = 0;
while($produit = mysqli_fetch_array($res))
{
	$tmp_nb1++;
	$tmp = "FINANCE_RESULTAT[" . $tmp_nb1 . "][0] = '" . $produit["idcompte"] . "';";
	echo $tmp;
	$tmp = "FINANCE_RESULTAT[" . $tmp_nb1 . "][1] = '" . $produit["nomcpte"] . "';";
	echo $tmp;
	$tmp = "FINANCE_RESULTAT[" . $tmp_nb1 . "][2] = '" . $produit["mois"] . "';";
	echo $tmp;
	$tmp = "FINANCE_RESULTAT[" . $tmp_nb1 . "][3] = '" . $produit["resultat"] . "';";
	echo $tmp;
	$tmp = "FINANCE_RESULTAT[" . $tmp_nb1 . "][4] = '" . $produit["devise"] . "';";
	echo $tmp;
}



?>







