
var nbmat = 0;
var nbres = 0;
var nbprod = 0;
var valide = 0;

function AfficheProduire()
{
   RAZ_tout();
   Action();
   Transformer()
}

function Action()
{
  temp = "<table border='0' width='800'><tr>";
  temp += "<td class='Texte1'>&nbsp;&nbsp;<b>&nbsp;&nbsp; Actions :&nbsp;</b>";
  temp += "<a href='#' OnClick='RAZ_droitec();'>&nbsp;Rapport d'activit?&nbsp;</a>";
  temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='detail_1_entreprise.php?entreprise=" + entre + "'>&nbsp;D?tail&nbsp;</a>";
  temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='consommer.php?entreprise=" + entre + "'>&nbsp;Consommation&nbsp;</a>";
  temp += "</td></tr></table>";
  document.getElementById("tabgaucheh").innerHTML = temp;
}

function Transformer()
{
  var aa = "ZZ";

    temp = "<CENTER><table border='0' width='150' class='Corps'><tr><td colspan='8' class='Titre5' height='40'>&nbsp;Productions :</td></tr>";

    temp += "<tr class='Titre3' height='40'><td width='150'><CENTER><b>&nbsp;Produit fini</b></CENTER></td>";
    temp += "</tr>";

    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++)
    {
        temp += "<tr>";
        if ((aa != PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_IDPRODFINI[ind01] == PRODUIRE_IDRES[ind01]))
        {
        	aa = PRODUIRE_IDPRODFINI[ind01];
                temp += "<td><CENTER><b><a href='#' onclick='Produire(" + ind01 + ");'>" + PRODUIRE_LIBPROD[ind01] + "</a></b></CENTER></td>";
        }
        temp += "</tr>";

    }

    temp += "</table></CENTER>";

    document.getElementById("tabdroitec").innerHTML = temp;

    temp = "<CENTER><table border='0' width='200' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Stocks :</td></tr>";

    temp += "<tr class='Titre3' height='40'><td width='200'><b>&nbsp;Produit</b></td>";
    temp += "<td width='100'><b>&nbsp;Quantit?</b></td>";
    temp += "</tr>";

    for (ind01 = 0; ind01 < DET_STOC_IDUNITE.length; ind01++)
    {
        if (parseInt(DET_STOC_QUANTITE[ind01]) > 0)
        {
           temp += "<tr>";
           temp += "<td>" + DET_STOC_NOMUNITE[ind01] + "</td>";
           temp += "<td>" + DET_STOC_QUANTITE[ind01] + "</td>";
           temp += "</tr>";
        }
    }

    temp += "</table></CENTER>";

    document.getElementById("tabcentrec").innerHTML = temp;


    temp = "<table border='0' width='300'><tr><td colspan='3' class='Titre2' height='40'>&nbsp;D?tail d'une entreprise :</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMENTRE + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Pays :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMPAYS;
    temp += "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Type d'entreprise :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMTYPE + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Directeur :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMUSER + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Capacit? mensuelle :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_CAPACITECONSO + " / " + DET_ENTRE_CAPACITEMENS + " ( " + DET_ENTRE_CAPACITE + " max)</td></tr>";

    temp += "</table>";

    document.getElementById("tabgauchec").innerHTML = temp;
}

