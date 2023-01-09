
function Profil(){
    temp = "<FORM name='modifprofil' method='post' action=''>";

    temp += "<center><table border='0' width='100%'>";

//    temp +="<tr><td colspan='2' class='Titre5' height='40'>&nbsp;Modification de votre profil :</td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;&nbsp;&nbsp;Nom :&nbsp;</td>";
    temp += "<td><INPUT type='text' name='nom' id='nom'></td></tr>";

    temp += "<tr><td></td><td>";
    temp += "<img src='" + PORTRAIT + "' width=100 height=80 alt=''>";
    temp += "</td></tr>";
    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;&nbsp;&nbsp;Portrait :&nbsp;</td>";
    temp += "<td><INPUT type='text' name='portrait' id='portrait' size='40'></td></tr>";

    temp += "<tr><td width='250' class='textBleu'>&nbsp;&nbsp;&nbsp;&nbsp;Résidence : &nbsp;</td>";
    temp += "<td><SELECT name='residence1' id='residence1'>";
    tmp = "<OPTION value=''>Aucune&nbsp;&nbsp;";
    for (ind01 = 0; ind01 < RES_CIT_IDPOSSESSION.length; ind01++){
        if (RES_CIT_OCCUPE[ind01] == '1')
            tmp += "<OPTION selected='true' value='" + RES_CIT_IDPOSSESSION[ind01] + "'>" + RES_CIT_ADRESSE[ind01] + "&nbsp;(" + RES_CIT_LIBPROVINCE[ind01] + ")&nbsp;";
        else
            tmp += "<OPTION value='" + RES_CIT_IDPOSSESSION[ind01] + "'>" + RES_CIT_ADRESSE[ind01] + "&nbsp;(" + RES_CIT_LIBPROVINCE[ind01] + ")&nbsp;";
    }
    temp += tmp;
    temp += "</SELECT></td></tr>";

    temp += "<tr><td width='250'><div class='textBleu'>&nbsp;&nbsp;&nbsp;&nbsp;Email :&nbsp;</div></td>";
    temp += "<td><INPUT type='text' name='email' id='email' size='40'></td></tr>";

    temp += "<tr><td width='250'><div class='textBleu'>&nbsp;&nbsp;&nbsp;&nbsp;Login :&nbsp;</div></td>";
    temp += "<td><INPUT type='text' name='login' id='login'></td></tr>";

    temp += "<tr><td width='250'><div class='textBleu'>&nbsp;&nbsp;&nbsp;&nbsp;Mot de passe :&nbsp;</div></td>";
    temp += "<td><INPUT type='password' name='pwd' id='pwd' size='20'></td></tr>";

    temp += "<tr><td width='250'><INPUT type=button name=valmodifprofil value='Modifier' onclick='majprofil();'></td>";
    temp += "<td class='textRouge'>(laissez le mot de passe vide pour ne pas le changer)</td></tr>";

    temp += "</table></center>";

    temp += "</FORM>";

    $("#tabcentrec").html(temp);

    $("#login").val(LOGIN);
    $("#email").val(EMAIL);
    $("#portrait").val(PORTRAIT);
    $("#nom").val(NOM);
}



