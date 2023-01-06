<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=citoyen_detail.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>
<html>
<head>
    <title> Citoyens du Micromonde</title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

<?php
  require("gestion/gest_citoyen_detail.php");
?>

<script language="javascript" type="text/javascript">
function valnewcitoyen(){
    if (($('#nomA').val() == "") || ($('#loginA').val() == "") || ($('#emailA').val() == "") || ($('#pwdA').val() == "")){
        alert("Tous les champs sont obligatoires.");
    }
    else{
        if ($('#nomA').val().length > 50){
            alert("Le nom du citoyen ne peut excéder 50 caractères.");
        }
        else{
            if ($('#emailA').val().length > 50){
                alert("L'email ne peut excéder 50 caractères.");
            }
            else{
                for (ind01 = 0; ind01 < LIST_CIT_LOGIN.length; ind01++){
                    if (LIST_CIT_LOGIN[ind01] == $('#loginA').val()){
            		alert("Ce login n'est pas valide, désolé.");
            		return;
                    }
                    if (LIST_CIT_NOM[ind01] == $('#nomA').val()){
            		alert("Ce nom n'est pas valide, désolé.");
            		return;
                    }
                }
                document.newcitoyen.action="gestion/newcitoyen.php";
                document.newcitoyen.submit();
            }
        }
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

<body onload="infojoueur(); AfficheCitoyen(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_citoyen_detail.js"></script>
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
                                <li>Liste l'ensemble des citoyens.
                                <li>Cliquez sur le nom d'un citoyen pour visualiser le détail.
                                <li>Possibilité de filtrer par pays et l'activité.
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
                <div class="textGros"><CENTER><b>Citoyens du Micromonde</b></CENTER></div>
                <div id="divCitoyen">
                    <table border='0' width='100%' cellspacing="0">
                        <tr class='Titre3' height='40'>
                            <td width='175'><b>Nation</b></td>
                            <td width='175'><b>Citoyen</b></td>
                            <td width='200'><b>Email</b></td>
                            <td width='50'><b>Date d'arrivée</b></td>
                        </tr>
                    </table>
                    <div id="citoyens" class="scroll-1"> </div>
                </div>
                <div id="divNewCitoyen" style="display:none;"> </div>
            </div>
        </td>

        <td valign=top width='400'>

            <CENTER>
                <div class="margin5 padding5" style="height:540px;"> 
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/profil_2.jpg" alt="" width="215" height="135" />
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/profil_1.jpg" alt="" width="215" height="135" />
                </div>
            </CENTER>
        </td>
    </tr>
</table>
</div></CENTER>
</body>
</html>