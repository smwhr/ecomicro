function AfficheStock(){
    RAZ_tout();
    MenuTransac();
    SelectPaysUnite();
    Stock();
}

function Stock(){
    var temp;
    var ind01;
    
    var unite = document.getElementById("unite1").value;
    var pays = document.getElementById("pays1").value;
    
    temp = "<table border='0' width='100%'>";
    
    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < ACHAT_STOC_NOMENTREPRISE.length; ind01++){
        if (((unite == ACHAT_STOC_IDUNITE[ind01]) || (unite == ACHAT_STOC_IDUNITEEQUI[ind01]) || (unite == '0')) && ((pays == ACHAT_STOC_IDPAYS[ind01]) || (pays == '0'))){
            if (ACHAT_STOC_QUANTITE[ind01] > 0){
                a++;
                b = a%2;
                if (b == 0)
                    temp += "<tr class='tr1 textPetit'>";
                else
                    temp += "<tr class='tr2 textPetit'>";
                temp += "<td width='250'>" + ACHAT_STOC_NOMPAYS[ind01] + "</td>";
                temp += "<td width='250'><b><a href='#' onclick='AchatStock(" + ind01 + ");'>" + ACHAT_STOC_NOMENTREPRISE[ind01] + "</a></b></td>";
                temp += "<td align=right width='100'>" + ACHAT_STOC_QUANTITE[ind01];
                temp += "&nbsp;" + ACHAT_STOC_NOMUNITE[ind01] + "</td>";
                temp += "</tr>";
            }
        }
    }
    
    temp += "</table>";
    
    $("#achatStock").html(temp);
    $("#divAchatStock").show();
    $("#divStock").hide();
}

function SelectPaysUnite(){
    temp = "<table width='100%'><tr>";
    temp += "<td class='textBleu'>&nbsp;&nbsp;Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Stock();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
        temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
    
    temp += "</SELECT></td>";
    
    temp += "<td class='textBleu'>";
    temp += "&nbsp;&nbsp;Unité : &nbsp;<SELECT name='unite1' id='unite1' onchange='Stock();'>";
    temp += "<OPTION value='0'>Toutes&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_UNITE_IDUNITE.length; ind01++)
        temp += "<OPTION value='" + LIST_UNITE_IDUNITE[ind01] + "'>" + LIST_UNITE_NOMUNITE[ind01] + "&nbsp;&nbsp;";
    
    temp += "</SELECT></td>";
    temp += "<td class='textBleu'>(sélectionnez votre fournisseur)</td>";
    temp += "</tr></table>"
    
    $("#tabcentrec").html(temp);
}

