<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=info_etat.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>
<html>
<head>

    <title>Informations générales des états</title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

<?php
  require("gestion/gest_info_etat.php");
?>

<script language="javascript" type="text/javascript" >
function majpays(){
    if (($('nompays').val() == "") || ($('devise').val() == "") || ($('mleco').val() == "")){
        alert("Veuillez renseignez tous les champs.");
    }
    else{
        if ($('nompays').val().length > 50){
            alert("Le nom du pays ne peut excéder 50 caractères.");
        }
        else{
            if ($('mleco').val().length > 50){
                alert("L'email de la ML économisue du pays ne peut excéder 50 caractères.");
            }
            else{
                if ($('devise').val().length > 3){
                    alert("La devise du pays ne peut excéder 50 caractères.");
                }
                else{
                    $('#page-loader').show();
                    document.modifpays.action="gestion/modifnation.php";
                    document.modifpays.submit();
                }
            }
        }
    }
}

function newpays(){
    if (($('#nompays').val() == "") || ($('#devise').val() == "") || ($('#mleco').val() == "")){
        alert("Veuillez renseignez tous les champs.");
    }
    else{
        if ($('#nompays').val().length > 50){
            alert("Le nom du pays ne peut excéder 50 caractères.");
        }
        else{
            if ($('#mleco').val().length > 50){
                alert("L'email de la ML économisue du pays ne peut excéder 50 caractères.");
            }
            else{
                if ($('#devise').val().length > 3){
                    alert("La devise du pays ne peut excéder 50 caractères.");
                }
                else{
                    for (ind01 = 0; ind01 < LIST_PAYS_IDPAYS.length; ind01++){
                        if ((LIST_PAYS_NOMPAYS[ind01] == $('#nompays').val()) || (LIST_PAYS_DEVISE[ind01] == $('#devise').val())){
                            alert("Le nom ou la devise du pays existe déjà.");
                            return;
                        }
                    }
                    for (ind01 = 0; ind01 < LIST_CIT_IDUSER.length; ind01++){
                        if ((LIST_CIT_NOM[ind01] == $('#nomA').val()) || (LIST_CIT_LOGIN[ind01] == $('#loginA').val())){
                            alert("Le nom ou le login du dirigeant existe déjà.");
                            return;
                        }
                    }
                    document.newpays1.action="gestion/newnation.php";
                    document.newpays1.submit();
                }
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

<body onload="infojoueur(); AfficheInfo(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_info_etat.js"></script>
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
                            <li>Liste les états.
                            <li>En cliquant sur le nom d'un pays, vous pouvez visualiser et modifier (selon vos droits) le détail.
                        
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
        <td valign=top>
            <div class="cadrePrincipal">
                <div class="textGros"><CENTER><b>Nations du Micromonde</b></CENTER></div>
                <div id="tabcentreb" class="scroll-1"> </div>
            </div>
        </td>
        <td valign=top width='400'>
            <CENTER>
                <div class="margin5 padding5" style="height:540px;"> 
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/etat2.jpg" alt="" width="150" height="200" />
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/etat1.jpg" alt="" width="150" height="200" />
                </div>
            </CENTER>
        </td>
    </tr>
</table>
</div></CENTER>

</body>
</html>