function Produire(i)
{
  nbres = 0;
  nbprod = 0;

  temp = "<FORM name='produire1' method='post' action=''>";

  temp += "<table border='1' width='300'><tr><td colspan='3' class='Titre5' height='40'>&nbsp;Produire :</td></tr>";

 if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS)) || (IDUSER == DET_ENTRE_IDUSER))
 {
  temp += "<tr class='Titre3'>";
  temp += "<td colspan='3' class='texte4'><CENTER><b>" + PRODUIRE_LIBPROD[i] + "</b></CENTER></td></tr>";

  temp += "<tr></tr>";

  for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++)
  {
        //production principale
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDRES[ind01]))
        {
                nbprod++;
                temp += "<tr><td width='80' class='texte1' valign=center>&nbsp;&nbsp;Produire&nbsp;</td>";
                temp += "<td width='220' colspan='2'>";

                temp += "<CENTER><b>" + PRODUIRE_LIBPROD[ind01] + "</b> (" + PRODUIRE_NBRES[ind01] + ")</CENTER>";
                temp += "<CENTER><INPUT type='text' name='prod0' id='prod0' size='4'></CENTER>";
                temp += "<CENTER><INPUT type='hidden' name='idprod0' id='idprod0' size='4' value='" + PRODUIRE_IDRES[ind01] + "'></CENTER>";

                temp += "</td>";
                temp += "</tr>";

                break;
        }
    }

  temp += "<tr><td colspan='3'><INPUT type=button name=valdonne value='Donne' onclick='Donne(" + i + ");'></td>";
  temp += "</tr>";

  var count_tmp = 0;

  for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++)
  {
        //productions annexes
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] != PRODUIRE_IDRES[ind01]))
        {
                nbprod++;
                count_tmp++;
                temp += "<tr><td width='80' class='texte2' valign=center>&nbsp;&nbsp;G?n?re&nbsp;</td>";
                temp += "<td width='220' colspan='2'>";

                temp += "<CENTER><b>" + PRODUIRE_LIBPROD[ind01] + "</b> (" + PRODUIRE_NBRES[ind01] + ")</CENTER>";
                temp += "<CENTER><INPUT type='text' name='prod" + count_tmp + "' id='prod" + count_tmp + "' size='4'></CENTER>";
                temp += "<CENTER><INPUT type='hidden' name='idprod" + count_tmp + "' id='idprod" + count_tmp + "' size='4' value='" + PRODUIRE_IDRES[ind01] + "'></CENTER>";

                temp += "</td>";
                temp += "</tr>";

        }
  }

  // ressources
  count_tmp = 0;

  for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++)
  {
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '2'))
        {
                nbres++;
                count_tmp++;
                temp += "<tr><td width='80' class='texte2' valign=center>&nbsp;&nbsp;Ressource&nbsp;</td>";
                temp += "<td width='220' colspan='2'>";

                temp += "<CENTER><b>" + PRODUIRE_LIBPROD[ind01] + "</b> (" + PRODUIRE_NBRES[ind01] + ")</CENTER>";
                temp += "<CENTER><INPUT type='text' name='res" + count_tmp + "' id='res" + count_tmp + "' size='4'></CENTER>";
                temp += "<CENTER><INPUT type='hidden' name='idres" + count_tmp + "' id='idres" + count_tmp + "' size='4' value='" + PRODUIRE_IDRES[ind01] + "'></CENTER>";

                temp += "</td>";
                temp += "</tr>";
        }

  }

  // ?quipement
  count_tmp = 0;

  for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++)
  {
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '3'))
        {
                nbmat++;
                count_tmp++;
                temp += "<tr><td width='80' class='texte2' valign=center>&nbsp;&nbsp;Equipement&nbsp;</td>";
                temp += "<td width='220' colspan='2'>";

                temp += "<CENTER><b>" + PRODUIRE_LIBPROD[ind01] + "</b> (" + PRODUIRE_NBRES[ind01] + ")</CENTER>";
                temp += "<CENTER><INPUT type='text' name='mat" + count_tmp + "' id='mat" + count_tmp + "' size='4'></CENTER>";
                temp += "<CENTER><INPUT type='hidden' name='idmat" + count_tmp + "' id='idmat" + count_tmp + "' size='4' value='" + PRODUIRE_IDRES[ind01] + "'></CENTER>";

                temp += "</td>";
                temp += "</tr>";
        }

  }

  temp += "<tr><td colspan=''><INPUT type=button name=vallance value='Lancer la production' onclick='Lancer(" + i + ");'>";
  temp += "<INPUT type='hidden' name='facteur' id='facteur' size='4'>";
  temp += "<INPUT type='hidden' name='prodfini' id='prodfini' size='4'>";
  temp += "<INPUT type='hidden' name='identre' id='identre' size='4'>";
  temp += "<INPUT type='hidden' name='type' id='type' size='4'>";
  temp += "<INPUT type='hidden' name='nbresA' id='nbresA' size='4'>";
  temp += "<INPUT type='hidden' name='nbmatA' id='nbmatA' size='4'>";
  temp += "</td></tr>";

  temp += "</table>";
  temp += "</FORM>";

  document.getElementById("xtabdroitec").innerHTML = temp;

  document.getElementById("prodfini").value = PRODUIRE_IDPRODFINI[i];
  document.getElementById("type").value = PRODUIRE_TYPEENTRE[i];
  document.getElementById("identre").value = entre;
  document.getElementById("nbresA").value = nbres;
  document.getElementById("nbmatA").value = nbmat;

 }
 else
 {
  temp += "<tr>";
  temp += "<td class='Texte2'>Aucun droit</td>";
  temp += "<td width='100'></td>";
  temp += "</tr>";

  temp += "</table>";
  temp += "</FORM>";

  document.getElementById("xtabdroitec").innerHTML = temp;
 }

}


