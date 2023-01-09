function AfficheCpteBanque(){
    RAZ_tout();
    CpteBanque();
    MvtBanque(look_cpte);
    $("#action").hide();
    $('#divCpte').hide();
    $('#divMvtPeriodique').hide();
}

function CpteBanque(){
    var temp;
    var ind01;
    var ind02;
    var tmptab;

    temp = "<table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++)  {
        a++;
        b = a%2;
        if (b == 0)
            temp += "<tr class='tr1 textPetit'>";
        else
            temp += "<tr class='tr2 textPetit'>";
        temp += "<td width='50'><CENTER><b><a href='#top' onClick='MvtBanque(" + CPTEP_NCPTE[ind01] + ")'>" + CPTEP_NCPTE[ind01] + "</a></b></CENTER></td>";

        if(CPTEP_IDTITULAIRE[ind01] == IDUSER)
            temp += "<td align=left width='200'><b><FONT color=blue>" + CPTEP_NOMCPTE[ind01] + "</FONT></td>";
        else if (CPTEP_TYPE[ind01] == 'P')
            temp += "<td align=left width='200'>" + CPTEP_NOMCPTE[ind01] + "</td>";
        else
            temp += "<td align=left width='200'><b>" + CPTEP_NOMCPTE[ind01] + "</b></td>";

        if(CPTEP_SOLDE[ind01] < 0) temp += "<td align=right width='100'><FONT color=red>" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + "</FONT></td>";
        else temp += "<td align=right width='100'>" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + "</td>";

        temp += "</tr>";
    }

    if (a == 0)
        temp = "Aucun compte !!";
    $("#divLstCpte").html(temp);

    temp = "<table border='0' width='100%'><tr>";
    temp += "<td class='textBleu textPetit'>&nbsp;&nbsp;Action : ";
    temp += "&nbsp;&nbsp;<a href='#' OnClick='NewCompte();'>&nbsp;Nouveau Compte&nbsp;</a>";
    temp += "&nbsp;&nbsp;-&nbsp;&nbsp;</b><a href='#' OnClick='SupprCompte();'>&nbsp;Supprimer un compte&nbsp;</a>";
    temp += "&nbsp;&nbsp;-&nbsp;&nbsp;</b><a href='#' OnClick='SupprPeriodique();'>&nbsp;Supprimer une transaction périodique&nbsp;</a>";
    temp += "</td></tr></table>";

    $("#tabcentrec").html(temp);
}


