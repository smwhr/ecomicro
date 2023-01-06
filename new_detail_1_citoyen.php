<?php
session_start();
if (!isset($_SESSION['perso_iduser'])){
    $citoyen = addslashes(trim($_GET['citoyen']));
    $verification ="formulaire.php?retour=new_detail_1_citoyen.php?citoyen=" .$citoyen;
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>

<html>
<head>

    <title> Détail d'un citoyen </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>
    <script language="Javascript" type="text/javascript" src="include/format.20110630-1100.min.js"></script>

<?php
  require("gestion/gest_new_detail_1_citoyen.php");
?>

<script language="javascript" type="text/javascript">

function majvendreposs(){
    $('#page-loader').show();
    document.vendreposs.action="gestion/modifpossession.php";
    document.vendreposs.submit();
}

function valmodifcitoyen(i){
    if (($('nomA').val() == "") || ($('loginA').val() == "")){
        alert("Le nom et le login sont obligatoires.");
    }
    else{
        if (($('loginA').val() != DET_CIT_LOGIN[i]) && ($('pwdA').val() == "")){
            alert("Vous devez changer le mot de passe si vous changer le login.");
        }
        else{
            if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '5')){
                $('#page-loader').show();
                document.modifcitoyen.action="gestion/modifcitoyen.php";
                document.modifcitoyen.submit();
           }
            else{
                if ((AUTORISATION.substring(1,2) == '5') && ($('idpaysA').val() == tabLC_IDPAYS[i])){
                    $('#page-loader').show();
                    document.modifcitoyen.action="gestion/modifcitoyen.php";
                    document.modifcitoyen.submit();
                }
                else
                    alert("Vous n'avez pas l'autorisation de changer le pays");
            }
        }
    }
}

function valnewcitoyen(){

    if (($('#nomA').val() == "") || ($('#loginA').val() == "")){
        alert("Le nom, le login et le mot de passe sont obligatoires.");
    }
    else{
        $('#page-loader').show();
        document.newcitoyen.action="gestion/newcitoyen.php";
        document.newcitoyen.submit();
    }
}

function modifresidence(){
    if ($('residence1').val() == ""){
        alert("Choix de la résidence invalide.");
    }
    else{
        $('#page-loader').show();
        document.modifresidence1.action="gestion/modifcitoyenresidence.php";
        document.modifresidence1.submit();
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

<script language="Javascript" type="text/javascript" src="gestion/gest_new_detail_1_citoyen.js"></script>
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
            </CENTER>
            </div>
        </td>
        <td valign=top>
            <table width='100%'>
                <tr>
                    <td valign=top width='35%'>
                        <CENTER>
                            <div id="enteteg" class="cadreClair"> </div>
                        </CENTER>
                    </td>
                    <td valign=top width='65%'>
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
                        <div id="enteted" class="cadreClair"> </div>
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
        <td valign=top>
            <table width='100%'>
                <tr>
                    <td valign=top width='100%'>
                        <CENTER>
                            <div id="directions" class="cadreClair">
                                <div onClick="$('#divDir').slideToggle('slow');" class="textGros"><b>Directions</b></div>
                                <div id="divDir"> </div> 
                            </div>
                        </CENTER>
                    </td>
                </tr>
                <tr>
                    <td valign=top>
                        <div class="cadrePrincipal">
                            <div onClick="$('#divPos').slideToggle('slow');" class="textGros"><CENTER><b>Possessions</b></CENTER></div>
                            <div id="divPos">
                                <table border='0' width='100%'>
                                    <tr height='30'>
                                        <td width='100'><CENTER><b>Action</b></CENTER></td>
                                        <td width='200'><CENTER><b>Type / Produit</b></CENTER></td>
                                        <td width='200'><CENTER><b>Image</b></CENTER></td>
                                        <td width='100'><CENTER><b>Valeur</b></CENTER></td>
                                    </tr>
                                </table>
                                <div id="possessions" class="scroll-1"> </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td valign=top width='500'>
            <div style="height:600px;">
            <table width='100%'>
                <tr>
                    <td valign=top>
                        <CENTER>
                            <div id="comptes" class="cadreClair"> 
                                <div onClick="$('#divTitres').slideToggle('slow'); $('#divComptes').slideToggle('slow');" class="textGros"><CENTER><b>Comptes</b></CENTER></div>
                                <div id="divComptes"></div>
                            </div>
                        </CENTER>
                    </td>
                </tr>
                <tr>
                    <td valign=top>
                        <CENTER>
                            <div id="titres" class="cadreClair"> 
                                <div onClick="$('#divComptes').slideToggle('slow'); $('#divTitres').slideToggle('slow');" class="textGros"><CENTER><b>Titres</b></CENTER></div>
                                <div id="divTitres"></div>
                            </div>
                        </CENTER>
                    </td>
                </tr>
                <tr>
                    <td valign=top>
                        <CENTER>
                            <div class="margin5 padding5"> 
                                <img src="obj/profil_2.jpg" alt="" width="215" height="135" />
                                </BR>
                                </BR>
                                <img src="obj/profil_1.jpg" alt="" width="215" height="135" />
                            </div>
                        </CENTER>
                    </td>
                </tr>
            </table>
            </div>
	</td>
    </tr>
</table>
</div></CENTER>
<table><tr>
<td width='100%' valign=top><div id="data_hide"> </div></td>
</tr></table>

</body>
</html>