<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=relation_etat.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>
<html>
<head>

    <title>Relations internationales</title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

<?php
  require("gestion/gest_relation_etat.php");
?>
<script language="javascript" type="text/javascript" >
function majrelation(){
    
    if ((($("#vision").val() == '0') && ($("#visionav").val() == '1')) || (($("#eco").val() == '0') && ($("#ecoav").val() == '1'))){
        $('#page-loader').show();
        document.modifrelation1.action="gestion/mes_relation.php";
        document.modifrelation1.submit();
    }
    else{
        $('#page-loader').show();
        document.modifrelation1.action="gestion/modifrelation.php";
        document.modifrelation1.submit();
    }
}

function newrelation(){
    $('#page-loader').show();
    document.newrelation1.action="gestion/newrelation.php";
    document.newrelation1.submit();
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

<body onload="infojoueur(); AfficheRelation(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_relation_etat.js"></script>
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
                                <li>Liste les relations entre les états.
                                <li>Lorsque qu'un pays n'est pas visible, il devient absent des listes (entreprise, stock et citoyen) et le commerce devient impossible.
                                    Lorsque l'économie est fermée avec une nation, aucun échange commercial n'est possible entre les deux pays considérés.
                                <li>Toute modification entraine une mise à jour identique pour l'autre partie.
                                    Pour ouvrir l'économie ou permettre la visualisation, une acceptation est nécessaire par l'autre partie.
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
                <div class="textGros"><CENTER><b>Relation Internationales</b></CENTER></div>
                <div id="divRelation">
                    <table border='0' width='100%' cellspacing="0">
                        <tr height='40'>
                            <td width='125'><b>Pays 1</b></td>
                            <td width='125'><b>Pays 2</b></td>
                            <td width='25'><b>Vision</b></td>
                            <td width='25'><b>Economie</b></td>
                            <td width='50'><b>date màj</b></td>
                        </tr>
                    </table>
                    <div id="tabcentreb" class="scroll-1"> </div>
                </div>
                <div id="divNewRelation" style="display:none; height:500px;"> </div>
            </div>
        </td>

        <td valign=top width='400'>
            <CENTER>
                <div class="margin5 padding5" style="height:540px;"> 
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/relation1.jpg" alt="" width="215" height="135" />
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/relation2.jpg" alt="" width="215" height="135" />
                </div>
            </CENTER>
        </td>
    </tr>
</table>
</div></CENTER>

</body>
</html>