function AfficheEtat(){
    RAZ_tout();
    Action();
    Etat();
}

function Action(){
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td class='textBleu'><CENTER>&nbsp;&nbsp;<b>&nbsp;&nbsp; Actions :&nbsp;</b>";
    temp += "<a href='activite_1_etat.php?etat=" + etat + "'>&nbsp;Rapport économique&nbsp;</a>";
    temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='#' OnClick='Modifier();'>&nbsp;Modifier données&nbsp;</a>";
    if (DET_PAYS_ELECTION == 0)
        temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='#' OnClick='Election();'>&nbsp;Lancer Election&nbsp;</a>";
    else
        temp += "&nbsp;&nbsp;-&nbsp;&nbsp;<a href='#' OnClick='Voter();'>&nbsp;>>&nbsp;Voter Election&nbsp;<<&nbsp;</a>";
    temp += "</CENTER></td></tr></table>";
    $("#tabcentrec").html(temp);
}


function Modifier(){
    var ind1 = 0;
    var ind2 = 0;
    
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' OnClick='AfficheEtat();'>&nbsp;Retour à la liste&nbsp;</a></CENTER>";
    temp += "</td></tr></table>";
    $("#tabcentrec").html(temp);
    
    temp = "<FORM name='modifetat1' method='post' action=''>";
    
    temp += "<table border='0' width='100%'><tr><td colspan='4' height='40' class='textGros'>Modification d'un état</td></tr>";
    
    if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '5') || ((AUTORISATION.substring(1,2) == '5') && (IDPAYS == DET_PAYS_IDPAYS))){
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Nom du pays :&nbsp;</td>";
        temp += "<td colspan='2'><b>" + DET_PAYS_NOMPAYS + "</b></td></tr>";
        
        temp += "<tr><td colspan='3'>";
        temp += "<CENTER><img src='" + DET_PAYS_DRAPEAU + "' width=100 height=80 alt=''></CENTER>";
        temp += "</td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Drapeau :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='drapeau' id='drapeau' size='40'></td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Adresse site :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='site' id='site' size='40'></td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Adresse forum :&nbsp;</td>";
        temp += "<td colspan='2'><INPUT type='text' name='forum' id='forum' size='40'></td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;ML éco :&nbsp;</td>";
        temp += "<td colspan='2'>http://groups.google.fr/group/&nbsp;<INPUT type='text' name='mleco' id='mleco' size='20'></td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Responsable :&nbsp;</td>";
        temp += "<td colspan='2'><SELECT name='chef' id='chef'>";
        for (ind01 = 0; ind01 < LIST_CIT_IDUSER.length; ind01++){
            if (DET_PAYS_IDPAYS == LIST_CIT_IDPAYS[ind01]){
                ind1 = 1;
                if (DET_PAYS_IDUSER == LIST_CIT_IDUSER[ind01])
                    temp += "<OPTION selected=TRUE value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
                else
                    temp += "<OPTION value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
            }
        }
        temp += "</SELECT></td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Contrôleur fiscal :&nbsp;</td>";
        temp += "<td colspan='2'><SELECT name='cf' id='cf'>";
        for (ind01 = 0; ind01 < LIST_CIT_IDUSER.length; ind01++){
            if (DET_PAYS_IDPAYS == LIST_CIT_IDPAYS[ind01]){
                ind1 = 1;
                if (DET_PAYS_IDCF == LIST_CIT_IDUSER[ind01])
                    temp += "<OPTION selected=TRUE value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
                else
                    temp += "<OPTION value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
            }
        }
        temp += "</SELECT></td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Devise :&nbsp;</td>";
        temp += "<td colspan='2'>" + DET_PAYS_DEVISE + "</td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Banque Nationale :&nbsp;</td>";
        temp += "<td colspan='2'><SELECT name='cptenat' id='cptenat'>";
        for (ind01 = 0; ind01 < CPTE_NAT_NCPTE.length; ind01++){
            if ((CPTE_NAT_IDTITULAIRE[ind01] == DET_PAYS_IDPAYS) && (CPTE_NAT_DEVISE[ind01] == DET_PAYS_DEVISE)){
                ind2 = 1;
                if (DET_PAYS_CPTENAT == CPTE_NAT_NCPTE[ind01])
                    temp += "<OPTION selected=TRUE value='" + CPTE_NAT_NCPTE[ind01] + "'>" + CPTE_NAT_NOMCPTE[ind01] + "&nbsp;(&nbsp;" + CPTE_NAT_NCPTE[ind01] + "&nbsp;en&nbsp;" + CPTE_NAT_DEVISE[ind01] + ")&nbsp;&nbsp;";
                else
                    temp += "<OPTION value='" + CPTE_NAT_NCPTE[ind01] + "'>" + CPTE_NAT_NOMCPTE[ind01] + "&nbsp;(&nbsp;" + CPTE_NAT_NCPTE[ind01] + "&nbsp;en&nbsp;" + CPTE_NAT_DEVISE[ind01] + ")&nbsp;&nbsp;";
            }
        }
        temp += "</SELECT></td></tr>";
        
        temp += "<tr><td width='100'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='iduser' id='iduser'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='idpays' id='idpays'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='nompays' id='nompays'></td>";
        temp += "<td colspan='2'><INPUT type='hidden' name='devise' id='devise'></td></tr>";
        
        if ((ind1 > 0) && (ind2 > 0)){
            temp += "<tr><td width='200'><INPUT type=button name=valmodifetat value='Modifier' onclick='majetat();'></td>";
            temp += "<td></td>";
            temp += "</tr>";
        }
    }
    else
    {
    temp += "<tr>";
    temp += "</tr>";
    temp += "<tr>";
    temp += "<td class='textRouge'>Aucun droit</td>";
    temp += "<td width='100'></td>";
    temp += "</tr>";
    }
    
    
    temp += "</table>";
    
    temp += "</FORM>";
    
    $("#divModifEtat").html(temp);
    $("#divEtat").hide();
    $("#divModifEtat").show();
       
    $("#iduser").val(DET_PAYS_IDUSER);
    $("#idpays").val(DET_PAYS_IDPAYS);
    $("#nompays").val(DET_PAYS_NOMPAYS);
    $("#mleco").val(DET_PAYS_EMAILECO);
    $("#drapeau").val(DET_PAYS_DRAPEAU);
    $("#site").val(DET_PAYS_ADRSITE);
    $("#forum").val(DET_PAYS_ADRFORUM);
    $("#devise").val(DET_PAYS_DEVISE);
}

