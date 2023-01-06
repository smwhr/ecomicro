<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $entreprise = addslashes(trim($_GET['entreprise']));
    $verification ="formulaire.php?retour=new_detail_1_entreprise.php?entreprise=" .$entreprise;
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>

<html>
<head>

    <title> Détail d'une entreprise </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>
    <script language="Javascript" type="text/javascript" src="include/format.20110630-1100.min.js"></script>

<?php
    require("gestion/gest_new_detail_1_entreprise.php");
?>

<script language="javascript" type="text/javascript">

function majvendreposs(){
    document.vendreposs.action="gestion/modifpossession.php";
    document.vendreposs.submit();
}

function majconso(i){
    if ((isNaN(parseInt($("#nbdeduite").val()))) || (parseInt($("#nbdeduite").val()) <= 0)){
        alert("Le nombre d'unité à consommer n'est pas valide.");
        return;
    }

    $('#page-loader').show();
    document.consommer1.action="gestion/consommer.php";
    document.consommer1.submit();
}

function Lancer(i){
    Donne(i);

    if (valide == 1){
        $('#page-loader').show();
        document.produire1.action="gestion/produire.php";
        document.produire1.submit();
    }
}

function majproduit(i){
    if (isNaN($('#nbunite').val())){
        alert("Il semble que le nombre d'unité ne soit pas un nombre. Si vous pouviez faire quelque chose...");
        return;
    }
    if (parseInt($('#nbunite').val()) <= 0){
        alert("Le nombre d'unité doit être positif...");
	return;
    }
    if ($('#description').val().length > 250){
        alert("La description ne peut excéder 250 caractères.");
        return;
    }
    if ($('#image').val().length > 150){
        alert("L'URL de l'image ne peut excéder 150 caractères.");
	return;
    }
    if ($('#nomproduit').val().length > 50){
        alert("Le nom du produit ne peut excéder 50 caractères.");
	return;
    }
    if (($('#nomproduit').val() == "") || ($('#description').val() == "") || ($('#image').val() == "")){
        alert("Vous devez renseigner tous les champs.");
	return;
    }
    $('#page-loader').show();
    document.modifproduit.action="gestion/modifproduit.php";
    document.modifproduit.submit();
}

function supprproduit(i){
    $('#page-loader').show();
    document.modifproduit.action="gestion/supprproduit.php";
    document.modifproduit.submit();
}

function newproduit(){
    if (isNaN($('#nbunite').val())){
        alert("Il semble que le nombre d'unité ne soit pas un nombre ! Si vous pouviez faire quelque chose...");
	return;
    }
    if (parseInt($('#nbunite').val()) < 0){
        alert("Le nombre d'unité doit être positif...");
	return;
    }
    if ($('#description').val().length > 250){
        alert("La description ne peut excéder 250 caractères.");
        return;
    }
    if ($('#image').val().length > 150){
        alert("L'URL de l'image ne peut excéder 150 caractères.");
        return;
    }
    if ($('#nomproduit').val().length > 50){
        alert("Le nom du produit ne peut excéder 50 caractères.");
	return;
    }
    if (($('#nomproduit').val() == "") || ($('#description').val() == "") || ($('#image').val() == "")){
        alert("Vous devez renseigner tous les champs.");
	return;
    }
    $('#page-loader').show();
    document.newproduit1.action="gestion/newproduit.php";
    document.newproduit1.submit();
}

function modifentre(){
    if (($('#nomA').value == "") || ($('#capaA').value == "")){
        alert("Le nom et la capacité sont obligatoires.");
	return;
    }
    if (($('#nomA').val().length > 50)){
        alert("Le nom de l'entreprise est limité à 50 caractères.");
        return;
    }
    if (($('#logoA').val().length > 100)){
        alert("Le logo de l'entreprise est limité à 100 caractères.");
        return;
    }
    if (($('#siteA').val().length > 100)){
        alert("Le site de l'entreprise est limité à 100 caractères.");
        return;
    }
    if ((isNaN(parseInt($("#capaA").val()))) || (parseInt($("#capaA").val()) < 0)){
        alert("Il s'agit de saisir un nombre entier positif supérieur ou égal à zéro !");
        return;
    }
    $('#page-loader').show();
    document.modifentre1.action="gestion/modifentre.php";
    document.modifentre1.submit();
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

<script language="Javascript" type="text/javascript" src="gestion/gest_new_produit.js"></script>
<script language="Javascript" type="text/javascript" src="gestion/gest_new_produire.js"></script>
<script language="Javascript" type="text/javascript" src="gestion/gest_new_consommer.js"></script>
<script language="Javascript" type="text/javascript" src="gestion/gest_new_detail_1_entreprise.js"></script>
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
            <div id="tabgaucheh" class='margin5 logo'></div>
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
            <CENTER>
                <div id="actions"> </div>
            </CENTER>
	</td>
    </tr>
</table>

<table width='100%'>
    <tr>
	<td valign=top width='100%'>
            <table width='100%'>
                <tr>
                    <td valign=top>
                        <div class="cadrePrincipal">
                            <div id='divPos'>
                                <div class="textGros"><CENTER><b>Possessions</b></CENTER></div>
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
                            <div id='divProduit'>
                                <div class="textGros"><CENTER><b>Produits en vente</b></CENTER></div>
                                <div id="ssActionsProduit"></div>
                                <div id="headerProduit">
                                    <table border='0' width='100%'>
                                        <tr height='30'>
                                            <td width='150'><b>&nbsp;Produit / Valeur</b></td>
                                            <td width='200'><CENTER><b>Image</b></CENTER></td>
                                            <td valign=center width='250'><b>&nbsp;Description</b></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="produit" class="scroll-1"> </div>
                            </div>
                            <div id='divStock'>
                                <div class="textGros"><CENTER><b>Stocks</b></CENTER></div>
                                <div id="stock" class="scroll-1"> </div>
                            </div>
                            <div id='divConso'>
                                <div class="textGros"><CENTER><b>Consommer</b></CENTER></div>
                                <div id="conso" class="scroll-1"> </div>
                            </div>
                            <div id='divFinance'>
                                <div class="textGros"><CENTER><b>Finance</b></CENTER></div>
                                <div id="finance" class="scroll-1"> </div>
                            </div>
                            <div id='divModif'>
                                <div class="textGros"><CENTER><b>Modification</b></CENTER></div>
                                <div id="modif" class="scroll-1"> </div>
                            </div>
                        </div>
                    </td>
		</tr>
            </table>
	</td>
        <td valign=top>
            <div id="droit" style="height:600px; width:500px;">
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
                                    </BR>
                                    </BR>
                                    <img src="obj/entreprise.gif" alt="" width="215" height="135" />
                                    </BR>
                                    </BR>
                                    <img src="obj/entreprise_2.jpg" alt="" width="215" height="135" />
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
