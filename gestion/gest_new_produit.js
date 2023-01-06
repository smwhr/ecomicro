
function ActionProduit(){
    temp = "<table border='0' width='100%' class='Corps'>";
    temp += "<tr>";
    temp += "<td class='textBleu'><CENTER><b>&nbsp;&nbsp; Action :&nbsp;</b><a href='#' OnClick='NewProduit();'>&nbsp;Nouveau Produit&nbsp;</a>";
    temp += "</CENTER></td>";
    temp += "<td></td>";
    temp += "</tr></table>";

    $("#ssActionsProduit").html(temp);
}

function NewProduit(){
    var a = 0;

    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='Produit();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    $("#ssActionsProduit").html(temp);

    if (DET_ENTRE_IDUSER != IDUSER){
  	temp = "<table border='0' width='100%'><tr><td colspan='3' height='30' class='textGros'>Nouveau produit</td></tr>";
        temp += "<tr><td class='textRouge' colspan='3'>Aucun droit.</td>";
        temp += "</tr>";
  	temp += "</table>";
        $("#produit").html(temp);
        $("#headerProduit").hide();
        return;
    }


    temp = "<FORM name='newproduit1' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr><td colspan='3' height='30 class='textGros'>Nouveau produit</td></tr>";

    if (DET_ENTRE_QUIPRODQUOI_TYPEENTRE.length > 0){
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Nom produit :&nbsp;</td>";
        temp += "<td colspan='2' align=left><INPUT type='text' name='nomproduit' id='nomproduit' size='40'></td></tr>";

        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Type Produit :&nbsp;</td>";
        temp += "<td class='texte1' colspan='2' align=left>";

        a = 0;
        temp += "<SELECT name='typeproduit1' id='typeproduit1' onchange='choix_prod(); aide();'>";
        for (ind01 = 0; ind01 < DET_ENTRE_QUIPRODQUOI_TYPEENTRE.length; ind01++){
             if (a+=0)
               temp += "<OPTION selected=TRUE value='" + DET_ENTRE_QUIPRODQUOI_TYPEPROD[ind01] + "'>" + DET_ENTRE_QUIPRODQUOI_LIBPROD[ind01] + "&nbsp;&nbsp;";
             else
               temp += "<OPTION value='" + DET_ENTRE_QUIPRODQUOI_TYPEPROD[ind01] + "'>" + DET_ENTRE_QUIPRODQUOI_LIBPROD[ind01] + "&nbsp;&nbsp;";
        }
        temp += "</SELECT>";
        temp += "</td></tr>";

        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Image :&nbsp;</td>";
        temp += "<td colspan='2' align=left><INPUT type='text' name='image' id='image' size='50'></td></tr>";

        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Description :&nbsp;</td>";
        temp += "<td colspan='2' align=left><INPUT type='text' name='description' id='description' size='50'></td></tr>";

        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Nb Unité :&nbsp;</td>";
        temp += "<td class='texte1' align=left width='100'><INPUT type='text' name='nbunite' id='nbunite' size='5' align=right>";

        temp += "</td><td class='textBleu'><div id='choix_prod'>";
        temp += "</div></td></tr>";

        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Prix :&nbsp;</td>";
        temp += "<td colspan='2' align=left><INPUT type='text' name='prix' id='prix' size='7'>&nbsp;" + DEVISEPAYS + "</td></tr>";

        temp += "<tr><td width='200' class='textBleu'><div id='immo_lib_prod'></div></td>";
        temp += "<td colspan='2'><div id='immo_prod'></div></td></tr>";

        temp += "<tr><td width='150'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='idproduit' id='idproduit'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='entre1' id='entre1'></td>";
        temp += "</tr>";


        temp += "<tr><td width='200'><INPUT type=button name=valnewproduit value='Créer' onclick='newproduit()'></td>";
        temp += "<td></td></tr>";
    }
    else{
	temp += "<tr><td width='100%' class='textRouge' colspan='3'>Aucune de vos entreprises ne peut mettre en vente de produit pour le moment. Veuillez contacter votre responsable, il pourra le cas échéant faire une demande pour ajouter un nouveau type de produit.</td>";
        temp += "</tr>";
    }
    temp += "</table>";

    temp += "</FORM>";

    temp += "<table border='0' width='100%'><tr>";
    temp += "<td class='textRouge' height='40'>";
    temp += "La valeur et l'unité sont importantes et doivent être autorisées (adressez vous à votre responsable).";
    temp += "</tr></table>";

    $("#produit").html(temp);
    $("#headerProduit").hide();

    $("#entre1").val(id_entreprise);

    choix_prod();
    immo_prod();

    aide();
}

function choix_prod(){
    for (ind01 = 0; ind01 < DET_ENTRE_QUIPRODQUOI_TYPEPROD.length; ind01++){
        if (DET_ENTRE_QUIPRODQUOI_TYPEPROD[ind01] == $("#typeproduit1").val()){
            temp = "&nbsp;&nbsp;Unité : &nbsp;<SELECT name='idunite1' id='idunite1' onchange='aide();'>";
            temp += "<OPTION selected=TRUE value='" + DET_ENTRE_QUIPRODQUOI_TYPEUNITE[ind01] + "'>" + DET_ENTRE_QUIPRODQUOI_LIBUNITE[ind01] + "&nbsp;&nbsp;";
            temp += "</SELECT>";
            $("#choix_prod").html(temp);
            return;
        }
    }
}

