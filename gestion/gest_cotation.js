function AfficheCotation(){
    RAZ_tout();
    MenuEntreprise();
    selectPays();
    Cotation();
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

function Cotation(){
    var temp;
    var ind01;
    
    var pays = $("#pays1").val();
    
    temp = "<table border='0' width='100%'>";
    
//    temp += "<tr><td colspan='8' class='Titre2' height='40'>&nbsp;Cotations bousi�res :</td></tr>";
/*    
    temp += "<tr class='Titre3' height='40'><td width='150'><CENTER><b>Pays</b></CENTER></td>";
    temp += "<td width='150'><b>&nbsp;Entreprise</b></td>";
    temp += "<td width='100'><CENTER><b>Cotation</b></CENTER></td>";
    temp += "<td width='100'><CENTER><b>Derni�re<br>cotation</b></CENTER></td>";
    temp += "</tr>";
*/
    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < COT_IDENTREPRISE.length; ind01++){
        if ((pays == COT_IDPAYS[ind01]) || (pays == '0')){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";
            temp += "<td width='150'>" + COT_NOMPAYS[ind01] + "</td>";
            temp += "<td width='150'><b><a href='#' onclick='DetailEntreprise(" + COT_IDENTREPRISE[ind01] + ");'>" + COT_NOMENTREPRISE[ind01] + "</a></b></td>";
            temp += "<td align=right width='100'>" + COT_COTATION[ind01] + "&nbsp;" + COT_DEVISE[ind01] + "</td>";
            temp += "<td align=right width='100'>" + COT_DERNIERECOT[ind01] + "&nbsp;" + COT_DEVISE[ind01] + "</td>";
            temp += "</tr>";
        }
    }
    
    temp += "</table>";
    $("#cotation").html(temp);

}

function selectPays(){
    temp = "<table width='100%'><tr>";
    temp += "<td></td>";
    temp += "<td class='textBleu'>&nbsp;&nbsp;Pays : &nbsp;</td><td><SELECT name='pays1' id='pays1' onchange='Cotation();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_PAYS_IDPAYS.length; ind01++)
    temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT></td>";
    
    temp += "</tr></table>"
    
    $("#tabcentrec").html(temp);
}

function DetailEntreprise(entre){
    $('#page-loader').show();
    $tmp = "new_detail_1_entreprise.php?entreprise=" + entre;
    document.location.replace($tmp);
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
