

function AffichePossessionPersonnel()
{
  RAZ_tout();
  selectPossTypeProduit();
  PossessionPersonnel();
}

function PossessionPersonnel()
{
  var temp;
  var ind01;
  var type = document.getElementById("type1").value;

  temp = "<table border='0' width='500' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Vos possessions :</td></tr>";

  temp += "<tr class='Titre3' height='40'>";
  temp += "<td width='100'><b>&nbsp;Action</b></td>";
  temp += "<td width='150'><b>&nbsp;Produit</b></td>";
  temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
  temp += "<td width='50'><CENTER><b>Valeur</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < POSSP_NOMPRODUIT.length; ind01++)
  {
    if ((type == POSSP_TYPE[ind01]) || (type == '0') || (type == POSSP_TYPEEQUI[ind01]))
    {
      temp += "<tr>";

      if ((POSSP_ETAT[ind01] == '0') && (POSSP_TYPEEQUI[ind01] != '20000'))
            temp += "<td><b><a href='#' onclick='Vendre(" + ind01 + ");'>Mettre aux PA</a></b></td>";
      else if ((POSSP_ETAT[ind01] == '0') && (POSSP_TYPEEQUI[ind01] == '20000'))
      {
            temp += "<td><b><a href='#' onclick='Vendre(" + ind01 + ");'>Mettre aux PA</a></b>";
            temp += "<br><b><a href='#' onclick='Louer(" + ind01 + ");'>Mettre Location</a></b></td>";
      }
      else if (POSSP_ETAT[ind01] == '1')
            temp += "<td><b><a href='#' onclick='RetirerVendre(" + ind01 + ");'>Retirer des PA</a></b></td>";
      else if (POSSP_ETAT[ind01] == '2')
            temp += "<td><b><a href='#' onclick='RetirerLouer(" + ind01 + ");'>Retirer Location</a></b></td>";
      else if ((POSSP_ETAT[ind01] == '3') && (POSSP_PRO[ind01] == 'a'))
            temp += "<td><b>En Location</b></td>";
      else if ((POSSP_ETAT[ind01] == '3') && (POSSP_PRO[ind01] == 'b'))
            temp += "<td><b><a href='#' onclick='StopperLouer(" + ind01 + ");'>Stopper Location <br>(n'oubliez pas la transaction)</a></b></td>";

      temp += "<td><b>" + POSSP_NOMPRODUIT[ind01] + "</b></td>";
      temp += "<td><CENTER><img src='" + POSSP_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
      temp += "<td align=right>" + POSSP_NBUNITE[ind01] + "&nbsp;" + POSSP_NOMUNITE[ind01] + "</td></tr>";
    }
  }

  temp += "</table>";
  document.getElementById("tabcentreb").innerHTML = temp;

  temp = "<table border='0' width='450' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Détail :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='350'><CENTER><b>Description</b></CENTER></td>";
  temp += "<td width='100'><CENTER><b>Date achat</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < POSSP_NOMPRODUIT.length; ind01++)
  {
    if ((type == POSSP_TYPE[ind01]) || (type == '0') || (type == POSSP_TYPEEQUI[ind01]))
    {
      temp += "<tr>";
      temp += "<td valign=center height='100'><FONT size=2>" + POSSP_DESCRIPTION[ind01] + "</FONT></td>";
      temp += "<td><CENTER>" + POSSP_DATEH[ind01] + "</CENTER></td></tr>";
    }
  }

  temp += "</table>";
  document.getElementById("tabdroiteb").innerHTML = temp;
}

function selectPossTypeProduit()
{
  temp = "<table><tr>";
  temp += "<td class='texte1'>&nbsp;&nbsp;Type de produit : &nbsp;<SELECT name='type1' id='type1' onchange='PossessionPersonnel()'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++)
    if (LIST_TYPEPROD_TYPEPROD[ind01] != '00000')
       temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;";

  temp += "</SELECT></td>";

  temp += "</tr></table>"

  document.getElementById("tabdroitec").innerHTML = temp;
}

function Vendre(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSP_IDPOSS[poss];
  document.getElementById("etat").value = '1';

  majvendreposs();
}

function Louer(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSP_IDPOSS[poss];
  document.getElementById("etat").value = '2';

  majvendreposs();
}

function RetirerVendre(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSP_IDPOSS[poss];
  document.getElementById("etat").value = '0';

  majvendreposs();
}

function RetirerLouer(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSP_IDPOSS[poss];
  document.getElementById("etat").value = '0';

  majvendreposs();

}

function StopperLouer(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSP_IDPOSS[poss];
  document.getElementById("etat").value = '2';

  majvendreposs();

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