function Donne(i)
{
 var tmp_prod = 0;
 var tmp_res = 0;
 var tmp_cal = 0;
 var tmp_facteur = 0;  // facteur multiplicatif de production

 valide = 0;

 if (nbprod > 0)
 {
    // production principale
    tmp_prod = parseInt(document.getElementById("prod0").value);
    if ((isNaN(tmp_prod)) || (tmp_prod <= 0))
    {
   	alert("Il s'agit de saisir un nombre entier positif sup?rieur ? z?ro !");
        return;
    }
    else
    {
    	document.getElementById("prod0").value = tmp_prod;
    }

    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++)
    {
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDRES[ind01]))
        {
             tmp_facteur = (parseInt(document.getElementById("prod0").value) / parseInt(PRODUIRE_NBRES[ind01]));
             tmp_cal = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

             if (parseInt(tmp_cal) == 0)
             {
           	alert("La quantit? ? produire est trop faible.");
                return;
             }
             document.getElementById("prod0").value = tmp_cal;
        }
    }
    document.getElementById("facteur").value = parseInt(tmp_facteur);

    var count_tmp = 0;
    var nom_tmp;
    var id_tmp;

    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++)
    {
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '1') && (PRODUIRE_IDPRODFINI[i] != PRODUIRE_IDRES[ind01]))
        {
             tmp_cal = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

             for (ind02 = 0; ind02 < 2; ++ind02)
             {
               nom_tmp = "prod" + ind02;
               id_tmp = "idprod" + ind02;

               if (PRODUIRE_IDRES[ind01] == document.getElementById(id_tmp).value)
                   document.getElementById(nom_tmp).value = tmp_cal;
             }
        }
    }

    if ((parseInt(document.getElementById("prod0").value) + parseInt(DET_ENTRE_CAPACITECONSO) ) > DET_ENTRE_CAPACITEMENS)
    {
        alert("Vous ne disposez pas de la capacit? n?cessaire ce mois pour produire une telle quantit?.");
        return;
    }
 }

 if ((nbres > 0) || (nbmat > 0))
 {
    tmp_res = 0;

    document.getElementById("res1").value = 0;
    if (nbres > 1)
       document.getElementById("res2").value = 0;
    if (nbres > 2)
       document.getElementById("res3").value = 0;
    if (nbres > 3)
       document.getElementById("res4").value = 0;
    if (nbres > 4)
       document.getElementById("res5").value = 0;
/*
    document.getElementById("mat1").value = 0;
    if (nbmat > 1)
       document.getElementById("mat2").value = 0;
    if (nbmat > 2)
       document.getElementById("mat3").value = 0;
    if (nbmat > 3)
       document.getElementById("mat4").value = 0;
    if (nbmat > 4)
       document.getElementById("mat5").value = 0;
*/
    if (DET_STOC_IDUNITE.length <= 0)
    {
       alert("Vous ne disposez pas de ressource !!");
       return;
    }

    tmp_res = 0;
    for (ind01 = 0; ind01 < PRODUIRE_IDPRODFINI.length; ind01++)
    {
        // ressources
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '2'))
        {
                tmp_res = 0;
                for (ind02 = 0; ind02 < DET_STOC_IDUNITE.length; ind02++)
                {
		    if (DET_STOC_IDUNITE[ind02] == PRODUIRE_IDRES[ind01])
                    {
                       tmp_res = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

                       if (DET_STOC_IDUNITE[ind02] == document.getElementById("idres1").value)
                       	  document.getElementById("res1").value = tmp_res;

                       if ((nbres > 1) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idres2").value))
                       	  document.getElementById("res2").value = tmp_res;

                       if ((nbres > 2) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idres3").value))
                       	  document.getElementById("res3").value = tmp_res;

                       if ((nbres > 3) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idres4").value))
                       	  document.getElementById("res4").value = tmp_res;

                       if ((nbres > 4) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idres5").value))
                       	  document.getElementById("res5").value = tmp_res;

                       if (parseInt(tmp_res) > parseInt(DET_STOC_QUANTITE[ind02]))
                       {
                       	  alert("Vous ne disposez pas assez de ressource.");
                       	  return;
                       }
                    }
                }
		if (parseInt(tmp_res) == 0)
		{
			alert("Vous ne disposez pas assez de ressource.");
			return;
		}

        }
/*
        // ?quipements
        if ((PRODUIRE_IDPRODFINI[i] == PRODUIRE_IDPRODFINI[ind01]) && (PRODUIRE_TYPEPRODUIRE[ind01] == '3'))
        {
                tmp_res = 0;
                for (ind02 = 0; ind02 < DET_STOC_IDUNITE.length; ind02++)
                {
                    if (DET_STOC_IDUNITE[ind02] == PRODUIRE_IDRES[ind01])
                    {
                       tmp_res = parseInt(tmp_facteur) * parseInt(PRODUIRE_NBRES[ind01]);

                       if (DET_STOC_IDUNITE[ind02] == document.getElementById("idmat1").value)
                       	  document.getElementById("mat1").value = tmp_res;

                       if ((nbmat > 1) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idmat2").value))
                       	  document.getElementById("mat2").value = tmp_res;

                       if ((nbmat > 2) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idmat3").value))
                       	  document.getElementById("mat3").value = tmp_res;

                       if ((nbmat > 3) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idmat4").value))
                       	  document.getElementById("mat4").value = tmp_res;

                       if ((nbmat > 4) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idmat5").value))
                       	  document.getElementById("mat5").value = tmp_res;

                       if (parseInt(tmp_res) > parseInt(DET_STOC_QUANTITE[ind02]))
                       {
                       	  alert("Vous ne disposez pas assez d'?quipements.");
                       	  return;
                       }
                    }
                }

		if (parseInt(tmp_res) == 0)
		{
			alert("Vous ne disposez pas assez d'?quipements.");
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

                       if (DET_STOC_IDUNITE[ind02] == document.getElementById("idprod1").value)
                       	  document.getElementById("prod1").value = tmp_res;

                       if ((nbres > 1) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idprod2").value))
                       	  document.getElementById("prod2").value = tmp_res;

                       if ((nbres > 2) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idprod3").value))
                       	  document.getElementById("prod3").value = tmp_res;

                       if ((nbres > 3) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idprod4").value))
                       	  document.getElementById("prod4").value = tmp_res;

                       if ((nbres > 4) && (DET_STOC_IDUNITE[ind02] == document.getElementById("idprod5").value))
                       	  document.getElementById("prod5").value = tmp_res;

                    }
                }
        }
*/
    }




 }

 valide = 1;

}

function RAZ_tout()
{
  document.getElementById("tabgaucheh").innerHTML = "";
  document.getElementById("tabcentreh").innerHTML = "";
  document.getElementById("tabgauchec").innerHTML = "";
  document.getElementById("tabcentrec").innerHTML = "";
  document.getElementById("tabdroitec").innerHTML = "";
  document.getElementById("tabgaucheb").innerHTML = "";
  document.getElementById("tabcentreb").innerHTML = "";
  document.getElementById("tabdroiteb").innerHTML = "";
}
function RAZ_droiteb()
{
  document.getElementById("tabdroiteb").innerHTML = "";
}
function RAZ_droitec()
{
  document.getElementById("tabdroitec").innerHTML = "";
}
function RAZ_centrec()
{
  document.getElementById("tabcentrec").innerHTML = "";
}

