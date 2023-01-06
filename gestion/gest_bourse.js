function AfficheBourse(){
    RAZ_tout();
    MenuEntreprise();
    Bourse();
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


function Bourse(){
    var temp;
    var ind01;
    
    temp = "<table border='0' width='100%'>";
  
//  temp += "<tr><td colspan='8' height='40'>&nbsp;Cotations bousi�res nationales :</td></tr>";
/*
  temp += "<tr class='Titre3' height='40'><td width='150'><CENTER><b>Pays</b></CENTER></td>";
  temp += "<td width='150'><b>&nbsp;Entreprise</b></td>";
  temp += "<td width='80'><CENTER><b>Cotation</b></CENTER></td>";
  temp += "<td width='80'><CENTER><b>Derni�re<br>cotation</b></CENTER></td>";
  temp += "<td width='40'><CENTER><b>Derni�re<br>maj</b></CENTER></td>";
  temp += "</tr>";
*/
    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < BOURSE_IDENTREPRISE.length; ind01++){
        a++;
        b = a%2;
        if (b == 0)
            temp += "<tr class='tr1 textPetit'>";
        else
            temp += "<tr class='tr2 textPetit'>";
        temp += "<td width='150'><b>" + BOURSE_NOMPAYS[ind01] + "</b></td>";
        temp += "<td width='150'><b><a href='#' onclick='ModifCotation(" + ind01 + ");'>" + BOURSE_NOMENTREPRISE[ind01] + "</a></b></td>";
        temp += "<td align=right width='80'>" + BOURSE_COTATION[ind01] + "&nbsp;" + BOURSE_DEVISE[ind01] + "</td>";
        temp += "<td align=right width='80'>" + BOURSE_DERNIERECOT[ind01] + "&nbsp;" + BOURSE_DEVISE[ind01] + "</td>";
        temp += "<td width='40'><CENTER>" + BOURSE_DATEMAJ[ind01].substring(0,10) + "</CENTER></td></tr>";
    }
    temp += "</table>";
    $("#bourse").html(temp);
    $("#divLstBourse").show();
    $("#divBourse").hide();
}

function ModifCotation(i){
    temp = "<FORM name='modifcotation' method='post' action=''>";
    
    temp += "<table border='0' width='100%'>";
    
    temp += "<tr><td colspan='3' height='40' class='textGros'>Modification d'une cotation</td></tr>";
    
    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Nom de l'entreprise :&nbsp;</td>";
    temp += "<td colspan='2'>" + BOURSE_NOMENTREPRISE[i] + "</td></tr>";
    
    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Cotation précédente :&nbsp;</td>";
    temp += "<td colspan='2'>" + BOURSE_DERNIERECOT[i] + "&nbsp;" + BOURSE_DEVISE[i] + "</td></tr>";
    
    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Cotation actuelle :&nbsp;</td>";
    temp += "<td colspan='2'>" + BOURSE_COTATION[i] + "&nbsp;" + BOURSE_DEVISE[i] + "</td></tr>";
    
    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Nouvelle cotation :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='cotation' id='cotation' size='5'>&nbsp;" + BOURSE_DEVISE[i] +"</td></tr>";
    
    temp += "<tr><td width='250' class='textBleu'></td>";
    temp += "<td colspan='2'><INPUT type='hidden' name='dernierecotation' id='dernierecotation' size='5'></td>";
    
    temp += "<td colspan='2'><INPUT type='hidden' name='entre' id='entre' size='5'></td>";
    temp += "</tr>";
    
    temp += "<tr><td width='250'><INPUT type=button name=valmodifcot value='Modifier' onclick='majcotation();'></td>";
    temp += "<td></td>";
    temp += "</tr>";
    
    temp += "</table>";
    
    temp += "</FORM>";
    
    $("#divBourse").html(temp);
    $("#divLstBourse").hide();
    $("#divBourse").show();
    
    $("#dernierecotation").val(BOURSE_COTATION[i]);
    $("#entre").val(BOURSE_IDENTREPRISE[i]);
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
    $tmp = "bourse.php";
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
