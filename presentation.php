<html>
<head>
    <title>Présentation EcoMicro</title>

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
  <b><FONT size=4>Présentation</FONT></b>
  </center>

  <br>
  <br>

  <b>EcoMicro</b> permet une gestion simplifiée du domaine financier et économique d'une nation virtuelle.
  Pour ce faire il centralise les fonctions d'<b>inventaire</b>, de <b>banque</b>, de <b>gestion de production</b> et de <b>gestion des relations économiques</b> entre les états membres.
  <br>
  Il offre la possibilité à chaque état membre de déterminer le <b>taux de change</b> de sa monnaie par rapport aux autres, ainsi qu'un niveau de <b>taxe par type de produit</b>.
  Ainsi le jeu diplomatique-économique peut s'exprimer.
  <br>
  <br>
  Afin de laisser la part belle aux échanges entre joueurs, le tarif des produits n'est pas définit et doit être négocié préalablement à chaque achat.
  Suite à cette <b>négociation</b>, l'acheteur effectue une proposition qui doit être <b>validée par le vendeur</b> pour être réalisée.
  <br>
   <br>
 
   <b>Accès et Droits</b>
   <br>
   L'accès s'effectue au niveau 'Citoyen'.
   A partir de son accès chaque citoyen peut agir sur les données qu'il gère, <b>personnelles et professionnelles</b>, comme créer des comptes bancaires, mettre en vente un nouveau produit, effectuer un achat ou une transaction financière.
   <br>
   <br>
   Chaque nation est gérée par un <b>responsable économique</b>.
   Ce responsable a la possibilité de modifier les paramètres de l'état, de créer des sociétés, d'ajouter des citoyens.
   De plus il a la vision de l'ensemble des comptes bancaires.
 
   <br>
   <br>
 
   <b>Le système bancaire</b>
   <br>
   Chaque utilisateur (citoyen enregistré) ainsi que chaque entité économique (entreprise, province) disposent d'un ou plusieurs comptes bancaires.
   <br>
   <br>
   Les <b>transactions financières</b> s'opèrent par simple choix des comptes Origine et Destinataire et la saisie du montant.
   S'applique alors si nécessaire le <b>taux de change</b> entre les deux devises, selon un processus déterminé et commun expliqué par ce <a href="schema_bancaire.php">schéma</a>.
   <br>
   L'achat de produits ou de stocks génère des transactions qui suivent le même processus enrichi de la prise en compte de la taxe définie par le responsable de la nation acheteuse.
 
 
   <br>
   <br>
 
   <b>La gestion de production</b>
   <br>
   Une <b>très grande souplesse</b> a été implémentée afin de laisser à chaque nation l'initaitive dans ce domaine et permettre l'utilisation de cet outil par un maximum de pays différents.
   La seule contrainte pour proposer un nouveau produit est de lui affecter une valeur et une matière, correspondant à son <b>coût de production</b>.
   Le produit est virtuel, seules sa valeur et sa matière importent.
   <br>
   Fabriquer un produit, revient à disposer de la quantité de matière déterminée.
   Pour ce faire il est possible d'acheter directement la matière ou de transformer d'autres matières selon des <a href="regles.php">règles de production</a>.
   <br>
   <br>
   Chaque pays détermine comme il l'entend le coût de production des produits qu'il autorise à fabriquer.
   EcoMicro ne contrôle pas la cohérence de ce coût, ni si le produit est autorisé, c'est au responsable économique de la nation de le faire.
 
   <br>
   <br>
 
   Bien entendu, pour que des échanges entre nations soient équitables, il est nécessaire que les méthodes de définition du coût de production soient comptatibles.
 
   <br>
   <br>
 
   <b>La gestion des relations économiques</b>
   <br>
   <b>EcoMicro</b> rassemble des nations aux règles économiques qui peuvent être très variées et pas forcément comptatibles ou cohérentes les une avec les autres.
   Pour que ce choix ne soit pas pénalisant, chaque pays peut cacher les données d'un autre état (il devient comme invisible ou inexistant), ou simplement empécher les échanges commerciaux.
   <br>
   <br>
   Certaines valeurs de paramétrage, comme le taux de change, ont un impact très important sur les transactions.
   Afin de garantir la pertinence de ces paramètres, les modifications crutiales nécessitent une validation de l'autre partie.
 
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