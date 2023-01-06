<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=entreprise_detail.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>

<html>
<head>

    <title> Entreprises du Micromonde </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>
    
<?php
  require("gestion/gest_entreprise_detail.php");
?>

<script language="javascript" type="text/javascript" >
function newentre(){
    if (($('#nomA').val() == "") || ($('#capaA').val() == "")){
        alert("Veuillez renseignez tous les champs.");
    }
    else{
        if ($('#nomA').val().length > 50){
            alert("Le nom de l'entreprise ne peut excéder 50 caractères.");
        }
        else{
            if (isNaN(parseInt($('#capaA').val()))){
                alert("La capacité doit être numérique !");
            }
            else{
                if ((parseInt($('#capaA').val()) > 500) || (parseInt($('#capaA').val()) < 0)){
                    alert("La capacité doit être comprise entre 0 et 500.");
                }
                else{
                    $('#page-loader').show();
                    document.newentre1.action="gestion/newentreprise.php";
                    document.newentre1.submit();
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


<body onload="infojoueur(); AfficheEntreprise(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_entreprise_detail.js"></script>
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
                                <li>Liste les entreprises et provinces.
                                <li>En cliquant sur le nom de l'une d'entre elles, vous pouvez visualiser et modifier (selon vos droits) le détail.
                                <li>Possibilité de filtrer par pays et type d'entreprise.
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
            <CENTER><div id="divSSMenuEntreprise"> </div></CENTER>
        </td>
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top class="cadreClair">
            <CENTER><div id="tabcentrec"> </div></CENTER>
        </td>
        <td valign=top width='300'></td>
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top>
            <div class="cadrePrincipal">
                <div class="textGros"><CENTER><b>Entreprises du Micromonde</b></CENTER></div>
                <div id="divEntreprise">
                    <table border='0' width='100%' cellspacing="0">
                        <tr height='40'>
                            <td width='130'><b>&nbsp;Pays</b></td>
                            <td width='150'><b>&nbsp;Nom</b></td>
                            <td width='150'><b>&nbsp;Directeur</b></td>
                            <td width='100'><b>&nbsp;Type</b></td>
                        </tr>
                    </table>
                    <div id="entreprises" class="scroll-1"> </div>
                </div>
                <div id="divNewEntreprise" style="display:none;"> </div>
            </div>
        </td>

        <td valign=top width='300'>
            <CENTER>
                <div class="margin5 padding5" style="height:540px;"> 
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/entreprise.gif" alt="" width="215" height="135" />
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/entreprise_2.jpg" alt="" width="215" height="135" />
                </div>
            </CENTER>
        </td>
    </tr>
</table>
</div></CENTER>

</body>
</html>