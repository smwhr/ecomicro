
function AfficheLoc()
{
   RAZ_tout();
   SelectEntreprisePaysType();
   Loc();
}

function Loc()
{

  var temp;
  var ind01;

  var pays = document.getElementById("pays1").value;
  var type = document.getElementById("typeproduit1").value;

  temp = "<table border='0' width='680' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Produits en vente :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='100'><b>&nbsp;Pays</b></td>";
  temp += "<td width='130'><b>&nbsp;Propriétaire</b></td>";
  temp += "<td width='150'><b>&nbsp;Produit</b></td>";
  temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
  temp += "<td width='50'><CENTER><b>Valeur</b></CENTER></td>";
  temp += "</tr>";

  for (ind01 = 0; ind01 < ACHAT_LOC_IDPRODUIT.length; ind01++)
  {
    if (((pays == ACHAT_LOC_IDPAYS[ind01]) || (pays == '0')) && ((type == ACHAT_LOC_TYPEPRODUIT[ind01]) || (type == ACHAT_LOC_TYPEPRODUITEQUI[ind01]) || (type == '0')))
    {
      temp += "<tr>";
      temp += "<td>" + ACHAT_LOC_NOMPAYS[ind01] + "</td>";
      temp += "<td><a href='#' onclick='DetailCitoyen(" + ACHAT_LOC_IDPOSS[ind01] + ");'>" + ACHAT_LOC_NOM[ind01] + "</a></td>";
      temp += "<td><b><a href='#' onclick='AchatLoc(" + ind01 + ");'>" + ACHAT_LOC_NOMPRODUIT[ind01] + "</a></b></td>";
      temp += "<td><CENTER><img src='" + ACHAT_LOC_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
      temp += "<td align=right>" + ACHAT_LOC_NBUNITE[ind01] + "&nbsp;" + ACHAT_LOC_NOMUNITE[ind01] + "</td>";
      temp += "</tr>";
    }
  }

  temp += "</table>";
  document.getElementById("tabcentreb").innerHTML = temp;

  temp = "<table border='0' width='300' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Détail :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='300'><CENTER><b>Description</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < ACHAT_LOC_IDPRODUIT.length; ind01++)
  {
    if (((pays == ACHAT_LOC_IDPAYS[ind01]) || (pays == '0')) && ((type == ACHAT_LOC_TYPEPRODUIT[ind01]) || (type == ACHAT_LOC_TYPEPRODUITEQUI[ind01]) || (type == '0')))
    {
      temp += "<tr>";
      temp += "<td valign=center height=100><FONT size=2>" + ACHAT_LOC_DESCRIPTION[ind01] + "</FONT></td></tr>";
    }
  }
  temp += "</table>";

  document.getElementById("tabdroiteb").innerHTML = temp;
}

function DetailCitoyen(entre)
{
  $tmp = "detail_1_citoyen.php?citoyen=" + entre;
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

  temp += "<td class='texte1'>&nbsp;&nbsp;Type Produit :&nbsp;</td>";
  temp += "<td class='texte1'>";
  temp += "<SELECT name='typeproduit1' id='typeproduit1' onchange='Produit();'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++)
     temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
  temp += "</SELECT></td>";

  temp += "</tr>";
  temp += "</table>";

  document.getElementById("tabcentrec").innerHTML = temp;
}


