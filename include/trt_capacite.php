<?php


// Liste des état
$sql = "SELECT idpays, devise ";
$sql .= "FROM eco_pays;";
$result = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche pays (trtcnx) !!!");
$num = @mysqli_num_rows($result);

if ($num > 0){
  while($produit1 = mysqli_fetch_array($result)){
    $idpays = $produit1["idpays"];
    $devise = $produit1["devise"];

    // Recherche des entreprises actives du secteur primaire de 10000 à 19999  + 4000 du pays sélectionné
    // avec un directeur actif
    $sql = "SELECT sum(capacite) as capmax ";
    $sql .= "FROM eco_entreprise, eco_user ";
    $sql .= "WHERE (typeentreprise = '40000' OR (typeentreprise >= '10000' AND typeentreprise < '20000')) ";
    $sql .= "AND eco_entreprise.idpays = '$idpays' AND eco_entreprise.iduser = eco_user.iduser ";
    $sql .= "AND eco_user.inactif = '0' ";

    $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche capacite (trtcnx) !!!");
    $produit = mysqli_fetch_array($res);

    $capmax = $produit["capmax"];

    if ($capmax <= 0)
      continue;

    // Recherche du nombre de citoyen
    $sql = "SELECT count(iduser) as nbuser ";
    $sql .= "FROM eco_user ";
    $sql .= "WHERE idpays = '$idpays' AND inactif = '0' ;";

    $res = @mysqli_query($conn, $sql) or die("Erreur dans la requete de recherche capacite (trtcnx) !!!");
    $num = @mysqli_num_rows($res);
    if ($num <= 0)
	continue;

    $produit = mysqli_fetch_array($res);

    $nbuser = $produit["nbuser"];

    if (($nbuser * 100) > $capmax)
      $facteur = 1;
    else
      $facteur = ($nbuser * 100) / $capmax;

    $sql = "UPDATE eco_entreprise SET capacitemens = (capacite * '$facteur') ";
    $sql .= "WHERE (typeentreprise = '40000' OR (typeentreprise >= '10000' AND typeentreprise < '20000')) ";
    $sql .= "AND eco_entreprise.idpays = '$idpays' AND eco_entreprise.iduser IN (SELECT eco_user.iduser ";
    $sql .= "FROM eco_user WHERE eco_user.inactif ='0') ;";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj capacité. (trtcnx)");

// Capacité des entreprises secondaires

    $sql = "UPDATE eco_entreprise SET capacitemens = capacite ";
    $sql .= "WHERE ((typeentreprise >= '20000' AND typeentreprise < '30000') ";
    $sql .= "OR (typeentreprise >= '50000' AND typeentreprise < '60000')) ";
    $sql .= "AND eco_entreprise.idpays = '$idpays' AND eco_entreprise.iduser IN (SELECT eco_user.iduser ";
    $sql .= "FROM eco_user WHERE eco_user.inactif ='0') ;";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj capacité secondaire. (trtcnx)");

// Capacité des entreprises tertiaires en NV

    $sql = "UPDATE eco_stock SET quantite = 100 ";
    $sql .= "WHERE idunite = '80100' AND identreprise IN (SELECT eco_entreprise.identreprise FROM eco_entreprise ";
    $sql .= "WHERE typeentreprise >= '30000' AND typeentreprise < '40000' ";
    $sql .= "AND eco_entreprise.idpays = '$idpays' AND eco_entreprise.iduser IN (SELECT eco_user.iduser ";
    $sql .= "FROM eco_user WHERE eco_user.inactif ='0')) ;";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de màj capacité 2. (trtcnx)");

// selection des entreprises tertiaires sans stock pour init
    $sql = "SELECT eco_entreprise.identreprise FROM eco_entreprise ";
    $sql .= "WHERE typeentreprise >= '30000' AND typeentreprise < '40000' ";
    $sql .= "AND eco_entreprise.idpays = '$idpays' AND eco_entreprise.iduser IN (SELECT eco_user.iduser ";
    $sql .= "FROM eco_user WHERE eco_user.inactif ='0') ";
    $sql .= "AND eco_entreprise.identreprise NOT IN (SELECT eco_stock.identreprise ";
    $sql .= "FROM eco_stock WHERE eco_stock.idunite = '80100') ;";
    $restmp = @mysqli_query($conn, $sql) or die("<br> PB de màj capacité 3. (trtcnx)");
		$numtmp = @mysqli_num_rows($restmp);

		if ($numtmp > 0)
		{
  		while($produittmp = mysqli_fetch_array($restmp))
  		{
    		$identretmp = $produittmp["identreprise"];
    		
				$sql = "INSERT INTO eco_stock (identreprise,idunite,quantite, prixrevient, devise, qualite, datemaj) VALUES ('$identretmp','80100','100', '0', '$devise', '0', NOW());";
        $restmp2 = @mysqli_query($conn, $sql) or die("Erreur dans la requete insert NV (trtcnx) !!!");

			}
		}
  }
}

?>

