<?php 
//header('Content-Type: text/html');
header('Access-Control-Allow-Origin: *');

//echo "GO<Br>";
$action = $_POST['action'];
$type = $_POST['type'];     
$id = $_POST['id'];

if (($action == "") || (($action <> "info") && ($action <> "possession") && ($action <> "catalogue") && ($action <> "stock") && ($action <> "besoin")))
	die("Erreur (action) lors de l'appel d'une fiche EcoMicro (".$action.")");

if (($type == "") || (($type <> "entreprise") && ($type <> "user") && ($type <> "pays")))
	die("Erreur (type) lors de l'appel d'une fiche EcoMicro (".$type.")");

if (($id == "") || ($id <= 0))
	die("Erreur (id) lors de l'appel d'une fiche EcoMicro (".$id.")");

//echo "Before Include<Br>";
include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter à la base de données"); // Le @ ordonne a php de ne pas afficher de message d'erreur
mysqli_select_db($conn, $bdd) or die("Impossible de se connecter à la base de données");

//echo "A";

if ($type == "pays") {
	if ($action == "info") {
		// Recherche données pays
		$sql = "select * from eco_pays where idpays = '$id';";
        $res = @mysqli_query($conn, $sql) or die("Erreur dans la requète (Recherche données pays).");
        $num = @mysqli_num_rows($res) or die("Pas de données... (Recherche données pays)");
		if ($num <= 0)
			die("Aucune info Pays trouvée (".$id.")");
        $produit = mysqli_fetch_array($res);
        
        $html = "<TABLE WIDTH='100%'>";
        $html .= "<TR>";
        $html .= "<TD WIDTH='33%'>";
        $html .= "<IMG SRC='".$produit['logo']."' ALT='Logo' STYLE='WIDTH:200px; HEIGHT:140px;' />";
        $html .= "</TD>";
        $html .= "<TD WIDTH='67%'>";
        $html .= $produit['nomentreprise']."<BR/>";

        // Recherche directeur
		$sql = "select * from eco_user where idpays = '$id';";
        $res = @mysqli_query($conn, $sql) or die("Erreur dans la requète (Recherche données pays).");
        $num = @mysqli_num_rows($res) or die("Pas de données... (Recherche données pays)");
		if ($num <= 0)
			die("Aucune info Pays trouvée (".$id.")");

         
        $html .= $produit['nomentreprise']."<BR/>"; 
        $html .= "</TD>";
        $html .= "</TR>";
        $html .= "</TABLE>";
        
		
	}
	else if ($type == "besoin") {
		// Recherche besoins pays
		$sql = "select * from eco_besoin where idpays = '$id';";

		if ($num <= 0)
			die("");

	}

}
else if ($type == "user") {
	if ($action == "info") {
		// Recherche données user
		$sql = "select * from eco_user where iduser = '$id';";
		
		if ($num <= 0)
			die("Aucune info User trouvée (".$id.")");
		
	}
	else if ($type == "possession") {
		// Recherche possession user
		$sql = "select * from eco_possession where idpossesseur = '$id';";

		if ($num <= 0)
			die("");

	}


}
else if ($type == "entreprise") {
//echo "Entreprise<br>";
	if ($action == "info") {
//echo "Info<br>";
		// Recherche données entreprise
		$sql = "select * from eco_entreprise where identreprise = '$id';";
		
//echo $sql."<br>";
        $res = @mysqli_query($conn, $sql) or die("Erreur dans la requète (Recherche données Entreprise).");
        $num = @mysqli_num_rows($res) or die("Pas de données... (Recherche données Entreprise)");
		if ($num <= 0)
			die("Aucune info Entreprise trouvée (".$id.")");
        $produit = mysqli_fetch_array($res);
        
        $html = "<TABLE WIDTH='100%'>";
        $html .= "<TR>";
        
//echo $produit['logo']."<br>";
        $html .= "<TD WIDTH='33%' VALIGN='MIDDLE'>";
        $html .= "<IMG SRC='".$produit['logo']."' ALT='Logo' STYLE='max-WIDTH:200px; max-HEIGHT:140px;' />";
        $html .= "</TD>";
        
        $html .= "<TD WIDTH='67%' VALIGN='MIDDLE'>";
//echo $produit['nomentreprise']."<br>";
        $html .= "<H2>".$produit['nomentreprise']."</H2>";

        // Recherche adresse
//echo "--- Recherche adresse<br>";
        $sql_immo = "SELECT eco_immo.idpossession,eco_immo.province,eco_immo.adresse_immo,eco_immo.occupe,eco_entreprise.nomentreprise ";
		$sql_immo .= "FROM eco_immo, eco_entreprise ";
		$sql_immo .= "WHERE ((eco_immo.idproprio = '$id' AND eco_immo.idlocataire = '0') ";
		$sql_immo .= "OR eco_immo.idlocataire = '$id') ";
		$sql_immo .= "AND eco_immo.province = eco_entreprise.identreprise AND eco_immo.occupe = 1;";
//echo $sql_immo."<br>";

		$res_immo = @mysqli_query($conn, $sql_immo) or die("Erreur dans la requête");
		$num_immo = @mysqli_num_rows($res_immo);

		if ($num_immo >= 1){
            $produit_immo = mysqli_fetch_array($res_immo);

            $html .= $produit_immo['adresse_immo']."<BR/>";
//echo $produit_immo['adresse']."<br>";
            $html .= $produit_immo['nomentreprise']."<BR/>";
		}
		else 
        	$html .= "Sans Adresse...<BR/>";
       

        // Recherche directeur
        if ($produit['iduser'] <> 0){
//echo "--- Recherche directeur<br>";
            $dir = $produit['iduser'];
    		$sql_dir = "select * from eco_user where iduser = '$dir';";
            $res_dir = @mysqli_query($conn, $sql_dir) or die("Erreur dans la requète (Recherche directeur).");
            $num_dir = @mysqli_num_rows($res_dir) or die("Pas de données... (Recherche directeur)");
    		if ($num_dir <= 0)
    			die("Aucune info Directeur trouvée (".$dir.")");
    		$produit_dir = mysqli_fetch_array($res_dir);	
            
            $html .= "<BR/>Directeur : ".$produit_dir['nom']."<BR/>"; 
        }
        else {
            $html .= "<BR/>Directeur : Sans directeur<BR/>"; 
        }
        
        $html .= "</TD>";
        
        $html .= "</TR>";
        $html .= "<TR>";
        
        $html .= "<TD COLSPAN=2 VALIGN='MIDDLE' >";

        // Recherche cours de bourse
//echo "--- Recherche cours de bourse<br>";
		$sql_cours = "select * from eco_cotation where identreprise = '$id';";
        $res_cours = @mysqli_query($conn, $sql_cours) or die("Erreur dans la requète (Recherche cours de bourse).");
        $num_cours = @mysqli_num_rows($res_cours) or die("Pas de données... (Recherche cours de bourse)");
		if ($num_cours <= 0)
			die("Aucun cours de bourse trouvé (".$id.")");
		else {
    		$produit_cours = mysqli_fetch_array($res_cours);	
            
            $html .= "Cours de bourse : ".$produit_cours['cotation'].$produit_cours['devise']; 
        }
        
        $html .= "<BR/>";
       
        // Recherche actionnaires
//echo "--- Recherche actionnaires<br>";
		$sql_acti = "SELECT eco_bourse.*, eco_pays.nompays, eco_entreprise.nomentreprise, eco_user.nom ";
		$sql_acti .= "FROM eco_bourse ";
		$sql_acti .= "LEFT JOIN eco_pays ON eco_pays.idpays = eco_bourse.idactionnaire ";
		$sql_acti .= "LEFT JOIN eco_entreprise ON eco_entreprise.identreprise = eco_bourse.idactionnaire ";
		$sql_acti .= "LEFT JOIN eco_user ON eco_user.iduser = eco_bourse.idactionnaire ";
		$sql_acti .= "WHERE eco_bourse.identreprise = '$id' ";
		$sql_acti .= "ORDER BY eco_bourse.nbaction DESC LIMIT 5;";
//echo $sql_acti."<br>";
        $res_acti = @mysqli_query($conn, $sql_acti) or die("Erreur dans la requète (Recherche actionnaires).");
        $num_acti = @mysqli_num_rows($res_acti) or die("Pas de données... (Recherche actionnaires)");
		if ($num_acti <= 0)
			die("Aucun actionnaire trouvé (".$id.")");
		else {
    			
            $html .= "Actionnaires : ";
            $i = 0;
            
            while ($produit_acti = mysqli_fetch_array($res_acti)){
                if ($i++ > 0) 
                    $html .= ", ";
                if (($produit_acti['nompays'] != null) && ($produit_acti['nompays'] > ""))
                    $html .= $produit_acti['nompays'];
                else if (($produit_acti['nomentreprise'] != null) && ($produit_acti['nomentreprise'] > ""))
                    $html .= $produit_acti['nomentreprise'];
                else if (($produit_acti['nom'] != null) && ($produit_acti['nom'] > ""))
                    $html .= $produit_acti['nom'];
                else 
                    $html .= "Inconnu...";

            } 
        }
                
        $html .= "</TD>";
        $html .= "</TR>";
        $html .= "</TABLE>";
        
/*		
	}
	else if ($action == "possession") {
*/
	
		$html .= "<BR/>";
		$html .= "<H4>Possessions</H4>";
		
		// Recherche possession entreprise

        $sql = "SELECT idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.typeproduit,a.libelle as libellea,a.typeequi,";
        $sql .= "eco_possession.image,description,nbunite,b.libelle as libelleb,datehachat,eco_possession.etat, 'a' as pro, '' as adresse_immo, '' as province ";
        $sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b ";
        $sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur = '$id' ";
        $sql .= "AND eco_possession.typeproduit = a.typeproduit AND a.typeequi <> '20000' ";
        $sql .= "UNION SELECT eco_possession.idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.typeproduit,a.libelle as libellea,a.typeequi,eco_possession.image,description,nbunite,b.libelle as libelleb,datehachat,eco_possession.etat, 'b' as pro, eco_immo.adresse_immo, eco_entreprise.nomentreprise as province ";
        $sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b, eco_immo, eco_entreprise ";
        $sql .= "WHERE (b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur <> '$id' ";
        $sql .= "AND eco_possession.typeproduit = a.typeproduit AND eco_entreprise.identreprise = province ";
        $sql .= "AND eco_possession.idpossession = eco_immo.idpossession AND eco_immo.idlocataire = '$id') ";
        $sql .= "OR (b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur = '$id' ";
        $sql .= "AND eco_possession.typeproduit = a.typeproduit AND eco_entreprise.identreprise = province ";
        $sql .= "AND eco_possession.idpossession = eco_immo.idpossession) ";
        $sql .= "ORDER BY nomproduit;";

//		$sql = "SELECT * FROM eco_possession WHERE idpossesseur = '$id';";
        $res = @mysqli_query($conn, $sql) or die("Erreur dans la requète (Recherche possession entreprise).");
        $num = @mysqli_num_rows($res);
		if ($num <= 0)
			$html .= "Aucune possession trouvée";
		else {

            $html .= "<TABLE WIDTH='100%'>";
    			
            while ($produit = mysqli_fetch_array($res)){
                $html .= "<TR>";
                
                $html .= "<TD WIDTH='33%' VALIGN='MIDDLE'>";
                $html .= "<IMG SRC='".$produit['image']."' ALT='image' STYLE='max-WIDTH:200px; max-HEIGHT:140px;' />";
                $html .= "</TD>";
                
                $html .= "<TD WIDTH='67%' VALIGN='MIDDLE'>";
                $html .= "<b>" . $produit['nomproduit'] . "</b> (".$produit['nbunite']." ".$produit['libelleb'].")<BR/>";
                $html .= $produit['libellea'] . "<BR/>";
				if ($produit['adresse_immo'] > "")
					$html .= $produit['adresse_immo'] . ",&nbsp;" . $produit['province']."<BR/>";
                $html .= "<BR/>Description : ".$produit['description'];
                $html .= "</TD>";
                
                $html .= "</TR>";
				
                $html .= "<TR><TD>";
                $html .= "<BR/>";
                $html .= "</TD></TR>";
            } 
            $html .= "</TABLE>";

		}
/*
	}
	else if ($action == "catalogue") {
*/
		$html .= "<BR/>";
		$html .= "<H4>Catalogue des produits en vente</H4>";
		
		// Recherche catalogue entreprise
		$sql = "SELECT eco_production.identreprise,eco_entreprise.nomentreprise,idproduit,nomproduit,a.typeproduit,a.typeequi, a.libelle as libellea,image,description,nbunite,b.libelle,b.typeproduit as typeprodb,eco_production.prix ";
		$sql .= "FROM eco_entreprise,eco_production,eco_typeproduit as a,eco_typeproduit as b ";
		$sql .= "WHERE b.typeproduit = eco_production.idunite AND eco_entreprise.identreprise = eco_production.identreprise ";
		$sql .= "AND eco_production.typeproduit = a.typeproduit AND eco_entreprise.identreprise = '$id' ";
		$sql .= "ORDER BY nomproduit";

        $res = @mysqli_query($conn, $sql) or die("Erreur dans la requète (Recherche catalogue entreprise).");
        $num = @mysqli_num_rows($res);
		if ($num <= 0)
			$html .= "Aucun produit trouvé ";
		else {

            $html .= "<TABLE WIDTH='100%'>";
    			
            while ($produit = mysqli_fetch_array($res)){
                $html .= "<TR>";
                
                $html .= "<TD WIDTH='33%' VALIGN='MIDDLE'>";
                $html .= "<IMG SRC='".$produit['image']."' ALT='image' STYLE='max-WIDTH:200px; max-HEIGHT:140px;' />";
                $html .= "</TD>";
                
                $html .= "<TD WIDTH='67%' VALIGN='MIDDLE'>";
                $html .= "<b>" . $produit['nomproduit'] . "</b> (".$produit['nbunite']." ".$produit['libelle'].")<BR/>";
                $html .= $produit['libellea'] . "<BR/>";
                $html .= "<BR/>Description : ".$produit['description'];

                $html .= "</TD>";

                $html .= "</TR>";

                $html .= "<TR><TD>";
                $html .= "<BR/>";
                $html .= "</TD></TR>";
            } 
            $html .= "</TABLE>";

		}
	}
	else if ($action == "stock") {
		// Recherche stockentreprise
		$sql = "select * from eco_stock where identreprise = '$id';";

		if ($num <= 0)
			die("");

	}
	
	echo $html;

}

?>
