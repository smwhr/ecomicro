<html>
<head>
    <title>Les capacités</title>

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
        <td width='200' class="texte3">
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>
        
        <td class="texte3">
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>
        <td class="texte3">
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>
        <td class="texte3">
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
            </CENTER>
            </div>
        </td>

        <td width='200' class="texte3">
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
            <div id="divJouer" class="margin5 menuAide boutonVert tailleDouble" onClick="gotoJouer();">Jouer !!</div>
        </td>
        <td valign=top width='100'>
            <div id="divPresentation" class="margin5 menuAide boutonOrange tailleSimple" onClick="gotoPresentation();">Présentation</div>
        </td>
        <td valign=top width='100'>
            <div id="divRegles" class="margin5 menuAide boutonMarron tailleSimple" onClick="gotoRegles();">Règles de Production</div>
        </td>
        <td valign=top width='100'>
            <div id="divSchema" class="margin5 menuAide boutonBlanc tailleSimple" onClick="gotoSchema();">Schéma bancaire</div>
        </td>
        <td valign=top width='100'>
            <div id="divPatron" class="margin5 menuAide boutonRouge tailleSimple" onClick="gotoPatron();">Etre un bon patron</div>
        </td>
        <td valign=top width='100' rowspan="2">
            <div id="divFAQ" class="margin5 menuAide boutonBleu tailleDouble" onClick="gotoFAQ();">FAQ - Comment faire...</div>
        </td>
    </tr>
    <tr>
        <td valign=top width='100'>
            <div id="divSysteme" class="margin5 menuAide boutonOrange tailleSimple" onClick="gotoSysteme();">Système économique</div>
        </td>
        <td valign=top width='100'>
            <div id="divCapacite" class="margin5 menuAide boutonMarron tailleSimple" onClick="gotoCapacite();">Les Capacités</div>
        </td>
        <td valign=top width='100'>
            <div id="divDonnees" class="margin5 menuAide boutonBlanc tailleSimple" onClick="gotoDonnees();">Données conseillées</div>
        </td>
        <td valign=top width='100'>
            <div id="divResp" class="margin5 menuAide boutonRouge tailleSimple" onClick="gotoResp();">Etre un Responsable</div>
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
                <div id="présentation" class="scroll-1">
  <br>
  <center>
  <b><FONT size=4>Les capacités</FONT></b>
  </center>

  <br>
  <br>
  <b>Détemination de la capacité de production mensuelle de chaque entreprise du primaire d'un pays</b> 
  <br>
  <br>
	Les ressources naturelles produites dans un pays sont limitées à un TOTAL NATIONAL MENSUEL de 100 unités x nombre de citoyens actifs.
	<br>
	Paralellement, chaque entreprise dispose de sa propre CAPACITE MENSUELLE MAX.
	<br>
	<br>
  Si la somme de toutes les capacités mensuelles max d'une nation excéde le total national mensuel, la CAPACITE REELLE DE PRODUCTION de toutes les entreprises du secteur primaire de cette nation est, pour le mois, réduite de manière à ce que la somme ne dépasse pas le total national mensuel.
	<br>
	<br>
  Si la somme de toutes les capacités mensuelles max d'une nation n'excéde pas le total national mensuel, la CAPACITE REELLE DE PRODUCTION des entreprises du secteur primaire de cette nation est, pour le mois, leur propre CAPACITE MENSUELLE MAX.
	<br>
	<br>
	Le tout est fixé lors de la permière connexion du mois.
	  <br>
  <br>
  <br>
  <b>Capacité de production, capactité totale, capacité du mois,...</b> 
  <br>
  <br>

Prenons un exemple :
  <br>
  <br>
Nb de citoyen du pays : 10
  <br>
Du coup la production mensuelle max pour le pays est de : 100 * 10 = 1000 Unités
  <br>
  <br>
Nb d'entreprise du secteur primaire : 15 
  <br>
10 avec une capacité de production de 100 unités par mois
  <br>
5 avec une capacité de production de 50 unités par mois
  <br>
Du coup la capacité totale de 1250 excéde le maximum autorisé de 1000.
  <br>
  <br>
Les entreprises de 100 auront alors une capacité du mois à 80 (100 * 1000 / 1250), et celle de 50 à 40. 
  <br>

  <br>
  <br>
Prenons un autre exemple :
  <br>
  <br>
Nb de citoyen du pays : 20
  <br>
Du coup la production mensuelle max pour le pays est de : 1000 * 20 = 2000 Unités
  <br>
  <br>
Nb d'entreprise du secteur primaire : 15 
  <br>
10 avec une capacité de production de 100 unités par mois
  <br>
5 avec une capacité de production de 50 unités par mois
  <br>
Du coup la capacité totale de 1500 est inférieure au maximum autorisé de 2000.
  <br>
  <br>
Les entreprises de 100 auront une capacité du mois de 100, et celle de 50 de 50 !
  <br>
Le reste est perdu.

  <br>
  <br>
  <br>

Au niveau du détail d'une société, 3 valeurs sont indiquées :
  <br>
&nbsp;&nbsp;- la capacité utilisée dans le mois
  <br>
&nbsp;&nbsp;- la capacité du mois
  <br>
&nbsp;&nbsp;- la capacité de production de l'entreprise

  <br>
  <br>
  <br>
  <b>Capacité conseillée</b>
  <br>
  <br>

EcoMicro conseille une taille spécifique pour chaque type d'entreprise bien que celle ci soit libre (étude d'une limitation en cours) :
  <br>
&nbsp;&nbsp;- Centrale Energétique : 70 PE
  <br>
&nbsp;&nbsp;- Ferme : 90 PA
  <br>
&nbsp;&nbsp;- Mine : 100 MP
  <br>
&nbsp;&nbsp;- Fabrique d'Objet : 400 P Objet
  <br>
&nbsp;&nbsp;- Fabrique de Machine : 200 P Machine
  <br>
&nbsp;&nbsp;- Constructeur de Véhicule : 200 P Véhicule
  <br>
&nbsp;&nbsp;- Restaurant : 100 PAL
  <br>
&nbsp;&nbsp;- Société du secondaire citoyen (ex : BTP) : 110 PP
  <br>
&nbsp;&nbsp;- Usine de retraitement : 100 PE
  <br>
&nbsp;&nbsp;- Distillerie : 50 P Alcool


  <br>
  <br>
  <br>
  <b>Co�t de construction</b>
  <br>
  <br>

Le coût de construction d'une entreprise dépend de la capacité de production et du type d'entreprise :
  <br>
  <br>
&nbsp;&nbsp;- <b>Entreprise du primaire</b> : le coût de construction s'élève à sa capacité en PP. (exemple une Centrale Energétique d'une capacité de production de 70, coûtera 70 PP).
  <br>
  <br>
&nbsp;&nbsp;- <b>Entreprise du secondaire</b> : le coût dépend de la capacité de production, mais vari en fonction des productions :
  <br>
  <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <b>Fabrique de Machine, Fabrique de Véhicule</b> : le coût est la capacité divisé par 2, en PP (une société de 200 P Véhicule coutera 100 PP) 
  <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <b>Fabrique d'Objet</b> : le coût est la capacité divisé par 4, en PP (une société de 400 P Objet coutera 100 PP) 
  <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <b>Secondaire citoyen, usine de retraitement, Restaurant</b> : le coût est la capacité en PP (une société de 100 PAL ou 100 PP coutera 100 PP) 
  <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <b>Distillerie</b> : le coût est la capacité multipliée par 2 en PP (une société de 50 P Alcool coutera 100 PP) 



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