function Election(){
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' OnClick='AfficheEtat();'>&nbsp;Retour à la liste&nbsp;</a></CENTER>";
    temp += "</td></tr></table>";
    $("#tabcentrec").html(temp);
    
    temp = "<FORM name='electionetat1' method='post' action=''>";
    
    temp += "<table border='0' width='100%'>";

    temp += "<tr><td colspan='3' height='40' class='textGros'>Election du responsable</td></tr>";
    
    if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '5') || ((AUTORISATION.substring(1,2) <= '5') && (IDPAYS == DET_PAYS_IDPAYS))){
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Nom du pays :&nbsp;</td>";
        temp += "<td colspan='2'><b>" + DET_PAYS_NOMPAYS + "</b></td></tr>";
        
        temp += "<tr><td colspan='3'>";
        temp += "<CENTER><img src='" + DET_PAYS_DRAPEAU + "' width=100 height=80 alt=''></CENTER>";
        temp += "</td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Dernière élection :&nbsp;</td>";
        temp += "<td colspan='2'>" + DET_PAYS_DATEELEC + "</td></tr>";
        
        temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;</td>";
        temp += "<td colspan='2'></td></tr>";
        
        temp += "<tr>";
        temp += "<td colspan='3' class='textRouge'>Une fois l'élection lancée, le responsable perd ces droits. L'élection dure 7 jours pendant lesquels il n'y a plus de responsable. <br>";
        temp += "Cette élection ne peut être lancée qu'au moins 30 jours après la précédente.</td></tr>";
        
        temp += "<tr><td colspan='2'><INPUT type='hidden' name='iduser' id='iduser'></td></tr>";
        temp += "<tr><td colspan='2'><INPUT type='hidden' name='idpays' id='idpays'></td></tr>";
        temp += "<tr><td colspan='2'><INPUT type='hidden' name='dateelec' id='dateelec'></td></tr>";
        
        temp += "<tr><td width='200'></td>";
        temp += "<td colspan='2'><INPUT type=button name=valmajelec value='Lancer Election' onclick='majelec();'></td>";
        temp += "</tr>";
    }
    else{
        temp += "<tr>";
        temp += "</tr>";
        temp += "<tr>";
        temp += "<td class='textRouge'>Aucun droit</td>";
        temp += "<td width='100'></td>";
        temp += "</tr>";
    }
    
    temp += "</table>";
    
    temp += "</FORM>";
    
    $("#divElectionEtat").html(temp);
    $("#divVoteEtat").hide();
    $("#divElectionEtat").show();
    $("#divBesoinEtat").hide();
       
    $("#iduser").val(DET_PAYS_IDUSER);
    $("#idpays").val(DET_PAYS_IDPAYS);
    $("#dateelec").val(DET_PAYS_DATEELEC);

}

