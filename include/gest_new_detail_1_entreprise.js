
function AfficheEntreprise(){
    RAZ_tout();
    Action();
    Entete();

   
    showPossession();
    
    Possessions();
    Comptes();
    Titres();
    
    Produit();
    Stock();
    Consommation();
    Finance();
    ModifierEntreprise();
}

function showModif(){
    $("#divPos").hide();
    $("#divProduit").hide();
    $("#divStock").hide();
    $("#divConso").hide();
    $("#divFinance").hide();
    $("#divModif").show();
    $("#droit").show();
}
function showPossession(){
    $("#divPos").show();
    $("#divProduit").hide();
    $("#divStock").hide();
    $("#divConso").hide();
    $("#divFinance").hide();
    $("#divModif").hide();
    $("#droit").show();
}
function showProduit(){
    $("#divPos").hide();
    $("#divProduit").show();
    $("#divStock").hide();
    $("#divConso").hide();
    $("#divFinance").hide();
    $("#divModif").hide();
    $("#droit").show();
}
function showStock(){
    $("#divPos").hide();
    $("#divProduit").hide();
    $("#divStock").show();
    $("#divConso").hide();
    $("#divFinance").hide();
    $("#divModif").hide();
    $("#droit").show();
}
function showConso(){
    $("#divPos").hide();
    $("#divProduit").hide();
    $("#divStock").hide();
    $("#divConso").show();
    $("#divFinance").hide();
    $("#divModif").hide();
    $("#droit").show();
}
function showFinance(){
    $("#divPos").hide();
    $("#divProduit").hide();
    $("#divStock").hide();
    $("#divConso").hide();
    $("#divFinance").show();
    $("#divModif").hide();
    $("#droit").hide();
}

function Action(){
    temp = "<table border='0' width='100%'>";
    temp += "<tr>";
    temp += "<td>";
    temp += "<div id='idPoss' class='menuEntreprise margin5 boutonVert tailleSimple' onClick='showPossession();'>Possessions</div>";
    temp += "</td>";
    temp += "<td>";
    temp += "<div id='idProd' class='menuEntreprise margin5 boutonOrange tailleSimple' onClick='showProduit();'>Catalogue de vente</div>";
    temp += "</td>";
    temp += "<td>";
    temp += "<div id='idStock' class='menuEntreprise margin5 boutonMarron tailleSimple' onClick='showStock();'>Stock / Productions</div>";
    temp += "</td>";
    temp += "<td>";
    temp += "<div id='idCons' class='menuEntreprise margin5 boutonRouge tailleSimple' onClick='showConso();'>Consommation</div>";
    temp += "</td>";
    temp += "<td>";
    temp += "<div id='idFin' class='menuEntreprise margin5 boutonBleu tailleSimple' onClick='showFinance();'>Finance</div";
    temp += "</td></tr></table>";
    $("#actions").html(temp);

}

function Entete(){

    temp = "<table border='0' width='100%' class='textPetit'>";

    temp += "<tr>";
    
    temp += "<td valign=top border='0'>";
    temp += "<CENTER><FONT size=2>" + DET_ENTRE_NOM + "</FONT></CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td width='120' valign=center border='0'>";
    temp += "<CENTER><a href='" + DET_ENTRE_SITE + "'><img src='" + DET_ENTRE_LOGO + "' width=100 height=80 alt=''></a></CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td valign=top border='0'>";
    temp += "<CENTER><b>" + DET_ENTRE_NOMPAYS + "</b></CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "</table>";
    
    $("#enteteg").html(temp);

    temp = "<table border='0' width='100%' class='textPetit'>";

    if ((DET_ENTRE_IDUSER == IDUSER) || (AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS))){
        temp += "<tr>";
        temp += "<td valign=top border='0'>";
    	temp += "<CENTER><a href='#' Onclick='showModif();'>Modifier entreprise</a><CENTER>";
        temp += "</td>";
        temp += "</tr>";
    }

    temp += "<tr>";
    temp += "<td valign=top border='0'>";
    temp += "<CENTER><b>" + DET_ENTRE_TYPELIB + "</b></CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td valign=top border='0'>";
    temp += "<CENTER>" + DET_ENTRE_ADR + "</CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td valign=top border='0'>";
    temp += "</td>";
    temp += "</tr>";

    temp += "<tr>";
    temp += "<td width='120' valign=center border='0'>";
    temp += "<CENTER>Directeur : <a href='#' Onclick='DetailCitoyen(" + DET_ENTRE_IDUSER + ");'>" + DET_ENTRE_NOMUSER + "</a></CENTER>";
    temp += "</td>";
    temp += "</tr>";

    temp += "</tr></table>";

    $("#enteted").html(temp);
}

