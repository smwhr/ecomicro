
function AfficheEntreprise()
{
   RAZ_tout();
   SelectType();
   Entreprise();
}
function SelectType()
{
  temp = "<table><tr>";
  temp += "<td width='200'></td>";
 
  temp += "<td class='texte1'>&nbsp;&nbsp;Type Entreprise : &nbsp;<SELECT name='type1' id='type1' onchange='Entreprise();'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_TYPEENTRE_TYPEENTRE.length; ind01++)
     temp += "<OPTION value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "&nbsp;&nbsp;";
  temp += "</SELECT></td>";

  temp += "</tr></table>";

  document.getElementById("tabcentrec").innerHTML = temp;
}

function Entreprise()
{

  var temp;
  var ind01;

  var type = document.getElementById("type1").value;
 
  temp = "<table border='0' width='450' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Entreprises - Organismes - Provinces :</td></tr>";

  temp += "<tr class='Titre3' height='40'>";
  temp += "<td width='150'><b>&nbsp;Nom</b></td>";
  temp += "<td width='150'><b>&nbsp;Directeur</b></td>";
  temp += "<td width='150'><b>&nbsp;Type</b></td></tr>";

  for (ind01 = 0; ind01 < DET_ENTRE_IDENTRE.length; ind01++)
  {
    if ((type == DET_ENTRE_TYPE[ind01]) || (type == DET_ENTRE_TYPEEQUI[ind01]) || (type == '0'))
    {
      temp += "<tr>";
      temp += "<td><b><a href='#' onclick='DetailEntreprise(" + DET_ENTRE_IDENTRE[ind01] + ");'>" + DET_ENTRE_NOMENTRE[ind01] + "</a></b></td>";
      temp += "<td><a href='#' onclick='DetailCitoyen(" + DET_ENTRE_IDUSER[ind01] + ");'>" + DET_ENTRE_NOMUSER[ind01] + "</a></td>";
      temp += "<td>" + DET_ENTRE_NOMTYPE[ind01] + "</td></tr>";
    }
  }

  temp += "</table>";
  document.getElementById("tabcentreb").innerHTML = temp;
}

function DetailCitoyen(i)
{
  $tmp = "detail_1_citoyen.php?citoyen=" + i;
  document.location.replace($tmp);
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