function aide(){
    temp = "<br><table border='0' width='100%'>";
    temp += "<tr><td height='30'>&nbsp;</td></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='300'>&nbsp;</td>";
    temp += "</tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='100%'>&nbsp;&nbsp;1- Choisissez l'entreprise de production";
    temp += "<br><br>&nbsp;&nbsp;2- Déterminez le type du produit";
    temp += "<br><br>&nbsp;&nbsp;3- Calculez le coût de production :";
    temp += "<br>";

    // Cout EL
    temp += "<INPUT type='text' name='cal_val' id='cal_val' size='5' align=right>";

    temp += "&nbsp;&nbsp;";
    var tmp_str = $("#typeproduit1").val();
    if ($("#typeproduit1").val() == '20004')   // Batiment industriel
        temp += "% capacité conseillée";
    else if (tmp_str.substring(0,2) == '20')
        temp += "m2";
    else
        temp += "Euro";

    temp += "&nbsp;&nbsp;&nbsp;&nbsp;";
    temp += "<INPUT type=button name=cal_bouton value='>>>' onclick='cal_cal()'>";
    temp += "&nbsp;&nbsp;&nbsp;&nbsp;";
    temp += "<INPUT type='text' name='cal_unite' id='cal_unite' size='5' align=right>";
    temp += "&nbsp;&nbsp;";

    for (ind01 = 0; ind01 < DET_ENTRE_QUIPRODQUOI_TYPEENTRE.length; ind01++){
        if (DET_ENTRE_QUIPRODQUOI_TYPEUNITE[ind01] == $("#idunite1").val()){
            temp += DET_ENTRE_QUIPRODQUOI_LIBUNITE[ind01];
            break;
        }
    }

    temp += "<br>";

    temp += "</td>";
    temp += "</tr>";

    temp += "<tr>";
    temp += "<td class='texte1' width='150'>&nbsp;&nbsp;</td>";
    temp += "</tr>";

    temp += "</table>";

    //  $("#comptes").html(temp);

    $("#cal_unite").val(0);
    cal_cal();
}

function cal_cal(){

    $("#cal_unite").val(0);

    var tmp_str = $("#typeproduit1").val();
    var tmp_iu = $("#idunite1").val();

    // Immobilier : batiment industriel
    if ($("#typeproduit1").val() == '20004'){   //Batiment Industriel
        $("#cal_unite").val(Math.round($("#cal_val").val()));
    }
    // Immobilier : logement
    else if ($("#typeproduit1").val() == '20002'){  // Logement
        $("#cal_unite").val(Math.round($("#cal_val").val() * 0.08));
    }
    // Immobilier : bureau
    else if ($("#typeproduit1").val() == '20003'){ // Bureau
        $("#cal_unite").val(Math.round($("#cal_val").val() * 0.04));
    }
    // Immobilier : terrain
    else if ($("#typeproduit1").val() == '20001'){   //Terrain
        $("#cal_unite").val(Math.round($("#cal_val").val() * 0.01));
    }
    // Autre
    else{
        if ($("#idunite1").val() == '30001')  // PObjet
            $("#cal_unite").val(Math.round(Math.sqrt($("#cal_val").val() / 7)));
        else{
            if ($("#idunite1").val() == '80100')  // NV
                $("#cal_unite").val(Math.round(Math.sqrt($("#cal_val").val() / 4)));
	   else{
                $("#cal_unite").val(Math.round(Math.sqrt($("#cal_val").val() / 100)));
           }
        }
    }
}

function immo_prod(){
    var temp = "";
    var tmp_str = $("#typeproduit1").val();

    $("#immo_lib_prod").html(temp);
    $("#immo_prod").html(temp);

    if (tmp_str.substring(0,2) == '20'){
        temp = "&nbsp;&nbsp;Adresse :&nbsp;";
        temp += "<br>&nbsp;&nbsp;Province :&nbsp;";

        $("#immo_lib_prod").html(temp);

        temp = "<INPUT type='text' name='adresse' id='adresse' size='40' align=right>";

        temp += "<br>";

        temp += "<SELECT name='province' id='province'>";
        for (ind01 = 0; ind01 < LIST_PROV_IDPROV.length; ind01++){
            if (DET_ENTRE_IDPAYS == LIST_PROV_IDPAYS[ind01])
                temp += "<OPTION value='" + LIST_PROV_IDPROV[ind01] + "'>" + LIST_PROV_LIBPROV[ind01] + "&nbsp;&nbsp;";
        }
        temp += "</SELECT>";

        $("#immo_prod").html(temp);
    }
}