function Possessions(){
    temp = "<CENTER><table border='0' width='100%'>";
            
    for (ind01 = 0; ind01 < DET_ENTRE_LPOSS_IDPOSS.length; ind01++){
        temp += "<tr class='textPetit'>";

        if ((DET_ENTRE_LPOSS_ETAT[ind01] == '0') && (DET_ENTRE_LPOSS_TYPEEQUI[ind01] != '20000')){
            temp += "<td width='100'><b><a href='#' onclick='Vendre(" + ind01 + ");'>Vendre aux PA</a></b>";
            temp += "<br><b><a href='#' onclick='Supprimer(" + ind01 + ");'>Consommer</a></b></td>";
        }
        else if ((DET_ENTRE_LPOSS_ETAT[ind01] == '0') && (DET_ENTRE_LPOSS_TYPEEQUI[ind01] == '20000')){
            temp += "<td width='100'><b><a href='#' onclick='Vendre(" + ind01 + ");'>Vendre aux PA</a></b>";
            temp += "<br><b><a href='#' onclick='Louer(" + ind01 + ");'>Mettre Location</a></b>";
            temp += "<br><b><a href='#' onclick='Supprimer(" + ind01 + ");'>Consommer</a></b></td>";
        }
        else if (DET_ENTRE_LPOSS_ETAT[ind01] == '1')
            temp += "<td width='100'><b><a href='#' onclick='RetirerVendre(" + ind01 + ");'>Retirer des PA</a></b></td>";
        else if (DET_ENTRE_LPOSS_ETAT[ind01] == '2')
            temp += "<td width='100'><b><a href='#' onclick='RetirerLouer(" + ind01 + ");'>Retirer Location</a></b></td>";
        else if ((DET_ENTRE_LPOSS_ETAT[ind01] == '3') && (DET_ENTRE_LPOSS_PRO[ind01] == 'a'))
            temp += "<td width='100'><b>En Location</b></td>";
        else if ((DET_ENTRE_LPOSS_ETAT[ind01] == '3') && (DET_ENTRE_LPOSS_PRO[ind01] == 'b'))
            temp += "<td width='100'><b><a href='#' onclick='StopperLouer(" + ind01 + ");'>Stopper Location <br>(n'oubliez pas la transaction)</a></b></td>";

        temp += "<td width='200'><CENTER>" + DET_ENTRE_LPOSS_NOMTYPE[ind01] + "<br><b>" + DET_ENTRE_LPOSS_NOMPRODUIT[ind01] + "</b><br>" + DET_ENTRE_LPOSS_ADR[ind01] + ",&nbsp;" + DET_ENTRE_LPOSS_ADR_PROVINCE[ind01] + "</CENTER></td>";
        temp += "<td width='200'><CENTER><img src='" + DET_ENTRE_LPOSS_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
        temp += "<td align=right width='100'>" + DET_ENTRE_LPOSS_NBUNITE[ind01] + "&nbsp;" + DET_ENTRE_LPOSS_NOMUNITE[ind01] + "</td>";
        temp += "</tr>";
    }

    temp += "</table>";

    $("#possessions").html(temp);
}