function Voter(){
    temp = "<table border='0' width='100%'><tr>";
    temp += "<td>";
    temp += "<CENTER><a href='#' OnClick='AfficheEtat();'>&nbsp;Retour à la liste&nbsp;</a></CENTER>";
    temp += "</td></tr></table>";
    $("#tabcentrec").html(temp);
    
    temp = "<FORM name='voteretat1' method='post' action=''>";
    
    temp += "<table border='0' width='100%'>";

    temp += "<tr><td colspan='3' height='40' class='textGros'>Voter pour l'élection du responsable</td></tr>";
    
    if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '5') || ((AUTORISATION.substring(1,2) <= '5') && (IDPAYS == DET_PAYS_IDPAYS))){
        temp += "<tr><td width='220' class='textBleu'>&nbsp;&nbsp;Nom du pays :&nbsp;</td>";
        temp += "<td colspan='2'><b>" + DET_PAYS_NOMPAYS + "</b></td></tr>";
        
        temp += "<tr><td colspan='3'>";
        temp += "<CENTER><img src='" + DET_PAYS_DRAPEAU + "' width=100 height=80 alt=''></CENTER>";
        temp += "</td></tr>";
        
        temp += "<tr><td width='220' class='textBleu'>&nbsp;&nbsp;</td>";
        temp += "<td colspan='2'></td></tr>";
        
        temp += "<tr><td width='220' class='textBleu'>&nbsp;&nbsp;Choix du Responsable :&nbsp;</td>";
        temp += "<td colspan='2'><SELECT name='chef' id='chef'>";
        for (ind01 = 0; ind01 < LIST_CIT_IDUSER.length; ind01++){
            if (DET_PAYS_IDPAYS == LIST_CIT_IDPAYS[ind01]){
                if (RESP == LIST_CIT_IDUSER[ind01])
                    temp += "<OPTION selected=TRUE value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
                else
                    temp += "<OPTION value='" + LIST_CIT_IDUSER[ind01] + "'>" + LIST_CIT_NOM[ind01] + "&nbsp;&nbsp;";
            }
        }
        temp += "</SELECT></td></tr>";
        
        
        temp += "<tr><td colspan='2'><INPUT type='hidden' name='iduser' id='iduser'></td></tr>";
        temp += "<tr><td colspan='2'><INPUT type='hidden' name='idpays' id='idpays'></td></tr>";
        
        temp += "<tr><td width='220'></td>";
        temp += "<td colspan='2'><INPUT type=button name=valvoterelec value='Voter !' onclick='voterelec();'></td>";
        temp += "</tr>";
    }
    else{
        temp += "<tr>";
        temp += "</tr>";
        temp += "<tr>";
        temp += "<td class='textRouge'>Aucun droit</td>";
        temp += "<td width='100'></td>";
        temp += "</tr>";
    }
    
    temp += "</table>";
    
    temp += "</FORM>";
    
    $("#divVoteEtat").html(temp);
    $("#divVoteEtat").show();
    $("#divElectionEtat").hide();
    $("#divBesoinEtat").hide();
    
    $("#iduser").val(DET_PAYS_IDUSER);
    $("#idpays").val(DET_PAYS_IDPAYS);
}

