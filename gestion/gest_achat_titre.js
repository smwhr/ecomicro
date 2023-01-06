function AfficheTitre(){
    RAZ_tout();
    MenuTransac();
    SelectPays();
    Titre();
}

function Titre(){
    var temp;
    var ind01;

    var pays = $("#pays1").val();

    temp = "<table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < TITRE_IDENTREPRISE.length; ind01++){
        if ((pays == TITRE_IDPAYS[ind01]) || (pays == '0')){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";
            temp += "<td width='150'>" + TITRE_NOMPAYS[ind01] + "</td>";
            temp += "<td width='150'><b><a href='#' onclick='AchatTitre(" + ind01 + ");'>" + TITRE_NOMENTREPRISE[ind01] + "</a></b></td>";
            temp += "<td width='150'>" + TITRE_NOMACTIONNAIRE[ind01] + "</td>";
            temp += "<td align=right width='50'>" + TITRE_NBACTION[ind01] + "</td>";
            temp += "<td width='100'><CENTER>" + TITRE_DATEMAJ[ind01].substring(0,10) + "</CENTER></td></tr>";
        }
    }

    temp += "</table>";
    $("#achatTitre").html(temp);
    $("#divAchatTitre").show();
    $("#divTitre").hide();
}



function SelectPays(){
    temp = "<table width='100%'><tr>";
    temp += "<td class='textBleu'>&nbsp;&nbsp;Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Titre();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
        temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";

    temp += "</SELECT></td>";

    temp += "<td class='textBleu'>(sélectionnez votre fournisseur)</td>";
    temp += "</tr></table>"

    $("#tabcentrec").html(temp);
}

function AchatTitre(entre){
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheTitre();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    $("#tabcentrec").html(temp);

    temp = "<FORM name='achattitre1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Achat de :&nbsp;</td>";
    temp += "<td colspan='2'><b><FONT size=2>" + TITRE_NOMENTREPRISE[entre] + "&nbsp;à&nbsp;" + TITRE_NOMACTIONNAIRE[entre] + "&nbsp;(" + TITRE_NOMPAYS[entre] + ")</FONT></b></td></tr>";

    temp += "<tr></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte acheteur : &nbsp;</td><td><SELECT name='idcpte1' id='idcpte1' onchange='ChangeCpte();'>";
    temp += "<OPTION value='0'>Pas de sélection&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++){
         temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>" + CPTEP_NCPTE[ind01] + " - " + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + ")&nbsp;&nbsp;";
    }
    temp += "</SELECT></td></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte vendeur : &nbsp;</td><td><SELECT name='idcpte2' id='idcpte2' onchange='ChangeCpte();'>";
    temp += "<OPTION value='0'>Pas de sélection&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < ACHAT_CPTE_NCPTE.length; ind01++){
        if ((TITRE_IDACTIONNAIRE[entre] == ACHAT_CPTE_IDTITULAIRE[ind01]))
            temp += "<OPTION value='" + ACHAT_CPTE_NCPTE[ind01] + "'>" + ACHAT_CPTE_NCPTE[ind01] + " - " + ACHAT_CPTE_NOMCPTE[ind01] + "&nbsp;(" + ACHAT_CPTE_DEVISE[ind01] + ")&nbsp;&nbsp;";
    }
    temp += "</SELECT></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Nb de titres achetés :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'><INPUT type='text' name='nbunite' id='nbunite' size='4' align=right>&nbsp;" + TITRE_NOMENTREPRISE[entre] + "</td></tr>";

    temp += "<tr><td width='150' class='textBleu'>&nbsp;&nbsp;Au tarif unitaire de :&nbsp;</td>";
    temp += "<td colspan='2'>";
    temp += "<INPUT type='text' name='tarif' id='tarif' size='4' align=right>";
    temp += "&nbsp;<INPUT type='text' name='deviseA' id='deviseA' size='2' align=right>";
    temp += "&nbsp;&nbsp;soit pour le vendeur : ";
    temp += "<INPUT type='text' name='tarifB' id='tarifB' size='4' align=right>";
    temp += "&nbsp;<INPUT type='text' name='deviseB' id='deviseB' size='2' align=right>";
    temp += "</td>";
    temp += "</tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valtotaltitre value='Total' onclick='ChangeCpte();'></td>";
    temp += "<td><INPUT type='text' name='total' id='total' size='4' align=right>";
    temp += "&nbsp;<INPUT type='text' name='deviseA1' id='deviseA1' size='2' align=right>";
    temp += "</td>";
    temp += "</tr>";

    temp += "<tr>";
    temp += "</tr>";

    temp += "<tr>";
    temp += "<td><INPUT type='hidden' name='soldeA' id='soldeA' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='idpaysA' id='idpaysA' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='entreA' id='entreA' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='entreB' id='entreB' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='idtitre' id='idtitre' size='4'></td>";
    temp += "</tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valachattitre value='Proposer' onclick='valachat("+ entre + ");'></td>";
    temp += "<td class='textRouge'>(Le taux de change est appliqué et un compte d'état utilisé le cas échéant)</td></tr>";

    temp += "</table>";

    temp += "</FORM>";

    $("#divTitre").html(temp);
    $("#divAchatTitre").hide();
    $("#divTitre").show();
    
    $("#idtitre").val(TITRE_IDENTREPRISE[entre]);

    ChangeCpte();
}

