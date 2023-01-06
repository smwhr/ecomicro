<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>

<html>
<head>

    <title> Profil </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

<?php
  require("gestion/gest_new_user_profile.php");
?>

<script language="javascript" type="text/javascript" >

function majprofil(){
    if ($('#login').val().length > 20){
        alert("Le login ne peut excéder 20 caract�res.");
        return;
    }
    if ($('#email').val().length > 50){
        alert("L'email ne peut excéder 50 caractères.");
        return;
    }
    if ($('#nom').val().length > 50){
        alert("Le nom ne peut excéder 50 caractères.");
        return;
    }
    if ($('#portrait').val().length > 100){
        alert("Le portrait ne peut excéder 100 caractères.");
        return;
    }
    if (($('#nom').val() == "") || ($('#login').val() == "") || ($('#email').val() == "")){
        alert("Vous devez renseigner le nom, le login et l'email.");
        return;
    }
    for (ind01 = 0; ind01 < LIST_CIT_LOGIN.length; ind01++){
        if ((LIST_CIT_LOGIN[ind01] == $('#login').val()) && (LIST_CIT_IDUSER[ind01] != IDUSER)){
            alert("Ce login est déjà utilisé, désolé.");
            return;
        }
        if ((LIST_CIT_NOM[ind01] == $('#nom').val()) && (LIST_CIT_IDUSER[ind01] != IDUSER)){
            alert("Ce nom est déjà utilisé, désolé.");
            return;
        }
    }
    if ($('#residence1').val() == ""){
       alert("Vous devez choisir une résidence.");
       return;
    }

    document.modifprofil.action="gestion/modifnewprofil.php";
    document.modifprofil.submit();
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

<body onload="infojoueur(); Profil(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_new_user_profile.js"></script>
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
                                <li>Un login et un mot de passe pour vous connecter, rien de bien original !
                                <li>L'Email saisi sera affiché. C'est le moyen dont dispose l'ensemble des utilisateurs pour vous contacter.
                                <Li>L'Email vous permettra de récupérer votre mot de passe en cas d'oubli.
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
        <td valign=top width='250'>
            <div class="rond-3 margin5" style="height:500px;">
                </br></br>
                </br></br>
                <CENTER><img src="obj/profil_1.jpg" width=200 height=135 alt="ecomicro profil citoyen 1"></CENTER>
            </div>
        </td>
        <td valign=top>
            <div class="cadrePrincipal" style="height:500px;">
                <div class="textGros"><CENTER><b>Modification de votre profil</b></CENTER></div>
                <CENTER><div id="tabcentrec"></div></CENTER>
            </div>
        </td>
        <td valign=top width='250'>
            <div class="rond-3 margin5" style="height:500px;">
                </br></br>
                </br></br>
                <CENTER><img src="obj/profil_2.jpg" width=200 height=135 alt="ecomicro profil citoyen 2"></CENTER>
            </div>
        </td>
    </tr>
</table>

    </div></CENTER>
</body>
</html>
