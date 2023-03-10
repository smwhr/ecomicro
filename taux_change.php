<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=taux_change.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>
<html>
<head>

    <title>Taux de change</title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

<?php
  require("gestion/gest_taux_change.php");
?>
<script language="javascript" type="text/javascript" >
function majtauxchange(){
    if ((isNaN(parseFloat($('#taux').val()))) || (parseFloat($('#taux').val()) <= 0)){
        alert("Il s'agit de renseigner un nombre positif.");
    }
    else{
        if ($('deviseA').val() == $('#deviseB').val())
            $('taux').val(1);

        if (parseFloat($('#taux').val()) != parseFloat($('#tauxav').val())){
            $('#page-loader').show();
            document.modiftauxchange.action="gestion/mes_taux.php";
            document.modiftauxchange.submit();
        }
        else{
            $('#page-loader').show();
            document.modiftauxchange.action="gestion/modiftaux.php";
            document.modiftauxchange.submit();
        }
    }
}

function newtauxchange(){
    if ((isNaN(parseFloat($('taux').val()))) || (parseFloat($('taux').val()) <= 0)){
       alert("Il s'agit de renseigner un nombre positif.");
    }
    else{
        for (ind01 = 0; ind01 < TX_DEVISE1.length; ind01++){
            if ((TX_DEVISE1[ind01] == $('deviseA').val()) && (TX_DEVISE2[ind01] == $('deviseB').val())){
                alert("Ce taux de change existe déjà.");
                return;
            }
        }
        if ($('deviseA').val() == $('deviseB').val())
            $('taux').val(1);

        $('#page-loader').show();
        document.newtauxchange1.action="gestion/mes_taux.php";
        document.newtauxchange1.submit();
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

<body onload="infojoueur(); AfficheTauxChange(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_taux_change.js"></script>
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
                                <li>Liste le taux de change entre les diffèrentes devises.
                                <li>Toute modification d'un taux de change attend sa validation par l'autre partie.
                                <li>Le compte d'état est celui du pays 1, utilisé pour les échanges en devise 2.
                                <br>
                                <br>
                                <li>Montant en devise 1 = Montant en devise 2 multiplié par le taux.
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
        <td valign=top width='400'></td>
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top>
            <div class="cadrePrincipal">
                <div class="textGros"><CENTER><b>Taux de change</b></CENTER></div>
                <div id="divTaux">
                    <table border='0' width='100%' cellspacing="0">
                        <tr height='40'>
                            <td width='200'><b><CENTER>Devise Pays 1</CENTER></b></td>
                            <td width='200'><b><CENTER>Devise Pays 2</CENTER></b></td>
                            <td width='75'><CENTER><b>Taux</b></CENTER></td>
                            <td width='75'><CENTER><b>Compte</b></CENTER></td>
                        </tr>
                    </table>
                    <div id="tabcentreb" class="scroll-1"> </div>
                </div>
                <div id="divNewTaux" style="display:none; height:500px;"> </div>
            </div>
        </td>

        <td valign=top width='400'>
            <CENTER>
                <div class="margin5 padding5" style="height:540px;"> 
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/taux_2.jpg" alt="" width="215" height="135" />
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/taux_1.png" alt="" width="215" height="135" />
                </div>
            </CENTER>
        </td>
    </tr>
</table>
</div></CENTER>

</body>
</html>