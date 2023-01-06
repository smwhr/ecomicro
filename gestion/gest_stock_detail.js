
function AfficheStock()
{
   RAZ_tout();
   SelectPaysUnite();
   Stock();
}

function Stock()
{

  var temp;
  var ind01;

  var unite = document.getElementById("unite1").value;
  var pays = document.getElementById("pays1").value;

  temp = "<table border='0' width='600' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Stocks :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='200'><b>&nbsp;Pays</b></td>";
  temp += "<td width='300'><b>&nbsp;Entreprise - Province</b></td>";
  temp += "<td width='50' align=right><b>Quantité</b></td>";
  temp += "</tr>";

  for (ind01 = 0; ind01 < DET_STOC_NOMENTREPRISE.length; ind01++)
  {
    if (((unite == DET_STOC_IDUNITE[ind01]) || (unite == DET_STOC_IDUNITEEQUI[ind01]) || (unite == '0')) && ((pays == DET_STOC_IDPAYS[ind01]) || (pays == '0')))
    {
      if (DET_STOC_QUANTITE[ind01] > 0)
      {
        temp += "<tr>";
        temp += "<td>" + DET_STOC_NOMPAYS[ind01] + "</td>";
        temp += "<td><b><a href='#' onclick='DetailEntreprise(" + DET_STOC_IDENTREPRISE[ind01] + ");'>" + DET_STOC_NOMENTREPRISE[ind01] + "</a></b></td>";
        temp += "<td align=right>" + DET_STOC_QUANTITE[ind01] + "&nbsp;";
        temp += DET_STOC_NOMUNITE[ind01] + "</td>";
        temp += "</tr>";
      }
    }
  }

  temp += "</table>";
  document.getElementById("tabcentreb").innerHTML = temp;
}

function DetailEntreprise(entre)
{
  $tmp = "detail_1_entreprise.php?entreprise=" + entre;
  document.location.replace($tmp);
}


function SelectPaysUnite()
{
  temp = "<table><tr>";
  temp += "<td class='texte1'>&nbsp;&nbsp;Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Stock();'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
     temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";

  temp += "</SELECT></td>";

  temp += "<td class='texte1'>";
  temp += "&nbsp;&nbsp;Unité : &nbsp;<SELECT name='unite1' id='unite1' onchange='Stock();'>";
  temp += "<OPTION value='0'>Toutes&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_UNITE_NOMUNITE.length; ind01++)
     temp += "<OPTION value='" + LIST_UNITE_IDUNITE[ind01] + "'>" + LIST_UNITE_NOMUNITE[ind01] + "&nbsp;&nbsp;";

  temp += "</SELECT></td>";
  temp += "</tr></table>"

  document.getElementById("tabcentrec").innerHTML = temp;
}


function RAZ_tout()
{
  document.getElementById("tabgauchec").innerHTML = "";
  document.getElementById("tabcentrec").innerHTML = "";
  document.getElementById("tabdroitec").innerHTML = "";
  document.getElementById("tabcentreb").innerHTML = "";
}
function RAZ_droitec()
{
  document.getElementById("tabdroitec").innerHTML = "";
}
function RAZ_centrec()
{
  document.getElementById("tabcentrec").innerHTML = "";
}


