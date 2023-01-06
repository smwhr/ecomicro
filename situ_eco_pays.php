<?php

$idpays = $_GET['pays'];
$taux = $_GET['taux'];     
//$id = $_GET['id'];

if (($taux == "") || ($taux <= 0))
	die("Erreur (taux) lors de l'appel d'une fiche Etat de EcoMicro (".$taux.")");

if (($idpays == "") || ($idpays <= 0))
	die("Erreur (pays) lors de l'appel d'une fiche Etat de EcoMicro (".$idpays.")");

include("include/config.php");

$conn = mysqli_connect($host,$user,$pass) or die("Impossible de se connecter à la base de données"); // Le @ ordonne a php de ne pas afficher de message d'erreur
mysqli_select_db($conn, $bdd) or die("Impossible de se connecter à la base de données");

$sql = "SELECT * ";
$sql .= "FROM eco_pays ";
$sql .= "WHERE eco_pays.idpays = '$idpays' ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête vérifiant le pays ");
$num = @mysqli_num_rows($res) or die("Erreur dans la requête vérifiant le pays");
$paysData = mysqli_fetch_array($res);


// Niveau économique / Masse monétaire

$html = "<H4>Niveau économique / Masse monétaire</H4>";

$sql_masse = "SELECT sum(solde) as masse ";
$sql_masse .= "FROM eco_banque, eco_pays ";
$sql_masse .= "WHERE eco_banque.devise = eco_pays.devise ";
$sql_masse .= "AND eco_pays.idpays = '$idpays' ";

$res_masse = @mysqli_query($conn, $sql_masse) or die("Erreur dans la requête vérifiant le masse ");
$num_masse = @mysqli_num_rows($res_masse) or die("Erreur dans la requête vérifiant la masse");
$paysMasse = mysqli_fetch_array($res_masse);

$sql_cotation = "SELECT sum(cotation * nbtitre) as capitalisation ";
$sql_cotation .= "FROM eco_cotation, eco_entreprise ";
$sql_cotation .= "WHERE eco_cotation.identreprise = eco_entreprise.identreprise ";
$sql_cotation .= "AND eco_entreprise.idpays = '$idpays' ";

$res_cotation = @mysqli_query($conn, $sql_cotation) or die("Erreur dans la requête vérifiant la capitalisation ");
$num_cotation = @mysqli_num_rows($res_cotation) or die("Erreur dans la requête vérifiant la capitalisation");
$paysCotation = mysqli_fetch_array($res_cotation);


$html .= "<TABLE>";
$html .= "<TR>";
$html .= "<TD>";
    $html .= "Masse Ménétaire";
$html .= "</TD>";
$html .= "<TD WIDTH='200px' ALIGN='RIGHT'>";
    $html .= $paysMasse['masse'] . $paysData['devise'];
$html .= "</TD>";
$html .= "</TR>";
$html .= "<TR>";
$html .= "<TD>";
    $html .= "Capitalisation totale";
$html .= "</TD>";
$html .= "<TD ALIGN='RIGHT'>";
    $html .= $paysCotation['capitalisation'] . $paysData['devise'];
$html .= "</TD>";
$html .= "</TR>";
$html .= "<TR>";
$html .= "<TD>";
    $html .= "Niveau économique";
$html .= "</TD>";
$html .= "<TD ALIGN='RIGHT'>";
    $html .= $paysCotation['capitalisation']/$paysMasse['masse'];
$html .= "</TD>";
$html .= "</TR>";
$html .= "</TABLE>";

$html .= "<BR/>";

// Activité du trimestre passé

$html .= "<H4>Activité du trimestre passé</H4>";

$sql_entreprise = "SELECT * ";
$sql_entreprise .= "FROM eco_entreprise ";
$sql_entreprise .= "WHERE eco_entreprise.idpays = '$idpays' ";
$sql_entreprise .= "ORDER BY eco_entreprise.typeentreprise, eco_entreprise.nomentreprise ";

$res_entreprise = @mysqli_query($conn, $sql_entreprise) or die("Erreur dans la requête listant les entreprises ");
$num_entreprise = @mysqli_num_rows($res_entreprise);

$html .= "<TABLE>";
$html .= "<TR>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='CENTER'>Entreprise</TD>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='CENTER'>Production</TD>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='CENTER'>Vente</TD>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='CENTER'>Taxe : " . $taux*100 . "%</TD>";
$html .= "</TR>";

$totaux = 0;

