<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=taxe_import.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>
<html>
<head>

    <title>Taxe Import - Export</title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

<?php
  require("gestion/gest_taxe_import.php");
?>

<script language="javascript" type="text/javascript" >
function majtaxeimport(){
    if ((isNaN(parseFloat($('#taxe').val()))) || (parseFloat($('#taxe').val()) < 0)){
        alert("Veuillez renseignez la valeur de la taxe correctement.");
    }
    else{
        taxe = parseFloat($('#taxe').val()) / 100;
        taxe = taxe.toFixed(2);
        if (taxe == 0.00){
            alert("Il est préférable de supprimer la taxe.");
        }
        else{
            $('#taxe').val(taxe);
            
            $('#page-loader').show();
            document.modiftaxeimport.action="gestion/modiftaxeimport.php";
            document.modiftaxeimport.submit();
        }
    }
}

function supprtaxeimport(){
    $('#page-loader').show();
    document.modiftaxeimport.action="gestion/supprtaxeimport.php";
    document.modiftaxeimport.submit();
}

function newtaxeimport(){
    var tmp = 0;
    if (isNaN(parseFloat($('#taxe').val())) || (parseFloat($('#taxe').val()) <= 0)){
        alert("Il s'agit de renseigner un nombre entié positif comme taux de taxe.");
    }
    else{
        for (ind01 = 0; ind01 < TAXE_IMPORT_IDPAYS1.length; ind01++){
            if ((TAXE_IMPORT_IDPAYS1[ind01] == $('#idpaysA').val()) && (TAXE_IMPORT_IDPAYS2[ind01] == $('#idpaysB').val()) && (TAXE_IMPORT_TYPE[ind01] == $('#typeA').val())){
                alert("Une Taxe Import existe déjà, vous devez la modifier.");
                return;
            }
        }
        tmp = parseFloat($('#taxe').val());
        $('#taxe').val(tmp.toFixed(2) / 100);

        $('#page-loader').show();
        document.newtaxeimport1.action="gestion/newtaxeimport.php";
        document.newtaxeimport1.submit();
    }
}

function gotoCitoyens(){
    $('#page-loader').show();
    $tmp = "citoyen_detail.php";
    document.location.replace($tmp);
}
function gotoEntreprises(){
    $('#page-loader').show();
    $tmp = "entreprise_detail.php";
    document.location.replace($tmp);
}
function gotoEtats(){
    $('#page-loader').show();
    $tmp = "info_etat.php";
    document.location.replace($tmp);
}
function gotoTransactions(){
    $('#page-loader').show();
    $tmp = "achat_stock.php";
    document.location.replace($tmp);
}
</script>
</head>

<body onload="infojoueur(); AfficheTaxeImport(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_taxe_import.js"></script>
<script language="Javascript" type="text/javascript" src="gestion/infojoueur.js"></script>

<div id="page-loader">  
    <div id="loading-mask" style=""></div>
    <div id="loading">
        <div id="loading-ind" class="loading-indicator" style="width:250px;">
            <CENTER>
            <span id="loading-titre">EcoMicro&trade;</span>
            <br><br><br>
            <img id="loading-image" src="obj/wait1.gif" width="64" height="64"/>
            <br><br><br>
            <span id="loading-msg">Chargement en cours.</span>
            <br>
            <span id="loading-msg">Veuillez patienter...</span>
            </CENTER>
        </div>
    </div>
</div>

<CENTER><div style="width:1300px;">
<table width='100%'>
    <tr>
        <td width='200'>
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
                </BR>
                NKWeb, Kaora 2013
            </CENTER>
            </div>
        </td>
        <td valign=top>
            <table width='100%'>
                <tr>
                    <td valign=top>
                        <CENTER>
                            <div id="menu"> 
                                <table width='100%'>
                                    <tr>
                                        <td valign=top width='25%'>
                                            <div id="divMenuCitoyen" class="menuIndex boutonVert tailleSimple" onClick="gotoCitoyens();">Citoyens</div>
                                        </td>
                                        <td valign=top width='25%'>
                                            <div id="divMenuEntreprise" class="menuIndex boutonOrange tailleSimple" onClick="gotoEntreprises();">Entreprises</div>
                                        </td>
                                        <td valign=top width='25%'>
                                            <div id="divMenuEtat" class="menuIndex boutonRouge tailleSimple" onClick="gotoEtats();">Etats</div>
                                        </td>
                                        <td valign=top width='25%'>
                                            <div id="divMenuTransaction" class="menuIndex boutonBleu tailleSimple" onClick="gotoTransactions();">Transactions</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </CENTER>
                        <div id="enteted" class="cadreClair textPetit"> 
                            <ul>
                                <li>Liste les taxes en vigueur.
                                <li>Possibilité de filtrer par pays et par type de produit.
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td width='400' valign=top>
            <CENTER>
                <div id="tabdroiteh" class="margin5 infoUser"> </div>
            </CENTER>
        </td>
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top class="margin5">
            <CENTER><div id="divSSMenuEtat"> </div></CENTER>
        </td>
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top class="cadreClair">
            <CENTER><div id="tabcentrec"> </div></CENTER>
        </td>
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top>
            <div class="cadrePrincipal">
                <div class="textGros"><CENTER><b>Taxes</b></CENTER></div>
                <div id="divTaxe">
                    <table border='0' width='100%' cellspacing="0">
                        <tr height='40'>
                            <td width='200'><b><CENTER>Pays 1</CENTER></b></td>
                            <td width='200'><b><CENTER>Pays 2</CENTER></b></td>
                            <td width='100'><CENTER><b>Type</b></CENTER></td>
                            <td width='100'><CENTER><b>Taxe</b></CENTER></td>
                        </tr>
                    </table>
                    <div id="tabcentreb" class="scroll-1"> </div>
                </div>
                <div id="divNewTaxe" style="display:none; height:500px;"> </div>
            </div>
        </td>

        <td valign=top width='300'>
            <CENTER>
                <div class="margin5 padding5" style="height:540px;"> 
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/taxe_2.jpg" alt="" width="215" height="135" />
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/taxe_1.jpg" alt="" width="215" height="135" />
                </div>
            </CENTER>
        </td>
    </tr>
</table>
</div></CENTER>

</body>
</html>