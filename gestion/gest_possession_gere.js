
function AffichePossessionPro()
{
  RAZ_tout();
  selectPossProTypeProduit();
  PossessionPro();
}

function PossessionPro()
{
  var temp;
  var ind01;

  var entre = document.getElementById("entre1").value;
  var type = document.getElementById("type1").value;

  temp = "<table border='0' width='650' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Possessions de vos Entreprises ou Provinces:</td></tr>";

  temp += "<tr class='Titre3' height='40'>";
  temp += "<td width='100'><CENTER><b>Action</b></CENTER></td>";
  temp += "<td width='150'><CENTER><b>Entreprise Province</b></CENTER></td>";
  temp += "<td width='150'><b>&nbsp;Produit</b></td>";
  temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
  temp += "<td width='50'><CENTER><b>Valeur</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < POSSE_NOMPRODUIT.length; ind01++)
  {
    if (((entre == POSSE_IDENTRE[ind01]) || (entre == '0')) && ((type == POSSE_TYPE[ind01]) || (type == '0') || (type == POSSE_TYPEEQUI[ind01])))
    {
      temp += "<tr>";
      if ((POSSE_ETAT[ind01] == '0') && (POSSE_TYPEEQUI[ind01] != '20000'))
            temp += "<td><b><a href='#' onclick='Vendre(" + ind01 + ");'>Mettre aux PA</a></b></td>";
      else if ((POSSE_ETAT[ind01] == '0') && (POSSE_TYPEEQUI[ind01] == '20000'))
      {
            temp += "<td><b><a href='#' onclick='Vendre(" + ind01 + ");'>Mettre aux PA</a></b>";
            temp += "<br><b><a href='#' onclick='Louer(" + ind01 + ");'>Mettre Location</a></b></td>";
      }
      else if (POSSE_ETAT[ind01] == '1')
            temp += "<td><b><a href='#' onclick='RetirerVendre(" + ind01 + ");'>Retirer des PA</a></b></td>";
      else if (POSSE_ETAT[ind01] == '2')
            temp += "<td><b><a href='#' onclick='RetirerLouer(" + ind01 + ");'>Retirer Location</a></b></td>";
      else if ((POSSE_ETAT[ind01] == '3') && (POSSE_PRO[ind01] == 'a'))
            temp += "<td><b>En Location</b></td>";
      else if ((POSSE_ETAT[ind01] == '3') && (POSSE_PRO[ind01] == 'b'))
            temp += "<td><b><a href='#' onclick='StopperLouer(" + ind01 + ");'>Stopper Location <br>(n'oubliez pas la transaction)</a></b></td>";

      temp += "<td><b><a href='#' onclick='DetailEntreprise(" + POSSE_IDENTRE[ind01] + ");'>" + POSSE_NOMENTRE[ind01] + "</a></b></td>";
      temp += "<td><b>" + POSSE_NOMPRODUIT[ind01] + "</b></td>";
      temp += "<td><CENTER><img src='" + POSSE_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
      temp += "<td align=right>" + POSSE_NBUNITE[ind01] + "&nbsp;" + POSSE_NOMUNITE[ind01] + "</td></tr>";
    }
  }

  temp += "</table>";
  document.getElementById("tabcentreb").innerHTML = temp;

  temp = "<table border='0' width='300' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Détail :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='250'><CENTER><b>Description</b></CENTER></td>";
  temp += "<td width='50'><CENTER><b>Date achat</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < POSSE_NOMPRODUIT.length; ind01++)
  {
    if (((entre == POSSE_IDENTRE[ind01]) || (entre == '0')) && ((type == POSSE_TYPE[ind01]) || (type == '0') || (type == POSSE_TYPEEQUI[ind01])))
    {
      temp += "<tr>";
      temp += "<td valign=center height='100'><FONT size=2>" + POSSE_DESCRIPTION[ind01] + "</FONT></td>";
      temp += "<td><CENTER>" + POSSE_DATEH[ind01] + "</CENTER></td></tr>";
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

function Vendre(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "<INPUT type=button name=valvendreposs value='Modifier' onclick='majvendreposs();'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSE_IDPOSS[poss];
  document.getElementById("etat").value = '1';

  majvendreposs();
}

function Louer(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "<INPUT type=button name=valvendreposs value='Modifier' onclick='majvendreposs();'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSE_IDPOSS[poss];
  document.getElementById("etat").value = '2';

  majvendreposs();
}

function RetirerVendre(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "<INPUT type=button name=valvendreposs value='Modifier' onclick='majvendreposs();'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSE_IDPOSS[poss];
  document.getElementById("etat").value = '0';

  majvendreposs();
}

function RetirerLouer(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "<INPUT type=button name=valvendreposs value='Modifier' onclick='majvendreposs();'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSE_IDPOSS[poss];
  document.getElementById("etat").value = '0';

  majvendreposs();

}

function StopperLouer(poss)
{
  temp = "<FORM name='vendreposs' method='post' action=''>";

  temp += "<INPUT type='hidden' name='poss' id='poss'>";

  temp += "<INPUT type='hidden' name='etat' id='etat'>";

  temp += "<INPUT type=button name=valvendreposs value='Modifier' onclick='majvendreposs();'>";

  temp += "</FORM>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("poss").value = POSSE_IDPOSS[poss];
  document.getElementById("etat").value = '2';

  majvendreposs();
}

function selectPossProTypeProduit()
{
  temp = "<table><tr>";
  temp += "<td class='texte1'>&nbsp;&nbsp;Entreprise : &nbsp;</td><td><SELECT name='entre1' id='entre1' onchange='PossessionPro();'>";
  temp += "<OPTION value='0'>Toutes&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < ENTRE_USER_IDENTRE.length; ind01++)
    temp += "<OPTION value='" + ENTRE_USER_IDENTRE[ind01] + "'>" + ENTRE_USER_NOMENTRE[ind01] + "&nbsp;&nbsp;";
  temp += "</SELECT></td>";
  temp += "<td class='texte1'>&nbsp;&nbsp;Type de produit : &nbsp;<SELECT name='type1' id='type1' onchange='PossessionPro()'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++)
    if (LIST_TYPEPROD_TYPEPROD[ind01] != '00000')
     temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;";

  temp += "</SELECT></td>";

  temp += "</tr></table>"

  document.getElementById("tabdroitec").innerHTML = temp;
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
