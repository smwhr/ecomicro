<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=achat_stock.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>
<html>
<head>
    <title> Effectuer vos achats </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>
    <script language="Javascript" type="text/javascript" src="include/format.20110630-1100.min.js"></script>

<?php
  require("gestion/gest_achat_stock.php");
?>

<script language="javascript" type="text/javascript" >
function valachat(i){
    var tmp = "";
    if ((isNaN(parseInt(document.getElementById('nbunite').value))) || (parseInt(document.getElementById('nbunite').value) <= 0)){
     alert("Combien vous en voulez ??");
    }
    else{
        if (parseInt(document.getElementById('nbunite').value) > parseInt(ACHAT_STOC_QUANTITE[i])){
            alert("Vous en demandez trop !!");
        }
        else{
            Calcul();
        
            if (isNaN(parseInt(document.getElementById("rescalcul1").value))){
                alert("Faites le calcul d'abord...");
            }
            else{
                document.achatstock.action="gestion/mes_achatstock.php";
                document.achatstock.submit();
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

<body onload="infojoueur(); AfficheStock(); $('#page-loader').hide();" style="background-color:#E0E0E0;">

<script language="Javascript" type="text/javascript" src="gestion/gest_achat_stock.js"></script>
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
                                <li>Cet ??cran vous permet de proposer l'achat de stock.
                                    Cette proposition doit encore ??tre valid??e par le vendeur pour que l'achat soit effectif.
                                <li>Le tarif unitaire hors taxe (HT) doit ??tre saisi. Il est pr??f??rable de le n??gocier au pr??alable avec le vendeur, c'est le montant qu'il va percevoir.
                                <li>Le tarif toutes taxes comprises (TTC) est indiqu?? en appliquant la taxe d'??tat, mais il sera recalcul?? lors de la validation par le vendeur.
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
        <td valign=top>
            <CENTER><div id="divSSMenuTransac"> </div></CENTER>
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
                <div class="textGros"><CENTER><b>Achat d'unit??s de Stock</b></CENTER></div>
                <div id="divAchatStock">
                    <table border='0' width='100%' cellspacing="0">
                        <tr height='40'>
                            <td width='250'><b>&nbsp;Pays</b></td>
                            <td width='250'><b>&nbsp;Entreprise - Province</b></td>
                            <td width='100' align=right><b>Quantit??</b></td>
                        </tr>
                    </table>
                    <div id="achatStock" class="scroll-1"> </div>
                </div>
                <div id="divStock" style="display:none;"> </div>
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