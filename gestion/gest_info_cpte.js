function AfficheCpteBanque(){
    RAZ_tout();
    if (AUTORISATION.substring(1,2) >= '4'){
        MenuEtat();
        SelectPays();
        MvtBanque(0);
        CpteBanque();
        $("#action").hide();
        $('#divCpte').hide();
        $('#divMvtPeriodique').hide();
    }
    else{
        temp = "<table border='0' width='300'><tr><td class='textRouge'>&nbsp;Aucun droit</td></tr>";
        $("#tabcentrec").html(temp);
    }
}

function MenuEtat(){
    var temp;
    temp = "<table width='100%'><tr>";

    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonVert' onClick='gotoInfo();'>Informations générales</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonOrange' onClick='gotoRelation();'>Relations internationales</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonMarron' onClick='gotoTaxe();'>Taxes</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonRouge' onClick='gotoTaux();'>Taux de change</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonBlanc' onClick='gotoListing();'>Listing bancaire</div>";
    temp += "</td>";
    
    temp += "</tr></table>";
    $("#divSSMenuEtat").html(temp);
}

function CpteBanque(){
    var temp;
    var ind01;
    var ind02;
    var tmptab;

    var inactif = $("#inactif1").val();
    var type = $("#type0").val();

    temp = "<table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++){
        if ((inactif == CPTEP_INACTIF[ind01]) && ((type == CPTEP_TYPE[ind01]) || (type == '0'))){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";

            temp += "<td width='50'><CENTER><b><a href='#top' onClick='MvtBanque(" + ind01 + ")'>" + CPTEP_NCPTE[ind01] + "</a></b></CENTER></td>";

            if(CPTEP_TYPE[ind01] == 'a') temp += "<td align=left width='200'><b><FONT color=blue>" + CPTEP_NOMCPTE[ind01] + "</FONT></b></td>";
            else if(CPTEP_TYPE[ind01] == 'b') temp += "<td align=left width='200'><b>" + CPTEP_NOMCPTE[ind01] + "</b></td>";
            else temp += "<td align=left width='200'>" + CPTEP_NOMCPTE[ind01] + "</td>";

            if(CPTEP_SOLDE[ind01] < 0) temp += "<td align=right width='100'><FONT color=red>" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + "</FONT></td>";
            else temp += "<td align=right width='100'>" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + "</td>";

            temp += "</tr>";
        }
    }

    temp += "</table>";
    if (a == 0)
        temp = "Aucun compte !!";
    $("#divLstCpte").html(temp);

}

function MvtBanque(cpte){
    var temp;
    var ind01;
    var ind02;

    temp = "<CENTER><b>Mouvements périodiques du compte N°&nbsp;" + CPTEP_NCPTE[cpte] + "&nbsp;" + CPTEP_NOMCPTE[cpte] + "</b></CENTER>";
    $("#titreMvtPeriodique").html(temp);

    temp = "<table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < TRANSAC_IDTRANSAC.length; ind01++){
        if (TRANSAC_NCPTE[ind01] == CPTEP_NCPTE[cpte]){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";

            temp += "<td width='30'><CENTER>" + TRANSAC_IDTRANSAC[ind01] + "</CENTER></td>";

            if(TRANSAC_TYPE[ind01] == 'a' ) temp += "<td align=right width='50'><FONT color=red>-" + format("#,##0.", TRANSAC_MONTANT[ind01]) + "&nbsp;" + TRANSAC_DEVISE[ind01] + "</FONT></td>";
            else temp += "<td align=right width='50'>" + format("#,##0.", TRANSAC_MONTANT[ind01]) + "&nbsp;" + TRANSAC_DEVISE[ind01] + "</td>";

            temp += "<td width='50'><CENTER>" + TRANSAC_CPTE2[ind01] + "</CENTER></td>";
            temp += "<td width='150'>" + TRANSAC_NOMCPTE2[ind01] + "</td>";
            temp += "<td width='200'>" + TRANSAC_COMMENT[ind01] + "</td>";
            temp += "<td width='50'>" + TRANSAC_FREQ[ind01] + "</td>";
            temp += "<td width='100'><CENTER>" + TRANSAC_JOUR[ind01] + "</CENTER></td></tr>";
        }
    }

    temp += "</table>";
    
    if (a == 0){
        temp = "Aucun mouvement périodique.";
        $("#mvtPeriodique").hide
    }
    $("#mvtPeriodique").html(temp);


    temp = "<CENTER><b>Le détail du compte N°&nbsp;" + CPTEP_NCPTE[cpte] + "&nbsp;" + CPTEP_NOMCPTE[cpte] + "</b></CENTER>";
    $("#titreMvt").html(temp);

    temp = "<table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < MVTP_IDMVT.length; ind01++){
        if (MVTP_NCPTE[ind01] == CPTEP_NCPTE[cpte]){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";

            temp += "<td width='50'><CENTER>" + MVTP_IDMVT[ind01] + "</CENTER></td>";

            if(MVTP_MONTANT[ind01] < 0 ) temp += "<td align=right width='50'><FONT color=red>" + format("#,##0.", MVTP_MONTANT[ind01]) + "&nbsp;" + MVTP_DEVISE[ind01] + "</FONT></td>";
            else temp += "<td align=right width='50'>" + format("#,##0.", MVTP_MONTANT[ind01]) + "&nbsp;" + MVTP_DEVISE[ind01] + "</td>";

            temp += "<td width='50'><CENTER>" + MVTP_CPTEAUX[ind01] + "</CENTER></td>";
            temp += "<td width='150'>" + MVTP_NOMCPTEAUX[ind01] + "</td>";
            temp += "<td width='300'>" + MVTP_COMMENT[ind01] + "</td>";
            temp += "<td width='50'><CENTER>" + MVTP_DATEH[ind01] + "</CENTER></td></tr>";
        }
    }

    temp += "</table>";
    if (a == 0)
        temp = "Auncun mouvement.";
    $("#mvt").html(temp);
}