function Comptes(){
    temp = "<CENTER><table border='0' width='100%'>";

    temp += "<tr height='30'>";
    temp += "<td width='50'><b>&nbsp;N° Compte</b></td>";
    temp += "<td width='150'><CENTER><b>Nom</b></CENTER></td>";
    temp += "<td width='100'><CENTER><b>Solde</b></CENTER></td>";
    temp += "</tr>";
    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < DET_ENTRE_CPT_IDCPTE.length; ind01++){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";
        temp += "<td width='80' class='padding2'><a href='#' Onclick='DetailCompte(" + DET_ENTRE_CPT_IDCPTE[ind01] + ");'>" + DET_ENTRE_CPT_IDCPTE[ind01] + "</a></td>";
        temp += "<td width='170' class='padding2'>" + DET_ENTRE_CPT_NOMCPTE[ind01] + "</td>";
        temp += "<td align=right width='80' class='padding2'>" + format("#,##0.", DET_ENTRE_CPT_SOLDE[ind01]) + "&nbsp;" + DET_ENTRE_CPT_DEVISE[ind01] + "</td>";
        temp += "</tr>";
    }

    temp += "</table>";

    if (ind01 == 0)
        temp = "Aucun compte géré...";
    
    $("#divComptes").html(temp);
}

function Titres(){
    temp = "<CENTER><table border='0' width='100%'>";

    temp += "<tr height='30'>";
    temp += "<td width='200'><b>&nbsp;Entreprise</b></td>";
    temp += "<td width='100'><CENTER><b>Nb titre</b></CENTER></td>";
    temp += "</tr>";
    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < DET_ENTRE_TITRE_IDENTRE.length; ind01++){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";
            temp += "<td width='200'><a href='#' Onclick='DetailEntreprise(" + DET_ENTRE_TITRE_IDENTRE[ind01] + ");'>" + DET_ENTRE_TITRE_NOMENTRE[ind01] + "</a></td>";
        temp += "<td align=right width='100'>" + format("#,##0.", DET_ENTRE_TITRE_NB[ind01]) + "</td>";
        temp += "</tr>";
    }

    temp += "</table>";

    if (ind01 == 0)
        temp = "Aucun titres possédés...";
    
    $("#divTitres").html(temp);
}

function Stock(){
    temp = "<table border='0' width='100%'><tr><td valign=top>";

    temp += "<table border='0' width='200' class='textPetit'>";
            
    temp += "<tr height='30'><td class='textGras textNormal' colsspan=2>Stock</td></tr>";
    for (ind01 = 0; ind01 < DET_STOC_NOMUNITE.length; ind01++){
        temp += "<tr>";
        temp += "<td align=right colsspan=2>" + DET_STOC_QUANTITE[ind01] + "&nbsp;" + DET_STOC_NOMUNITE[ind01] + "</td>";
        temp += "</tr>";
    }
    temp += "<tr height='30'><td width='200' class='textGras textNormal' colsspan=2>Capacités</td></tr>";
    temp += "<tr><td width='200'><b>Capacité max&nbsp;:&nbsp;</b></td><td align=right>" + DET_ENTRE_CAPACITE + "</td></tr>";
    temp += "<tr><td width='200'><b>Capacité ce mois&nbsp;:&nbsp;</b></td><td align=right>" + DET_ENTRE_CAPACITEMENS + "</td></tr>";
    temp += "<tr><td width='200'><b>Capacité utilisé&nbsp;:&nbsp;</b></td><td align=right>" + DET_ENTRE_CAPACITECONSO + "</td></tr>";
    temp += "</table>";
	
    temp += "</td><td valign=top>";

    var aa = "ZZ";
    temp += "<FORM name='produire1' method='post' action=''>";
    temp += "<table border='1' width='100%' class='textPetit'>";
    temp += "<tr><td colspan='3' height='30'>&nbsp;&nbsp;Productions :&nbsp;&nbsp;&nbsp;<SELECT name='produitf' id='produitf' onchange='Produire();'>";
    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++){
        if ((aa != PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_IDPRODFINI[ind01] == PRODUIRE_IDRES[ind01])){
            aa = PRODUIRE_IDPRODFINI[ind01];
            temp += "<OPTION value='" + ind01 + "'>" + PRODUIRE_LIBPROD[ind01];
        }
    }
    temp += "</SELECT></td></tr>";
    temp += "<tr><td><div id='produire'></div></td></tr>";
    temp += "</table></form>";

    temp += "</td></tr></table>";

    $("#stock").html(temp);
    Produire();
}