function AchatLoc(entre)
{
  RAZ_tout();

  temp = "<table border='0' width='1000'><tr>";
  temp += "<td class='Texte1'>";
  temp += "<CENTER><a href='#' onclick='AfficheLoc();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
  temp += "</tr></table>";

  document.getElementById("tabcentrec").innerHTML = temp;

  temp = "<td width='200''>";
  temp += "<br><br><CENTER><img src='obj/achat1.jpg' width=200 height=135 alt='achat_1'></CENTER>";
  temp += "</td>";
  document.getElementById("tabgaucheb").innerHTML = temp;

  temp = "<td width='200''>";
  temp += "<br><br><CENTER><img src='" + ACHAT_LOC_IMAGE[entre] + "' width=200 height=100 align=top alt=''></CENTER>";
  temp += "</td>";
  document.getElementById("tabdroiteb").innerHTML = temp;


  temp = "<FORM name='achatlocation' method='post' action=''>";

  temp += "<table border='0' width='600'><tr><td colspan='3' class='Titre5' height='40'>&nbsp;Louer un bien immobilier :</td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Location de :&nbsp;</td>";
  temp += "<td colspan='2'><b>" + ACHAT_LOC_NOMPRODUIT[entre] + "&nbsp;à&nbsp;" + ACHAT_LOC_NOM[entre] + "&nbsp;(" + ACHAT_LOC_NOMPAYS[entre] + ")</b></td></tr>";

  temp += "<tr></tr>";

  temp += "<tr>";
  temp += "<td class='texte1' width='150'>&nbsp;&nbsp;Compte acheteur : &nbsp;</td><td><SELECT name='idcpte1' id='idcpte1' onchange='ChangeCpte();'>";
  for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++)
  {
     if (CPTEP_TYPE[ind01] != 'P')
       temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>" + CPTEP_NCPTE[ind01] + "-" + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + CPTEP_SOLDE[ind01] + "&nbsp;" + CPTEP_DEVISE[ind01] + ")&nbsp;&nbsp;";
  }
  temp += "</SELECT></td></tr>";

  temp += "<tr>";
  temp += "<td class='texte1' width='150'>&nbsp;&nbsp;Compte bailleur : &nbsp;</td><td><SELECT name='idcpte2' id='idcpte2' onchange='ChangeCpte();'>";
  for (ind01 = 0; ind01 < ACHAT_CPTE_NCPTE.length; ind01++)
  {
     if ((ACHAT_LOC_IDPOSS[entre] == ACHAT_CPTE_IDTITULAIRE[ind01]))

        temp += "<OPTION value='" + ACHAT_CPTE_NCPTE[ind01] + "'>" + ACHAT_CPTE_NCPTE[ind01] + "-" + ACHAT_CPTE_NOMCPTE[ind01] + "&nbsp;(" + ACHAT_CPTE_DEVISE[ind01] + ")&nbsp;&nbsp;";
  }
  temp += "</SELECT></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Au tarif HT mensuel de :&nbsp;</td>";
  temp += "<td colspan='2' class='texte2'>";
  temp += "<INPUT type='text' name='tarif' id='tarif' size='4' align=right>";
  temp += "&nbsp;<INPUT type='text' name='deviseA1' id='deviseA1' size='2' align=right>";
  temp += "&nbsp;&nbsp;soit pour le vendeur : ";
  temp += "<INPUT type='text' name='tarifB' id='tarifB' size='4' align=right>";
  temp += "&nbsp;<INPUT type='text' name='deviseB' id='deviseB' size='2' align=right>";
  temp += "</td>";
  temp += "</tr>";

  temp += "<tr><td width='150'><INPUT type=button name=valcalcul value='Calculer' onclick='Calcul();'></td>";
  temp += "<td class='texte2'>&nbsp;&nbsp;Taxe :&nbsp;&nbsp;<INPUT type='text' name='taxe' id='taxe' size='3' align=right> %</td></tr>";
  temp += "<tr><td width='150' class='texte2'>&nbsp;&nbsp;Tarif TTC :&nbsp;</td>";
  temp += "<td><INPUT type='text' name='rescalcul1' id='rescalcul1' size='4' align=right>";
  temp += "&nbsp;<INPUT type='text' name='deviseA' id='deviseA' size='2' align=right></td></tr>";

  temp += "<tr>";
  temp += "<td><INPUT type='hidden' name='nomprod' id='nomprod' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='idprod' id='idprod' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='idunite' id='idunite' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='nbunite' id='nbunite' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='nomunite' id='nomunite' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='soldeA' id='soldeA' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='idpaysA' id='idpaysA' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='entreA' id='entreA' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='idpaysB' id='idpaysB' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='entreB' id='entreB' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='prodtype' id='prodtype' size='4'></td>";
  temp += "<td><INPUT type='hidden' name='prodequi' id='prodequi' size='4'></td>";
  temp += "</tr>";

  temp += "<tr><td width='150'></td>";
  temp += "<td class='texte2'><INPUT type=button name=valachatpa value='Proposer' onclick='vallocation("+ entre + ");'></td></tr>";

  temp += "</table>";

  temp += "</FORM>";

  document.getElementById("tabcentreb").innerHTML = temp;

  document.getElementById("idpaysA").value = ACHAT_CPTE_DEVISE[ind01];
  document.getElementById("idpaysB").value = ACHAT_LOC_IDPAYS[entre];
  document.getElementById("entreB").value = ACHAT_LOC_IDPOSS[entre];
  document.getElementById("idunite").value = ACHAT_LOC_IDUNITE[entre];
  document.getElementById("nomunite").value = ACHAT_LOC_NOMUNITE[entre];
  document.getElementById("nbunite").value = ACHAT_LOC_NBUNITE[entre];
  document.getElementById("idprod").value = ACHAT_LOC_IDPOSSESSION[entre];
  document.getElementById("nomprod").value = ACHAT_LOC_NOMPRODUIT[entre];
  document.getElementById("prodequi").value = ACHAT_LOC_TYPEPRODUITEQUI[entre];
  document.getElementById("prodtype").value = ACHAT_LOC_TYPEPRODUIT[entre];
  ChangeCpte();
}

