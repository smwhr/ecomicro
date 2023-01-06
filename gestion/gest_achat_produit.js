
function AfficheProduit(){
    RAZ_tout();
    MenuTransac();
    SelectEntreprisePaysType();
    Produit();
}

function Produit(){
    var temp;
    var ind01;

    var entre = $("#entre1").val();
    var pays = $("#pays1").val();
    var type = $("#typeproduit1").val();

    temp = "<table border='0' width='100%'>";
  
    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < ACHAT_PROD_IDPRODUIT.length; ind01++){
      if (((entre == ACHAT_PROD_IDENTRE[ind01]) || (entre == '0')) && ((pays == ACHAT_PROD_IDPAYS[ind01]) || (pays == '0')) && ((type == ACHAT_PROD_TYPEPRODUIT[ind01]) || (type == ACHAT_PROD_TYPEPRODUITEQUI[ind01]) || (type == '0'))){
        a++;
        b = a%2;
        if (b == 0)
            temp += "<tr class='tr1 textPetit'>";
        else
            temp += "<tr class='tr2 textPetit'>";
        
        temp += "<td width='100'>" + ACHAT_PROD_NOMPAYS[ind01] + "</td>";
        temp += "<td width='130'><a href='#' onclick='DetailEntreprise(" + ACHAT_PROD_IDENTRE[ind01] + ");'>" + ACHAT_PROD_NOMENTRE[ind01] + "</a></td>";
        temp += "<td width='150'><b><a href='#' onclick='AchatProduit(" + ind01 + ");'>" + ACHAT_PROD_NOMPRODUIT[ind01] + "</a></b></td>";
        temp += "<td width='200'><CENTER><img src='" + ACHAT_PROD_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
        temp += "<td align=right width='100'>" + ACHAT_PROD_NBUNITE[ind01] + "&nbsp;" + ACHAT_PROD_NOMUNITE[ind01];
                temp += "<br>" + ACHAT_PROD_PRIX[ind01] + "&nbsp;" + DEVISEPAYS + "";
/*
	  if (ACHAT_PROD_NOMUNITE[ind01] == 'PP')
			{
				var tarif = ACHAT_PROD_NBUNITE[ind01] * 190;
	      temp += "<br>" + tarif + "&nbsp;" + DEVISEPAYS + "";
	    }
			if (ACHAT_PROD_NOMUNITE[ind01] == 'PA')
			{
				var tarif = ACHAT_PROD_NBUNITE[ind01] * 90;
	      temp += "<br>" + tarif + "&nbsp;" + DEVISEPAYS + "";
	    }
			if (ACHAT_PROD_NOMUNITE[ind01] == 'P V�hicule')
			{
				var tarif = ACHAT_PROD_NBUNITE[ind01] * 140;
	      temp += "<br>" + tarif + "&nbsp;" + DEVISEPAYS + "";
	    }
			if (ACHAT_PROD_NOMUNITE[ind01] == 'P Machine')
			{
				var tarif = ACHAT_PROD_NBUNITE[ind01] * 120;
	      temp += "<br>" + tarif + "&nbsp;" + DEVISEPAYS + "";
	    }
			if (ACHAT_PROD_NOMUNITE[ind01] == 'P Outil')
			{
				var tarif = ACHAT_PROD_NBUNITE[ind01] * 50;
	      temp += "<br>" + tarif + "&nbsp;" + DEVISEPAYS + "";
	    }
			if (ACHAT_PROD_NOMUNITE[ind01] == 'PE')
			{
				var tarif = ACHAT_PROD_NBUNITE[ind01] * 90;
	      temp += "<br>" + tarif + "&nbsp;" + DEVISEPAYS + "";
	    }
			if (ACHAT_PROD_NOMUNITE[ind01] == 'MP')
			{
				var tarif = ACHAT_PROD_NBUNITE[ind01] * 110;
	      temp += "<br>" + tarif + "&nbsp;" + DEVISEPAYS + "";
	    }
*/
            temp += "</td></tr>";
        }
    }

    temp += "</table>";
    $("#achatProduit").html(temp);
    $("#divAchatProduit").show();
    $("#divProduit").hide();
