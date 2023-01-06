
function AfficheConsommer()
{
   RAZ_tout();
   Action();
   Consommer()
}

function Action()
{
  temp = "<table border='0' width='800'><tr>";
  temp += "<td class='Texte1'>&nbsp;&nbsp;<b>&nbsp;&nbsp; Actions :&nbsp;</b>";
  temp += "<a href='#' OnClick='RAZ_droitec();'>&nbsp;Rapport d'activité&nbsp;</a>";
  temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='detail_1_entreprise.php?entreprise=" + entre + "'>&nbsp;Détail&nbsp;</a>";
  temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='produire.php?entreprise=" + entre + "'>&nbsp;Production&nbsp;</a>";
  temp += "</td></tr></table>";
  document.getElementById("tabgaucheh").innerHTML = temp;
}

function Consommer()
{
  var aa = "ZZ";

    temp = "<CENTER><table border='0' width='150' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Stocks :</td></tr>";

    temp += "<tr class='Titre3' height='40'><td width='150'><b><CENTER>Matière</CENTER></b></td>";
    temp += "</tr>";

    for (ind01 = 0; ind01 < DET_STOC_IDUNITE.length; ind01++)
    {
      if ((parseInt(DET_STOC_QUANTITE[ind01]) > 0) && (DET_STOC_IDUNITE[ind01] != '80008'))
      {
        temp += "<tr>";
                temp += "<td align=right><a href='#' OnClick='RAZ_droitec(); Conso(" + ind01 + ");'>" + DET_STOC_QUANTITE[ind01] + "&nbsp;&nbsp;" + DET_STOC_NOMUNITE[ind01] + "</a></td>";
        temp += "</tr>";
      }
    }

    temp += "</table></CENTER>";

    document.getElementById("tabcentrec").innerHTML = temp;


    temp = "<table border='0' width='350'><tr><td colspan='3' class='Titre2' height='40'>&nbsp;Détail d'une entreprise :</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMENTRE + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Pays :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMPAYS;
    temp += "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Type d'entreprise :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMTYPE + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Directeur :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_NOMUSER + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Capacité mensuelle :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_ENTRE_CAPACITECONSO + " / " + DET_ENTRE_CAPACITE + "</td></tr>";

    temp += "</table>";

    document.getElementById("tabgauchec").innerHTML = temp;
}

function Conso(i)
{
  nbres = 0;
  nbprod = 0;

  temp = "<FORM name='consommer1' method='post' action=''>";

  temp += "<table border='0' width='400'><tr><td colspan='3' class='Titre5' height='40'>&nbsp;Consommer :</td></tr>";

 if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS)) || (IDUSER == DET_ENTRE_IDUSER))
 {

    temp += "<tr><td width='120' class='texte1'>&nbsp;&nbsp;Quantité disponible :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'><b>" + DET_STOC_QUANTITE[i] + "&nbsp;" + DET_STOC_NOMUNITE[i] + "</b></td></tr>";

      temp += "<tr><td colspan='3'>";
      temp += "</td></tr>";

      temp += "<tr><td colspan='3'>";
      temp += "&nbsp;</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Quantité consommée :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'><INPUT type='text' name='nbdeduite' id='nbdeduite' size=4 align=right>&nbsp;&nbsp;" + DET_STOC_NOMUNITE[i] + "</td></tr>";

      temp += "<tr><td colspan='3'>";
      temp += "</td></tr>";

  temp += "<tr>";
  temp += "<td class='texte1' width='150'>&nbsp;&nbsp;Type consommation : &nbsp;</td><td colspan='2'><SELECT name='besoin' id='besoin'>";
  temp += "<OPTION value='0'>Consommation classique&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < BES_ETAT_IDTITULAIRE.length; ind01++)
  {
     if ((BES_ETAT_TYPEPRODUIT[ind01] == DET_STOC_IDUNITE[i]) && (BES_ETAT_QUANTITE[ind01] > 0) && (DET_STOC_IDUNITE[i] != '80008'))
       temp += "<OPTION value='" + BES_ETAT_IDTITULAIRE[ind01] + "'>" + BES_ETAT_LIBTITULAIRE[ind01] + "&nbsp;&nbsp;-&nbsp;&nbsp;" + BES_ETAT_QUANTITE[ind01] + "&nbsp;" + BES_ETAT_LIBTYPEPRODUIT[ind01] + "&nbsp;&nbsp;";
  }
  temp += "</SELECT></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;</td>";
  temp += "<td colspan='2' class='texte2'>Consommation classique : perte des unités.";
  temp += "<br>Choix d'un besoin national : perte des unités et diminution des besoins de la province.";
  temp += "</td></tr>";



    temp += "<tr><td width='100'></td>";
    temp += "<td><INPUT type='hidden' name='identre' id='identre'></td>";
    temp += "<td><INPUT type='hidden' name='idunite' id='idunite'></td>";
    temp += "</tr>";

      temp += "<tr><td width='120'><INPUT type=button name=valmodifconso value='Consommer' onclick='majconso();'></td>";
      temp += "<td class='texte2'>(Attention ces unités seront perdues.)</td>";
      temp += "</tr>";


 }
 else
 {
  temp += "<tr>";
  temp += "<td class='Texte2'>Aucun droit</td>";
  temp += "<td width='100'></td>";
  temp += "</tr>";

 }
  temp += "</table>";
  temp += "</FORM>";

  document.getElementById("tabdroitec").innerHTML = temp;

  document.getElementById("identre").value = DET_ENTRE_IDENTRE;
  document.getElementById("idunite").value = DET_STOC_IDUNITE[i];
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

