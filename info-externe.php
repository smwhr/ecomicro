<?php

if (($action == "") || (($action <> "info") && 
     ($action <> "possession") && 
     ($action <> "catalogue") && 
     ($action <> "stock") && 
     ($action <> "besoin")
    )){
	die("Erreur (action) lors de l'appel d'une fiche EcoMicro (".$action.")");
}
if (($type == "") || (($type <> "entreprise") && ($action <> "user") && ($action <> "pays"))){
	die("Erreur (type) lors de l'appel d'une fiche EcoMicro (".$type.")");
}
if (($id == "") || ($type <= 0)){
	die("Erreur (id) lors de l'appel d'une fiche EcoMicro (".$id.")");
}

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter à la base de données"); // Le @ ordonne a php de ne pas afficher de message d'erreur
mysqli_select_db($conn, $bdd) or die("Impossible de se connecter à la base de données");


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
        $html .= "<IMG SRC='".$produit['logo']."' ALT='Logo' WIDTH='200' HEIGHT='140' />";
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
	if ($action == "info") {
		// Recherche données entreprise
		$sql = "select * from eco_entreprise where identreprise = '$id';";
		
        $res = @mysqli_query($conn, $sql) or die("Erreur dans la requète (Recherche données Entreprise).");
        $num = @mysqli_num_rows($res) or die("Pas de données... (Recherche données Entreprise)");
		if ($num <= 0)
			die("Aucune info Entreprise trouvée (".$id.")");
        $produit = mysqli_fetch_array($res);
        
        $html = "<TABLE WIDTH='100%'>";
        $html .= "<TR>";
        
        $html .= "<TD WIDTH='33%' VALIGN='MIDDLE'>";
        $html .= "<IMG SRC='".$produit['logo']."' ALT='Logo' WIDTH='200' HEIGHT='140' />";
        $html .= "</TD>";
        
        $html .= "<TD WIDTH='67%' VALIGN='MIDDLE'>";
        $html .= "<H2>".$produit['nomentreprise']."</H2><BR/>";

        // Recherche adresse
		$sql_immo = "select * from eco_immo where idoccupant = '$id' AND pricnipal = 0;";
        $res_immo = @mysqli_query($conn, $sql_immo) or die("Erreur dans la requète (Recherche adresse).");
        $num_immo = @mysqli_num_rows($res_immo) or die("Pas de données... (Recherche adresse)");
		if ($num_immo <= 0)
			$html .= "Sans Adresse...<BR/>";
		else {
    		$produit_immo = mysqli_fetch_array($res_immo);	
        
            $html .= $produit_immo['adresse']."<BR/>";
            $html .= $produit_immo['province']."<BR/>";
            
        } 
        // Recherche directeur
        if ($produit['iduser'] <> 0){
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
		$sql_acti = "SELECT eco_bourse.*, eco_pays.nompays, eco_entreprise.nomentreprise, eco_user.nom ";
		$sql_acti .= "FROM eco_bourse ";
		$sql_acti .= "LEFT INNER JOIN eco_pays ON eco_pays.idpays = eco_bourse.idactionnaire ";
		$sql_acti .= "LEFT INNER JOIN eco_entreprise ON eco_entreprise.identreprise = eco_bourse.idactionnaire ";
		$sql_acti .= "LEFT INNER JOIN eco_user ON eco_user.iduser = eco_bourse.idactionnaire ";
		$sql_acti .= "WHERE eco_bourse.identreprise = '$id' ";
		$sql_acti .= "ORDER BY eco_bourse.nbaction DESC LIMIT 5;";
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
        
		
	}
	else if ($type == "possession") {
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
        $num = @mysqli_num_rows($res) or die("Pas de données... (Recherche possession entreprise)");
		if ($num <= 0)
			die("Aucune possession trouvé (".$id.")");
		else {

            $html = "<TABLE WIDTH='100%'>";
    			
            while ($produit = mysqli_fetch_array($res)){
                $html .= "<TR>";
                
                $html .= "<TD WIDTH='33%' VALIGN='MIDDLE'>";
                $html .= "<IMG SRC='".$produit['image']."' ALT='image' WIDTH='200' HEIGHT='140' />";
                $html .= "</TD>";
                
                $html .= "<TD WIDTH='67%' VALIGN='MIDDLE'>";
                $html .= "<b>" . $produit['nomproduit'] . "</b> (".$produit['nbunite']." ".$produit['libelleb'].")<BR/>";
                $html .= $produit['libellea'] . "<BR/>";
                $html .= $produit['adresse_immo'] . ",&nbsp;" . $produit['province']."<BR/>";
                $html .= "</TD>";
                
                $html .= "</TR>";
                $html .= "<TR>";
                
                $html .= "<TD COLSPAN=2>";
                $html .= "Description : ".$produit['description'];
                $html .= "</TD>";

                $html .= "</TR>";
            } 
            $html .= "</TABLE>";

		}

	}
	else if ($type == "catalogue") {
		// Recherche catalogue entreprise
		$sql = "select * from eco_produit where identreprise = '$id';";

		if ($num <= 0)
			die("");

	}
	else if ($type == "stock") {
		// Recherche stockentreprise
		$sql = "select * from eco_stock where identreprise = '$id';";

		if ($num <= 0)
			die("");

	}
	
	echo $html;

}

?>