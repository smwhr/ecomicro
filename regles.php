<html>
<head>
    <title>Règles de production</title>

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
                <div id="presentation" class="scroll-1">
  <br>
  <center>
  <b><FONT size=4>Règles de production</FONT></b>
  </center>

  <br>
  <br>
  <br>
  <br>

  <b>Point d'Energie - PE</b>
  <br>
  <br>
&nbsp;&nbsp;7 PE <= 2 P Objet + 1 P Machine
  <br>
  <br>
Les Points d'Energie sont la production des Centrales Energétiques.

  <br>
  <br>
  <br>
  <br>
  <b>Produit Almientaire basique - PA</b>
  <br>
  <br>
&nbsp;&nbsp;9 PA <= 4 P Objet + 1 P Véhicule
  <br>
  <br>
Les Produits Alimentaire sont la production des Fermes.

  <br>
  <br>
  <br>
  <br>
  <b>Matière Première - MP</b>
  <br>
  <br>
&nbsp;&nbsp;10 MP + 1 PDt <= 1 PE + 2 P Machine + 1 P Véhicule 
  <br>
  <br>
Les Matières Premières sont la production des Mines.

  <br>
  <br>
  <br>
  <br>
  <b>Point Objet - P Objet</b>
  <br>
  <br>
&nbsp;&nbsp;80 P Objet + 1 PDt <= 2 PE + 6 MP + 4 P Machine + 2 P Véhicule + 1 PAL + 2 P Alcool 
  <br>
  <br>
Les Points Objet sont la production des Fabriques d'Objet.
  <br>
  <br>
Ces unités représentent les besoins en outils et divers objets des différentes productions.
  <br>
  <br>
  <br>
  <br>
  <b>Point de Machine - P Machine</b> 
  <br>
  <br>
&nbsp;&nbsp;40 P Machine + 3 PDt <= 4 PE + 8 MP + 10 P Objet + 2 P Véhicule + 1 PAL + 2 P Alcool 
  <br>
  <br>
Les Points de Machine sont la production des Fabriques de Machine.
  <br>
  <br>
Ces unités représentent les besoins en machines des différentes productions.

  <br>
  <br>
  <br>
  <br>
  <b>Point de Véhicule - P Véhicule</b> 
  <br>
  <br>
&nbsp;&nbsp;40 P Véhicule + 4 PDt <= 2 PE + 8 MP + 14 P Objet + 6 P Machine + 1 PAL + 2 P Alcool 
  <br>
  <br>
Les Points de Véhicules sont la production des Constructeurs de Véhicule.
  <br>
  <br>
Ces unités représentent les besoins en véhicules des différentes productions.

  <br>
  <br>
  <br>
  <br>
  <b>Produit Alimentaire de Luxe - PAL</b> 
  <br>
  <br>
&nbsp;&nbsp;20 PAL <= 1 PE + 10 PA + 4 P Alcool 
  <br>
  <br>
Les Produits Alimentaires de Luxe sont la production des Restaurants.
  <br>
  <br>
  <br>
  <br>
  <b>Point d'Production - PP</b> 
  <br>
  <br>
&nbsp;&nbsp;20 PP + 1 PDt <= 2 PE + 4 MP + 4 P Objet + 2 P Machine + 4 P Véhicule + 1 PAL + 1 P Alcool 
  <br>
  <br>
Les Points d'Production sont la production : 
  <br>
&nbsp;&nbsp;des entreprises de BTP
  <br>
&nbsp;&nbsp;des entreprises de ???
  <br>
&nbsp;&nbsp;des entreprises de ???
  <br>
  <br>
  <br>
 <br>
  <b>Point d'Energie recyclé - PE</b> 
  <br>
 <br>
&nbsp;&nbsp;20 PE <= 1 PE + 4 P Machine + 2 P Véhicule + 1 PAL + 30 PDt 
  <br>
  <br>
Les Points d'Production sont la production des entreprises de Retraitements.
  <br>
  <br>
  <br>
  <br>
  <br>
  <b>Point d'Alcool - P Alcool</b> 
  <br>
  <br>
&nbsp;&nbsp;5 P Alcool <= 4 PA 
  <br>
  <br>
Les Points d'Alcool sont la production des Distilleries.
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