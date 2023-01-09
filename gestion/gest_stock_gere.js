
function StockPro()
{
  var temp;
  var ind01;

  temp = "<table border='0' width='600' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Stocks gérés :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='150'><b>&nbsp;Pays</b></td>";
  temp += "<td width='250'><b>&nbsp;Entreprise Province</b></td>";
  temp += "<td width='100'><CENTER><b>Quantité</b></CENTER></td>";
  temp += "</tr>";

  for (ind01 = 0; ind01 < STOCK_GERE_NOMENTREPRISE.length; ind01++)
  {
      if (STOCK_GERE_QUANTITE[ind01] > 0)
      {
        temp += "<tr>";
        temp += "<td>" + STOCK_GERE_NOMPAYS[ind01] + "</td>";
        temp += "<td><b><a href='#' onclick='DetailEntreprise(" + STOCK_GERE_IDENTREPRISE[ind01] + ");'>" + STOCK_GERE_NOMENTREPRISE[ind01] + "</a></b></td>";
        temp += "<td align=right>" + STOCK_GERE_QUANTITE[ind01] + "&nbsp;";
        temp += STOCK_GERE_NOMUNITE[ind01] + "</td>";
        temp += "</tr>";
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

function RAZ_tout()
{
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



