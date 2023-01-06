
function AfficheCitoyen()
{
   RAZ_tout();
   Action();
   Citoyens();
}

function Action()
{
  temp = "<table border='0' width='800'><tr>";
  temp += "<td class='Texte1'>";
/*
  temp += "&nbsp;&nbsp;<b>&nbsp;&nbsp; Actions :&nbsp;</b>";
  temp += "<a href='#' OnClick='RAZ_droitec(); Exclure();'>&nbsp;Exclusion&nbsp;</a>";
  temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='#' Onclick='RAZ_droitec(); Actif();'>&nbsp;Activité&nbsp;</a>";
*/


  temp += "</td></tr></table>";
  document.getElementById("tabgaucheh").innerHTML = temp;

}


function Actif()
{
  var a = 0;

  temp = "<FORM name='modifactif1' method='post' action=''>";

  temp += "<table border='0' width='500'><tr><td colspan='3' class='Titre5' height='40'>&nbsp;Actif / Inactif :</td></tr>";

 if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_CIT_IDPAYS)))
 {
  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom du citoyen :&nbsp;</td>";
  temp += "<td colspan='2' class='texte4'>" + DET_CIT_NOM + "</td></tr>";

  temp += "<tr></tr>";
  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Etat :&nbsp;</td>";
  temp += "<td colspan='2' class='texte4'>"
  if (DET_CIT_INACTIF  == '0' )
   temp +=  "Actif";
  else
   temp +=  "Inactif";
  temp += "</td></tr>";

  temp += "<tr><td width='150' class='texte1'></td>";
  temp += "<td colspan='2'><INPUT type='hidden' name='iduserA' id='iduserA' size='4'></td></tr>";

  temp += "<tr>";
  temp += "</tr>";

  temp += "<tr><td width='150'><INPUT type=button name=valactif value='Modifier' onclick='modifactif();'></td>";
  temp += "<td class='texte2'></td>";
  temp += "</tr>";

  temp += "</table>";
  temp += "</FORM>";

  document.getElementById("tabcentrec").innerHTML = temp;

  document.getElementById("iduserA").value = DET_CIT_IDUSER;

 }
 else
 {
  temp += "<tr><td width='150'></td>";
  temp += "<td class='Texte2'>Aucun droit</td>";
  temp += "<td width='100'></td>";
  temp += "</tr>";

  temp += "</table>";
  temp += "</FORM>";

  document.getElementById("tabcentrec").innerHTML = temp;
 }

}

function Exclure()
{

}
function Citoyens()
{
  var temp;
  var tmp;
  var ind01;

    temp = "<table border='0' width='400'><tr><td colspan='3' class='Titre2' height='40'>&nbsp;Détail d'un citoyen :</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_CIT_NOM + "</td></tr>";

    temp += "<tr><td></td><td colspan='2'>";
    temp += "<img src='" + DET_CIT_PORTRAIT + "' width=100 height=80 alt=''>";
    temp += "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Pays :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_CIT_NOMPAYS;
    if (DET_CIT_EXCLU  == '1' )
    {
      temp += "&nbsp;&nbsp;&nbsp;";
      temp += "<FONT color=red>Exclu</FONT>";
    }
    temp += "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Pays d'accueil :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_CIT_NOMACCUEIL + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Email :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_CIT_EMAIL + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Date d'arrivée :&nbsp;</td>";
    temp += "<td colspan='2' class='texte4'>" + DET_CIT_DCREATE + "</td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Activité :&nbsp;</td>";
    if (DET_CIT_INACTIF  == '0' )
      temp += "<td width='150'>Actif</td>";
    else
      temp += "<td width='150'><FONT color=red>Inactif</FONT></td>";
    temp += "</tr>";


  temp += "<tr><td colspan='3'><FORM name='modifresidence1' method='post' action=''>";

  temp += "<table border='0' width='350'>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Résidence : &nbsp;<SELECT name='residence1' id='residence1' onchange='Produit();'>";
  tmp = "<OPTION value=''>Aucune&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < RES_CIT_IDPOSSESSION.length; ind01++)
  {
    if (RES_CIT_OCCUPE[ind01] == '1')
      tmp += "<OPTION selected='true' value='" + RES_CIT_IDPOSSESSION[ind01] + "'>" + RES_CIT_ADRESSE[ind01] + "&nbsp;(" + RES_CIT_LIBPROVINCE[ind01] + ")&nbsp;";
    else
      tmp += "<OPTION value='" + RES_CIT_IDPOSSESSION[ind01] + "'>" + RES_CIT_ADRESSE[ind01] + "&nbsp;(" + RES_CIT_LIBPROVINCE[ind01] + ")&nbsp;";
  }
  temp += tmp;
  temp += "</SELECT></td></tr>";

  temp += "<tr><td class='texte1'>";
  temp += "<INPUT type='hidden' name='iduserA' id='iduserA' size='4'></td></tr>";

  temp += "<tr>";
  temp += "</tr>";

  if ((AUTORISATION == '999') || ((AUTORISATION.substring(1,2) > '4') && (IDPAYS == DET_CIT_IDPAYS)) || (IDUSER == DET_CIT_IDUSER))
  {
    temp += "<tr><td width='150'><INPUT type=button name=valresidence value='Modifier' onclick='modifresidence();'></td>";
    temp += "</tr>";
  }
  temp += "</table>";
  temp += "</FORM></td></tr>";


    temp += "</table>";

    document.getElementById("tabgauchec").innerHTML = temp;

    document.getElementById("iduserA").value = IDUSER;



    temp = "<CENTER><table border='0' width='550' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Possessions :</td></tr>";

    temp += "<tr class='Titre3' height='40'><td width='150'><b>&nbsp;Produit</b></td>";
    temp += "<td width='100'><CENTER><b>Type</b></CENTER></td>";
    temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
    temp += "<td width='50'><CENTER><b>Valeur</b></CENTER></td>";
    temp += "<td width='80'><CENTER><b>Date d'achat</b></CENTER></td>";
    temp += "</tr>";

    for (ind01 = 0; ind01 < POSSP_IDPOSS.length; ind01++)
    {
        temp += "<tr>";
        temp += "<td><b>" + POSSP_NOMPRODUIT[ind01] + "</b></td>";
        temp += "<td><CENTER>" + POSSP_NOMTYPE[ind01] + "</CENTER></td>";
        temp += "<td><CENTER><img src='" + POSSP_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
        temp += "<td><CENTER>" + POSSP_NBUNITE[ind01] + "&nbsp;" + POSSP_NOMUNITE[ind01] + "</CENTER></td>";
        temp += "<td><CENTER>" + POSSP_DATEH[ind01] + "</CENTER></td>";
        temp += "</tr>";
    }

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