/*
  temp = "<table border='0' width='250' class='Corps'>";
  
//  temp += "<tr><td colspan='8' class='Titre2' height='40'>&nbsp;D�tail :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='250'><CENTER><b>Description</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < ACHAT_PROD_IDPRODUIT.length; ind01++)
  {
    if (((entre == ACHAT_PROD_IDENTRE[ind01]) || (entre == '0')) && ((pays == ACHAT_PROD_IDPAYS[ind01]) || (pays == '0')) && ((type == ACHAT_PROD_TYPEPRODUIT[ind01]) || (type == ACHAT_PROD_TYPEPRODUITEQUI[ind01]) || (type == '0')))
    {
      temp += "<tr>";
      temp += "<td valign=center height=100><FONT size=2>" + ACHAT_PROD_DESCRIPTION[ind01] + "</FONT></td></tr>";
    }
  }
  temp += "</table>";

  document.getElementById("tabdroiteb").innerHTML = temp;
*/
}

function DetailEntreprise(entre){
    $('#page-loader').show();
    $tmp = "new_detail_1_entreprise.php?entreprise=" + entre;
    document.location.replace($tmp);
}

function SelectEntreprisePaysType(){
    temp = "<table border='0' width='100%'>";
    temp += "<tr>";
    temp += "<td class='textBleu'>&nbsp;&nbsp;Pays : &nbsp;<SELECT name='pays1' id='pays1' onchange='Produit()'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_PAYS_NOMPAYS.length; ind01++)
        temp += "<OPTION value='" + LIST_PAYS_IDPAYS[ind01] + "'>" + LIST_PAYS_NOMPAYS[ind01] + "&nbsp;&nbsp;";
    
    temp += "</SELECT></td>";
    
    temp += "<td class='textBleu'>&nbsp;&nbsp;Entreprise : &nbsp;</td><td class='texte1'><SELECT name='entre1' id='entre1' onchange='Produit();'>";
    temp += "<OPTION value='0'>Toutes&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < DET_ENTRE_IDENTRE.length; ind01++)
        temp += "<OPTION value='" + DET_ENTRE_IDENTRE[ind01] + "'>" + DET_ENTRE_NOMENTRE[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT></td>";
    
    temp += "<td class='textBleu'>&nbsp;&nbsp;Type Produit :&nbsp;</td>";
    temp += "<td class='textBleu'>";
    temp += "<SELECT name='typeproduit1' id='typeproduit1' onchange='Produit();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++)
        temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
    temp += "</SELECT></td>";
    
    temp += "</tr>";
    temp += "</table>";
    
    $("#tabcentrec").html(temp);
}

function AchatProduit(entre){
    RAZ_tout();

    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheProduit();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    $("#tabcentrec").html(temp);

    temp = "<FORM name='achatstock' method='post' action=''>";

    temp += "<table border='0' width='100%'>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Achat de :&nbsp;</td>";
    temp += "<td colspan='2'><FONT size=2><b>" + ACHAT_PROD_NOMPRODUIT[entre] + "&nbsp;à&nbsp;" + ACHAT_PROD_NOMENTRE[entre] + "&nbsp;(" + ACHAT_PROD_NOMPAYS[entre] + ")</FONT></b></td></tr>";

    temp += "<tr></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte acheteur : &nbsp;</td><td><SELECT name='idcpte1' id='idcpte1' onchange='ChangeCpte();'>";
    temp += "<OPTION value='0'>Pas de sélection&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++){
        if (CPTEP_TYPE[ind01] != 'P')
            temp += "<OPTION value='" + CPTEP_NCPTE[ind01] + "'>" + CPTEP_NCPTE[ind01] + " - " + CPTEP_NOMCPTE[ind01] + "&nbsp;(" + format("#,##0.", CPTEP_SOLDE[ind01]) + "&nbsp;" + CPTEP_DEVISE[ind01] + ")&nbsp;&nbsp;";
    }
    temp += "</SELECT></td></tr>";

    temp += "<tr>";
    temp += "<td class='textBleu' width='250'>&nbsp;&nbsp;Compte vendeur : &nbsp;</td><td><SELECT name='idcpte2' id='idcpte2' onchange='ChangeCpte();'>";
    temp += "<OPTION value='0'>Pas de sélection&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < ACHAT_CPTE_NCPTE.length; ind01++){
        if ((ACHAT_PROD_IDENTRE[entre] == ACHAT_CPTE_IDTITULAIRE[ind01]))
            temp += "<OPTION value='" + ACHAT_CPTE_NCPTE[ind01] + "'>" + ACHAT_CPTE_NCPTE[ind01] + " - " + ACHAT_CPTE_NOMCPTE[ind01] + "&nbsp;(" + ACHAT_CPTE_DEVISE[ind01] + ")&nbsp;&nbsp;";
    }
    temp += "</SELECT></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Nb de produit acheté :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='nbprod' id='nbprod' size='4' align=right>&nbsp;" + ACHAT_PROD_NOMPRODUIT[entre] + "</td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;Au tarif unitaire HT de :&nbsp;</td>";
    temp += "<td colspan='2'>";
    temp += "<INPUT type='text' name='tarif' id='tarif' size='4' align=right>";
    temp += "&nbsp;<INPUT type='text' name='deviseA1' id='deviseA1' size='2' align=right>";
    temp += "&nbsp;&nbsp;soit pour le vendeur : ";
    temp += "<INPUT type='text' name='tarifB' id='tarifB' size='4' align=right>";
    temp += "&nbsp;<INPUT type='text' name='deviseB' id='deviseB' size='2' align=right>";
    temp += "</td>";
    temp += "</tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valcalcul value='Calculer' onclick='Calcul();'></td>";
    temp += "<td>&nbsp;&nbsp;Taxe :&nbsp;&nbsp;<INPUT type='text' name='taxe' id='taxe' size='3' align=right> %</td></tr>";
    temp += "<tr><td width='250' class='texte2'>&nbsp;&nbsp;Tarif TTC :&nbsp;</td>";
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

    temp += "<tr><td width='250'></td>";
    temp += "<td class='textRouge'><INPUT type=button name=valachatstock value='Proposer' onclick='valachat("+ entre + ");'></td></tr>";

    temp += "</table>";

    temp += "</FORM>";

    $("#divProduit").html(temp);
    $("#divAchatProduit").hide();
    $("#divProduit").show();
    
    $("#idpaysA").val(ACHAT_CPTE_DEVISE[ind01]);
    $("#idpaysB").val(ACHAT_PROD_IDPAYS[entre]);
    $("#entreB").val(ACHAT_PROD_IDENTRE[entre]);
    $("#idunite").val(ACHAT_PROD_IDUNITE[entre]);
    $("#nomunite").val(ACHAT_PROD_NOMUNITE[entre]);
    $("#nbunite").val(ACHAT_PROD_NBUNITE[entre]);
    $("#idprod").val(ACHAT_PROD_IDPRODUIT[entre]);
    $("#nomprod").val(ACHAT_PROD_NOMPRODUIT[entre]);
    $("#prodequi").val(ACHAT_PROD_TYPEPRODUITEQUI[entre]);
    $("#prodtype").val(ACHAT_PROD_TYPEPRODUIT[entre]);
    //  document.getElementById("tarif").value = ACHAT_PROD_PRIX[entre];
    ChangeCpte();
}