function Consommation(){
    temp = "<table border='0' width='100%'><tr><td valign=top>";

    temp += "<table border='0' width='200' class='textPetit'>";
            
    temp += "<tr height='30'><td class='textGras textNormal' colsspan=2>Stock</td></tr>";
    for (ind01 = 0; ind01 < DET_STOC_NOMUNITE.length; ind01++){
        temp += "<tr>";
        temp += "<td align=right colsspan=2>" + DET_STOC_QUANTITE[ind01] + "&nbsp;" + DET_STOC_NOMUNITE[ind01] + "</td>";
        temp += "</tr>";
    }
    temp += "<tr height='30'><td width='200' class='textGras textNormal' colsspan=2>Capacités</td></tr>";
    temp += "<tr><td width='200'><b>Capacité max&nbsp;:&nbsp;</b></td><td align=right>" + DET_ENTRE_CAPACITE + "</td></tr>";
    temp += "<tr><td width='200'><b>Capacité ce mois&nbsp;:&nbsp;</b></td><td align=right>" + DET_ENTRE_CAPACITEMENS + "</td></tr>";
    temp += "<tr><td width='200'><b>Capacité utilisé&nbsp;:&nbsp;</b></td><td align=right>" + DET_ENTRE_CAPACITECONSO + "</td></tr>";
    temp += "</table>";
	
    temp += "</td><td valign=top>";

    temp += "<FORM name='consommer1' method='post' action=''>";
    temp += "<table border='1' width='100%'>";
    temp += "<tr><td colspan='3' height='30'>&nbsp;&nbsp;Consommations :&nbsp;&nbsp;&nbsp;<SELECT name='consostock' id='consostock' onchange='Conso();'>";
    for (ind01 = 0; ind01 < DET_STOC_IDUNITE.length; ind01++){
        if ((parseInt(DET_STOC_QUANTITE[ind01]) > 0) && (DET_STOC_IDUNITE[ind01] != '80008'))
            temp += "<OPTION value='" + ind01 + "'>" + DET_STOC_NOMUNITE[ind01];
    }
    temp += "</SELECT></td></tr>";
    temp += "<tr><td><div id='consommer'></div></td></tr>";
    temp += "</table></form>";

    temp += "</td></tr></table>";

    $("#conso").html(temp);
    if (DET_STOC_IDUNITE.length > 0)
        Conso();
}

function Produit(){
    temp = "<table border='0' width='100%'>";
    
    for (ind01 = 0; ind01 < DET_ENTRE_PROD_IDPRODUIT.length; ind01++){
        temp += "<tr class='textPetit'>";
        temp += "<td width='150'><b><a href='#' OnClick='ModifProduit(" + ind01 + ");'>" + DET_ENTRE_PROD_NOMPRODUIT[ind01] + "</a></b></br>";
        temp += DET_ENTRE_PROD_NBUNITE[ind01] + "&nbsp;" + DET_ENTRE_PROD_NOMUNITE[ind01] + "</td>";
        temp += "<td align=center width='200'><img src='" + DET_ENTRE_PROD_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></td>";
        temp += "<td valign=center width='250'>" + DET_ENTRE_PROD_DESCRIPTION[ind01] + "</td></tr>";
    }

    temp += "</table>";

    $("#produit").html(temp);
    $("#headerProduit").show();
    ActionProduit();
}

