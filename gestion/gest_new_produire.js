
var nbmat = 0;
var nbres = 0;
var nbprod = 0;
var valide = 0;

function Produire(){
    i = $("#produitf").val();

    if (i == '')
        return;

    nbres = 0;
    nbprod = 0;

    temp = "<table border='1' width='100%'>";

    if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS)) || (IDUSER == DET_ENTRE_IDUSER)) {
        temp += "<tr>";
    if (i != '')
  	temp += "<td colspan='3'><CENTER><b>" + PRODUIRE_LIBPROD[i] + "</b></CENTER></td></tr>";
    else
  	temp += "<td colspan='3'></td></tr>";

    temp += "<tr></tr>";

    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++){
        //production principale
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDRES[ind01])){
            nbprod++;
            temp += "<tr><td width='80' class='textBleu' valign=center>&nbsp;&nbsp;Produire&nbsp;</td>";
            temp += "<td width='220'>";

            temp += "<CENTER><b>" + PRODUIRE_LIBPROD[ind01] + "</b> (" + PRODUIRE_NBRES[ind01] + ")</CENTER></td>";
            temp += "<td width='100'><CENTER><INPUT type='text' name='prod0' id='prod0' size='4'></CENTER>";
            temp += "<CENTER><INPUT type='hidden' name='idprod0' id='idprod0' size='4' value='" + PRODUIRE_IDRES[ind01] + "'></CENTER>";

            temp += "</td>";
            temp += "</tr>";

            break;
        }
    }

    temp += "<tr><td colspan='3'><INPUT type=button name=valdonne value='Donne' onclick='Donne(" + i + ");'></td>";
    temp += "</tr>";

    var count_tmp = 0;

    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++){
        //productions annexes
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] != PRODUIRE_IDRES[ind01])){
            nbprod++;
            count_tmp++;
            temp += "<tr><td width='80' class='textRouge' valign=center>&nbsp;&nbsp;Génère&nbsp;</td>";
            temp += "<td width='220'>";

            temp += "<CENTER><b>" + PRODUIRE_LIBPROD[ind01] + "</b> (" + PRODUIRE_NBRES[ind01] + ")</CENTER></td>";
            temp += "<td width='100'><CENTER><INPUT type='text' name='prod" + count_tmp + "' id='prod" + count_tmp + "' size='4'></CENTER>";
            temp += "<CENTER><INPUT type='hidden' name='idprod" + count_tmp + "' id='idprod" + count_tmp + "' size='4' value='" + PRODUIRE_IDRES[ind01] + "'></CENTER>";

            temp += "</td>";
            temp += "</tr>";
        }
    }

    // ressources
    count_tmp = 0;

    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++){
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '2')){
            nbres++;
            count_tmp++;
            temp += "<tr><td width='80' class='textRouge' valign=center>&nbsp;&nbsp;Ressource&nbsp;</td>";
            temp += "<td width='220'>";

            temp += "<CENTER><b>" + PRODUIRE_LIBPROD[ind01] + "</b> (" + PRODUIRE_NBRES[ind01] + ")</CENTER></td>";
            temp += "<td width='100'><CENTER><INPUT type='text' name='res" + count_tmp + "' id='res" + count_tmp + "' size='4'></CENTER>";
            temp += "<CENTER><INPUT type='hidden' name='idres" + count_tmp + "' id='idres" + count_tmp + "' size='4' value='" + PRODUIRE_IDRES[ind01] + "'></CENTER>";

            temp += "</td>";
            temp += "</tr>";
        }
    }

    // équipement
    count_tmp = 0;

    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++){
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '3')){
            nbmat++;
            count_tmp++;
            temp += "<tr><td width='80' class='textRouge' valign=center>&nbsp;&nbsp;Equipement&nbsp;</td>";
            temp += "<td width='220'>";

            temp += "<CENTER><b>" + PRODUIRE_LIBPROD[ind01] + "</b> (" + PRODUIRE_NBRES[ind01] + ")</CENTER></td>";
            temp += "<td width='100'><CENTER><INPUT type='text' name='mat" + count_tmp + "' id='mat" + count_tmp + "' size='4'></CENTER>";
            temp += "<CENTER><INPUT type='hidden' name='idmat" + count_tmp + "' id='idmat" + count_tmp + "' size='4' value='" + PRODUIRE_IDRES[ind01] + "'></CENTER>";

            temp += "</td>";
            temp += "</tr>";
        }
    }

    temp += "<tr><td colspan='3'><INPUT type=button name=vallance value='Lancer la production' onclick='Lancer(" + i + ");'>";
    temp += "<INPUT type='hidden' name='facteur' id='facteur' size='4'>";
    temp += "<INPUT type='hidden' name='prodfini' id='prodfini' size='4'>";
    temp += "<INPUT type='hidden' name='identre' id='identreProd' size='4'>";
    temp += "<INPUT type='hidden' name='type' id='type' size='4'>";
    temp += "<INPUT type='hidden' name='nbresA' id='nbresA' size='4'>";
    temp += "<INPUT type='hidden' name='nbmatA' id='nbmatA' size='4'>";
    temp += "<INPUT type='hidden' name='nbresA' id='nbprodA' size='4'>";
    temp += "</td></tr>";

    temp += "</table>";

    $("#produire").html(temp);

    $("#prodfini").val(PRODUIRE_IDPRODFINI[i]);
    $("#type").val(PRODUIRE_TYPEENTRE[i]);
    $("#identreProd").val(id_entreprise);
    $("#nbresA").val(nbres);
    $("#nbmatA").val(nbmat);
    $("#nbprodA").val(nbprod);

    }
    else{
        temp += "<tr>";
        temp += "<td class='textRouge'>Aucun droit</td>";
        temp += "<td width='100'></td>";
        temp += "</tr>";

        temp += "</table>";

        $("#produire").html(temp);
    }
}

