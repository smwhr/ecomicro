
function AfficheCitoyen(){
    RAZ_tout();
    SelectPays();
    Citoyens();
}
function Citoyens(){
    var temp;
    var ind01;

    var pays = $("#pays1").val();
    var inactif = $("#inactif1").val();

    temp = "<CENTER><table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < DET_CIT_NOMPAYS.length; ind01++)
    {
        if (((pays == DET_CIT_IDPAYS[ind01]) || (pays == '0')) && (inactif == DET_CIT_INACTIF[ind01])){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";
            
            if (DET_CIT_IDPAYS[ind01] != DET_CIT_IDPAYSUSER[ind01])
                  temp += "<td width='175' class='padding2'><FONT color='blue'>" + DET_CIT_NOMPAYS[ind01] + "</FONT></td>";
            else
            {
                  if (DET_CIT_EXCLU[ind01] == '1')
                       temp += "<td width='175' class='padding2'><FONT color='red'>" + DET_CIT_NOMPAYS[ind01] + "</FONT></td>";
                  else
                       temp += "<td width='175' class='padding2'>" + DET_CIT_NOMPAYS[ind01] + "</td>";
            }

            temp += "<td width='175' class='padding2'><b><a href='#' onclick='DetailCitoyen(" + ind01 + ")'>" + DET_CIT_NOM[ind01] + "</a></b></td>";

            temp += "<td width='200' class='padding2'>" + DET_CIT_EMAIL[ind01] + "</td>";
            temp += "<td width='50' class='padding2'><CENTER>" + DET_CIT_DCREATE[ind01] + "</CENTER></td>";
            temp += "</tr>";
        }
    }

    temp += "</table></CENTER>";
    $("#citoyens").html(temp);
    $("#divCitoyen").show();
    $("#divNewCitoyen").hide();
}

function DetailCitoyen(i){
    $('#page-loader').show();
    $tmp = "new_detail_1_citoyen.php?citoyen=" + DET_CIT_IDUSER[i];
    document.location.replace($tmp);
}

function NewCitoyen(){
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheCitoyen();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    $("#tabcentrec").html(temp);

    $("#divNewCitoyen").html("");
    var a = 0;

    temp = "<FORM name='newcitoyen' method='post' action=''>";

    temp += "<table border='0' width='100%'>";
    
//    temp += "<tr>";
//    temp += "<td colspan='3' class='Titre5' height='40'>&nbsp;Créer un citoyen :</td>";
//    temp += "</tr>";

    if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '4'))
    {
    temp += "<tr>";
    temp += "<td class='textBleu'>&nbsp;&nbsp;Pays : &nbsp;</td><td><SELECT name='idpaysA' id='idpaysA' onchange='saveDevise();'>";
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++){
        if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '5') || ((AUTORISATION.substring(1,2) == '5') && (LIST_PAYS_IDPAYS[ind01] == IDPAYS))){
            if (a+=0)
                temp += "<OPTION selected='TRUE' value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
            else
                temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
        }
    }
    temp += "</SELECT></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Nom :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='nomA' id='nomA' size='40'></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Email :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='emailA' id='emailA' size='40'></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Login :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='loginA' id='loginA' size='20'></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Mot de passe&nbsp;:&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='password' name='pwdA' id='pwdA' size='20'></td></tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valnewcitoyen1 value='Créer' onclick='valnewcitoyen();'></td>";
    temp += "<td class='textRouge'>(un compte bancaire est créé automatiquement)</td></tr>";

    temp += "<tr>";
    temp += "<td colspan='2'><INPUT type='hidden' name='deviseA' id='deviseA'></td></tr>";
    }
    else
    {
    temp += "<tr><td class='textRouge'>Aucun droit";
    temp += "</td></tr>";
    }

    temp += "</table>";

    temp += "</FORM>";

    $("#divNewCitoyen").html(temp);
    $("#divCitoyen").hide();
    $("#divNewCitoyen").show();
    saveDevise();
}

function SelectPays()
{
    temp = "<table width='100%'><tr>";
    temp += "<td class='textBleu'>Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Citoyens();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
        temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT></td>";

    temp += "<td class='textBleu'>&nbsp;&nbsp;Activité : &nbsp;<SELECT name='inactif1' id='inactif1' onchange='Citoyens();'>";
    temp += "<OPTION value='0'>Actif&nbsp;&nbsp;";
    temp += "<OPTION value='1'>Inactif&nbsp;&nbsp;";
    temp += "</SELECT></td>";

    if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '4')){
        temp += "<td class='textBleu'>Action :&nbsp;<a href='#' onclick='RAZ_centrec(); NewCitoyen();'>&nbsp;Nouveau citoyen&nbsp;</a>";
        temp += "</td>";
    }

    temp += "</tr></table>";

    $("#tabcentrec").html(temp);
}

function saveDevise(){
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++){
        if (LIST_PAYS_IDPAYS[ind01] == $("#idpaysA").val()){
            $("#deviseA").val(LIST_PAYS_DEVISE[ind01]);
            break;
        }
    }
}

function RAZ_tout(){
    $("#tabcentrec").html("");
    $("#citoyens").html("");
}
function RAZ_droitec(){
    $("#tabdroitec").html("");
}
function RAZ_centrec(){
    $("#tabcentrec").html("");
}