while($entrepriseData = mysqli_fetch_array($res_entreprise)) {
    
    $identreprise = $entrepriseData['identreprise'];
    
    $sql_entrepriseHisto = "SELECT eco_histo.action, sum(eco_histo.nb * eco_histo.cout) as res ";
    $sql_entrepriseHisto .= "FROM eco_histo ";
    $sql_entrepriseHisto .= "WHERE eco_histo.identreprise = '$identreprise' ";
    $sql_entrepriseHisto .= "AND eco_histo.datemaj > NOW() - INTERVAL 4 MONTH ";
    $sql_entrepriseHisto .= "AND eco_histo.datemaj < NOW() ";
    $sql_entrepriseHisto .= "GROUP BY eco_histo.action ";
    $sql_entrepriseHisto .= "ORDER BY eco_histo.action ";

//echo $sql_entrepriseHisto;

    $res_entrepriseHisto = @mysqli_query($conn, $sql_entrepriseHisto) or die("Erreur dans la requête listant les histo ");
    $num_entrepriseHisto = @mysqli_num_rows($res_entrepriseHisto);
    
    if ($num_entrepriseHisto > 0){
        $entrepriseHisto1 = mysqli_fetch_array($res_entrepriseHisto);
        $entrepriseHisto2 = mysqli_fetch_array($res_entrepriseHisto);
        
        $html .= "<TR>";
        $html .= "<TD VALIGN='MIDDLE' ALIGN='LEFT'>";
        $html .= $entrepriseData['nomentreprise'];
        $html .= "</TD>";
        $html .= "<TD VALIGN='MIDDLE' ALIGN='RIGHT'>";
        if ($entrepriseHisto1['action'] == 1){
            $html .= $entrepriseHisto1['res'] . $paysData['devise'];
        }
        else {
            $html .= "";
        }
        $html .= "</TD>";
        $html .= "<TD VALIGN='MIDDLE' ALIGN='RIGHT'>";
        if ($entrepriseHisto1['action'] == 2){
            $html .= $entrepriseHisto1['res'] . $paysData['devise'];
            $val = $entrepriseHisto1['res'];
        } 
        else if ($entrepriseHisto2['res'] != FALSE) {
            $html .= $entrepriseHisto2['res'] . $paysData['devise'];
            $val = $entrepriseHisto2['res']; 
        }
        else {
            $html .= "";
            $val = 0;
        }
        $html .= "</TD>";
        $html .= "<TD VALIGN='MIDDLE' ALIGN='RIGHT'>";
        $totaux += $val * $taux;
        $html .= $val * $taux . $paysData['devise'];
        $html .= "</TD>";
        $html .= "</TR>";
    }
    
}

$html .= "<TR>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='LEFT'>";
$html .= "<b>TOTAL</b>";
$html .= "</TD>";
$html .= "<TD VALIGN='MIDDLE'>";
$html .= "</TD>";
$html .= "<TD VALIGN='MIDDLE'>";
$html .= "</TD>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='RIGHT'>";
$html .= $totaux . $paysData['devise'];
$html .= "</TD>";
$html .= "</TR>";

$html .= "</TABLE>";

// Finance des Provinces et organismes publics

$html .= "<BR/>";
$html .= "<H4>Finance des Provinces et organismes publics</H4>";

$sql_organisme = "SELECT eco_entreprise.typeentreprise, eco_entreprise.nomentreprise, eco_banque.solde ";
$sql_organisme .= "FROM eco_entreprise, eco_banque ";
$sql_organisme .= "WHERE eco_entreprise.idpays = '$idpays' ";
$sql_organisme .= "AND eco_entreprise.typeentreprise IN (80000, 90000) ";
$sql_organisme .= "AND eco_entreprise.identreprise = eco_banque.idtitulaire ";
$sql_organisme .= "ORDER BY eco_entreprise.typeentreprise, eco_entreprise.nomentreprise ";

$res_organisme = @mysqli_query($conn, $sql_organisme) or die("Erreur dans la requête listant les organismes publics ");
$num_organisme = @mysqli_num_rows($res_organisme);

$html .= "<TABLE>";
$html .= "<TR>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='CENTER'>Organisme</TD>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='CENTER' WIDTH='200px'>Solde</TD>";
$html .= "</TR>";

$totaux = 0;

while($organismeData = mysqli_fetch_array($res_organisme)) {
    
    $html .= "<TR>";
    $html .= "<TD VALIGN='MIDDLE' ALIGN='LEFT'>";
    $html .= $organismeData['nomentreprise'];
    $html .= "</TD>";
    $html .= "<TD VALIGN='MIDDLE' ALIGN='RIGHT'>";
    $html .= $organismeData['solde'] . $paysData['devise'];
    $totaux += $organismeData['solde']; 
    $html .= "</TR>";
        
}

$html .= "<TR>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='LEFT'>TOTAL</TD>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='RIGHT'>";
$html .= $totaux . $paysData['devise'];
$html .= "</TR>";

$html .= "</TABLE>";

// Solde des comptes d'état

$html .= "<BR/>";
$html .= "<H4>Solde des comptes d'état</H4>";

$sql_cpteEtat = "SELECT eco_banque.nomcpte, eco_banque.solde ";
$sql_cpteEtat .= "FROM eco_banque ";
$sql_cpteEtat .= "WHERE eco_banque.idtitulaire = '$idpays' ";
$sql_cpteEtat .= "ORDER BY eco_banque.nomcpte ";

$res_cpteEtat = @mysqli_query($conn, $sql_cpteEtat) or die("Erreur dans la requête listant les comptes d'Etat ");
$num_cpteEtat = @mysqli_num_rows($res_cpteEtat);

$html .= "<TABLE>";
$html .= "<TR>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='CENTER'>Compte</TD>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='CENTER' WIDTH='200px'>Solde</TD>";
$html .= "</TR>";

$totaux = 0;

while($cpteEtatData = mysqli_fetch_array($res_cpteEtat)) {
    
    $html .= "<TR>";
    $html .= "<TD VALIGN='MIDDLE' ALIGN='LEFT'>";
    $html .= $cpteEtatData['nomcpte'];
    $html .= "</TD>";
    $html .= "<TD VALIGN='MIDDLE' ALIGN='RIGHT'>";
    $html .= $cpteEtatData['solde'] . $paysData['devise'];
    $totaux += $cpteEtatData['solde']; 
    $html .= "</TR>";
        
}

$html .= "<TR>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='LEFT'>TOTAL</TD>";
$html .= "<TD VALIGN='MIDDLE' ALIGN='RIGHT'>";
$html .= $totaux . $paysData['devise'];
$html .= "</TR>";

$html .= "</TABLE>";


echo $html;
?>
