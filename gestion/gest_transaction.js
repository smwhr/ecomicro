 
var ppays = 0;
var ttype = 'C';

function Transaction(){

    temp = "<FORM name='transaction' method='post' action=''>";
    temp += "<table border='0' width='100%'>";
    
    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte Origine : &nbsp;</td>"; 
    temp += "<td colspan='2'><SELECT name='idcpte1' id='idcpte1' onchange='ChangeCpte();'>";
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++)
        temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>" + CPTEP_NCPTE[ind01] + " - " + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + ")&nbsp;&nbsp;";
    temp += "</SELECT></td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td width='250' class='textBleu'>&nbsp;&nbsp;Montant :&nbsp;</td>";
    temp += "<td colspan='2'>";
    temp += "<INPUT type='text' name='montant' id='montant' size='4' align=right>";
    temp += "&nbsp;&nbsp;<INPUT type='text' name='deviseA' id='deviseA' size='2' align=right>";
    temp += "</td>"; 
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td class='textBleu' width='250' >&nbsp;&nbsp;Pays : </td><td class='textBleu' colspan='2'><SELECT name='pays' id='pays' onchange='ChangeSel();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++){
        if (LIST_PAYS_IDPAYS[ind01] == ppays)
            temp += "<OPTION selected=TRUE value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
        else
            temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
    }
    temp += "</SELECT>";
    
    temp += "&nbsp;&nbsp;";
    temp += "Type : &nbsp;&nbsp;<SELECT name='type' id='type' onchange='ChangeSel();'>";
    if (ttype == 'A')
        temp += "<OPTION selected=TRUE value='A'>Pays&nbsp;&nbsp;";
    else
        temp += "<OPTION value='A'>Pays&nbsp;&nbsp;";
    if (ttype == 'B')
        temp += "<OPTION selected=TRUE value='B'>Entreprise&nbsp;&nbsp;";
    else
        temp += "<OPTION value='B'>Entreprise&nbsp;&nbsp;";
    if (ttype == 'C')
        temp += "<OPTION selected=TRUE value='C'>Citoyen&nbsp;&nbsp;";
    else
        temp += "<OPTION value='C'>Citoyen&nbsp;&nbsp;";
    temp += "</SELECT>";
    temp += "</td></tr>";
    
    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte Destination : &nbsp;</td>";
    temp += "<td colspan='2'><SELECT name='idcpte2' id='idcpte2' onchange='ChangeCpte();'>";
    for (ind01 = 0; ind01 < CPTE_TRANSAC_NCPTE.length; ind01++){
        if (((CPTE_TRANSAC_IDPAYS[ind01] == ppays) || (ppays == 0)) && (CPTE_TRANSAC_TYPE[ind01] == ttype))
            temp += "<OPTION value='" + CPTE_TRANSAC_NCPTE[ind01] + "'>" + CPTE_TRANSAC_NCPTE[ind01] + " - " + CPTE_TRANSAC_NOMCPTE[ind01] + "&nbsp;(" + CPTE_TRANSAC_DEVISE[ind01] + ")&nbsp;&nbsp;";
    }
    temp += "</SELECT>";
    
    temp += "<b>&nbsp;==>>&nbsp;</b><INPUT type='text' name='montantB' id='montantB' size='4' align=right>";
    temp += "&nbsp;&nbsp;<INPUT type='text' name='deviseB' id='deviseB' size='2' align=right>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td width='250' class='textBleu'>&nbsp;&nbsp;Commentaire :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='com' id='com' size='65' align=left></td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td class='textBleu' width='250' valign=top>&nbsp;&nbsp;Périodicité : &nbsp;</td>";
    temp += "<td width='250'><INPUT type='checkbox' name='desuite' id='desuite' CHECKED>Tout de suite !";
    temp += "<br><INPUT type='checkbox' name='periodique' id='periodique'>Périodique";
    temp += "<br>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type='radio' name='frequence' id='mensuel' value='1' CHECKED>Mensuel";
    temp += "<br>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type='radio' name='frequence' id='bimestriel' value='2'>Bimestriel";
    temp += "<br>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type='radio' name='frequence' id='trimestriel' value='3'>Trimestriel";
    
    temp += "</td><td><SELECT name='periode' id='periode'>";
    temp += "<OPTION value='1'>Début de mois&nbsp;&nbsp;";
    temp += "<OPTION value='2'>Milieu de mois&nbsp;&nbsp;";
    temp += "<OPTION value='3'>Fin de mois&nbsp;&nbsp;";
    temp += "</SELECT></td>";
    temp += "</tr>";

    temp += "<tr>";
    temp += "<td><INPUT type='hidden' name='soldeA' id='soldeA' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='idpaysA' id='idpaysA' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='idpaysB' id='idpaysB' size='4'></td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td width='250'><INPUT type=button name=valtransac value='Valider' onclick='transac();'></td>";
    temp += "<td class='textRouge' colspan='2'>(Le taux de change est appliqué et un compte d'état utilisé le cas échéant)</td>";
    temp += "</tr>";
    
    temp += "</table>";
    temp += "</FORM>";
    
    $("#transac").html(temp);
    ChangeCpte();
}



function ChangeSel(){
  ttype = $("#type").val();
  ppays = $("#pays").val();
  Transaction();
}

function ChangeCpte(){
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++){
        if (CPTEP_NCPTE[ind01] == $("#idcpte1").val()){
            $("#soldeA").val(CPTEP_SOLDE[ind01]);
            $("#idpaysA").val(CPTEP_IDPAYS[ind01]);
            $("#deviseA").val(CPTEP_DEVISE[ind01]);
        }
    }
    
    for (ind01 = 0; ind01 < CPTE_TRANSAC_NCPTE.length; ind01++){
        if (CPTE_TRANSAC_NCPTE[ind01] == document.getElementById("idcpte2").value){
            $("#idpaysB").val(CPTE_TRANSAC_IDPAYS[ind01]);
            $("#deviseB").val(CPTE_TRANSAC_DEVISE[ind01]);
        }
    }
    
    if (!isNaN(parseFloat($("#montant").val()))){
        for (ind01 = 0; ind01 < TX_DEVISE1.length; ind01++){
            if ((TX_DEVISE1[ind01] == $("#deviseB").val()) && (TX_DEVISE2[ind01] == $("#deviseA").val())){
                $("#montantB").val($("#montant").val() * TX_TAUX[ind01]);
                break;
            }
        }
    }
    
    else{
        $("#montant").val('0');
        $("#montantB").val('0');
    }
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