function ChangeCpte(){

    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++){
        if (CPTEP_NCPTE[ind01] == $("#idcpte1").val()){
            $("#deviseA").val(CPTEP_DEVISE[ind01]);
            $("#deviseA1").val(CPTEP_DEVISE[ind01]);
            $("#soldeA").val(CPTEP_SOLDE[ind01]);
            $("#idpaysA").val(CPTEP_IDPAYS[ind01]);
            $("#entreA").val(CPTEP_IDTITULAIRE[ind01]);
            break;
        }
    }

    for (ind01 = 0; ind01 < ACHAT_CPTE_NCPTE.length; ind01++){
        if (ACHAT_CPTE_NCPTE[ind01] == $("#idcpte2").val()){
            $("#deviseB").val(ACHAT_CPTE_DEVISE[ind01]);
            $("#entreB").val(ACHAT_CPTE_IDTITULAIRE[ind01]);
            break;
        }
    }

    if (!isNaN(parseFloat($("#tarif").val()))){
        for (ind01 = 0; ind01 < TX_DEVISE1.length; ind01++){
            if ((TX_DEVISE1[ind01] == $("#deviseB").val()) && (TX_DEVISE2[ind01] == $("#deviseA").val())){
                $("#tarifB").val($("#tarif").val() * TX_TAUX[ind01]);
                break;
            }
        }
        if ((!isNaN(parseFloat($("#nbunite").val()))) && (parseFloat($("#nbunite").val()) > 0)){
            $("#total").val($("#tarif").val() * $("#nbunite").val());
        }
        else{
            $("#nbunite").val('0');
        }
    }
    else{
        $("#tarif").val('0');
        $("#tarifB").val('0');
        $("#total").val('0');
    }
}

function RAZ_tout(){
    $("#tabcentrec").html("");
}

function MenuTransac(){
    var temp;
    temp = "<table width='100%'><tr>";

    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonVert' onClick='gotoTransac();'>Transaction</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonOrange' onClick='gotoStock();'>Achat Stock</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonMarron' onClick='gotoProduit();'>Achat Produit</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonRouge' onClick='gotoTitre();'>Achat Titre</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonBlanc' onClick='gotoPA();'>Petites Annonces</div>";
    temp += "</td>";
    
    temp += "</tr></table>";
    $("#divSSMenuTransac").html(temp);
}


function gotoTransac(){
    $('#page-loader').show();
    $tmp = "transaction.php";
    document.location.replace($tmp);
}
function gotoStock(){
    $('#page-loader').show();
    $tmp = "achat_stock.php";
    document.location.replace($tmp);
}
function gotoProduit(){
    $('#page-loader').show();
    $tmp = "achat_produit.php";
    document.location.replace($tmp);
}
function gotoTitre(){
    $('#page-loader').show();
    $tmp = "achat_titre.php";
    document.location.replace($tmp);
}
function gotoPA(){
    $('#page-loader').show();
    $tmp = "achat_pa.php";
    document.location.replace($tmp);
}
