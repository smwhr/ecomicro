function AfficheActivite(){
    Rapport();
}


function Rapport(){
    var temp;
    var ind01;

    temp = "<table border='0' width='100%'>";
//    temp += "<tr><td colspan='3' height='40'>Rapport économique</td></tr>";
    
    temp += "<tr><td colspan='3' height='40' class='textGros'>&nbsp;" + RAPP_NOMPAYS + "</td></tr>";

    temp += "<tr><td width='250' class='textBleu'>";
    temp += "&nbsp;&nbsp;Masse Monétaire : ";
    temp += "</td>";
    temp += "<td colspan='2' align=right>" + format("#,##0.", MASS_TTMASSE) + "&nbsp;&nbsp;" + RAPP_DEVISE + "</td>";
    temp += "</tr>";

    temp += "<tr><td width='250' class='textBleu'>";
    temp += "&nbsp;&nbsp;Total contrôlé par l'étranger : ";
    temp += "</td>";
    temp += "<td colspan='2' align=right>" + format("#,##0.", MASS_TTDEVISE) + "&nbsp;&nbsp;" + RAPP_DEVISE + "</td>";
    temp += "</tr>";

    temp += "</table>";

    $("#rapport").html(temp);

}

