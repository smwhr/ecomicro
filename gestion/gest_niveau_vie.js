
function AfficheNiveau()
{
   RAZ_tout();
   SelectPays();
   Affichage();
}
function SelectPays()
{
  temp = "<table><tr>";
  temp += "<td width='200'></td>";
  temp += "<td class='texte1'>&nbsp;&nbsp;Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Entreprise();'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
     temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
  temp += "</SELECT></td>";

  temp += "</tr></table>";

  document.getElementById("tabcentrec").innerHTML = temp;
}

function Affichage()
{
	if(document.getElementById("pays1").value == 0)
		AffGlobal();
	else
		AffPays(document.getElementById("pays1").value);
}

function AffGlobal()
{

  temp = "<table border='0' width='600'><tr><td colspan='8'></td></tr>";

  temp += "<tr><td width='250'>";
	  temp += "<table border='0' width='300' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Masses monétaires :</td></tr>";
	
	  temp += "<tr class='Titre3' height='40'><td width='200'><b>&nbsp;Pays</b></td>";
	  temp += "<td width='100'><b>&nbsp;Solde</b></td>";
	  temp += "</tr>";
	
	  for (ind01 = 0; ind01 < NV_GL_FI_PY_NOMPAYS.length; ind01++)
	  {
	      temp += "<tr>";
	      temp += "<td>" + NV_GL_FI_PY_NOMPAYS[ind01] + "</td>";
	      temp += "<td align=right>" + NV_GL_FI_PY_SOLDE[ind01] + "&nbsp;" + NV_GL_FI_PY_DEVISE[ind01] + "</td>";
	      temp += "</tr>";
	  }
	
	  temp += "</table>";

  temp += "</td><td width='300'>";

	  temp += "<table border='0' width='300' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Valeur titres en devise :</td></tr>";
	
	  temp += "<tr class='Titre3' height='40'><td width='200'><b>&nbsp;Pays</b></td>";
	  temp += "<td width='100'><b>&nbsp;Solde</b></td>";
	  temp += "</tr>";
	
	  for (ind01 = 0; ind01 < NV_GL_FI_TI_NOMPAYS.length; ind01++)
	  {
	      temp += "<tr>";
	      temp += "<td>" + NV_GL_FI_TI_NOMPAYS[ind01] + "</td>";
	      temp += "<td align=right>" + NV_GL_FI_TI_SOLDE[ind01] + "&nbsp;" + NV_GL_FI_TI_DEVISE[ind01] + "</td>";
	      temp += "</tr>";
	  }
	
	  temp += "</table>";

  temp += "</td></tr>";

  temp += "<tr><td>";
	  temp += "<table border='0' width='200' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Solde des provinces :</td></tr>";
	
	  temp += "<tr class='Titre3' height='40'><td width='200'><b>&nbsp;Pays</b></td>";
	  temp += "</tr>";
	
	  for (ind01 = 0; ind01 < NV_GL_FI_PR_NOM.length; ind01++)
	  {
	      temp += "<tr>";
	      temp += "<td>" + NV_GL_FI_PR_NOM[ind01] + "&nbsp;(" + NV_GL_FI_PR_DEVISE[ind01] + ")</td>";
	      temp += "</tr>";
	  }
	
	  temp += "</table>";

  temp += "</td><td width='200'>";

	  temp += "<table border='0' width='200' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Solde des entreprises :</td></tr>";
	
	  temp += "<tr class='Titre3' height='40'><td width='200'><b>&nbsp;Pays</b></td>";
	  temp += "</tr>";
	
	  for (ind01 = 0; ind01 < NV_GL_FI_EN_NOM.length; ind01++)
	  {
	      temp += "<tr>";
	      temp += "<td>" + NV_GL_FI_EN_NOM[ind01] + "&nbsp;(" + NV_GL_FI_EN_DEVISE[ind01] + ")</td>";
	      temp += "</tr>";
	  }
	
	  temp += "</table>";

  temp += "</td><td width='200'>";

	  temp += "<table border='0' width='200' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Solde des entreprises :</td></tr>";
	
	  temp += "<tr class='Titre3' height='40'><td width='200'><b>&nbsp;Pays</b></td>";
	  temp += "</tr>";
	
	  for (ind01 = 0; ind01 < NV_GL_FI_CY_NOM.length; ind01++)
	  {
	      temp += "<tr>";
	      temp += "<td>" + NV_GL_FI_CY_NOM[ind01] + "&nbsp;(" + NV_GL_FI_CY_DEVISE[ind01] + ")</td>";
	      temp += "</tr>";
	  }
	
	  temp += "</table>";

  temp += "</td></tr>";

  temp += "</table>";

  document.getElementById("tabcentreb").innerHTML = temp;
}

function AffPays(p)
{
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


