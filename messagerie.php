<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=messagerie.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>

<html>
<head>
    <title> Vos Messages </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

<?php
  require("gestion/gest_messagerie.php");
?>

<script language="javascript" type="text/javascript">
function valachat(i){
    if (($('#reponse1').val() == "A") || ($('#reponse1').val() == "R")){
        if (MSG_OBJET[i] == "VENTE_STOCK"){
            $('#page-loader').show();
            document.msgmaj.action="gestion/achatstock.php";
            document.msgmaj.submit();
        }
        else if (MSG_OBJET[i] == "VENTE_DECHET"){
            $('#page-loader').show();
            document.msgmaj.action="gestion/achatdechet.php";
            document.msgmaj.submit();
        }
        else if (MSG_OBJET[i] == "VENTE_PRODUIT"){
            $('#page-loader').show();
            document.msgmaj.action="gestion/achatproduit.php";
            document.msgmaj.submit();
        }
        else if (MSG_OBJET[i] == "VENTE_OCCASION"){
            $('#page-loader').show();
            document.msgmaj.action="gestion/achatpa.php";
            document.msgmaj.submit();
        }
        else if (MSG_OBJET[i] == "LOCATION"){
            $('#page-loader').show();
            document.msgmaj.action="gestion/achatpa.php";
            document.msgmaj.submit();
        }
        else if (MSG_OBJET[i] == "OUVRIR_RELATION"){
            $('#page-loader').show();
            document.msgmaj.action="gestion/ouvrirrelation.php";
            document.msgmaj.submit();
        }
        else if (MSG_OBJET[i] == "DEFINIR_TAUX"){
            $('#page-loader').show();
            document.msgmaj.action="gestion/definirtaux.php";
            document.msgmaj.submit();
        }
        else if (MSG_OBJET[i] == "VENTE_TITRE"){
            $('#page-loader').show();
            document.msgmaj.action="gestion/achattitre.php";
            document.msgmaj.submit();
        }
    }
}

function annuler(){
    $('#page-loader').show();
    document.msgmaj.action="gestion/annulermsg.php";
    document.msgmaj.submit();
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

<body onload="infojoueur(); AfficheMessagerie(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_messagerie.js"></script>
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
                                <li>Vous devez valider, ou refuser, les propositions qui vous sont faites si la date d'expiration n'a pas été dépassée.
                                    Vous avez la possibilité d'Annuler une proposition si celle ci n'a pas encore été validée.
                                <li>En cas de validation d'un achat, des contrôles sont effectués pour assurer la cohérence de la demande avec la situation actuelle.
                                    C'est à cet instant que sont exploitées les données d'état, comme le taux de change et l'éventuelle taxe.
                                <li>Cliquez sur la demande pour effectuer une action.
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
        <td valign=top class="cadreClair">
            <CENTER><div id="divSelectMesg"> </div></CENTER>
        </td>
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top>
            <CENTER><div id="tabgaucheb"> </div></CENTER>
        </td>
        <td valign=top>
            <div class="cadrePrincipal">
                <div class="textGros"><CENTER><b>Messagerie</b></CENTER></div>
                <div id="divMessagerie" class="scroll-1"></div>
            </div>
        </td>
        <td valign=top>
            <CENTER><div id="tabdroiteb"> </div></CENTER>
        </td>
    </tr>
</table>

</div></CENTER>

</body>
</html>