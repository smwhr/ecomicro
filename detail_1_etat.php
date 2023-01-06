<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $etat = addslashes(trim($_GET['etat']));
    $verification ="formulaire.php?retour=detail_1_etat.php?etat=" .$etat;
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>
<html>
<head>
    <title> Détail entité </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

<?php
  require("gestion/gest_detail_1_etat.php");
?>

<script language="javascript" type="text/javascript">
function majelec(){
    document.electionetat1.action="gestion/electionetat.php";
    document.electionetat1.submit();
}

function voterelec(){
    document.voteretat1.action="gestion/voteretat.php";
    document.voteretat1.submit();
}

function majetat(){
    if (document.getElementById('mleco').value == ""){
        alert("L'email de le ML eco est obligatoire.");
    }
    else{
        if ((document.getElementById('mleco').value.length > 100)){
           alert("L'email de le ML eco est limité à 100 caract�res.");
        }
        else{
            if ((document.getElementById('forum').value.length > 100)){
                alert("L'adresse du forum est limité à 100 caract�res.");
            }
            else{
                if ((document.getElementById('site').value.length > 100)){
                    alert("L'adresse du site est limité à 100 caract�res.");
                }
                else{
                    if ((document.getElementById('drapeau').value.length > 100)){
                        alert("L'adresse du drapeau est limité à 100 caract�res.");
                    }
                    else{
                        $('#page-loader').show();
                        document.modifetat1.action="gestion/modifetat.php";
                        document.modifetat1.submit();
                    }
                }
            }
        }
    }
}

function majbesoin(){
    if ((isNaN(parseInt(document.getElementById('nbdeduite').value))) || (parseInt(document.getElementById('nbdeduite').value) <= 0)){
        alert("La quantité doit être supérieure à zero.");
    }
    else{
        $('#page-loader').show();
        document.modifbesoin1.action="gestion/modifbesoin.php";
        document.modifbesoin1.submit();
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

<body onload="infojoueur(); AfficheEtat(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_detail_1_etat.js"></script>
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
                        <div id="enteted" class="cadreClair"> 
                            <ul>
                                <li>Affiche le détail d'un état.
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
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top width='50%'>
            <div class="cadrePrincipal" style="height:500px;">
                <div class="textGros"><CENTER><b>Etat</b></CENTER></div>
                <div id="divEtat" style="display:none;"> </div>
                <div id="divModifEtat" style="display:none;"> </div>
            </div>
        </td>
        <td valign=top width='50%'>
            <div class="cadrePrincipal" style="height:500px;">
                <div id="divElectionEtat" style="display:none;"> </div>
                <div id="divVoteEtat" style="display:none;"> </div>
                <div id="divBesoinEtat" style="display:none;"> </div>
            </div>
        </td>

        <td valign=top width='400'>
            <CENTER>
                <div class="margin5 padding5" style="height:540px;"> 
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/achat1.jpg" alt="" width="215" height="135" />
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    </BR>
                    <img src="obj/achat2.jpg" alt="" width="215" height="135" />
                </div>
            </CENTER>
        </td>
    </tr>
</table>
</div></CENTER>
</body>
</html>