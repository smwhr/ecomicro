function AfficheDette(){
    RAZ_tout();
    MenuEntreprise();
    SelectPays();
    Dette();
}

function MenuEntreprise(){
    var temp;
    temp = "<table width='100%'><tr>";

    temp += "<td>&nbsp;</td>";
    temp += "<td width='250'>";
    temp += "<div class='menuEtat tailleSimple boutonVert' onClick='gotoEntreprise();'>Liste Entreprises</div>";
    temp += "</td>";
    temp += "<td width='250'>";
    temp += "<div class='menuEtat tailleSimple boutonOrange' onClick='gotoTitre();'>Répartition des titres</div>";
    temp += "</td>";
    temp += "<td width='250'>";
    temp += "<div class='menuEtat tailleSimple boutonMarron' onClick='gotoCotation();'>Cotations boursières</div>";
    temp += "</td>";
    temp += "<td width='250'>";
    temp += "<div class='menuEtat tailleSimple boutonBleu' onClick='gotoDette();'>Dettes</div>";
    temp += "</td>";
    temp += "<td>&nbsp;</td>";

    
    temp += "</tr></table>";
    $("#divSSMenuEntreprise").html(temp);
}

function Dette(){
    var temp;
    var ind01;
    
    temp = "<table border='0' width='100%'>";
//    temp += "<tr><td colspan='8' class='Titre2' height='40'>&nbsp;Dettes  :</td></tr>";
 /*   
    temp += "<tr class='Titre3' height='40'><td width='150'><CENTER><b>Pays</b></CENTER></td>";
    temp += "<td width='150'><b>&nbsp;Entreprise</b></td>";
    temp += "<td width='80'><CENTER><b>Dette</b></CENTER></td>";
    temp += "<td width='40'><CENTER><b>Derni�re<br>maj</b></CENTER></td>";
    temp += "</tr>";
 */
    var a = 0;
    var b = 0;   
    for (ind01 = 0; ind01 < DETTE_IDENTREPRISE.length; ind01++){
        if (($('#pays1').val() == 0) || ($('#pays1').val() == DETTE_IDPAYS[ind01])) {
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";
            temp += "<td width='150'><b>" + DETTE_NOMPAYS[ind01] + "</b></td>";
            temp += "<td width='150'><b><a href='#' onclick='ModifDette(" + ind01 + ");'>" + DETTE_NOMENTREPRISE[ind01] + "</a></b></td>";
            temp += "<td align=right width='80'>" + DETTE_DETTE[ind01] + "&nbsp;" + DETTE_DEVISE[ind01] + "</td>";
            temp += "<td width='40'><CENTER>" + DETTE_DATEMAJ[ind01] + "</CENTER></td></tr>";
        }
    }
    
    temp += "</table>";
    $("#dette").html(temp);
    $("#divLstDette").show();
    $("#divDette").hide();
}

function ModifDette(i){

    if ((AUTORISATION.substring(1,2) > '4') && (DETTE_IDPAYS[i] == IDPAYS)){
        temp = "<FORM name='modifdette' method='post' action=''>";
        
        temp += "<table border='0' width='100%'>";
        
        temp += "<tr><td colspan='3' height='40' class='textGros'>Modification d'une dette</td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Nom de l'entreprise :&nbsp;</td>";
        temp += "<td colspan='2'>" + DETTE_NOMENTREPRISE[i] + "</td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Nouvelle dette :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='dette' id='dette' size='5'>&nbsp;" + DETTE_DEVISE[i] +"</td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='entre' id='entre' size='5'></td>";
        temp += "</tr>";
        
        temp += "<tr><td width200150'><INPUT type=button name=valmodifdette value='Modifier' onclick='majdette();'></td>";
        temp += "<td></td>";
        temp += "</tr>";
        
        temp += "</table>";
        
        temp += "</FORM>";
        
        $("#divDette").html(temp);
        $("#divLstDette").hide();
        $("#divDette").show();   
             
        $("#entre").val(DETTE_IDENTREPRISE[i]);
    }
}

function SelectPays(){
    temp = "<table width='100%'><tr>";
    temp += "<td class='textBleu'>&nbsp;&nbsp;Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Dette();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
        temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT></td>";
    
    temp += "</tr></table>";
    
    $("#tabcentrec").html(temp);
}

function RAZ_tout(){
    $("#tabcentrec").html("");
}
function gotoEntreprise(){
    $('#page-loader').show();
    $tmp = "entreprise_detail.php";
    document.location.replace($tmp);
}

function gotoTitre(){
    $('#page-loader').show();
    $tmp = "titre.php";
    document.location.replace($tmp);
}
function gotoCotation(){
    $('#page-loader').show();
    $tmp = "cotation.php";
    document.location.replace($tmp);
}
function gotoDette(){
    $('#page-loader').show();
    $tmp = "dette.php";
    document.location.replace($tmp);
}