function Finance(){
    temp = "<CENTER><table border='1' width='100%' class='textPetit'>";
            
    temp += "<tr><td colspan='13'height='30' class='textGras'>&nbsp;Finance</td></tr>";

    temp += "<tr>";
    temp += "<td colspan='13'><br>&nbsp;Prix moyen à la vente et à la production :</td>";
    temp += "</tr>";

    for (ind01 = 0; ind01 < FINANCE_HISTO.length; ind01++){
        if (ind01 > 0)  
            temp += "</tr>";

        if (ind01 == 0)  
            temp += "<tr height='30' class='textGras'>";
        else
            temp += "<tr>";

        for (ind02 = 0; ind02 < 13; ind02++){
            if (FINANCE_HISTO[ind01][ind02] > ' ')
	        temp += "<td align=center width='70'>" + FINANCE_HISTO[ind01][ind02] + "</td>";
            else
	        temp += "<td align=center>&nbsp;</td>";
        }
    }
    temp += "</tr>";

    temp += "<tr>";
    temp += "<td colspan='13'><br>&nbsp;Valeur moyenne des unités du stock en cours :</td>";
    temp += "</tr>";


    for (ind01 = 0; ind01 < FINANCE_STOCK.length; ind01++){
        if (ind01 > 0)  
            temp += "</tr>";

        if (ind01 == 0)  
            temp += "<tr height='30' class='textGras'>";
        else
            temp += "<tr>";

        for (ind02 = 0; ind02 < 13; ind02++){
            if (FINANCE_STOCK[ind01][ind02] > ' ')
	        temp += "<td align=center width='70'>" + FINANCE_STOCK[ind01][ind02] + "</td>";
            else
                temp += "<td align=center>&nbsp;</td>";
        }
    }
    temp += "</tr>";

    temp += "</table>";

    $("#finance").html(temp);
}

function DetailEntreprise(entre){
    $('#page-loader').show();
    $tmp = "new_detail_1_entreprise.php?entreprise=" + entre;
    document.location.replace($tmp);
}

function DetailCitoyen(citoyen){
    $('#page-loader').show();
    $tmp = "new_detail_1_citoyen.php?citoyen=" + citoyen;
    document.location.replace($tmp);
}

function DetailCompte(cpte){
    $('#page-loader').show();
    $tmp = "compte_gere.php?cpte=" + cpte;
    document.location.replace($tmp);
}

