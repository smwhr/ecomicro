<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=compte_gere.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>
<html>
<head>
    <title> Comptes gérés </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>
    <script language="Javascript" type="text/javascript" src="include/format.20110630-1100.min.js"></script>

<?php
  require("gestion/gest_compte_gere.php");
?>

<script language="javascript" type="text/javascript" >
function newcompte(){
    if ($('#nomcompte').val().length > 50){
      alert("Le libellé du compte ne peut excéder 50 caractères.");
    }
    else{
        if (($('#nomcompte').val() == "") || ($('#titulaire').val() == "") || ($('#devise').val() == "")){
            alert("Vous devez renseigner tous les champs.");
        }
        else{
            $('#page-loader').show();
            document.newcompte1.action="gestion/newcompte.php";
            document.newcompte1.submit();
        }
    }
}
function supprcompte(){
    $('#page-loader').show();
    document.supprcompte1.action="gestion/supprcompte.php";
    document.supprcompte1.submit();
}
function supprtransac(){
    $('#page-loader').show();
    document.supprtransac1.action="gestion/supprtransac.php";
    document.supprtransac1.submit();
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

<body onload="infojoueur(); AfficheCpteBanque(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_compte_gere.js"></script>
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
                NKWeb, Kaora 2005
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
                                <li>Liste tous les comptes bancaires que vous gérez.
                                <li>Apparaissent en bleu vos comptes personnels, en gras les comptes gérés.
                                <li>En cliquant sur un numéro de compte vous pouvez visualiser à droite le détail des mouvements.
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


<div>
    <div id="cpte" class="cadreClair positionCpte Cpte" onmouseover="$('#divCpte').show();" onmouseout="$('#divCpte').hide();">
        <div id="titreCpte" class="textGros">Comptes bancaires</div>
        <div id="divCpte" class="relativeCpte cadreClair">
            <CENTER><div id="tabcentred"> </div></CENTER>
            <table border='0' width='100%'>
                <tr height='40'>
                    <td width='50'><CENTER><b>N° Compte</b></CENTER></td>
                    <td width='200'><b>Nom</b></td>
                    <td width='100'><CENTER><b>Solde</b></CENTER></td>
                </tr>
            </table>
            <div id="divLstCpte" class="scroll-1" onclick="$('#divCpte').hide();"> </div>
        </div>
    </div>
    <table width='100%'>
        <tr>
            <td valign=top class="cadreClair">
                <CENTER><div id="tabcentrec"> </div></CENTER>
            </td>
            <td valign=top width='400'>
            </td>
        </tr>
    </table>


        
<table width='100%'>
    <tr>
        <td valign=top>
            <div id="action" class="cadreClair margin5">
            </div>
            <div class="cadreClair">
                <div id="titreMvtPeriodique" class="textGros" onClick="$('#divMvtPeriodique').slideToggle('slow');"></div>
                <div id="divMvtPeriodique">
                    <table border='0' width='100%' cellspacing="0">
                        <tr height='40'>
                            <td width='30'><CENTER><b>N°</b></CENTER></td>
                            <td width='50'><CENTER><b>Montant</b></CENTER></td>
                            <td width='50'><CENTER><b>Cpte Aux</b></CENTER></td>
                            <td width='150'><b>Tiers</b></td>
                            <td width='200'><b>Commentaire</b></td>
                            <td width='50'><b>Fréquence</b></td>
                            <td width='100'><b>Jour</b></td>
                        </tr>
                    </table>
                    <div id="mvtPeriodique" class="scroll-2"> </div>
                </div>
            </div>
            <div class="cadrePrincipal">
                <div id="titreMvt" class="textGros"></div>
                <div id="divMvt">
                    <table border='0' width='100%' cellspacing="0">
                        <tr height='40'>
                            <td width='50'><CENTER><b>N° Mvt</b></CENTER></td>
                            <td width='50'><CENTER><b>Montant</b></CENTER></td>
                            <td width='50'><CENTER><b>Cpte Aux</b></CENTER></td>
                            <td width='150'><b>Tiers</b></td>
                            <td width='300'><b>Commentaire</b></td>
                            <td width='50'><CENTER><b>Date heure</b></CENTER></td>
                        </tr>
                    </table>
                    <div id="mvt" class="scroll-1"> </div>
                </div>
            </div>
        </td>

    </tr>
</table>
</div>

</div></CENTER>

</body>
</html>