function SelectPays(){
    temp = "<table width='100%'><tr>";

    temp += "<td class='textBleu' height='30'>&nbsp;&nbsp;Type : &nbsp;<SELECT name='type0' id='type0' onchange='CpteBanque();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    temp += "<OPTION value='a'>Citoyen&nbsp;&nbsp;";
    temp += "<OPTION value='b'>Entreprise&nbsp;&nbsp;";
    temp += "<OPTION value='c'>Etat&nbsp;&nbsp;";
    temp += "</SELECT></td>";

    temp += "<td class='textBleu' height='30'>&nbsp;&nbsp;Activité : &nbsp;<SELECT name='inactif1' id='inactif1' onchange='CpteBanque();'>";
    temp += "<OPTION value='0'>Actif&nbsp;&nbsp;";
    temp += "<OPTION value='1'>Inactif&nbsp;&nbsp;";
    temp += "</SELECT></td>";

    temp += "<td class='textBleu'>&nbsp;&nbsp;";
    temp += "</td>";
    temp += "</tr></table>";

    $("#tabcentred").html(temp);
    
    temp = "<table border='0' width='100%' class='textPetit'><tr>";
    temp += "<td class='textBleu'>&nbsp;&nbsp;<b>&nbsp;&nbsp; Action :&nbsp;</b>";
    temp += "&nbsp;&nbsp;</b><a href='#' OnClick='Credit();'>&nbsp;Créditer un compte&nbsp;</a>";
    temp += "&nbsp;&nbsp;-&nbsp;&nbsp;</b><a href='#' OnClick='Debit();'>&nbsp;Débiter un compte&nbsp;</a>";
    temp += "&nbsp;&nbsp;-&nbsp;&nbsp;</b><a href='#' OnClick='SupprCompte();'>&nbsp;Supprimer un compte&nbsp;</a>";
    temp += "&nbsp;&nbsp;-&nbsp;&nbsp;</b><a href='#' OnClick='SupprPeriodique();'>&nbsp;Supprimer une transaction périodique&nbsp;</a>";
    temp += "</td></tr></table>";
    $("#tabcentrec").html(temp);
}

function Credit(){
    var a = 0;

    temp = "<table border='0' width='100%' height='30'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheCpteBanque();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    temp += "<FORM name='credcompte1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";
    
    temp += "<tr><td colspan='3' class='textGros' height='40'>&nbsp;Créditer un compte :</td></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte à créditer : &nbsp;</td><td><SELECT name='idcpte' id='idcpte'>";
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++)
        temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>&nbsp;" + CPTEP_NCPTE[ind01] + " - " + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + format("#,##0.", CPTEP_SOLDE[ind01]) + " " + CPTEP_DEVISE[ind01] + ")&nbsp;&nbsp;";
    temp += "</SELECT></td><td></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Montant à créditer :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='cred' id='cred' size='5'></td></tr>";

    temp += "<tr><td>";
    temp += "</td></tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valcredcompte value='Créditer' onclick='credcompte()'></td>";
    temp += "<td class='textRouge'>(Les fonds sont créés de toute pièce)</td></tr>";

    temp += "</table>";

    temp += "</FORM>";

    $("#action").html(temp);
    $("#action").show();
}

