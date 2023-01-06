
function AfficheProduitPro()
{
  RAZ_tout();
  selectProdEntreprise();
  ProduitPro();
}


function ProduitPro()
{
  var temp;
  var ind01;

  var entre = document.getElementById("entre1").value;
  var type = document.getElementById("type1").value;

  temp = "<table border='0' width='600' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Produits gérés :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='100'><b>&nbsp;Entreprise</b></td>";
  temp += "<td width='150'><b>&nbsp;Produit</b></td>";
  temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
  temp += "<td width='100'><CENTER><b>Valeur</b></CENTER></td>";
  temp += "<td width='50'><CENTER><b>Util.</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < PRODP_IDPRODUIT.length; ind01++)
  {
    if (((entre == PRODP_IDENTRE[ind01]) || (entre == '0')) && ((type == PRODP_TYPE[ind01]) || (type == '0') || (type == PRODP_TYPEEQUI[ind01])))
    {
      temp += "<tr>";
      temp += "<td><b><a href='#' onclick='DetailEntreprise(" + PRODP_IDENTRE[ind01] + ");'>" + PRODP_NOMENTRE[ind01] + "</a></b></td>";
      temp += "<td><b><a href='#' OnClick='RAZ_droiteb(); ModifProduit(" + ind01 + ");'>" + PRODP_NOMPRODUIT[ind01] + "</a></b></td>";
      temp += "<td><CENTER><img src='" + PRODP_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
      temp += "<td align=right>" + PRODP_NBUNITE[ind01] + "&nbsp;" + PRODP_NOMUNITE[ind01] + "</td>";
      temp += "<td><CENTER>" + PRODP_NBUSE[ind01] + "</CENTER></td></tr>";
    }
  }

  temp += "</table>";
  document.getElementById("tabcentreb").innerHTML = temp;

  temp = "<table border='0' width='400' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Détail :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='400'><CENTER><b>Description</b></CENTER></td></tr>";

  for (ind01 = 0; ind01 < PRODP_IDPRODUIT.length; ind01++)
  {
    if (((entre == PRODP_IDENTRE[ind01]) || (entre == '0')) && ((type == PRODP_TYPE[ind01]) || (type == '0') || (type == PRODP_TYPEEQUI[ind01])))
    {
      temp += "<tr>";
      temp += "<td valign=center height='100'><FONT size=2>" + PRODP_DESCRIPTION[ind01] + "</FONT></td></tr>";
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

function selectProdEntreprise()
{
  temp = "<table border='0' width='100%' class='Corps'>";
  temp += "<tr>";
  temp += "<td class='texte1'>&nbsp;&nbsp;Entreprise : &nbsp;</td><td><SELECT name='entre1' id='entre1' onchange='ProduitPro();'>";
  temp += "<OPTION value='0'>Toutes&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < ENTRE_USER_IDENTRE.length; ind01++)
    temp += "<OPTION value='" + ENTRE_USER_IDENTRE[ind01] + "'>" + ENTRE_USER_NOMENTRE[ind01] + "&nbsp;&nbsp;";
  temp += "</SELECT></td>";
  temp += "<td class='texte1'>&nbsp;&nbsp;Type de produit : &nbsp;<SELECT name='type1' id='type1' onchange='ProduitPro()'>";
  temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++)
    if (LIST_TYPEPROD_TYPEPROD[ind01] != '00000')
     temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;";

  temp += "</SELECT></td>";
  temp += "<td class='Texte1'><CENTER><b>&nbsp;&nbsp; Action :&nbsp;</b><a href='#' OnClick='RAZ_droiteb(); NewProduit();'>&nbsp;Nouveau Produit&nbsp;</a>";
  temp += "</CENTER></td>";
  temp += "<td class='texte1'></td>";
  temp += "</tr></table>";

  document.getElementById("tabcentrec").innerHTML = temp;
}

function NewProduit()
{
  var a = 0;
  document.getElementById("tabcentrec").innerHTML = "";
  document.getElementById("tabcentreb").innerHTML = "";

  temp = "<table border='0' width='400'><tr>";
  temp += "<td class='Texte1'>";
  temp += "<CENTER><a href='#' onclick='AfficheProduitPro();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
  temp += "</tr></table>";

  document.getElementById("tabcentrec").innerHTML = temp;


  temp = "<FORM name='newproduit1' method='post' action=''>";

  temp += "<table border='0' width='500'><tr><td colspan='3' class='Titre5' height='40'>&nbsp;Nouveau produit :</td></tr>";

  if ((ENTRE_USER_IDENTRE.length > 0) || (LIST_QUIPRODQUOI_IDENTRE.length > 0))
  {
    temp += "<tr>";
    temp += "<td class='texte1' width='150'>&nbsp;&nbsp;Entreprise : &nbsp;</td><td colspan='2'><div id='liste_entre'>";
/*
    temp += "<SELECT name='entre1' id='entre1' onchange='choix_entre(); choix_prod(); immo_prod();'>";
    for (ind01 = 0; ind01 < ENTRE_USER_IDENTRE.length; ind01++)
      temp += "<OPTION value='" + ENTRE_USER_IDENTRE[ind01] + "'>" + ENTRE_USER_NOMENTRE[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT>";
*/
    temp += "</div></td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom produit :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='nomproduit' id='nomproduit' size='40'></td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Type Produit :&nbsp;</td>";
    temp += "<td class='texte1' colspan='2'><div id='choix_entre'>";
/*
    temp += "<SELECT name='typeproduit1' id='typeproduit1'>";
    for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++)
    {
       if (LIST_TYPEPROD_TYPEPROD[ind01] != '00000')
       {
         if (a+=0)
           temp += "<OPTION selected=TRUE value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
         else
           temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
       }
    }
    temp += "</SELECT></td></tr>";
*/
    temp += "</div></td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Image :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='image' id='image' size='50'></td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Description :&nbsp;</td>";
    temp += "<td colspan='2'><INPUT type='text' name='description' id='description' size='50'></td></tr>";

    temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nb Unité :&nbsp;</td>";
    temp += "<td class='texte1'><INPUT type='text' name='nbunite' id='nbunite' size='5' align=right>";

    temp += "</td><td class='texte1'><div id='choix_prod'>";
/*
    for (ind01 = 0; ind01 < LIST_UNITE_NOMUNITE.length; ind01++)
      temp += "<OPTION value='" + LIST_UNITE_IDUNITE[ind01] + "'>" + LIST_UNITE_NOMUNITE[ind01] + "&nbsp;&nbsp;";
    temp += "</SELECT></td></tr>";
*/
    temp += "</div></td></tr>";


    temp += "<tr><td width='150' class='texte1'><div id='immo_lib_prod'></div></td>";
    temp += "<td><div id='immo_prod'></div></td></tr>";



    temp += "<tr><td width='150'></td>";
    temp += "<td colspan='2'><INPUT type='hidden' name='idproduit' id='idproduit'></td></tr>";

    temp += "<tr><td width='150'><INPUT type=button name=valnewproduit value='Créer' onclick='newproduit()'></td>";
    temp += "<td class='texte2'></td></tr>";
  }
  else
  {
    if (ENTRE_USER_IDENTRE.length <= 0)
	temp += "<tr><td width='200' class='texte2' colspan='3'>Vous ne dirigez pas d'entreprise du secondaire !</td>";
    else
	temp += "<tr><td width='200' class='texte2' colspan='3'>Aucune de vos entreprises ne peut mettre en vente de produit pour le moment. Veuillez contacter votre responsable, il pourra le cas échéant faire une demande pour ajouter un nouveau type de produit.</td>";
    temp += "</tr>";
  }
  temp += "</table>";

  temp += "</FORM>";

  temp += "<table border='0' width='500'><tr>";
  temp += "<td colspan='8' class='Texte2' height='40'>";
  temp += "<ul>";
  temp += "<li>La valeur et l'unité sont importantes et doivent être autorisées (adressez vous à votre responsable).";
  temp += "</ul>";
  temp += "</tr></table>";

  document.getElementById("tabcentreb").innerHTML = temp;

  liste_entre();
  choix_entre();
  choix_prod();
  immo_prod();

  aide();
}

function aide()
{
  temp = "<table border='0' width='400'><tr><td class='Titre4' height='40'>&nbsp;</td></tr>";

  temp += "<tr>";
  temp += "<td class='texte1' width='150'>&nbsp;</td>";
  temp += "</tr>";

  temp += "<tr>";
  temp += "<td class='texte1' width='150'>&nbsp;&nbsp;1- Choisissez l'entreprise de production";
  temp += "<br><br>&nbsp;&nbsp;2- Déterminez le type du produit";
  temp += "<br><br>&nbsp;&nbsp;3- Calculez le coût de production :";
  temp += "<br>";

  // Cout EL
  temp += "<INPUT type='text' name='cal_val' id='cal_val' size='5' align=right>";

  temp += "&nbsp;&nbsp;";
  var tmp_str = document.getElementById("typeproduit1").value;
  if (document.getElementById("typeproduit1").value == '20004')   // Batiment industriel
    temp += "% capacité conseillée";
  else if (tmp_str.substring(0,2) == '20')
    temp += "m2";
  else
    temp += "Euro";

  temp += "&nbsp;&nbsp;&nbsp;&nbsp;";
  temp += "<INPUT type=button name=cal_bouton value='>>>' onclick='cal_cal()'>";
  temp += "&nbsp;&nbsp;&nbsp;&nbsp;";
  temp += "<INPUT type='text' name='cal_unite' id='cal_unite' size='5' align=right>";
  temp += "&nbsp;&nbsp;";

  for (ind01 = 0; ind01 < LIST_QUIPRODQUOI_IDENTRE.length; ind01++)
  {
    if (LIST_QUIPRODQUOI_TYPEUNITE[ind01] == document.getElementById("idunite1").value)
    {
      temp += LIST_QUIPRODQUOI_LIBUNITE[ind01];
      break;
    }
  }

  temp += "<br>";

  temp += "</td>";
  temp += "</tr>";

  temp += "<tr>";
  temp += "<td class='texte1' width='150'>&nbsp;&nbsp;</td>";
  temp += "</tr>";

  temp += "</table>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("cal_unite").value = 0;
  cal_cal();

}

function cal_cal()
{

  document.getElementById("cal_unite").value = 0;

  var tmp_str = document.getElementById("typeproduit1").value;

  // Immobilier : batiment industriel
  if (document.getElementById("typeproduit1").value == '20004')   //Batiment Industriel
  {
    document.getElementById("cal_unite").value = Math.round(document.getElementById("cal_val").value);
  }
  // Immobilier : logement
  else if (document.getElementById("typeproduit1").value == '20002')  // Logement
  {
    document.getElementById("cal_unite").value = Math.round(document.getElementById("cal_val").value * 0.08);
  }
  // Immobilier : bureau
  else if (document.getElementById("typeproduit1").value == '20003') // Bureau
  {
    document.getElementById("cal_unite").value = Math.round(document.getElementById("cal_val").value * 0.04);
  }
  // Immobilier : terrain
  else if (document.getElementById("typeproduit1").value == '20001')   //Terrain
  {
    document.getElementById("cal_unite").value = Math.round(document.getElementById("cal_val").value * 0.01);
  }
  // Autre
  else
  {
   if (document.getElementById("idunite1").value == '30001')  // PObjet
     document.getElementById("cal_unite").value = Math.round(Math.sqrt(document.getElementById("cal_val").value / 10));
   else
      document.getElementById("cal_unite").value = Math.round(Math.sqrt(document.getElementById("cal_val").value / 100));

  }

}

function liste_entre()
{
    a = 0;
    temp = "<SELECT name='entre1' id='entre1' onchange='choix_entre(); choix_prod(); immo_prod(); aide();'>";
    for (ind01 = 0; ind01 < ENTRE_USER_IDENTRE.length; ind01++)
    {
      a = 0;
      for (ind02 = 0; ind02 < LIST_QUIPRODQUOI_IDENTRE.length; ind02++)
      {
         if (LIST_QUIPRODQUOI_IDENTRE[ind02] == ENTRE_USER_IDENTRE[ind01])
         {
           a = 1;
           temp += "<OPTION value='" + ENTRE_USER_IDENTRE[ind01] + "'>" + ENTRE_USER_NOMENTRE[ind01] + "&nbsp;&nbsp;";
           break
         }
      }
    }
    
    temp += "</SELECT>";

    document.getElementById("liste_entre").innerHTML = temp;

}
function choix_entre()
{
    a = 0;
    temp = "<SELECT name='typeproduit1' id='typeproduit1' onchange='choix_prod(); aide();'>";
    for (ind01 = 0; ind01 < LIST_QUIPRODQUOI_IDENTRE.length; ind01++)
    {
       if (LIST_QUIPRODQUOI_IDENTRE[ind01] == document.getElementById("entre1").value)
       {
         if (a+=0)
           temp += "<OPTION selected=TRUE value='" + LIST_QUIPRODQUOI_TYPEPROD[ind01] + "'>" + LIST_QUIPRODQUOI_LIBPROD[ind01] + "&nbsp;&nbsp;";
         else
           temp += "<OPTION value='" + LIST_QUIPRODQUOI_TYPEPROD[ind01] + "'>" + LIST_QUIPRODQUOI_LIBPROD[ind01] + "&nbsp;&nbsp;";
       }
    }
    temp += "</SELECT>";

    document.getElementById("choix_entre").innerHTML = temp;

}

function choix_prod()
{

    for (ind01 = 0; ind01 < LIST_QUIPRODQUOI_IDENTRE.length; ind01++)
    {
       if ((LIST_QUIPRODQUOI_IDENTRE[ind01] == document.getElementById("entre1").value) && (LIST_QUIPRODQUOI_TYPEPROD[ind01] == document.getElementById("typeproduit1").value))
       {
		temp = "&nbsp;&nbsp;Unité : &nbsp;<SELECT name='idunite1' id='idunite1' onchange='aide();'>";
		temp += "<OPTION selected=TRUE value='" + LIST_QUIPRODQUOI_TYPEUNITE[ind01] + "'>" + LIST_QUIPRODQUOI_LIBUNITE[ind01] + "&nbsp;&nbsp;";
		temp += "</SELECT>";
		document.getElementById("choix_prod").innerHTML = temp;
		return;
       }
    }

}

function immo_prod()
{

    var temp = "";
    var tmp_str = document.getElementById("typeproduit1").value;

    document.getElementById("immo_lib_prod").innerHTML = temp;
    document.getElementById("immo_prod").innerHTML = temp;

    if (tmp_str.substring(0,2) == '20')
    {
        temp = "&nbsp;&nbsp;Adresse :&nbsp;";
        temp += "<br>&nbsp;&nbsp;Province :&nbsp;";

      document.getElementById("immo_lib_prod").innerHTML = temp;

        temp = "<INPUT type='text' name='adresse' id='adresse' size='40' align=right>";

      temp += "<br>";

        temp += "<SELECT name='province' id='province'>";
        for (ind01 = 0; ind01 < LIST_PROV_IDPROV.length; ind01++)
          temp += "<OPTION value='" + LIST_PROV_IDPROV[ind01] + "'>" + LIST_PROV_LIBPROV[ind01] + "&nbsp;&nbsp;";
        temp += "</SELECT>";

    document.getElementById("immo_prod").innerHTML = temp;

    }

}

function ModifProduit(i)
{

  document.getElementById("tabgauchec").innerHTML = "";
  document.getElementById("tabdroitec").innerHTML = "";
  document.getElementById("tabgaucheb").innerHTML = "";
  document.getElementById("tabdroiteb").innerHTML = "";
  document.getElementById("tabcentreb").innerHTML = "";

  var temp;
  var ind01;

  temp = "<table border='0' width='400' class='Corps'><tr>";
  temp += "<td colspan='8' class='Texte1' height='40'>";
  temp += "<CENTER><a href='#' onclick='AfficheProduitPro();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
  temp += "</tr></table>";

  document.getElementById("tabcentrec").innerHTML = temp;


  temp = "<table border='0' width='400' class='Corps'><tr><td colspan='8' class='Titre2' height='40'>&nbsp;Produit :</td></tr>";

  temp += "<tr class='Titre3' height='40'><td width='100'><b>&nbsp;Produit</b></td>";
  temp += "<td width='200'><CENTER><b>Image</b></CENTER></td>";
  temp += "<td width='40'><CENTER><b>Valeur</b></CENTER></td>";
  temp += "</tr>";

  for (ind01 = 0; ind01 < PRODP_IDPRODUIT.length; ind01++)
  {
    if (PRODP_IDPRODUIT[ind01] == PRODP_IDPRODUIT[i])
    {
      temp += "<tr>";
      temp += "<td><b>" + PRODP_NOMPRODUIT[ind01] + "</b></td>";
      temp += "<td><CENTER><img src='" + PRODP_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
      temp += "<td align=right>" + PRODP_NBUNITE[ind01] + "&nbsp;" + PRODP_NOMUNITE[ind01] + "</td>";
      temp += "</tr>";
    }
  }

  temp += "</table>";
  document.getElementById("tabcentreb").innerHTML = temp;

  ModifProduit1(i);
}

function ModifProduit1(i)
{
  temp = "<table border='0' width='500'><tr>";
  temp += "<td class='Texte1'>";
  temp += "<CENTER></CENTER></td>";
  temp += "</tr></table>";

  document.getElementById("tabdroitec").innerHTML = temp;

  var a = 0;

  temp = "<FORM name='modifproduit' method='post' action=''>";

  temp += "<table border='0' width='500'><tr><td colspan='3' class='Titre5' height='40'>&nbsp;Modification de votre produit :</td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Entreprise :&nbsp;</td>";
  temp += "<td colspan='2' class='texte4'>" + PRODP_NOMENTRE[i] + "</td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nom produit :&nbsp;</td>";
  temp += "<td colspan='2'><INPUT type='text' name='nomproduit' id='nomproduit' size='40'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Type Produit :&nbsp;</td>";
  temp += "<td class='texte1'>";
  temp += "<SELECT name='typeproduit1' id='typeproduit1'>";
  for (ind01 = 0; ind01 < LIST_TYPEPROD_TYPEPROD.length; ind01++)
  {
    if (LIST_TYPEPROD_TYPEPROD[ind01] != '00000')
    {
     if (LIST_TYPEPROD_TYPEPROD[ind01] == PRODP_TYPE[i])
       temp += "<OPTION selected=TRUE value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
     else
       temp += "<OPTION value='" + LIST_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TYPEPROD_LIBELLE[ind01] + "&nbsp;&nbsp;(" + LIST_TYPEPROD_LIBELLEEQUI[ind01] + ")&nbsp;&nbsp;";
    }
  }
  temp += "</SELECT></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Image :&nbsp;</td>";
  temp += "<td colspan='2'><INPUT type='text' name='image' id='image' size='60'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Description :&nbsp;</td>";
  temp += "<td colspan='2'><INPUT type='text' name='description' id='description' size='60'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;Nb Unité :&nbsp;</td>";
  temp += "<td class='texte1'><INPUT type='text' name='nbunite' id='nbunite' size='5' align=right>";
  temp += "&nbsp;<SELECT name='idunite1' id='idunite1'>";
  for (ind01 = 0; ind01 < LIST_UNITE_NOMUNITE.length; ind01++)
  {
     if (LIST_UNITE_IDUNITE[ind01] == PRODP_IDUNITE[i])
       temp += "<OPTION selected=TRUE value='" + LIST_UNITE_IDUNITE[ind01] + "'>" + LIST_UNITE_NOMUNITE[ind01] + "&nbsp;&nbsp;";
     else
       temp += "<OPTION value='" + LIST_UNITE_IDUNITE[ind01] + "'>" + LIST_UNITE_NOMUNITE[ind01] + "&nbsp;&nbsp;";
  }
  temp += "</SELECT></td></tr>";

  temp += "<tr><td width='150'></td>";
  temp += "<td colspan='2'><INPUT type='hidden' name='idproduit' id='idproduit'></td></tr>";

  temp += "<tr><td width='150'><INPUT type=button name=valmodifproduit value='Modifier' onclick='majproduit(" + i + ");'></td>";
  temp += "<td class='texte2'></td>";
  temp += "<td width='100'><INPUT type=button name=valsupprproduit value='Supprimer' onclick='supprproduit(" + i + ");'></td></tr>";

  temp += "</table>";

  temp += "</FORM>";

  temp += "<table border='0' width='500'><tr>";
  temp += "<td colspan='8' class='Texte2' height='40'>";
  temp += "<ul>";
  temp += "<li>La valeur et l'unité sont importantes et doivent être autorisées. (adressez vous à votre responsable)";
  temp += "</ul>";
  temp += "</tr></table>";

  document.getElementById("tabdroiteb").innerHTML = temp;

  document.getElementById("nomproduit").value = PRODP_NOMPRODUIT[i];
  document.getElementById("image").value = PRODP_IMAGE[i];
  document.getElementById("description").value = PRODP_DESCRIPTION[i];
  document.getElementById("nbunite").value = PRODP_NBUNITE[i];
  document.getElementById("idproduit").value = PRODP_IDPRODUIT[i];
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



