function immo()
{
  temp = "<FORM name='add_immo' method='post' action=''>";

  temp += "<center><table border='0' width='600'><tr><td colspan='2' class='Titre5' height='40'>&nbsp;Création immobilière :</td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Nom produit :&nbsp;</td>";
  temp += "<td><INPUT type='text' name='nomproduit' id='nomproduit'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Propriétaire : &nbsp;</td>";
  temp += "<td><SELECT name='proprietaire' id='proprietaire'>";
  temp += "<OPTION value=''>Aucune&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < ENTITE_ID.length; ind01++)
      temp += "<OPTION selected='true' value='" + ENTITE_ID[ind01] + "'>" + ENTITE_NOM[ind01] + "&nbsp;(" + ENTITE_NOMPAYS[ind01] + "&nbsp;-&nbsp;" + ENTITE_TYPE[ind01] + ")&nbsp;";
  temp += "</SELECT></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Description :&nbsp;</td>";
  temp += "<td><INPUT type='text' name='description' id='description' size='40'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Adresse :&nbsp;</td>";
  temp += "<td><INPUT type='text' name='adresse' id='adresse' size='40'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Province : &nbsp;</td>";
  temp += "<td><SELECT name='province' id='province'>";
  temp += "<OPTION value=''>Aucune&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < ENTITE_ID.length; ind01++)
    if (ENTITE_TYPEENTE[ind01] == '90000')
      temp += "<OPTION selected='true' value='" + ENTITE_ID[ind01] + "'>" + ENTITE_NOM[ind01] + "&nbsp;(" + ENTITE_NOMPAYS[ind01] + "&nbsp;-&nbsp;" + ENTITE_TYPE[ind01] + ")&nbsp;";
  temp += "</SELECT></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Image :&nbsp;</td>";
  temp += "<td><INPUT type='text' name='image' id='image' size='40'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Type de produit : &nbsp;</td>";
  temp += "<td><SELECT name='typeproduit' id='typeproduit'>";
  temp += "<OPTION value=''>Aucune&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_TOUT_TYPEPROD_TYPEPROD.length; ind01++)
      temp += "<OPTION selected='true' value='" + LIST_TOUT_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TOUT_TYPEPROD_LIBELLE[ind01] + "&nbsp;";
  temp += "</SELECT></td></tr>";

  temp += "<tr><td width='150'><div class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Nb unité :&nbsp;</div></td>";
  temp += "<td><INPUT type='text' name='nbunite' id='nbunite' size='40'></td></tr>";

  temp += "<tr><td width='150' class='texte1'>&nbsp;&nbsp;&nbsp;&nbsp;Type unité : &nbsp;</td>";
  temp += "<td><SELECT name='idunite' id='idunite'>";
  temp += "<OPTION value=''>Aucune&nbsp;&nbsp;";
  for (ind01 = 0; ind01 < LIST_TOUT_TYPEPROD_TYPEPROD.length; ind01++)
      temp += "<OPTION selected='true' value='" + LIST_TOUT_TYPEPROD_TYPEPROD[ind01] + "'>" + LIST_TOUT_TYPEPROD_LIBELLE[ind01] + "&nbsp;";
  temp += "</SELECT></td></tr>";

  temp += "<tr><td width='150'><INPUT type=button name=valaddimmo value='Créer' onclick='addimmo();'></td>";
  temp += "<td class='texte2'>()</td></tr>";

  temp += "</table></center>";

  temp += "</FORM>";

  document.getElementById("tabcentrec").innerHTML = temp;
}



