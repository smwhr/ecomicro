
function AfficheMessagerie(){
    RAZ_tout();
    Selection();
    MessagerieList();
}
function MessagerieList(){
    var temp;
    var ind01;

    var reponse = $("#reponse1").val();
    var objet = $("#objet1").val();

    temp = "<table border='0' width='100%'>";
    
//    temp += "<tr><td colspan='8' class='Titre2' height='40'>&nbsp;Vos messages :</td></tr>";

    temp += "<tr height='40'><td width='100'>&nbsp;<b>Objet</b></td>";
    temp += "<td width='50'>&nbsp;<b>Réponse</b></td>";
    temp += "<td width='100'>&nbsp;<b>Demandeur</b></td>";
    temp += "<td width='100'>&nbsp;<b>Destinataire</b></td>";
    temp += "<td width='490'><CENTER><b>Demande</b></CENTER></td>";
    temp += "<td width='80'><CENTER><b>Date<br>proposition</b></CENTER></td>";
    temp += "<td width='80'><CENTER><b>Date<br>expiration</b></CENTER></td>";
    temp += "</tr>";

    var a = 0;
    var b = 0;
    for (ind01 = 0; ind01 < MSG_IDMSG.length; ind01++){
        if (((objet == MSG_OBJET[ind01]) || (objet == '0')) && ((reponse == MSG_REPONSE[ind01]) || (reponse == '0'))){
            a++;
            b = a%2;
            if (b == 0)
                temp += "<tr class='tr1 textPetit'>";
            else
                temp += "<tr class='tr2 textPetit'>";

            temp += "<td>" + MSG_OBJET[ind01] + "</td>";
            if (MSG_REPONSE[ind01] == "A")
               temp += "<td>&nbsp;Accord</td>";
            else if (MSG_REPONSE[ind01] == "R")
               temp += "<td>&nbsp;Refus</td>";
            else if (MSG_REPONSE[ind01] == "D")
               temp += "<td>&nbsp;Annuler</td>";
            else if (MSG_REPONSE[ind01] == "E")
               temp += "<td>&nbsp;Expirer</td>";
            else
               temp += "<td><b><FONT color=red>&nbsp;En Attente</FONT></b></td>";

            temp += "<td><b><a href='#' onclick='DetailCitoyen(" + MSG_IDORIGINE[ind01] + ")'>" + MSG_NOMORIGINE[ind01] + "</a></b></td>";
            temp += "<td><b><a href='#' onclick='DetailCitoyen(" + MSG_IDDEST[ind01] + ")'>" + MSG_NOMDEST[ind01] + "</a></b></td>";

            temp += "<td class='padding'><a href='#' onclick='DetailMessage(" + ind01 + ")'><span class='msgLst'>" + MSG_LIBELLE[ind01] + "</span></a></td>";
            temp += "<td><CENTER>" + MSG_DATEPROPO[ind01] + "</CENTER></td>";
            temp += "<td><CENTER>" + MSG_DATEEXPIR[ind01] + "</CENTER></td>";
            temp += "</tr>";
        }
    }

    temp += "</table>";
   
    $("#divMessagerie").html(temp);
    $("#tabgaucheb").html("");
    $("#tabdroiteb").html("");
}

