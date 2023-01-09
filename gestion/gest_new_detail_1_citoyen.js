
function AfficheCitoyen(){
    RAZ_tout();
    Profil();
    Directions();
    Possessions();
    Comptes();
    Titres();
}

function Profil(){
    temp = "<table border='0' width='100%' class='textPetit'>";

    temp += "<tr>";
    
    temp += "<td valign=top border='0'>";
    temp += "<CENTER><FONT size=2>" + DET_CIT_NOM + "</FONT></CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td width='120' valign=center border='0'>";
    temp += "<CENTER><img src='" + DET_CIT_PORTRAIT + "' width=100 height=80 alt=''></CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td valign=top border='0'>";
    temp += "<CENTER><b>" + DET_CIT_NOMPAYS + "</b></CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "</table>";

    $("#enteteg").html(temp);

    temp = "<table border='0' width='100%' class='textPetit'>";

    temp += "<tr>";
    
    temp += "<td valign=top border='0'>";
    temp += "<CENTER>" + DET_CIT_ADR + "</CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td width='120' valign=center border='0'>";
    temp += "<CENTER>" + DET_CIT_PROVINCE + "</CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td valign=top border='0'>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td valign=top border='0'>";
    temp += "<CENTER>Arrivée le " + DET_CIT_DCREATE + "</CENTER>";
    temp += "</td>";
    temp += "</tr>";
    
    temp += "<tr>";
    temp += "<td valign=top border='0'>";
    temp += "<CENTER>Email : " + DET_CIT_EMAIL + "</CENTER>";
    temp += "</td>";

    temp += "</tr></table>";

    $("#enteted").html(temp);

}


function Directions(){

    temp = "<table border='0' width='100%'>";
    temp += "<tr align=left>";
    
    for (ind01 = 0; ind01 < DET_CIT_LENTRE_IDENTRE.length; ind01++){
        temp += "<td width='120'><CENTER>";
    	temp += "<div class='direction margin5' onclick='DetailEntreprise(" + DET_CIT_LENTRE_IDENTRE[ind01] + ");'><span class='textDirection'>" + DET_CIT_LENTRE_NOMENTRE[ind01] + "</span></div>";
        temp += "</CENTER></td>";
        if (((ind01+1)%4 == 0)){
            temp += "</tr><tr>";
        }
    }
    if (DET_CIT_LENTRE_IDENTRE.length == 0)
          temp += "<FONT color=red>Aucune direction</FONT>";

    temp += "</td></tr></table>";

    $("#divDir").html(temp);
}


function Possessions(){
    temp = "<CENTER><table border='0' width='100%' class='textPetit'>";

    for (ind01 = 0; ind01 < DET_CIT_LPOSS_IDPOSS.length; ind01++){
        temp += "<tr>";

        if ((DET_CIT_LPOSS_ETAT[ind01] == '0') && (DET_CIT_LPOSS_TYPEEQUI[ind01] != '20000'))        {    
            temp += "<td width='100'><b><a href='#' onclick='Vendre(" + ind01 + ");'>Vendre aux PA</a></b>";
            temp += "<br><b><a href='#' onclick='Supprimer(" + ind01 + ");'>Consommer</a></b></td>";
        }
        else if ((DET_CIT_LPOSS_ETAT[ind01] == '0') && (DET_CIT_LPOSS_TYPEEQUI[ind01] == '20000'))
        {
            temp += "<td width='100'><b><a href='#' onclick='Vendre(" + ind01 + ");'>Vendre aux PA</a></b>";
            temp += "<br><b><a href='#' onclick='Louer(" + ind01 + ");'>Mettre Location</a></b>";
            temp += "<br><b><a href='#' onclick='Supprimer(" + ind01 + ");'>Consommer</a></b></td>";
        }
        else if (DET_CIT_LPOSS_ETAT[ind01] == '1')
            temp += "<td width='100'><b><a href='#' onclick='RetirerVendre(" + ind01 + ");'>Retirer des PA</a></b></td>";
        else if (DET_CIT_LPOSS_ETAT[ind01] == '2')
            temp += "<td width='100'><b><a href='#' onclick='RetirerLouer(" + ind01 + ");'>Retirer Location</a></b></td>";
        else if ((DET_CIT_LPOSS_ETAT[ind01] == '3') && (DET_CIT_LPOSS_PRO[ind01] == 'a'))
            temp += "<td width='100'><b>En Location</b></td>";
        else if ((DET_CIT_LPOSS_ETAT[ind01] == '3') && (DET_CIT_LPOSS_PRO[ind01] == 'b'))
            temp += "<td><b><a href='#' onclick='StopperLouer(" + ind01 + ");'>Stopper Location <br>(n'oubliez pas la transaction)</a></b></td>";

        temp += "<td width='200'><CENTER>" + DET_CIT_LPOSS_NOMTYPE[ind01] + "<br><b>" + DET_CIT_LPOSS_NOMPRODUIT[ind01] + "</b><br>" + DET_CIT_LPOSS_ADR[ind01] + ",&nbsp;" + DET_CIT_LPOSS_ADR_PROVINCE[ind01] + "</CENTER></td>";
        temp += "<td width='200'><CENTER><img src='" + DET_CIT_LPOSS_IMAGE[ind01] + "' width=200 height=100 align=top alt=''></CENTER></td>";
        temp += "<td width='100'><CENTER>" + DET_CIT_LPOSS_NBUNITE[ind01] + "&nbsp;" + DET_CIT_LPOSS_NOMUNITE[ind01] + "</CENTER></td>";
        temp += "</tr>";
    }

    temp += "</table>";
    
    if (ind01 == 0)
        temp = "Aucune possession.";

    $("#possessions").html(temp);
}