function ChangeCpte(){
  for (ind01 = 0; ind01 < CPTEP_NCPTE.length; ind01++){
    if (CPTEP_NCPTE[ind01] == $("#idcpte1").val()){
      $("#deviseA").val(CPTEP_DEVISE[ind01]);
      $("#deviseA1").val(CPTEP_DEVISE[ind01]);
      $("#soldeA").val(CPTEP_SOLDE[ind01]);
      $("#idpaysA").val(CPTEP_IDPAYS[ind01]);
      $("#entreA").val(CPTEP_IDTITULAIRE[ind01]);
    }
  }

  for (ind01 = 0; ind01 < ACHAT_CPTE_NCPTE.length; ind01++){
    if (ACHAT_CPTE_NCPTE[ind01] == $("#idcpte2").val()){
      $("#deviseB").val(ACHAT_CPTE_DEVISE[ind01]);
      break;
    }
  }

  if (!isNaN(parseFloat($("#tarif").val()))){
    for (ind01 = 0; ind01 < TX_DEVISE1.length; ind01++){
      if ((TX_DEVISE1[ind01] == $("#deviseB").val()) && (TX_DEVISE2[ind01] == $("#deviseA").val())){
        $("#tarifB").val($('#nbprod').val() * $("#tarif").val() * TX_TAUX[ind01]);
        break;
      }
    }
  }
  else{
    $("#tarif").val('0');
    $("#tarifB").val('0');
  }

  var ind0 = 0;
  var ind1 = 0;
  var taxe = 0;
  var taxe0 = 0;
  var taxe1 = 0;
  $("#taxe").val('0');
  for (ind01 = 0; ind01 < TAXE_IMPORT_IDPAYS1.length; ind01++){
    if ((TAXE_IMPORT_IDPAYS1[ind01] == $("#idpaysA").val()) && (TAXE_IMPORT_IDPAYS2[ind01] == $("#idpaysA").val())){
      if ((TAXE_IMPORT_TYPE[ind01] == '00000') && (ind0 == 0)){
        ind0 = 1;
        taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
      }
      if ((TAXE_IMPORT_TYPE[ind01] == $("#prodequi").val()) && (ind0 < 4)){
        ind0 = 3;
        taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
      }
      if (TAXE_IMPORT_TYPE[ind01] == $("#prodtype").val()){
        ind0 = 4;
        taxe0 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
      }
    }

    if ($("#idpaysA").val() != $("#idpaysB").val()){
      if ((TAXE_IMPORT_IDPAYS1[ind01] == $("#idpaysA").val()) && (TAXE_IMPORT_IDPAYS2[ind01] == $("#idpaysB").val())){
        if ((TAXE_IMPORT_TYPE[ind01] == '00000') && (ind1 == 0)){
          ind1 = 1;
          taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
        }
        if ((TAXE_IMPORT_TYPE[ind01] == $("#prodequi").val()) && (ind1 < 4)){
          ind1 = 3;
          taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
        }
        if (TAXE_IMPORT_TYPE[ind01] == $("#prodtype").val()){
          ind1 = 4;
          taxe1 = parseFloat(TAXE_IMPORT_TAXE[ind01]) * 100;
        }
      }
    }
  }

  taxe = taxe0 + taxe1;
  $("#taxe").val(taxe.toFixed(0));
}

