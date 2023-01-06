
function AfficheEntreprise()
{
   RAZ_tout();
   Action();
   Entreprise();
}

function Action()
{
  temp = "<table border='0' width='500'><tr>";
  temp += "<td class='Texte1'>&nbsp;&nbsp;<b>&nbsp;&nbsp; Actions :&nbsp;</b>";
  temp += "<a href='#' OnClick='RAZ_droitec();'>&nbsp;Rapport d'activité&nbsp;</a>";
  temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='produire.php?entreprise=" + entre + "'>&nbsp;Production&nbsp;</a>";
  temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='consommer.php?entreprise=" + entre + "'>&nbsp;Consommation&nbsp;</a>";
  temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='#' OnClick='RAZ_droitec(); Modifier();'>&nbsp;Modifier données&nbsp;</a>";
  temp += "</td></tr></table>";
  document.getElementById("tabgaucheh").innerHTML = temp;
}


function Modifier()
{
  var a = 0;
  var temp;
  var tmp;

  temp = "<table border='0' width='200'><tr>";
  temp += "<td class='Texte1'>";
  temp += "<a href='#' OnClick='AfficheEntreprise();'>&nbsp;Retour à la liste&nbsp;</a>";
  temp += "</td></tr></table>";
  document.getElementById("tabcentreh").innerHTML = temp;

  temp = "<FORM name='modifentre1' method='post' action=''>";

  temp += "<table border='0' width='600'><tr><td colspan='3' class='Titre5' height='40'>&nbsp;Modifier l'entreprise :</td></tr>";

 if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS)) || (IDUSER == DET_ENTRE_IDUSER))
 {
  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom du pays :&nbsp;</td>";
  temp += "<td colspan='2' class='texte4'>" + NOMPAYS + "</td></tr>";

  temp += "<tr></tr>";
  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom de l'entreprise :&nbsp;</td>";
  temp += "<td colspan='2'><INPUT type='text' name='nomA' id='nomA' size='40'></td></tr>";

  temp += "<tr></tr>";
  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Site de l'entreprise :&nbsp;</td>";
  temp += "<td colspan='2'><INPUT type='text' name='siteA' id='siteA' size='40'></td></tr>";

  temp += "<tr></tr>";
  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Logo de l'entreprise :&nbsp;</td>";
  temp += "<td colspan='2'><INPUT type='text' name='logoA' id='logoA' size='40'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Type d'entreprise :&nbsp;</td>";

 if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_ENTRE_IDPAYS)))
 {
	temp += "<td class='texte1'><SELECT name='typeA' id='typeA'>";
	for (ind01 = 0; ind01 < LIST_TYPEENTRE_TYPEENTRE.length; ind01++)
	{
	if (LIST_TYPEENTRE_TYPEENTRE[ind01] == DET_ENTRE_TYPE)
	temp += "<OPTION selected=TRUE value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "&nbsp;&nbsp;";
	else
	temp += "<OPTION value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "&nbsp;&nbsp;";
	}
	temp += "</SELECT></td>";
	temp += "</tr>";
 }
 else
 {
	for (ind01 = 0; ind01 < LIST_TYPEENTRE_TYPEENTRE.length; ind01++)
	{
	   if (LIST_TYPEENTRE_TYPEENTRE[ind01] == DET_ENTRE_TYPE)
	   {	
		temp += "<td colspan='2'>" + LIST_TYPEENTRE_LIBELLE[ind01] + "</td>";
		break;
	   }
	}
	temp += "</tr>";

	temp += "<tr><td width='150' class='texte1'></td>";
	temp += "<td colspan='2' class='texte4'><INPUT type='hidden' name='typeA' id='typeA' size='4' value='" + LIST_TYPEENTRE_TYPEENTRE[ind01] + "'></td></tr>";
 }

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Dirigeant :&nbsp;</td>";
  temp += "<td class='texte1'><SELECT name='iduserA' id='iduserA'>";
  temp += "<OPTION value='0'>Sans Directeur&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_CIT_IDUSER.length; ind01++)
  {
     if (LIST_CIT_IDPAYS[ind01] == IDPAYS)
     {
        if (DET_ENTRE_IDUSER == LIST_CIT_IDUSER[ind01])
           temp += "<OPTION selected=TRUE value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
        else
           temp += "<OPTION value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
     }
  }
  temp += "</SELECT></td>";
  temp += "</tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Capacité mensuelle :&nbsp;</td>";
  temp += "<td colspan='2'><INPUT type='text' name='capaA' id='capaA' size='4' align=right></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Résidence : &nbsp;</td><td colspan='2'><SELECT name='residence1' id='residence1'>";
  tmp = "<OPTION value=''>Aucune&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < RES_ENTRE_IDPOSSESSION.length; ind01++)
  {
    if (RES_ENTRE_OCCUPE[ind01] == '1')
      tmp += "<OPTION selected='true' value='" + RES_ENTRE_IDPOSSESSION[ind01] + "'>" + RES_ENTRE_ADRESSE[ind01] + "&nbsp;(" + RES_ENTRE_LIBPROVINCE[ind01] + ")&nbsp;";
    else
      tmp += "<OPTION value='" + RES_ENTRE_IDPOSSESSION[ind01] + "'>" + RES_ENTRE_ADRESSE[ind01] + "&nbsp;(" + RES_ENTRE_LIBPROVINCE[ind01] + ")&nbsp;";
  }
  temp += tmp;
  temp += "</SELECT></td></tr>";

  temp += "<tr>";
  temp += "</tr>";



  temp += "<tr><td width='150' class='texte1'></td>";
  temp += "<td colspan='2'><INPUT type='hidden' name='identreA' id='identreA' size='4'></td></tr>";

  temp += "<tr>";
  temp += "</tr>";

  temp += "<tr><td width='150'><INPUT type=button name=valmodif value='Modifier' onclick='modifentre();'></td>";
  temp += "<td class='texte2'>(La modification du type et de la capacité doivent être discutées avec le responsable avant toute modification.)</td>";
  temp += "</tr>";

  temp += "</table>";
  temp += "</FORM>";

  document.getElementById("tabdroitec").innerHTML = temp;

  document.getElementById("identreA").value = DET_ENTRE_IDENTRE;
  document.getElementById("nomA").value = DET_ENTRE_NOMENTRE;
  document.getElementById("logoA").value = DET_ENTRE_LOGO;
  document.getElementById("siteA").value = DET_ENTRE_SITE;
  document.getElementById("capaA").value = DET_ENTRE_CAPACITE;

 }
 else
 {
  temp += "<tr><td width='150'></td>";
  temp += "<td class='Texte2'>Aucun droit</td>";
  temp += "<td width='100'></td>";
  temp += "</tr>";

  temp += "</table>";
  temp += "</FORM>";

  document.getElementById("tabdroitec").innerHTML = temp;
 }

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