function DetailMessage(ind){
    
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' onclick='AfficheMessagerie();'>&nbsp;Retour à la liste&nbsp;</a></CENTER></td>";
    temp += "</tr></table>";

    $("#divSelectMesg").html(temp);

    var temp;
    var ind01;

    temp = "<FORM name='msgmaj' method='post' action=''>";

    temp += "<CENTER><table border='0' width='100%'>";

    temp += "<tr class='msgDetail'>";
    temp += "<td width='150'>&nbsp;<b>Objet : </b></td>";
    temp += "<td width='450'><b>"+ MSG_OBJET[ind] + "</b></td>";
    temp += "</tr>";

    temp += "<tr><td></BR></td><td></td></tr>";
    temp += "<tr><td></BR></td><td></td></tr>";
    
    temp += "<tr class='msgDetail'>";
    temp += "<td width='150'>&nbsp;<b>Message : </b></td>";
    temp += "<td width='450'><b>"+ MSG_LIBELLE[ind] + "</b></td>";
    temp += "</tr>";

    temp += "<tr><td></BR></td><td></td></tr>";
    temp += "<tr><td></BR></td><td></td></tr>";

    temp += "<tr class='msgDetail'>";
    temp += "<td width='150'>&nbsp;<b>Dates : </b></td>";
    temp += "<td width='450'>Proposition : <b>"+ MSG_DATEPROPO[ind] + "</b>&nbsp;&nbsp;&nbsp;Expiration : <b>"+ MSG_DATEEXPIR[ind] + "</b></td>";
    temp += "</tr>";

    temp += "<tr><td></BR></td><td></td></tr>";
    temp += "<tr><td></BR></td><td></td></tr>";

    temp += "<tr class='msgDetail'>";
    temp += "<td width='150'>&nbsp;<b>Action : </b></td>";

    if (MSG_REPONSE[ind] <= " " ){
        if (MSG_IDDEST[ind] == IDUSER){
            temp += "<td><SELECT name='reponse1' id='reponse1' onchange=''>";
            temp += "<OPTION value='A'>Accord&nbsp;&nbsp;";
            temp += "<OPTION value='R'>Refus&nbsp;&nbsp;";
            temp += "</SELECT>";
            temp += "&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type=button name=valider value='Valider' onclick='valachat(" + ind + ");'>";
            temp += "</td>";
        }
        else{
            temp += "<td class='texte1'><SELECT name='reponse1' id='reponse1' onchange=''>";
            temp += "<OPTION value='D'>Annuler&nbsp;&nbsp;";
            temp += "</SELECT>";
            temp += "&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type=button name=annul value='Annuler' onclick='annuler();'>";
            temp += "</td>";
        }
    }
    temp += "</tr>";

    temp += "<tr>";
    temp += "<td colspan='2'><INPUT type='hidden' name='idmsg' id='idmsg'></td>";
    temp += "</tr>";

    temp += "</table></CENTER></FORM>";
    $("#divMessagerie").html(temp);

    $("#idmsg").val(MSG_IDMSG[ind]);


    temp = "<div style='height:540px;'></BR></BR></BR></BR></BR></BR><CENTER><img src='obj/message1.jpg' alt='logo' width='200' height='160'></CENTER></div>";
    $("#tabgaucheb").html(temp);

    temp = "<div style='height:540px;'></BR></BR></BR></BR></BR></BR><CENTER><img src='obj/message2.jpg' alt='logo' width='200' height='160'></CENTER></div>";
    $("#tabdroiteb").html(temp);
}

function DetailCitoyen(i){
    $('#page-loader').show();
    $tmp = "new_detail_1_citoyen.php?citoyen=" + i;
    document.location.replace($tmp);
}

function Selection(){
    temp = "<table width='100%'><tr>";

    temp += "<td width='100'></td>"

    temp += "<td class='textBleu'><CENTER>&nbsp;&nbsp;Objet : &nbsp;<SELECT name='objet1' id='objet1' onchange='MessagerieList();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    temp += "<OPTION value='VENTE_STOCK'>VENTE_STOCK&nbsp;&nbsp;";
    temp += "<OPTION value='VENTE_PRODUIT'>VENTE_PRODUIT&nbsp;&nbsp;";
    temp += "<OPTION value='VENTE_DECHET'>VENTE_DECHET&nbsp;&nbsp;";
    temp += "<OPTION value='VENTE_TITRE'>VENTE_TITRE&nbsp;&nbsp;";
    temp += "<OPTION value='VENTE_OCCASION'>VENTE_OCCASION&nbsp;&nbsp;";
    temp += "<OPTION value='OUVRIR_RELATION'>OUVRIR_RELATION&nbsp;&nbsp;";
    temp += "<OPTION value='DEFINIR_TAUX'>DEFINIR_TAUX&nbsp;&nbsp;";
    temp += "<OPTION value='LOCATION'>LOCATION&nbsp;&nbsp;";
    temp += "</SELECT></CENTER></td>";

    temp += "<td class='textBleu'><CENTER>&nbsp;&nbsp;Réponse : &nbsp;<SELECT name='reponse1' id='reponse1' onchange='MessagerieList();'>";
    temp += "<OPTION value='0'>Tous&nbsp;&nbsp;";
    temp += "<OPTION value=''>Attente&nbsp;&nbsp;";
    temp += "<OPTION value='A'>Accord&nbsp;&nbsp;";
    temp += "<OPTION value='R'>Refus&nbsp;&nbsp;";
    temp += "<OPTION value='D'>Annuler&nbsp;&nbsp;";
    temp += "<OPTION value='E'>Expirer&nbsp;&nbsp;";
    temp += "</SELECT></CENTER></td>";

    temp += "<td class='textBleu'>&nbsp;&nbsp;";
    temp += "</td>";
    
    temp += "<td width='100'></td>"
    
    temp += "</tr></table>";

    $("#divSelectMesg").html(temp);
}

function RAZ_tout(){
    $("#divSelectMesg").html("");
    $("#tabgaucheb").html("");
    $("#divMessagerie").html("");
    $("#tabdroiteb").html("");
}