function MvtBanque(cpte){
    var temp;
    var ind01;
    var ind02;

    for (ind02 = 0; ind02 < CPTEP_NCPTE.length; ind02++) {
        if(CPTEP_NCPTE[ind02] == cpte)
          break;
    }

    temp = "<CENTER><b>Mouvements périodiques du compte N°&nbsp;" + cpte + "&nbsp;" + CPTEP_NOMCPTE[ind02] + "</b></CENTER>";
    $("#titreMvtPeriodique").html(temp);

    temp = "<table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < TRANSACP_IDTRANSAC.length; ind01++){

        if (TRANSACP_NCPTE[ind01] == cpte){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";
            
            temp += "<td width='30'><CENTER>" + TRANSACP_IDTRANSAC[ind01] + "</CENTER></td>";

            if(TRANSACP_TYPE[ind01] == 'a') temp += "<td align=right width='50'><FONT color=red>-" + format("#,##0.", TRANSACP_MONTANT[ind01]) + "&nbsp;" + TRANSACP_DEVISE[ind01] + "</FONT></td>";
            else temp += "<td align=right width='50'>" + format("#,##0.", TRANSACP_MONTANT[ind01]) + "&nbsp;" + TRANSACP_DEVISE[ind01] + "</td>";

            temp += "<td width='50'><CENTER>" + TRANSACP_CPTE2[ind01] + "</CENTER></td>";
            temp += "<td width='150'>" + TRANSACP_NOMCPTE2[ind01] + "</td>";
            temp += "<td width='200'>" + TRANSACP_COMMENT[ind01] + "</td>";
            temp += "<td width='50'>" + TRANSACP_FREQ[ind01] + "</td>";
            temp += "<td width='100'><CENTER>" + TRANSACP_JOUR[ind01] + "</CENTER></td></tr>";
        }
    }

    temp += "</table>";

    if (a == 0){
        temp = "Aucun mouvement périodique.";
        $("#mvtPeriodique").hide
    }
    $("#mvtPeriodique").html(temp);

    temp = "<CENTER><b>Le détail du compte N°&nbsp;" + CPTEP_NCPTE[ind02] + "&nbsp;" + CPTEP_NOMCPTE[ind02] + "</b></CENTER>";
    $("#titreMvt").html(temp);

    temp = "<table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < MVTP_IDMVT.length; ind01++){
        if (MVTP_NCPTE[ind01] == cpte){
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

function NewCompte(){
    var a = 0;

    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheCpteBanque();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    temp += "</BR></BR>";


    temp += "<FORM name='newcompte1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";
          
    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Titulaire : &nbsp;</td><td><SELECT name='titulaire' id='titulaire'>";
    temp += "<OPTION value='" + IDUSER + "'>Vous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < TITU_CPTE_USER_IDENTRE.length; ind01++)
        temp += "<OPTION value='" + TITU_CPTE_USER_IDENTRE[ind01] + "'>" + TITU_CPTE_USER_NOMENTRE[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT></td><td></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Libellé du compte :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='nomcompte' id='nomcompte' size='40'></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Devise :&nbsp;</td>";
    temp += "<td class='textBleu'>";
    temp += "<SELECT name='devise' id='devise'>";
    for (ind01 = 0; ind01 < LIST_DEVISE_DEVISE.length; ind01++)
        temp += "<OPTION value='" + LIST_DEVISE_DEVISE[ind01] + "'>" + LIST_DEVISE_DEVISE[ind01] + "&nbsp;&nbsp;";

    temp += "</SELECT></td></tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valnewcompte value='Créer' onclick='newcompte()'></td>";
    temp += "<td class='texte2'></td></tr>";

    temp += "</table>";

    temp += "</FORM>";

    $("#action").html(temp);
    $("#action").show();
}

function SupprCompte(){
    var a = 0;

    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheCpteBanque();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

      temp += "</BR></BR>";


    temp += "<FORM name='supprcompte1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte à supprimer : &nbsp;</td><td><SELECT name='idcpte' id='idcpte'>";
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++)
        temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>&nbsp;" + CPTEP_NCPTE[ind01] + " - " + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + ")" + "&nbsp;&nbsp;";
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

    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheCpteBanque();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    temp += "</BR></BR>";


    temp += "<FORM name='supprtransac1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='350'>&nbsp;&nbsp;Transaction périodique à supprimer : &nbsp;</td><td><SELECT name='idtransac' id='idtransac'>";
    for (ind01 = 0; ind01 < TRANSACP_IDTRANSAC.length; ind01++)
        temp += "<OPTION value='" + TRANSACP_IDTRANSAC[ind01] + "'>&nbsp;" + TRANSACP_IDTRANSAC[ind01] + " - " + TRANSACP_NCPTE[ind01] +  " -> " + TRANSACP_CPTE2[ind01] + "&nbsp;(" + format("#,##0.", TRANSACP_MONTANT[ind01]) + " " + TRANSACP_DEVISE[ind01] + ")" + "&nbsp;&nbsp;";
    temp += "</SELECT></td><td></td></tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valsupprtransac value='Supprimer' onclick='supprtransac()'></td>";
    temp += "<td class='texte2'></td></tr>";

  temp += "</table>";

  temp += "</FORM>";

    $("#action").html(temp);
    $("#action").show();
}

function RAZ_tout()
{
  document.getElementById("tabcentrec").innerHTML = "";
  document.getElementById("tabcentred").innerHTML = "";
}