function Debit(){
    var a = 0;

    temp = "<table border='0' width='100%' height='30'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheCpteBanque();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    $("#tabdroiteb1").html(temp);


    temp = "<FORM name='debcompte1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr><td colspan='3' class='textGros' height='40'>&nbsp;Débiter un compte :</td></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte à créditer : &nbsp;</td><td><SELECT name='idcpte' id='idcpte'>";
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++)
        temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>&nbsp;" + CPTEP_NCPTE[ind01] + " - " + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + format("#,##0.", CPTEP_SOLDE[ind01]) + " " + CPTEP_DEVISE[ind01] + ")&nbsp;&nbsp;";
    temp += "</SELECT></td><td></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Montant à débiter :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='deb' id='deb' size='5'></td></tr>";

    temp += "<tr><td>";
    temp += "</td></tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valdebcompte value='Débiter' onclick='debcompte()'></td>";
    temp += "<td class='textRouge'>(Les fonds sont perdus.)</td></tr>";

    temp += "</table>";

    temp += "</FORM>";

    $("#action").html(temp);
    $("#action").show();
}

function SupprCompte(){
    var a = 0;

    temp = "<table border='0' width='100%' height='30'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheCpteBanque();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    temp += "<FORM name='supprcompte1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr><td colspan='3' class='textGros' height='40'>&nbsp;Supprimer un compte :</td></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte à supprimer : &nbsp;</td><td><SELECT name='idcpte' id='idcpte'>";
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++)
        temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>&nbsp;" + CPTEP_NCPTE[ind01] + " - " + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + format("#,##0.", CPTEP_SOLDE[ind01]) + " " + CPTEP_DEVISE[ind01] + ")&nbsp;&nbsp;";
    temp += "</SELECT></td><td></td></tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valsupprcompte value='Supprimer' onclick='supprcompte()'></td>";
    temp += "<td class='textRouge'>(Les fonds seront perdus et les transactions prériodiques annulées)</td></tr>";

    temp += "</table>";

    temp += "</FORM>";

    $("#action").html(temp);
    $("#action").show();
}

function SupprPeriodique(){
    var a = 0;

    temp = "<table border='0' width='100%' height='30'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheCpteBanque();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    temp += "<FORM name='supprtransac1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr><td colspan='3' class='textGros' height='40'>&nbsp;Supprimer une transaction périodique :</td></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte à supprimer : &nbsp;</td><td><SELECT name='idtransac' id='idtransac'>";
    for (ind01 = 0; ind01 < TRANSAC_IDTRANSAC.length; ind01++){
//    	if (TRANSAC_TYPE[ind01] == 'a')
      temp += "<OPTION value='" + TRANSAC_IDTRANSAC[ind01] + "'>&nbsp;" + TRANSAC_IDTRANSAC[ind01] + " - " + TRANSAC_NCPTE[ind01] +  " -> " + TRANSAC_CPTE2[ind01] + "&nbsp;(" + format("#,##0.", TRANSAC_MONTANT[ind01]) + " " + TRANSAC_DEVISE[ind01] + ")" + "&nbsp;&nbsp;";
    }
    temp += "</SELECT></td><td></td></tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valsupprtransac value='Supprimer' onclick='supprtransac()'></td>";
    temp += "<td class='textRouge'></td></tr>";

    temp += "</table>";

    temp += "</FORM>";

    $("#action").html(temp);
    $("#action").show();
}

function RAZ_tout(){
    $("#tabcentrec").html("");
    $("#tabcentred").html("");
}

function gotoInfo(){
    $('#page-loader').show();
    $tmp = "info_etat.php";
    document.location.replace($tmp);
}
function gotoRelation(){
    $('#page-loader').show();
    $tmp = "relation_etat.php";
    document.location.replace($tmp);
}
function gotoTaxe(){
    $('#page-loader').show();
    $tmp = "taxe_import.php";
    document.location.replace($tmp);
}
function gotoTaux(){
    $('#page-loader').show();
    $tmp = "taux_change.php";
    document.location.replace($tmp);
}
function gotoListing(){
    $('#page-loader').show();
    $tmp = "info_cpte.php";
    document.location.replace($tmp);
}