function Donne(i){
    var tmp_prod = 0;
    var tmp_res = 0;
    var tmp_cal = 0;
    var tmp_facteur = 0;  // facteur multiplicatif de production

    valide = 0;

    if ($("#nbprodA").val() > 0){
        // production principale
        tmp_prod = parseInt($("#prod0").val());
        if ((isNaN(tmp_prod)) || (tmp_prod <= 0)){
            alert("Il s'agit de saisir un nombre entier positif supérieur à zéro !");
            return;
        }
        else{
            $("#prod0").val(tmp_prod);
        }

        for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++){
            if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDRES[ind01])){
                tmp_facteur = (parseInt($("#prod0").val()) / parseInt(PRODUIRE_NBRES[ind01]));
                tmp_cal = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

                if (parseInt(tmp_cal) == 0){
                    alert("La quantité à produire est trop faible.");
                    return;
                }
                $("#prod0").val(tmp_cal);
            }
        }
        $("#facteur").val(parseInt(tmp_facteur));

        var count_tmp = 0;
        var nom_tmp;
        var id_tmp;

        for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++){
            if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] != PRODUIRE_IDRES[ind01])){
                tmp_cal = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

                for (ind02 = 0; ind02 < 2; ++ind02){
                    nom_tmp = "#prod" + ind02;
                    id_tmp = "#idprod" + ind02;

                    if (PRODUIRE_IDRES[ind01] == $(id_tmp).val())
                        $(nom_tmp).val(tmp_cal);
                }
            }
        }

        if ((parseInt($("#prod0").val()) + parseInt(DET_ENTRE_CAPACITECONSO) ) > DET_ENTRE_CAPACITEMENS){
            alert("Vous ne disposez pas de la capacité nécessaire ce mois pour produire une telle quantité.");
            return;
        }
    }

    var nbres = $("#nbresA").val();
    var nbmat = $("#nbmatA").val();
    if ((nbres > 0) || (nbmat > 0)){
        tmp_res = 0;

        $("#res1").val(0);
        if (nbres > 1)
            $("#res2").val(0);
        if (nbres > 2)
            $("#res3").val(0);
        if (nbres > 3)
            $("#res4").val(0);
        if (nbres > 4)
            $("#res5").val(0);
/*
    $("#mat1").val() = 0;
    if (nbmat > 1)
       $("#mat2").val() = 0;
    if (nbmat > 2)
       $("#mat3").val() = 0;
    if (nbmat > 3)
       $("#mat4").val() = 0;
    if (nbmat > 4)
       $("#mat5").val() = 0;
*/
        if (DET_STOC_IDUNITE.length <= 0){
            alert("Vous ne disposez pas de ressource !!");
            return;
        }

        tmp_res = 0;
        for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++){
        // ressources
            if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '2')){
                tmp_res = 0;
                for (ind02 = 0; ind02 < DET_STOC_IDUNITE.length; ind02++){
                    if (DET_STOC_IDUNITE[ind02] == PRODUIRE_IDRES[ind01]){
                        tmp_res = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

                        if (DET_STOC_IDUNITE[ind02] == $("#idres1").val())
                            $("#res1").val(tmp_res);

                        if ((nbres > 1) && (DET_STOC_IDUNITE[ind02] == $("#idres2").val()))
                            $("#res2").val(tmp_res);

                        if ((nbres > 2) && (DET_STOC_IDUNITE[ind02] == $("#idres3").val()))
                            $("#res3").val(tmp_res);

                        if ((nbres > 3) && (DET_STOC_IDUNITE[ind02] == $("#idres4").val()))
                            $("#res4").val(tmp_res);

                        if ((nbres > 4) && (DET_STOC_IDUNITE[ind02] == $("#idres5").val()))
                            $("#res5").val(tmp_res);

                        if (parseInt(tmp_res) > parseInt(DET_STOC_QUANTITE[ind02])){
                            alert("Vous ne disposez pas assez de ressource.");
                            return;
                        }
                    }
                }
                if (parseInt(tmp_res) == 0){
                    alert("Vous ne disposez pas assez de ressource.");
                    return;
                }
            }