function Etat(){
    var temp;
    var ind01;

    temp = "<table border='0' width='100%'>";
//    temp += "<tr><td colspan='3' height='40'>&nbsp;D�tail d'un pays :</td></tr>";

    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Nom du pays :&nbsp;</td>";
    temp += "<td colspan='2'>" + DET_PAYS_NOMPAYS + "</td></tr>";

    temp += "<tr><td width='200' class='textBleu'>";
    temp += "<CENTER><a href='" + DET_PAYS_ADRSITE + "'><img src='" + DET_PAYS_DRAPEAU + "' width=100 height=80 alt=''></a></CENTER>";
    temp += "</td>";
    temp += "<td colspan='2'>" + DET_PAYS_ADRSITE + "</td>";
    temp += "</tr>";
    temp += "</td></tr>";

    temp += "<tr><td width='200' class='textBleu'>";
    temp += "<CENTER><a href='" + DET_PAYS_ADRFORUM + "'>Forum</a></CENTER>";
    temp += "</td>";
    temp += "<td colspan='2' class='textPetit'>" + DET_PAYS_ADRFORUM + "</td>";
    temp += "</tr>";

    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Responsable :&nbsp;</td>";
    temp += "<td colspan='2'>" + DET_PAYS_NOMUSER;
    temp += "</td></tr>";

    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Contrôle fiscal :&nbsp;</td>";
    temp += "<td colspan='2'>" + DET_PAYS_NOMCF;
    temp += "</td></tr>";

    temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Date d'entrée :&nbsp;</td>";
    temp += "<td colspan='2'>" + DET_PAYS_DATECREATE + "</td></tr>";

    temp += "</table>";

    $("#divEtat").html(temp);
    $("#divEtat").show();
    $("#divModifEtat").hide();
    
    temp = "<CENTER><table border='0' width='100%'>";

    temp += "<tr><td colspan='2' height='40' class='textGros'>Besoins</td></tr>";

    temp += "<tr height='10'><td colspan='2'><b>&nbsp;</b></td>";
    temp += "</tr>";

    for (ind01 = 0; ind01 < BES_ETAT_TYPE.length; ind01++){
        if (parseInt(BES_ETAT_QUANTITE[ind01]) > 0){
            temp += "<tr>";
            temp += "<td align=left>" + BES_ETAT_LIBTITULAIRE[ind01] + "</td>";
            temp += "<td align=right><a href='#' onclick='Besoin(" + ind01 + ");'>" + BES_ETAT_QUANTITE[ind01] + "&nbsp;" + BES_ETAT_LIBTYPEPRODUIT[ind01] + "</td>";
            temp += "</tr>";
        }
    }

    temp += "</table></CENTER>";

    $("#divBesoinEtat").html(temp);
    $("#divVoteEtat").hide();
    $("#divElectionEtat").hide();
    $("#divBesoinEtat").show();
}