function AchatStock(entre){
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheStock();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";
    
    $("#tabcentrec").html(temp);
    
    temp = "<FORM name='achatstock' method='post' action=''>";
    
    temp += "<table border='0' width='100%'>";
        
    if (ACHAT_STOC_IDUNITE[entre] == '80008')
        temp += "<tr><td class='textRouge' colspan='3'>&nbsp;Attention, pour les déchets (PDt), c'est l'entreprise de retraitement qui doit faire la proposition.</td></tr>";
        
    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Achat de :&nbsp;</td>";
    temp += "<td colspan='2'><b><FONT size=2>" + ACHAT_STOC_NOMUNITE[entre] + "&nbsp;à&nbsp;" + ACHAT_STOC_NOMENTREPRISE[entre] + "&nbsp;(" + ACHAT_STOC_NOMPAYS[entre] + ")</FONT></b></td></tr>";
    
    temp += "<tr></tr>";
    
    temp += "<tr>";
    temp += "<td class='textBleu' width='220'>&nbsp;&nbsp;Compte acheteur : &nbsp;</td><td colspan='2'><SELECT name='idcpte1' id='idcpte1' onchange='ChangeCpte();'>";
    temp += "<OPTION value='0'>Pas de sélection&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++){
        if (CPTEP_TYPE[ind01] == 'E')
            temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>" + CPTEP_NCPTE[ind01] + " - " + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + ")&nbsp;&nbsp;";
    }
    temp += "</SELECT></td></tr>";
    
    temp += "<tr>";
    temp += "<td class='textBleu' width='220'>&nbsp;&nbsp;Compte vendeur : &nbsp;</td><td colspan='2'><SELECT name='idcpte2' id='idcpte2' onchange='ChangeCpte();'>";
    temp += "<OPTION value='0'>Pas de sélection&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < ACHAT_CPTE_NCPTE.length; ind01++){
        if ((ACHAT_STOC_IDENTREPRISE[entre] == ACHAT_CPTE_IDTITULAIRE[ind01]))
            temp += "<OPTION value='" + ACHAT_CPTE_NCPTE[ind01] + "'>" + ACHAT_CPTE_NCPTE[ind01] + " - " + ACHAT_CPTE_NOMCPTE[ind01] + "&nbsp;(" + ACHAT_CPTE_DEVISE[ind01] + ")&nbsp;&nbsp;";
    }
    temp += "</SELECT></td></tr>";
    
    temp += "<tr><td width='220' class='textBleu'>&nbsp;&nbsp;Nb unité achetée :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='nbunite' id='nbunite' size='4' align=right>&nbsp;" + ACHAT_STOC_NOMUNITE[entre] + "</td></tr>";
    
    temp += "<tr><td width='220' class='textBleu'>&nbsp;&nbsp;Au tarif unitaire HT de :&nbsp;</td>";
    temp += "<td colspan='2'>";
    temp += "<INPUT type='text' name='tarif' id='tarif' size='4' align=right>";
    temp += "&nbsp;<INPUT type='text' name='deviseA1' id='deviseA1' size='2' align=right>";
    if (ACHAT_STOC_IDUNITE[entre] != '80008')
        temp += "&nbsp;&nbsp;soit pour le vendeur : ";
    else
        temp += "&nbsp;&nbsp;soit : ";
    temp += "<INPUT type='text' name='tarifB' id='tarifB' size='4' align=right>";
    temp += "&nbsp;<INPUT type='text' name='deviseB' id='deviseB' size='2' align=right>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr><td width='220'><INPUT type=button name=valcalcul value='Calculer' onclick='Calcul();'></td>";
    temp += "<td colspan='2'>&nbsp;&nbsp;Taxe :&nbsp;&nbsp;<INPUT type='text' name='taxe' id='taxe' size='4' align=right> %</td></tr>";
    temp += "<tr><td width='220'>&nbsp;&nbsp;Tarif TTC :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='rescalcul1' id='rescalcul1' size='4' align=right>";
    temp += "&nbsp;&nbsp;<INPUT type='text' name='deviseA' id='deviseA' size='2' align=right></td></tr>";
    
    temp += "<tr>";
    temp += "<td><INPUT type='hidden' name='nomunite' id='nomunite' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='idunite' id='idunite' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='iduniteequi' id='iduniteequi' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='soldeA' id='soldeA' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='idpaysA' id='idpaysA' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='entreA' id='entreA' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='idpaysB' id='idpaysB' size='4'></td>";
    temp += "<td><INPUT type='hidden' name='entreB' id='entreB' size='4'></td>";
    temp += "</tr>";
    
    temp += "<tr><td width='200'><INPUT type=button name=valachatstock value='Proposer' onclick='valachat("+ entre + ");'></td>";
    temp += "<td class='textRouge' colspan='2'>(Le taux de change est appliqué et un compte d'état utilisé le cas échéant)</td></tr>";
    
    temp += "<tr>";
    temp += "<td>&nbsp;&nbsp;</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td valign=top>&nbsp;&nbsp; Tarif HT conseillé :</td>";
    temp += "<td>&nbsp;&nbsp;- PE : 90 P§";
    temp += "<br>&nbsp;&nbsp;- PA : 90 P§";
    temp += "<br>&nbsp;&nbsp;- MP : 110 P§";
    temp += "<br>&nbsp;&nbsp;- P Objet : 50 P§";
    temp += "<br>&nbsp;&nbsp;- P Machine : 120 P§</td>";
    temp += "<td>&nbsp;&nbsp;- P Véhicule : 140 P§";
    temp += "<br>&nbsp;&nbsp;- PAL : 150 P§";
    temp += "<br>&nbsp;&nbsp;- PP : 190 P§";
    temp += "<br>&nbsp;&nbsp;- P Alcool : 190 P§";
    temp += "<br>&nbsp;&nbsp;- PDt : 10 P§";
    temp += "</td></tr>";
    
    temp += "</table>";
    
    temp += "</FORM>";
    
    $("#divStock").html(temp);
    $("#divAchatStock").hide();
    $("#divStock").show();
    
    $("#idpaysA").val(ACHAT_CPTE_DEVISE[ind01]);
    $("#idpaysB").val(ACHAT_STOC_IDPAYS[entre]);
    $("#entreB").val(ACHAT_STOC_IDENTREPRISE[entre]);
    $("#nomunite").val(ACHAT_STOC_NOMUNITE[entre]);
    $("#idunite").val(ACHAT_STOC_IDUNITE[entre]);
    $("#iduniteequi").val(ACHAT_STOC_IDUNITEEQUI[entre]);
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
            break;
        }
    }
    
    if (!isNaN(parseFloat($("#tarif").val()))){
        for (ind01 = 0; ind01 < TX_DEVISE1.length; ind01++){
            if ((TX_DEVISE1[ind01] == $("#deviseB").val()) && (TX_DEVISE2[ind01] == $("#deviseA").val())){
                $("#tarifB").val($('#nbunite').val() * $("#tarif").val() * TX_TAUX[ind01]);
                break;
            }
        }
    }
    else{
        $("#tarif").val('0');
        $("#tarifB").val('0');
    }

    var ind0 = 0;
    var ind1 = 0;
    var taxe = 0;
    var taxe0 = 0;
    var taxe1 = 0;
    $("#taxe").val('0');
    for (ind01 = 0; ind01 < TAXE_IMPORT_IDPAYS1.length; ind01++){
        if ((TAXE_IMPORT_IDPAYS1[ind01] == $("#idpaysA").val()) && (TAXE_IMPORT_IDPAYS2[ind01] == $("#idpaysA").val())){
            if ((TAXE_IMPORT_TYPE[ind01] == '00000') && (ind0 == 0)){
                ind0 = 1;
                taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
            }
            if ((TAXE_IMPORT_TYPE[ind01] == '80000') && (ind0 < 3)){
                ind0 = 2;
                taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
            }
            if ((TAXE_IMPORT_TYPE[ind01] == $("#iduniteequi").val()) && (ind0 < 4)){
                ind0 = 3;
                taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
            }
            if (TAXE_IMPORT_TYPE[ind01] == $("#idunite").val()){
                ind0 = 4;
                taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
            }
        }

        if ($("#idpaysA").val() != $("#idpaysB").val()){
            if ((TAXE_IMPORT_IDPAYS1[ind01] == $("#idpaysA").val()) && (TAXE_IMPORT_IDPAYS2[ind01] == $("#idpaysB").val())){
                if ((TAXE_IMPORT_TYPE[ind01] == '00000') && (ind1 == 0)){
                    ind1 = 1;
                    taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
                }
                if ((TAXE_IMPORT_TYPE[ind01] == '80000') && (ind1 < 3)){
                    ind1 = 2;
                    taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
                }
                if ((TAXE_IMPORT_TYPE[ind01] == $("#iduniteequi").val()) && (ind1 < 4)){
                    ind1 = 3;
                    taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
                }
                if (TAXE_IMPORT_TYPE[ind01] == $("#idunite").val()){
                    ind1 = 4;
                    taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
                }
            }
        }
    }

    taxe = taxe0 + taxe1;
    $("#taxe").val(taxe.toFixed(0));

}