function Comptes(){
    temp = "<CENTER><table border='0' width='100%'>";
    
    temp += "<tr class='textGras' height='30'><td width='80'><CENTER><b>N° Compte</b></CENTER></td>";
    temp += "<td width='170'><CENTER><b>Nom</b></CENTER></td>";
    temp += "<td width='80'><CENTER><b>Solde</b></CENTER></td>";
    temp += "</tr>";
    
    var a = 0;
    var b = 0;

    for (ind01 = 0; ind01 < DET_CIT_CPT_IDCPTE.length; ind01++)    {
        a++;
        b = a%2;
        if (b == 0)
            temp += "<tr class='tr1 textPetit'>";
        else
            temp += "<tr class='tr2 textPetit'>";

        temp += "<td width='80' class='padding2'><CENTER><a href='#' Onclick='DetailCompte(" + DET_CIT_CPT_IDCPTE[ind01] + ");'>" + DET_CIT_CPT_IDCPTE[ind01] + "</a></CENTER></td>";
        temp += "<td width='170' class='padding2'><CENTER>" + DET_CIT_CPT_NOMCPTE[ind01] + "</CENTER></td>";
        temp += "<td align=right width='80' class='padding2'>" + format("#,##0.", DET_CIT_CPT_SOLDE[ind01]) + "&nbsp;" + DET_CIT_CPT_DEVISE[ind01] + "</td>";
        temp += "</tr>";
    }

    temp += "</table>";

    if (ind01 == 0)
        temp = "Aucun compte géré...";
    
    $("#divComptes").html(temp);
}


function Titres(){
    temp = "<CENTER><table border='0' width='100%'>";
    
    temp += "<tr class='textGras' height='30'><td width='200'><CENTER><b>Entreprise</b></CENTER></td>";
    temp += "<td width='100'><CENTER><b>Nb titre</b></CENTER></td>";
    temp += "</tr>";

    var a = 0;
    var b = 0;

    for (ind01 = 0; ind01 < DET_CIT_TITRE_IDENTRE.length; ind01++)    {
        a++;
        b = a%2;
        if (b == 0)
            temp += "<tr class='tr1 textPetit'>";
        else
            temp += "<tr class='tr2 textPetit'>";

        temp += "<td class='padding2'><CENTER><a href='#' Onclick='DetailEntreprise(" + DET_CIT_TITRE_IDENTRE[ind01] + ");'>" + DET_CIT_TITRE_NOMENTRE[ind01] + "</a></CENTER></td>";
        temp += "<td align=right class='padding2'>" + format("#,##0.", DET_CIT_TITRE_NB[ind01]) + "</td>";
        temp += "</tr>";
    }

    temp += "</table>";

    if (ind01 == 0)
        temp = "Aucun titres possédés...";

    $("#divTitres").html(temp);
}

function DetailEntreprise(entre){
    $('#page-loader').show();
    $tmp = "new_detail_1_entreprise.php?entreprise=" + entre;
    document.location.replace($tmp);
}

function DetailCompte(cpte){
    $('#page-loader').show();
    $tmp = "compte_gere.php?cpte=" + cpte;
    document.location.replace($tmp);
}

function Vendre(poss){
    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_CIT_LPOSS_IDPOSS[poss]);
    $("#etat").val(1);

    majvendreposs();
}

function Supprimer(poss){
    if (confirm("Voulez vous consommer (supprimer) ce produit ?")){
        temp = "<FORM name='vendreposs' method='post' action=''>";

        temp += "<INPUT type='hidden' name='poss' id='poss'>";
        temp += "<INPUT type='hidden' name='etat' id='etat'>";

        temp += "</FORM>";

        $("#data_hide").html(temp);

        $("#poss").val(DET_CIT_LPOSS_IDPOSS[poss]);
        $("#etat").val(9);

        majvendreposs();
    }
}

function Louer(poss){
    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_CIT_LPOSS_IDPOSS[poss]);
    $("#etat").val(2);

    majvendreposs();
}

function RetirerVendre(poss){
    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_CIT_LPOSS_IDPOSS[poss]);
    $("#etat").val(0);

    majvendreposs();
}

function RetirerLouer(poss){
    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_CIT_LPOSS_IDPOSS[poss]);
    $("#etat").val('0');

    majvendreposs();
}

function StopperLouer(poss){
    temp = "<FORM name='vendreposs' method='post' action=''>";

    temp += "<INPUT type='hidden' name='poss' id='poss'>";
    temp += "<INPUT type='hidden' name='etat' id='etat'>";

    temp += "</FORM>";

    $("#data_hide").html(temp);

    $("#poss").val(DET_CIT_LPOSS_IDPOSS[poss]);
    $("#etat").val('2');

    majvendreposs();
}

function RAZ_tout(){
    $("#possessions").html("");
    $("#divDir").html("");
    $("#divDir").hide();
    $("#divComptes").html("");
    $("#divTitres").html("");
    $("#divTitres").hide();
    $('#page-loader').hide();
}