function Besoin(i){
    var ind1 = 0;
    
    temp = "<FORM name='modifbesoin1' method='post' action=''>";
    
    if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '5') || ((AUTORISATION.substring(1,2) == '5') && (IDPAYS == DET_PAYS_IDPAYS))){
        
        if (BES_ETAT_TYPE[i] == 'CONS'){
            temp += "<table border='0' width='100%'>";
            
            temp += "<tr><td colspan='8' height='40' class='textGros'>Consomation</td></tr>";
            
            temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Besoin :&nbsp;</td>";
            temp += "<td colspan='2'><b>" + BES_ETAT_LIBTITULAIRE[i] + "&nbsp;&nbsp;--&nbsp;&nbsp;" + BES_ETAT_QUANTITE[i] + "&nbsp;" + BES_ETAT_LIBTYPEPRODUIT[i] + "</b></td></tr>";
            
            temp += "<tr><td colspan='3'>";
            temp += "</td></tr>";
            
            temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Choix :&nbsp;</td>";
            temp += "<td colspan='2'><SELECT name='identre' id='identre'>";
            for (ind01 = 0; ind01 < DET_STOC_IDENTRE.length; ind01++){
                if (DET_STOC_IDUNITE[ind01] == BES_ETAT_TYPEPRODUIT[i]){
                    ind1 = 1;
                    temp += "<OPTION value='" + DET_STOC_IDENTRE[ind01] + "'>" + DET_STOC_NOMENTRE[ind01] + "&nbsp;(&nbsp;" + DET_STOC_QUANTITE[ind01] + "&nbsp;en&nbsp;" + BES_ETAT_LIBTYPEPRODUIT[i] + ")&nbsp;&nbsp;";
                }
            }
            temp += "</SELECT></td>";
            
            temp += "</tr>";
            
            temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Quantité déduite :&nbsp;</td>";
            temp += "<td colspan='2'><INPUT type='text' name='nbdeduite' id='nbdeduite' size=4 align=right>&nbsp;&nbsp;" + BES_ETAT_LIBTYPEPRODUIT[i] + "</td></tr>";
            
            
            temp += "<tr><td width='100'></td>";
            temp += "<td><INPUT type='hidden' name='idpays' id='idpays'></td>";
            temp += "<td><INPUT type='hidden' name='idtitulaire' id='idtitulaire'></td>";
            temp += "<td><INPUT type='hidden' name='type' id='type'></td>";
            temp += "<td><INPUT type='hidden' name='typeproduit' id='typeproduit'></td>";
            temp += "<td><INPUT type='hidden' name='quantite' id='quantite'></td>";
            temp += "</tr>";
            
            if (ind1 > 0){
                temp += "<tr><td width='200'><INPUT type=button name=valmodifbesoin value='Consommer' onclick='majbesoin();'></td>";
                temp += "<td></td>";
                temp += "</tr>";
            }
            temp += "</table>";
            
            temp += "<br>";
            
            temp += "<table width='100%'>";
             temp += "<tr>";
            temp += "<td class='textRouge'>";
            
            temp += "Cet écran permet de déduire les besoins nationaux du stock d'une province ou d'une entreprise. Il ne s'agit pas d'achat il n'y a pas d'échange financier, le stock de la province ou de l'entreprise, comme celui des besoins, seront simplement diminués.";
            
            	temp += "<br>";
            temp += "<br>";
            
            temp += "=> Cet écran ne devrait donc pas être utilisé régulièrement. Il est là pour permettre la saisie de stock afin de combler les besoins nationaux dans des périodes de faible activité par exemple.";
            
            temp += "</td>";
             temp += "</tr>";
            temp += "</table>";
        }
    
        if (BES_ETAT_TYPE[i] == 'PROD'){
            temp += "<table border='0' width='100%'>";
            
            temp += "<tr><td colspan='8' height='40' class='textGros'>Affectation</td></tr>";
            
            temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Besoin :&nbsp;</td>";
            temp += "<td colspan='2'><b>" + BES_ETAT_LIBTITULAIRE[i] + "&nbsp;&nbsp;--&nbsp;&nbsp;" + BES_ETAT_QUANTITE[i] + "&nbsp;" + BES_ETAT_LIBTYPEPRODUIT[i] + "</b></td></tr>";
            
            temp += "<tr><td colspan='3'>";
            temp += "</td></tr>";
            
            temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Choix :&nbsp;</td>";
            temp += "<td colspan='2'><SELECT name='identre' id='identre'>";
            for (ind01 = 0; ind01 < ENTRE_IDENTRE.length; ind01++)
                temp += "<OPTION value='" + ENTRE_IDENTRE[ind01] + "'>" + ENTRE_NOMENTRE[ind01] + "&nbsp;&nbsp;";
            temp += "</SELECT></td></tr>";
            
            temp += "<tr><td width='200' class='textBleu'>&nbsp;&nbsp;Quantité générée :&nbsp;</td>";
            temp += "<td colspan='2'><INPUT type='text' name='nbdeduite' id='nbdeduite' size=4 align=right>&nbsp;&nbsp;" + BES_ETAT_LIBTYPEPRODUIT[i] + "</td></tr>";
            
            
            temp += "<tr><td width='100'></td>";
            temp += "<td><INPUT type='hidden' name='idpays' id='idpays'></td>";
            temp += "<td><INPUT type='hidden' name='idtitulaire' id='idtitulaire'></td>";
            temp += "<td><INPUT type='hidden' name='type' id='type'></td>";
            temp += "<td><INPUT type='hidden' name='typeproduit' id='typeproduit'></td>";
            temp += "<td><INPUT type='hidden' name='quantite' id='quantite'></td>";
            temp += "</tr>";
            
            if (ENTRE_IDENTRE.length > 0){
                temp += "<tr><td width='120'><INPUT type=button name=valmodifbesoin value='Affecter' onclick='majbesoin();'></td>";
                temp += "<td></td>";
                temp += "</tr>";
            }
            temp += "</table>";
            
            temp += "<br>";
            
            temp += "<table width='100%'>";
            temp += "<tr>";
            temp += "<td class='textRouge'>";
            
            temp += "Cet écran permet d'affecter les besoins nationaux du stock d'une province ou d'une entreprise. Il ne s'agit pas d'achat il n'y a pas d'échange financier, le stock de la province ou de l'entreprise, seront simplement augmentés.";
            
        	temp += "<br>";
        	temp += "<br>";
            
            temp += "=> Cet écran doit être utilisé chaque mois pour affecter les déchets aux provinces, afin qu'elles puissent les faire retraiter.";
            
            	temp += "<br>";
            
            temp += "Le choix d'une entreprise n'est par contre pas à user de manière courante. Le choix est laissé pour permettre le retraitement des déchets dans des périodes de faible activité par exemple.";
            
            temp += "</td>";
            temp += "</tr>";
            temp += "</table>";
        
        }
    }
    temp += "</FORM>";
    
    $("#divBesoinEtat").html(temp);
    $("#divVoteEtat").hide();
    $("#divElectionEtat").hide();
    $("#divBesoinEtat").show();
       
    $("#idpays").val(DET_PAYS_IDPAYS);
    $("#idtitulaire").val(BES_ETAT_IDTITULAIRE[i]);
    $("#type").val(BES_ETAT_TYPE[i]);
    $("#typeproduit").val(BES_ETAT_TYPEPRODUIT[i]);
    $("#quantite").val(BES_ETAT_QUANTITE[i]);

}

function RAZ_tout(){
  $("#tabcentrec").html("");
}