function ChangeCpte()
{
  for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++)
  {
    if (CPTEP_NCPTE[ind01] == document.getElementById("idcpte1").value)
    {
      document.getElementById("deviseA").value = CPTEP_DEVISE[ind01];
      document.getElementById("deviseA1").value = CPTEP_DEVISE[ind01];
      document.getElementById("soldeA").value = CPTEP_SOLDE[ind01];
      document.getElementById("idpaysA").value = CPTEP_IDPAYS[ind01];
      document.getElementById("entreA").value = CPTEP_IDTITULAIRE[ind01];
    }
  }

  for (ind01 = 0; ind01 < ACHAT_CPTE_NCPTE.length; ind01++)
  {
    if (ACHAT_CPTE_NCPTE[ind01] == document.getElementById("idcpte2").value)
    {
      document.getElementById("deviseB").value = ACHAT_CPTE_DEVISE[ind01];
      break;
    }
  }

  if (!isNaN(parseFloat(document.getElementById("tarif").value)))
  {
    for (ind01 = 0; ind01 < TX_DEVISE1.length; ind01++)
    {
      if ((TX_DEVISE1[ind01] == document.getElementById("deviseB").value) && (TX_DEVISE2[ind01] == document.getElementById("deviseA").value))
      {
        document.getElementById("tarifB").value = document.getElementById("tarif").value * TX_TAUX[ind01];
        break;
      }
    }
  }
  else
  {
    document.getElementById("tarif").value = '0';
    document.getElementById("tarifB").value = '0';
  }

  var ind0 = 0;
  var ind1 = 0;
  var taxe = 0;
  var taxe0 = 0;
  var taxe1 = 0;
  document.getElementById("taxe").value = '0';
  for (ind01 = 0; ind01 < TAXE_IMPORT_IDPAYS1.length; ind01++)
  {
    if ((TAXE_IMPORT_IDPAYS1[ind01] == document.getElementById("idpaysA").value) && (TAXE_IMPORT_IDPAYS2[ind01] == document.getElementById("idpaysA").value))
    {
      if ((TAXE_IMPORT_TYPE[ind01] == '00000') && (ind0 == 0))
      {
        ind0 = 1;
        taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
      }
      if ((TAXE_IMPORT_TYPE[ind01] == document.getElementById("prodequi").value) && (ind0 < 4))
      {
        ind0 = 3;
        taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
      }
      if (TAXE_IMPORT_TYPE[ind01] == document.getElementById("prodtype").value)
      {
        ind0 = 4;
        taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
      }
    }

    if (document.getElementById("idpaysA").value != document.getElementById("idpaysB").value)
    {
      if ((TAXE_IMPORT_IDPAYS1[ind01] == document.getElementById("idpaysA").value) && (TAXE_IMPORT_IDPAYS2[ind01] == document.getElementById("idpaysB").value))
      {
        if ((TAXE_IMPORT_TYPE[ind01] == '00000') && (ind1 == 0))
        {
          ind1 = 1;
          taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
        }
        if ((TAXE_IMPORT_TYPE[ind01] == document.getElementById("prodequi").value) && (ind1 < 4))
        {
          ind1 = 3;
          taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
        }
        if (TAXE_IMPORT_TYPE[ind01] == document.getElementById("prodtype").value)
        {
          ind1 = 4;
          taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
        }
      }
    }
  }

  taxe = taxe0 + taxe1;
  document.getElementById("taxe").value = taxe.toFixed(0);
}

function Calcul()
{
  ChangeCpte();
  document.getElementById("rescalcul1").value = "";

  if ((isNaN(parseFloat(document.getElementById("taxe").value))) || (parseFloat(document.getElementById("taxe").value) < 0))
     document.getElementById("taxe").value = 0;
  taxe = 1 + parseFloat(document.getElementById("taxe").value) / 100 ;

  if ((isNaN(parseInt(document.getElementById('tarif').value))))
  {
    alert("Avec le montant cela ira mieux.");
    return;
  }
  else
  {
    if ((parseInt(document.getElementById('tarif').value) < 0))
    {
      alert("Le montant doit être positif.");
      return;
    }
    else
    {
        document.getElementById("rescalcul1").value = parseInt(document.getElementById('tarif').value) * taxe;
    }
  }
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


