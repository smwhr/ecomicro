
function AfficheCitoyen()
{
   RAZ_tout();
   SelectActif();
   Citoyens();
}
function Citoyens()
{
  var temp;
  var ind01;

   var inactif = document.getElementById("inactif1").value;

  temp = "<CENTER><table border='0' width='400' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Citoyens :</td></tr>";

  temp += "<tr class='Titre3' height='40'>";
  temp += "<td width='150'><b>&nbsp;Nom</b></td>";
  temp += "<td width='200'><b>&nbsp;Email</b></td>";
  temp += "<td width='50'><CENTER><b>Date d'arrivée</b></CENTER></td>";
  temp += "</tr>";

  for (ind01 = 0; ind01 < DET_CIT_NOMPAYS.length; ind01++)
  {
    if (inactif == DET_CIT_INACTIF[ind01])
    {
      temp += "<tr>";
      temp += "<td><b><a href='#' onclick='DetailCitoyen(" + ind01 + ")'>" + DET_CIT_NOM[ind01] + "</a></b></td>";
      temp += "<td>" + DET_CIT_EMAIL[ind01] + "</td>";
      temp += "<td><CENTER>" + DET_CIT_DCREATE[ind01] + "</CENTER></td>";
      temp += "</tr>";
    }
  }

  temp += "</table></CENTER>";
  document.getElementById("tabcentreb").innerHTML = temp;
}

function DetailCitoyen(i)
{
  $tmp = "detail_1_citoyen.php?citoyen=" + DET_CIT_IDUSER[i];
  document.location.replace($tmp);
}


function SelectActif()
{
  temp = "<table><tr>";
  temp += "<td width='200'></td>";

  temp += "<td class='texte1'>&nbsp;&nbsp;Activité : &nbsp;<SELECT name='inactif1' id='inactif1' onchange='Citoyens();'>";
  temp += "<OPTION value='0'>Actif&nbsp;&nbsp;";
  temp += "<OPTION value='1'>Inactif&nbsp;&nbsp;";
  temp += "</SELECT></td>";

  temp += "<td class='texte1'>&nbsp;&nbsp;";
  temp += "</td>";
  temp += "</tr></table>";

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