function ModifierEntreprise(){
    var a = 0;
    var temp;
    var tmp;

    temp = "<FORM name='modifentre1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";
    
    temp += "<tr><td colspan='3' height='30' class='textGros'>Modifier l'entreprise</td></tr>";

    if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS)) || (IDUSER == DET_ENTRE_IDUSER)){
        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Nom du pays :&nbsp;</td>";
        temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMPAYS + "</td></tr>";

        temp += "<tr></tr>";
        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Nom de l'entreprise :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='nomA' id='nomA' size='40'></td></tr>";

        temp += "<tr></tr>";
        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Site de l'entreprise :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='siteA' id='siteA' size='40'></td></tr>";

        temp += "<tr></tr>";
        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Logo de l'entreprise :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='logoA' id='logoA' size='40'></td></tr>";

        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Type d'entreprise :&nbsp;</td>";

        if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS))){
            temp += "<td class='textBleu'><SELECT name='typeA' id='typeA'>";
            for (ind01 = 0; ind01 < LIST_TYPEENTRE_TYPEENTRE.length; ind01++)
            {
            if (LIST_TYPEENTRE_TYPEENTRE[ind01] == DET_ENTRE_TYPE)
            temp += "<OPTION selected=TRUE value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "&nbsp;&nbsp;";
            else
            temp += "<OPTION value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "&nbsp;&nbsp;";
            }
            temp += "</SELECT></td>";
            temp += "</tr>";

            temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Capacité mensuelle :&nbsp;</td>";
            temp += "<td colspan='2'><INPUT type='text' name='capaA' id='capaA' size='4' align=right></td></tr>";
        }
        else{
            for (ind01 = 0; ind01 < LIST_TYPEENTRE_TYPEENTRE.length; ind01++){
                if (LIST_TYPEENTRE_TYPEENTRE[ind01] == DET_ENTRE_TYPE){	
                    temp += "<td colspan='2'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "</td>";
                    break;
                }
            }
            temp += "</tr>";

            temp += "<tr><td width='250' class='textBleu'></td>";
            temp += "<td colspan='2'><INPUT type='hidden' name='typeA' id='typeA' size='4' value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'></td></tr>";

            temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Capacité mensuelle :&nbsp;</td>";
            temp += "<td colspan='2'>" + DET_ENTRE_CAPACITE + "</td></tr>";

            temp += "<tr><td width='250' class='textBleu'></td>";
            temp += "<td colspan='2' class='texte4'><INPUT type='hidden' name='capaA' id='capaA' size='4' value='" + DET_ENTRE_CAPACITE + "'></td></tr>";
        }

        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Dirigeant :&nbsp;</td>";
        temp += "<td class='textBleu'><SELECT name='iduserA' id='iduserA'>";
        temp += "<OPTION value='0'>Sans Directeur&nbsp;&nbsp;";
        for (ind01 = 0; ind01 < LIST_CIT_IDUSER.length; ind01++){
            if (LIST_CIT_IDPAYS[ind01] == IDPAYS){
                if (DET_ENTRE_IDUSER == LIST_CIT_IDUSER[ind01])
                    temp += "<OPTION selected=TRUE value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
                else
                    temp += "<OPTION value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
            }
        }
        temp += "</SELECT></td>";
        temp += "</tr>";

        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Résidence : &nbsp;</td><td colspan='2'><SELECT name='residence1' id='residence1'>";
        tmp = "<OPTION value='0'>Aucune&nbsp;&nbsp;";
        for (ind01 = 0; ind01 < RES_ENTRE_IDPOSSESSION.length; ind01++){
            if (RES_ENTRE_OCCUPE[ind01] == '1')
                tmp += "<OPTION selected='true' value='" + RES_ENTRE_IDPOSSESSION[ind01] + "'>" + RES_ENTRE_ADRESSE[ind01] + "&nbsp;(" + RES_ENTRE_LIBPROVINCE[ind01] + ")&nbsp;";
            else
                tmp += "<OPTION value='" + RES_ENTRE_IDPOSSESSION[ind01] + "'>" + RES_ENTRE_ADRESSE[ind01] + "&nbsp;(" + RES_ENTRE_LIBPROVINCE[ind01] + ")&nbsp;";
        }
        temp += tmp;
        temp += "</SELECT></td></tr>";

        temp += "<tr>";
        temp += "</tr>";

        temp += "<tr><td width='250' class='textBleu'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='identreA' id='identreModif' size='4'></td></tr>";

        temp += "<tr>";
        temp += "</tr>";

        temp += "<tr><td width='250'><INPUT type=button name=valmodif value='Modifier' onclick='modifentre();'></td>";
        temp += "<td class='textRouge'>(La modification du type et de la capacité doivent être discutées avec le responsable avant toute modification.)</td>";
        temp += "</tr>";

        temp += "</table>";
        temp += "</FORM>";

        $("#modif").html(temp);

        $("#identreModif").val(DET_ENTRE_IDENTRE);
        $("#nomA").val(DET_ENTRE_NOM);
        $("#logoA").val(DET_ENTRE_LOGO);
        $("#siteA").val(DET_ENTRE_SITE);
        $("#capaA").val(DET_ENTRE_CAPACITE);

    }
    else{
        temp += "<tr><td width='250'></td>";
        temp += "<td class='textRouge'>Aucun droit</td>";
        temp += "<td width='100'></td>";
        temp += "</tr>";

        temp += "</table>";
        temp += "</FORM>";

        $("#modif").html(temp);
    }
}

function Vendre(poss){
    if (DET_ENTRE_IDUSER != IDUSER){
        temp = "<table border='0' width='100%'><tr>";
        temp += "<td>";
        temp += "<CENTER><a href='#' onclick='AfficheEntreprise();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
        temp += "</tr></table>";

//        $("#directions").html(temp);

  	temp += "<table border='0' width='100%'><tr><td colspan='3' height='30' class='textGros'>Vendre</td></tr>";
        temp += "<tr><td class='textRouge' colspan='3'>Aucun droit.</td>";
        temp += "</tr>";
  	temp += "</table>";
        $("#possessions").html(temp);
        return;
    }

    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_ENTRE_LPOSS_IDPOSS[poss]);
    $("#etat").val(1);

    majvendreposs();
}

