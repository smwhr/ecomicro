
function Conso(){
    i = $("#consostock").val();

    nbres = 0;
    nbprod = 0;


    temp = "<table border='0' width='100%'>";

    if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS)) || (IDUSER == DET_ENTRE_IDUSER)){

        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Quantité disponible :&nbsp;</td>";
        temp += "<td colspan='2' class='texte4'><b>" + DET_STOC_QUANTITE[i] + "&nbsp;" + DET_STOC_NOMUNITE[i] + "</b></td></tr>";

        temp += "<tr><td colspan='3'>";
        temp += "</td></tr>";

        temp += "<tr><td colspan='3'>";
        temp += "&nbsp;</td></tr>";

        temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Quantité consommée :&nbsp;</td>";
        temp += "<td colspan='2' class='texte4'><INPUT type='text' name='nbdeduite' id='nbdeduite' size=4 align=right>&nbsp;&nbsp;" + DET_STOC_NOMUNITE[i] + "</td></tr>";

        temp += "<tr><td colspan='3'>";
        temp += "</td></tr>";

        temp += "<tr>";
        temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Type consommation : &nbsp;</td><td colspan='2'><SELECT name='besoin' id='besoin'>";
        temp += "<OPTION value='0'>Consommation classique&nbsp;&nbsp;";
        for (ind01 = 0; ind01 < BES_ETAT_IDTITULAIRE.length; ind01++){
            if ((BES_ETAT_TYPEPRODUIT[ind01] == DET_STOC_IDUNITE[i]) && (BES_ETAT_QUANTITE[ind01] > 0) && (DET_STOC_IDUNITE[i] != '80008'))
                temp += "<OPTION value='" + BES_ETAT_IDTITULAIRE[ind01] + "'>" + BES_ETAT_LIBTITULAIRE[ind01] + "&nbsp;&nbsp;-&nbsp;&nbsp;" + BES_ETAT_QUANTITE[ind01] + "&nbsp;" + BES_ETAT_LIBTYPEPRODUIT[ind01] + "&nbsp;&nbsp;";
        }
        temp += "</SELECT></td></tr>";

        temp += "<tr>";
        temp += "<td colspan='3' class='textRouge'>Consommation classique : perte des unités.";
        temp += "<br>Choix d'un besoin national : perte des unités et diminution des besoins de la province.";
        temp += "</td></tr>";

        temp += "<tr><td width='250'></td>";
        temp += "<td><INPUT type='hidden' name='identre' id='identreConso'></td>";
        temp += "<td><INPUT type='hidden' name='idunite' id='iduniteConso'></td>";
        temp += "</tr>";

        temp += "<tr><td width='250'><INPUT type=button name=valmodifconso value='Consommer' onclick='majconso();'></td>";
        temp += "<td class='textRouge'>(Attention ces unités seront perdues.)</td>";
        temp += "</tr>";


    }
    else{
        temp += "<tr>";
        temp += "<td class='textRouge'>Aucun droit</td>";
        temp += "<td width='100'></td>";
        temp += "</tr>";

    }
    temp += "</table>";

    $("#consommer").html(temp);

    $("#identreConso").val(DET_ENTRE_IDENTRE);
    $("#iduniteConso").val(DET_STOC_IDUNITE[i]);
}

