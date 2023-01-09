
function AfficheEntreprise()
{
   RAZ_tout();
   Entreprise();
}

function Entreprise()
{
  var temp;
  var tmp;
  var ind01;

    temp = "<table border='0' width='350'><tr><td colspan='3' class='Titre2' height='40'>&nbsp;Détail d'une entreprise :</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMENTRE + "</td></tr>";

    temp += "<tr><td colspan='3'>";
    temp += "<CENTER><a href='" + DET_ENTRE_SITE + "'><img src='" + DET_ENTRE_LOGO + "' width=120 height=80 alt=''></a></CENTER>";
    temp += "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Pays :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMPAYS;
    temp += "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Type d'entreprise :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMTYPE + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Directeur :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMUSER + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Capacité mensuelle :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_CAPACITECONSO + " / " + DET_ENTRE_CAPACITEMENS + " ( " + DET_ENTRE_CAPACITE + " max)</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Résidence : &nbsp;</td><td colspan='2' class='texte4'>";
    tmp = "Aucune";
    for (ind01 = 0; ind01 < RES_ENTRE_IDPOSSESSION.length; ind01++)
    {
      if (RES_ENTRE_OCCUPE[ind01] == '1')
      {
        tmp = RES_ENTRE_ADRESSE[ind01] + "&nbsp;(" + RES_ENTRE_LIBPROVINCE[ind01] + ")&nbsp;";
        break;
      }
    }
    temp += tmp;
    temp += "</td></tr>";

    temp += "</table>";

    document.getElementById("tabgauchec").innerHTML = temp;


    temp = "<CENTER><table border='0' width='600' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Possessions :</td></tr>";

    temp += "<tr class='Titre3' height='40'><td width='150'><b>&nbsp;Produit</b></td>";
    temp += "<td width='100'><CENTER><b>Type</b></CENTER></td>";
    temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
    temp += "<td width='50'><CENTER><b>Valeur</b></CENTER></td>";
    temp += "<td width='50'><CENTER><b>Date d'achat</b></CENTER></td>";
    temp += "</tr>";

    for (ind01 = 0; ind01 < POSSP_IDPOSS.length; ind01++)
    {
        temp += "<tr>";
        temp += "<td><b>" + POSSP_NOMPRODUIT[ind01] + "</b>";
        if (POSSP_PRO[ind01] == 'b') temp += " (location)";
        temp += "</td>";
        temp += "<td><CENTER>" + POSSP_NOMTYPE[ind01] + "</CENTER></td>";
        temp += "<td><CENTER><img src='" + POSSP_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
        temp += "<td><CENTER>" + POSSP_NBUNITE[ind01] + "&nbsp;" + POSSP_NOMUNITE[ind01] + "</CENTER></td>";
        temp += "<td><CENTER>" + POSSP_DATEH[ind01] + "</CENTER></td>";
        temp += "</tr>";
    }

    temp += "</table></CENTER>";

    document.getElementById("tabdroitec").innerHTML = temp;
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