function Supprimer(poss){
    if (confirm("Voulez vous consommer (supprimer) ce produit ?")){
        temp = "<FORM name='vendreposs' method='post' action=''>";

        temp += "<INPUT type='hidden' name='poss' id='poss'>";
        temp += "<INPUT type='hidden' name='etat' id='etat'>";

        temp += "</FORM>";

        $("#data_hide").html(temp);

        $("#poss").val(DET_ENTRE_LPOSS_IDPOSS[poss]);
        $("#etat").val(8);

        majvendreposs();
    }
}

function Louer(poss){
    if (DET_ENTRE_IDUSER != IDUSER)
    {
        temp = "<table border='0' width='100%'><tr>";
        temp += "<td class='Texte1'>";
        temp += "<CENTER><a href='#' onclick='AfficheEntreprise();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
        temp += "</tr></table>";

//        $("#directions").html(temp);
        
        temp += "<table border='0' width='100%'><tr><td colspan='3' height='30' class='textGros'>Louer</td></tr>";
        temp += "<tr><td class='textRouge' colspan='3'>Aucun droit.</td>";
        temp += "</tr>";
        temp += "</table>";
        $("#possessions").html(temp);
        return;
    }

    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_ENTRE_LPOSS_IDPOSS[poss]);
    $("#etat").val(2);

    majvendreposs();
}

function RetirerVendre(poss){
    if (DET_ENTRE_IDUSER != IDUSER){
        temp = "<table border='0' width='100%'><tr>";
        temp += "<td>";
        temp += "<CENTER><a href='#' onclick='AfficheEntreprise();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
        temp += "</tr></table>";

//        $("#directions").html(temp);
        
        temp += "<table border='0' width='100%'><tr><td colspan='3' height='30' class='textGros'>Retirer vente</td></tr>";
        temp += "<tr><td class='textRouge' colspan='3'>Aucun droit.</td>";
        temp += "</tr>";
        temp += "</table>";
        $("#possessions").html(temp);
        return;
    }

    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_ENTRE_LPOSS_IDPOSS[poss]);
    $("#etat").val(0);

    majvendreposs();
}

function RetirerLouer(poss){
    if (DET_ENTRE_IDUSER != IDUSER){
        temp = "<table border='0' width='400'><tr>";
        temp += "<td>";
        temp += "<CENTER><a href='#' onclick='AfficheEntreprise();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
        temp += "</tr></table>";

//        $("#directions").html(temp);
        
  	temp += "<table border='0' width='100%'><tr><td colspan='3' class='Titre5' height='30' class='textGros'>Retirer location</td></tr>";
        temp += "<tr><td class='textRouge' colspan='3'>Aucun droit.</td>";
        temp += "</tr>";
  	temp += "</table>";
        $("#possessions").html(temp);
        return;
    }

    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_ENTRE_LPOSS_IDPOSS[poss]);
    $("#etat").val(0);

    majvendreposs();
}

function StopperLouer(poss){
    if (DET_ENTRE_IDUSER != IDUSER){
        temp = "<table border='0' width='100%'><tr>";
        temp += "<td class='Texte1'>";
        temp += "<CENTER><a href='#' onclick='AfficheEntreprise();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
        temp += "</tr></table>";
	
//        $("#directions").html(temp);
        
  	temp += "<table border='0' width='100%'><tr><td colspan='3' height='30' class='textGros'>Stopper location</td></tr>";
        temp += "<tr><td class='textRouge' colspan='3'>Aucun droit.</td>";
        temp += "</tr>";
  	temp += "</table>";
        $("#possessions").html(temp);
        return;
    }

    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_ENTRE_LPOSS_IDPOSS[poss]);
    $("#etat").val(2);

    majvendreposs();
}

function RAZ_tout(){
    $("#possessions").html("");
    $("#divComptes").html("");
    $("#divTitres").html("");
    $("#divTitres").hide();
}