function Calcul(){
  ChangeCpte();
  $("#rescalcul1").val("");

  if ((parseInt($('#idcpte1').val()) == 0) || (parseInt($('#idcpte2').val()) == 0)){
    alert("Sélectionnez les comptes.");
    return;
  }

  if ((isNaN(parseFloat($("#taxe").val()))) || (parseFloat($("#taxe").val()) < 0))
     $("#taxe").val(0);
  taxe = 1 + parseFloat($("#taxe").val()) / 100 ;

  if ((isNaN(parseInt($('#nbunite').val()))) || (isNaN(parseInt($('#tarif').val())))){
    alert("Avec le montant et le nb d'unité cela ira mieux.");
    return;
  }
  else{
    if ((parseInt($('#tarif').val()) <= 0) || (parseInt($('#nbunite').val()) <= 0)){
      alert("Le nombre d'unité et le montant doivent être supérieurs à zero.");
      return;
    }
    else{
      if (($("#prodequi").val() == '20000') && (parseInt($('#nbprod').val()) > 1)){
        alert("Un seul produit immobilier à la fois.");
        return;
      }
      else
        $("#rescalcul1").val(parseInt($('#nbprod').val()) * parseInt($('#tarif').val()) * taxe);
    }
  }
}

function RAZ_tout(){
  $("#tabcentrec").html("");
}
function RAZ_centrec(){
  $("#tabcentrec").html("");
}

function MenuTransac(){
    var temp;
    temp = "<table width='100%'><tr>";

    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonVert' onClick='gotoTransac();'>Transaction</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonOrange' onClick='gotoStock();'>Achat Stock</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonMarron' onClick='gotoProduit();'>Achat Produit</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonRouge' onClick='gotoTitre();'>Achat Titre</div>";
    temp += "</td>";
    temp += "<td width='200'>";
    temp += "<div class='menuEtat tailleSimple boutonBlanc' onClick='gotoPA();'>Petites Annonces</div>";
    temp += "</td>";
    
    temp += "</tr></table>";
    $("#divSSMenuTransac").html(temp);
}


function gotoTransac(){
    $('#page-loader').show();
    $tmp = "transaction.php";
    document.location.replace($tmp);
}
function gotoStock(){
    $('#page-loader').show();
    $tmp = "achat_stock.php";
    document.location.replace($tmp);
}
function gotoProduit(){
    $('#page-loader').show();
    $tmp = "achat_produit.php";
    document.location.replace($tmp);
}
function gotoTitre(){
    $('#page-loader').show();
    $tmp = "achat_titre.php";
    document.location.replace($tmp);
}
function gotoPA(){
    $('#page-loader').show();
    $tmp = "achat_pa.php";
    document.location.replace($tmp);
}