/*
        // équipements
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '3'))
        {
                tmp_res = 0;
                for (ind02 = 0; ind02 < DET_STOC_IDUNITE.length; ind02++)
                {
                    if (DET_STOC_IDUNITE[ind02] == PRODUIRE_IDRES[ind01])
                    {
                       tmp_res = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

                       if (DET_STOC_IDUNITE[ind02] == $("#idmat1").val())
                       	  $("#mat1").val() = tmp_res;

                       if ((nbmat > 1) && (DET_STOC_IDUNITE[ind02] == $("#idmat2").val()))
                       	  $("#mat2").val() = tmp_res;

                       if ((nbmat > 2) && (DET_STOC_IDUNITE[ind02] == $("#idmat3").val()))
                       	  $("#mat3").val() = tmp_res;

                       if ((nbmat > 3) && (DET_STOC_IDUNITE[ind02] == $("#idmat4").val()))
                       	  $("#mat4").val() = tmp_res;

                       if ((nbmat > 4) && (DET_STOC_IDUNITE[ind02] == $("#idmat5").val()))
                       	  $("#mat5").val() = tmp_res;

                       if (parseInt(tmp_res) > parseInt(DET_STOC_QUANTITE[ind02]))
                       {
                       	  alert("Vous ne disposez pas assez d'�quipements.");
                       	  return;
                       }
                    }
                }

		if (parseInt(tmp_res) == 0)
		{
			alert("Vous ne disposez pas assez d'�quipements.");
			return;
		}

        }
*/
/*
        // productions annexes
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] != PRODUIRE_IDRES[ind01]))
        {
                for (ind02 = 0; ind02 < DET_STOC_IDUNITE.length; ind02++)
                {
                    if (DET_STOC_IDUNITE[ind02] == PRODUIRE_IDRES[ind01])
                    {
                       tmp_res = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

                       if (DET_STOC_IDUNITE[ind02] == $("#idprod1").val())
                       	  $("#prod1").val() = tmp_res;

                       if ((nbres > 1) && (DET_STOC_IDUNITE[ind02] == $("#idprod2").val()))
                       	  $("#prod2").val() = tmp_res;

                       if ((nbres > 2) && (DET_STOC_IDUNITE[ind02] == $("#idprod3").val()))
                       	  $("#prod3").val() = tmp_res;

                       if ((nbres > 3) && (DET_STOC_IDUNITE[ind02] == $("#idprod4").val()))
                       	  $("#prod4").val() = tmp_res;

                       if ((nbres > 4) && (DET_STOC_IDUNITE[ind02] == $("#idprod5").val()))
                       	  $("#prod5").val() = tmp_res;

                    }
                }
        }
*/
        }
    }
    valide = 1;
}