function Calcul(){
    ChangeCpte();
    $("#rescalcul1").val("");
    
    if ((parseInt($('#idcpte1').val()) == 0) || (parseInt($('#idcpte2').val()) == 0)){
        alert("Sélectionnez les comptes.");
        return;
    }
    
    if ((isNaN(parseFloat($("#taxe").val()))) || (parseFloat($("#taxe").val()) < 0))
        $("taxe").val(0);
    taxe = 1 + parseFloat($("#taxe").val()) / 100 ;
    taxe80008 = 1 - parseFloat($("#taxe").val()) / 100 ;
    
    if ((isNaN(parseInt($('#nbunite').val()))) || (isNaN(parseInt($('#tarif').val())))){
        alert("Avec le montant et le nb d'unité cela ira mieux.");
        return;
    }
    else{
        if ((parseInt($('#tarif').val()) <= 0) || (parseInt($('#nbunite').val()) <= 0)){
            alert("Le nombre d'unit� et le montant doivent être sup�rieurs à zero.");
            return;
        }
        else{
            if ($('#idunite').value != '80008')
                $("#rescalcul1").val(parseInt(parseInt($('#nbunite').val()) * parseInt($('#tarif').val()) * taxe));
            else
                $("#rescalcul1").val(parseInt(parseInt($('#nbunite').val()) * parseInt($('#tarif').val()) * taxe80008));
        }
    }

}

function RAZ_tout(){
  $("#tabcentrec").html("");
  $("#achatStock").html("");
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