function ModifProduit(i){

    var temp;
    var ind01;

    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='Produit();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    $("#ssActionsProduit").html(temp);

    if (DET_ENTRE_IDUSER != IDUSER){
        temp = "<table border='0' width='100%'>";
        temp += "<tr><td colspan='3' height='30' class='textGros'>Produit</td></tr>";
        temp += "<tr><td class='textRouge' colspan='3'>Aucun droit.</td>";
        temp += "</tr>";
        temp += "</table>";
        $("#produit").html(temp);
        $("#headerProduit").hide();
        return;
    }

    temp = "<br><table border='0' width='300'>";

    temp += "<tr><td colspan='8' height='30' class='textGros'>Produit</td></tr>";

    temp += "<tr height='30'><td width='100'><b>&nbsp;Produit</b></td>";
    temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
    temp += "</tr>";

    for (ind01 = 0; ind01 < DET_ENTRE_PROD_IDPRODUIT.length; ind01++){
        if (DET_ENTRE_PROD_IDPRODUIT[ind01] == DET_ENTRE_PROD_IDPRODUIT[i]){
            temp += "<tr>";
            temp += "<td><b>" + DET_ENTRE_PROD_NOMPRODUIT[ind01] + "</b></td>";
            temp += "<td><CENTER><img src='" + DET_ENTRE_PROD_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
            temp += "</tr>";
        }
    }

    temp += "</table>";
    //  $("#comptes").html(temp);

    ModifProduit1(i);
}

function ModifProduit1(i){
    var a = 0;

    temp = "<FORM name='modifproduit' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr><td colspan='3' class='textGros' height='30'>Modification de votre produit</td></tr>";

    temp += "<tr><td width='150' class='textBleu'>&nbsp;&nbsp;Nom produit :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='nomproduit' id='nomproduit' size='40'></td></tr>";

    temp += "<tr><td width='150' class='textBleu'>&nbsp;&nbsp;Type Produit :&nbsp;</td>";
    temp += "<td class='texte1'>";
    temp += "<SELECT name='typeproduit1' id='typeproduit1'>";
    for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++){
        if (LIST_TYPEPROD_TYPEPROD[ind01] != '00000'){
            if (LIST_TYPEPROD_TYPEPROD[ind01] == DET_ENTRE_PROD_TYPE[i])
                temp += "<OPTION selected=TRUE value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
            else
                temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
        }
    }
    temp += "</SELECT></td></tr>";

    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Image :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='image' id='image' size='60'></td></tr>";

    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Description :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='description' id='description' size='60'></td></tr>";

    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Nb Unité :&nbsp;</td>";
    temp += "<td><INPUT type='text' name='nbunite' id='nbunite' size='5' align=right>";
    temp += "&nbsp;<SELECT name='idunite1' id='idunite1'>";
    for (ind01 = 0; ind01 < LIST_UNITE_NOMUNITE.length; ind01++){
        if (LIST_UNITE_IDUNITE[ind01] == DET_ENTRE_PROD_IDUNITE[i])
            temp += "<OPTION selected=TRUE value='" + LIST_UNITE_IDUNITE[ind01] + "'>" + LIST_UNITE_NOMUNITE[ind01] + "&nbsp;&nbsp;";
        else
            temp += "<OPTION value='" + LIST_UNITE_IDUNITE[ind01] + "'>" + LIST_UNITE_NOMUNITE[ind01] + "&nbsp;&nbsp;";
    }
    temp += "</SELECT></td></tr>";

    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Prix :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='prix' id='prix' size='7'>&nbsp;" + DEVISEPAYS + "</td></tr>";

    temp += "<tr><td width='200'></td>";
    temp += "<td colspan='2'><INPUT type='hidden' name='deviseprix' id='deviseprix'></td></tr>";

    temp += "<tr><td width='200'></td>";
    temp += "<td colspan='2'><INPUT type='hidden' name='idproduit' id='idproduit'></td></tr>";

    temp += "<tr><td width='200'><INPUT type=button name=valmodifproduit value='Modifier' onclick='majproduit(" + i + ");'></td>";
    temp += "<td class='texte2'></td>";
    temp += "<td width='100'><INPUT type=button name=valsupprproduit value='Supprimer' onclick='supprproduit(" + i + ");'></td></tr>";

    temp += "</table>";

    temp += "</FORM>";

    temp += "<table border='0' width='100%'><tr>";
    temp += "<td class='textRouge' height='40'>";
    temp += "La valeur et l'unité sont importantes et doivent être autorisées. (adressez vous à votre responsable)";
    temp += "</tr></table>";

    $("#produit").html(temp);
    $("#headerProduit").hide();

    $("#nomproduit").val(DET_ENTRE_PROD_NOMPRODUIT[i]);
    $("#image").val(DET_ENTRE_PROD_IMAGE[i]);
    $("#description").val(DET_ENTRE_PROD_DESCRIPTION[i]);
    $("#nbunite").val(DET_ENTRE_PROD_NBUNITE[i]);
    $("#idproduit").val(DET_ENTRE_PROD_IDPRODUIT[i]);
    $("#prix").val(DET_ENTRE_PROD_PRIX[i]);
    $("#deviseprix").val(DEVISEPAYS);
}