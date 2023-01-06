
function AfficheEntreprise(){
    RAZ_tout();
    MenuEntreprise();
    SelectPaysType();
    Entreprise();
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


function SelectPaysType(){
    temp = "<table width='100%'><tr>";
    temp += "<td class='textBleu'>&nbsp;&nbsp;Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Entreprise();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
        temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT></td>";
    
    temp += "<td class='textBleu'>&nbsp;&nbsp;Type Entreprise : &nbsp;<SELECT name='type1' id='type1' onchange='Entreprise();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_TYPEENTRE_TYPEENTRE.length; ind01++)
        temp += "<OPTION value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT></td>";
    
    if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '4')){
        temp += "<td class='textBleu'>&nbsp;&nbsp;Action : <a href='#' onclick='NewEntreprise();'>&nbsp;Nouvelle entreprise&nbsp;</a>"
        temp += "</td>"
    }
    
    temp += "</tr></table>";
    
    $("#tabcentrec").html(temp);
}

function Entreprise(){
    var temp;
    var ind01;
    
    var type = $("#type1").val();
    var pays = $("#pays1").val();
    
    temp = "<table border='0' width='100%'>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < DET_ENTRE_IDENTRE.length; ind01++){
        if (((type == DET_ENTRE_TYPE[ind01]) || (type == DET_ENTRE_TYPEEQUI[ind01]) || (type == '0')) && ((pays == DET_ENTRE_IDPAYS[ind01]) || (pays == '0'))){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";
            
            temp += "<td width='130'>" + DET_ENTRE_NOMPAYS[ind01] + "</td>";
            temp += "<td width='150'><b><a href='#' onclick='DetailEntreprise(" + DET_ENTRE_IDENTRE[ind01] + ");'>" + DET_ENTRE_NOMENTRE[ind01] + "</a></b></td>";
            temp += "<td width='150'><a href='#' onclick='DetailCitoyen(" + DET_ENTRE_IDUSER[ind01] + ");'>" + DET_ENTRE_NOMUSER[ind01] + "</a></td>";
            temp += "<td width='100'>" + DET_ENTRE_NOMTYPE[ind01] + "</td></tr>";
        }
    }
    
    temp += "</table>";
    
    $("#entreprises").html(temp);
    $("#divEntreprise").show();
    $("#divNewEntreprise").hide();
}

function DetailCitoyen(i){
    $('#page-loader').show();
    $tmp = "new_detail_1_citoyen.php?citoyen=" + i;
    document.location.replace($tmp);
}

function DetailEntreprise(entre){
    $('#page-loader').show();
    $tmp = "new_detail_1_entreprise.php?entreprise=" + entre;
    document.location.replace($tmp);
}

function NewEntreprise(){
    var a = 0;
    
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheEntreprise();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";
    
    $("#tabcentrec").html(temp);
    
    temp = "<FORM name='newentre1' method='post' action=''>";

    temp += "<table border='0' width='100%'>"; 

    
    if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '4')){
        temp += "<tr>";
        temp += "<td width='250' class='textBleu'>&nbsp;&nbsp;Nom du pays :&nbsp;</td>";
        temp += "<td colspan='2'>" + NOMPAYS + "</td>";
        temp += "</tr>";
        
        temp += "<tr></tr>";

        temp += "<tr>";
        temp += "<td width='250' class='textBleu'>&nbsp;&nbsp;Nom de l'entreprise :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='nomA' id='nomA' size='40'></td>";
        temp += "</tr>";
        
        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Type d'entreprise :&nbsp;</td>";
        temp += "<td class='textBleu'><SELECT name='typeA' id='typeA'>";
        for (ind01 = 0; ind01 < LIST_TYPEENTRE_TYPEENTRE.length; ind01++)
            temp += "<OPTION value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "&nbsp;&nbsp;";
        temp += "</SELECT></td>";
        temp += "</tr>";
        
        
        temp += "<tr>";
        temp += "<td width='250' class='textBleu'>&nbsp;&nbsp;Propriétaire (100%) :&nbsp;</td>";
        temp += "<td class='textBleu'><SELECT name='propriA' id='propriA'>";
        for (ind01 = 0; ind01 < LIST_PROPRI_ID.length; ind01++){
//            if ( IDPAYS == LIST_PROPRI_PAYS[ind01]){
                temp += "<OPTION value='" + LIST_PROPRI_ID[ind01] + "'>";
				temp +=  LIST_PROPRI_NOMPAYS[ind01] + "&nbsp;-&nbsp;&nbsp;";
                if (LIST_PROPRI_TYPE[ind01] == 'C')
                    temp += "CITOYEN&nbsp;-&nbsp;&nbsp;";
                if (LIST_PROPRI_TYPE[ind01] == 'E')
                    temp += "ENTREPRISE&nbsp;-&nbsp;&nbsp;";
                if (LIST_PROPRI_TYPE[ind01] == 'P')
                    temp += "PAYS&nbsp;-&nbsp;&nbsp;";
				temp +=  LIST_PROPRI_NOM[ind01] + "&nbsp;&nbsp;";
//            }     
        }
        temp += "</SELECT></td>";
        temp += "</tr>";
        
        temp += "<tr>";
        temp += "<td width='250' class='textBleu'>&nbsp;&nbsp;Dirigeant :&nbsp;</td>";
        temp += "<td class='textBleu'><SELECT name='iduserA' id='iduserA'>";
        for (ind01 = 0; ind01 < LIST_CIT_IDUSER.length; ind01++){
//            if ( IDPAYS == LIST_CIT_IDPAYS[ind01])
                temp += "<OPTION value='" + LIST_CIT_IDUSER[ind01] + "'>";
                temp += LIST_CIT_NOMPAYS[ind01] + "&nbsp;-&nbsp;&nbsp;";
                temp += LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
        }
        temp += "</SELECT></td>";
        temp += "</tr>";
        
        temp += "<tr>";
        temp += "<td width='250' class='textBleu'>&nbsp;&nbsp;Capacité :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='capaA' id='capaA' size='4' align=right></td>";
        temp += "</tr>";
        
        temp += "<tr>";
        temp += "<td width='250'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='idpaysA' id='idpaysA' size='4'></td>";
        temp += "</tr>";
        
        temp += "<tr>";
        temp += "</tr>";
        
        temp += "<tr>";
        temp += "<td width='250'><INPUT type=button name=valnewentre value='Créer' onclick='newentre();'></td>";
        temp += "<td class='textRouge'>(Un compte bancaire est créé. Le nombre total d'action est de 1000 et est affecté au propriétaire.)</td>";
        temp += "</tr>";
    }
    else{
        temp += "<tr>";
        temp += "<td width='250'></td>";
        temp += "<td class='textRouge'>Aucun droit</td>";
        temp += "<td width='100'></td>";
        temp += "</tr>";
    }
    
    temp += "</table>";
    temp += "</FORM>";
    
    $("#divNewEntreprise").html(temp);
    $("#divEntreprise").hide();
    $("#divNewEntreprise").show();

    $("#idpaysA").val(IDPAYS);
}

function RAZ_tout(){
    $("#tabcentrec").html("");
    $("#entreprises").html("");
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
