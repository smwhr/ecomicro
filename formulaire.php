<html>
<head>
    <title> Economie du Micromonde - </title>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>
    
<script language="javascript" type="text/javascript">

function gotoJouer(){
    $('#page-loader').show();
    $tmp = "vosdonnees.php";
    document.location.replace($tmp);
}
function gotoPresentation(){
    $('#page-loader').show();
    $tmp = "presentation.php";
    document.location.replace($tmp);
}
function gotoRegles(){
    $('#page-loader').show();
    $tmp = "regles.php";
    document.location.replace($tmp);
}
function gotoSchema(){
    $('#page-loader').show();
    $tmp = "schema_bancaire.php";
    document.location.replace($tmp);
}
function gotoPatron(){
    $('#page-loader').show();
    $tmp = "patron.php";
    document.location.replace($tmp);
}
function gotoFAQ(){
    $('#page-loader').show();
    $tmp = "comment.php";
    document.location.replace($tmp);
}
function gotoSysteme(){
    $('#page-loader').show();
    $tmp = "systeme_eco.php";
    document.location.replace($tmp);
}
function gotoCapacite(){
    $('#page-loader').show();
    $tmp = "capacite.php";
    document.location.replace($tmp);
}
function gotoDonnees(){
    $('#page-loader').show();
    $tmp = "conseils.php";
    document.location.replace($tmp);
}
function gotoResp(){
    $('#page-loader').show();
    $tmp = "responsable.php";
    document.location.replace($tmp);
}
function gotoForum(){
    $('#page-loader').show();
    $tmp = "http://forum.micromonde.net";
    document.location.replace($tmp);
}

</script>        
</head>

<body onload="$('#page-loader').hide();" style="background-color:#E0E0E0;">

<div id="page-loader">  
    <div id="loading-mask" style=""></div>
    <div id="loading">
        <div id="loading-ind" class="loading-indicator" style="width:250px;">
            <CENTER>
            <span id="loading-titre">EcoMicro&trade;</span>
            <br><br><br>
            <img id="loading-image" src="obj/wait1.gif" width="64" height="64"/>
            <br><br><br>
            <span id="loading-msg">Chargement en cours.</span>
            <br>
            <span id="loading-msg">Veuillez patienter...</span>
            </CENTER>
        </div>
    </div>
</div>

<CENTER><div style="width:1300px;">
<table width='100%'>
    <tr>
        <td width='200'>
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>
        
        <td>
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>
        <td>
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>
        <td>
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>

        <td width='200'>
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>
    </tr>
</table>

<table width='100%'>
    <tr>
        <td valign=top width='100' rowspan="2">
            <div id="divJouer" class="menuAide  boutonVert tailleDouble" onClick="gotoForum();">Forum</div>
        </td>
        <td valign=top width='100'>
            <div id="divPresentation" class="menuAide boutonOrange tailleSimple" onClick="gotoPresentation();">Présentation</div>
        </td>
        <td valign=top width='100'>
            <div id="divRegles" class="menuAide boutonMarron tailleSimple" onClick="gotoRegles();">Règles de Production</div>
        </td>
        <td valign=top width='100'>
            <div id="divSchema" class="menuAide boutonBlanc tailleSimple" onClick="gotoSchema();">Schéma bancaire</div>
        </td>
        <td valign=top width='100'>
            <div id="divPatron" class="menuAide boutonRouge tailleSimple" onClick="gotoPatron();">Etre un bon patron</div>
        </td>
        <td valign=top width='100' rowspan="2">
            <div id="divFAQ" class="menuAide boutonBleu tailleDouble" onClick="gotoFAQ();">FAQ - Comment faire...</div>
        </td>
    </tr>
    <tr>
        <td valign=top width='100'>
            <div id="divSysteme" class="menuAide boutonOrange tailleSimple" onClick="gotoSysteme();">Système économique</div>
        </td>
        <td valign=top width='100'>
            <div id="divCapacite" class="menuAide boutonMarron tailleSimple" onClick="gotoCapacite();">Les Capacités</div>
        </td>
        <td valign=top width='100'>
            <div id="divDonnees" class="menuAide boutonBlanc tailleSimple" onClick="gotoDonnees();">Données conseillées</div>
        </td>
        <td valign=top width='100'>
            <div id="divResp" class="menuAide boutonRouge tailleSimple" onClick="gotoResp();">Etre un Responsable</div>
        </td>
    </tr>
</table>

<table width='100%'>
    <tr>
         <td valign=top width='200'>
            <CENTER>
                <div class="margin5 padding5"> 
                    <img src="obj/people_6.jpg" alt="logo EcoMicro" width="200" height="290" />
                </div>
            </CENTER>
    	</td>

        <td valign=top>
            <div class="cadrePrincipal">
                <div id="présentation">

<br>


                    <BR>
                    <FONT color=red>
                        Mon hébergement arrive à échéance. Au vue de son coût et de ma disponibilité pour poursuivre les travaux sur la v2, il est très probable que je ferme Ecomicro (v1 et v2) ainsi que ce forum. Cela devrait intervenir fin de semaine prochaine. Je tacherais, comme je l'avais déjà fait, de mettre à disposition avant la fermeture une copie de la base de données et des sources de la v1.
                        <BR>Ce fut pour ma part une belle aventure que de développer Ecomicro et j'espère au fond de moi pouvoir un jour reprendre les travaux.
                        <BR>Yoann G.
                    </FONT>
                    <BR>


<h3>Veuillez vous identifier, svp :</h3>

<form method="post" action="verif.php">

   Identifiant :         <input type="text" name="login">

   Mot de passe:         <input type="password" name="password">

       <input type="hidden" name="retour" value="<?php echo $_GET['retour'] ;?>">

       <input type="submit" name="Submit" value="Ok">

</form>

  <br>    

<ul>
   <li>Vous devez vous identifiez à l'aide de votre login et de votre mot de passe.
        Ces informations vous ont été transmises lors de votre inscription.</li>
    <li>Vous avez la possibilité de récupérer votre mot de passe dans l'éventualité où vous l'auriez oublié.</li>
<br>
<br>
<!--    <li><font color=green>Une démo ? Oui : demo / demo. Bonne visite et venez nous rejoindre !</font></li>	-->
<br>
<br>
    <li>Une question ? Un bug ? allez sur <a href="http://forum.micromonde.net">notre Forum</a>.</li>

</ul>

<br>

<h4>Un oubli ? Une solution !</h4>

<form method="post" action="gestion/mdp.php">
   Identifiant :         <input type="text" name="login">
    <input type="submit" name="Submit" value="Envoyez moi mon mot de passe">
</form>


                </div>
            </div>
        </td>

        <td valign=top width='200'>
            <CENTER>
                <div class="margin5 padding5"> 
                    <img src="obj/business_1.jpg" alt="logo EcoMicro" width="200" height="290" />
                </div>
            </CENTER>
    	</td>
    </tr>
</table>

</div></CENTER>

</body>
</html>