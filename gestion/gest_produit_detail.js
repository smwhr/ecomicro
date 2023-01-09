
function AfficheProduit()
{
   RAZ_tout();
   SelectEntreprisePaysType();
   Produit();
}

function Produit()
{

  var temp;
  var ind01;

  var entre = document.getElementById("entre1").value;
  var pays = document.getElementById("pays1").value;
  var type = document.getElementById("typeproduit1").value;

  temp = "<table border='0' width='680' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Produits en vente :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='100'><b>&nbsp;Pays</b></td>";
  temp += "<td width='130'><b>&nbsp;Entreprise</b></td>";
  temp += "<td width='150'><b>&nbsp;Produit</b></td>";
  temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
  temp += "<td width='50'><CENTER><b>Valeur</b></CENTER></td>";
  temp += "<td width='50'><CENTER><b>Util.</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < DET_PROD_IDPRODUIT.length; ind01++)
  {
    if (((entre == DET_PROD_IDENTRE[ind01]) || (entre == '0')) && ((pays == DET_PROD_IDPAYS[ind01]) || (pays == '0')) && ((type == DET_PROD_TYPEPRODUIT[ind01]) || (type == DET_PROD_TYPEPRODUITEQUI[ind01]) || (type == '0')))
    {
      temp += "<tr>";
      temp += "<td>" + DET_PROD_NOMPAYS[ind01] + "</td>";
      temp += "<td><a href='#' onclick='DetailEntreprise(" + DET_PROD_IDENTRE[ind01] + ");'>" + DET_PROD_NOMENTRE[ind01] + "</a></td>";
      temp += "<td><b>" + DET_PROD_NOMPRODUIT[ind01] + "</b></td>";
      temp += "<td><CENTER><img src='" + DET_PROD_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
      temp += "<td align=right>" + DET_PROD_NBUNITE[ind01] + "&nbsp;" + DET_PROD_NOMUNITE[ind01] + "</td>";
      temp += "<td><CENTER>" + DET_PROD_NBUSE[ind01] + "</CENTER></td></tr>";
    }
  }

  temp += "</table>";
  document.getElementById("tabcentreb").innerHTML = temp;

  temp = "<table border='0' width='300' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Détail :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='300'><CENTER><b>Description</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < DET_PROD_IDPRODUIT.length; ind01++)
  {
    if (((entre == DET_PROD_IDENTRE[ind01]) || (entre == '0')) && ((pays == DET_PROD_IDPAYS[ind01]) || (pays == '0')) && ((type == DET_PROD_TYPEPRODUIT[ind01]) || (type == DET_PROD_TYPEPRODUITEQUI[ind01]) || (type == '0')))
    {
      temp += "<tr>";
      temp += "<td valign=center height=100><FONT size=2>" + DET_PROD_DESCRIPTION[ind01] + "</FONT></td></tr>";
    }
  }
  temp += "</table>";

  document.getElementById("tabdroiteb").innerHTML = temp;
}

function DetailEntreprise(entre)
{
  $tmp = "detail_1_entreprise.php?entreprise=" + entre;
  document.location.replace($tmp);
}

function SelectEntreprisePaysType()
{
  temp = "<table border='0' width='100%' class='Corps'>";
  temp += "<tr>";
  temp += "<td class='texte1'>&nbsp;&nbsp;Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Produit()'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
     temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";

  temp += "</SELECT></td>";

  temp += "<td class='texte1'>&nbsp;&nbsp;Entreprise : &nbsp;</td><td class='texte1'><SELECT name='entre1' id='entre1' onchange='Produit();'>";
  temp += "<OPTION value='0'>Toutes&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < DET_ENTRE_IDENTRE.length; ind01++)
    temp += "<OPTION value='" + DET_ENTRE_IDENTRE[ind01] + "'>" + DET_ENTRE_NOMENTRE[ind01] + "&nbsp;&nbsp;";
  temp += "</SELECT></td>";

  temp += "<td class='texte1'>&nbsp;&nbsp;Type Produit :&nbsp;</td>";
  temp += "<td class='texte1'>";
  temp += "<SELECT name='typeproduit1' id='typeproduit1' onchange='Produit();'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++)
    if (LIST_TYPEPROD_TYPEPROD[ind01] != '00000')
     temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
  temp += "</SELECT></td>";

  temp += "</tr>";
  temp += "</table>";

  document.getElementById("tabcentrec").innerHTML = temp;
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


