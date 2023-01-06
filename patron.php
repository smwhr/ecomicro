<html>
<head>
    <title>EcoMicro - Etre un bon patron</title>

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
                </BR>
                NKWeb, Kaora 2013
            </CENTER>
            </div>
        </td>
        
        <td class="texte3">
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
                </BR>
                NKWeb, Kaora 2013
            </CENTER>
            </div>
        </td>
        <td class="texte3">
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
                </BR>
                NKWeb, Kaora 2013
            </CENTER>
            </div>
        </td>
        <td class="texte3">
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
                </BR>
                NKWeb, Kaora 2013
            </CENTER>
            </div>
        </td>

        <td width='200' class="texte3">
            <div class="margin5 logo">
            <CENTER>
                <a href="index.php">
                    <img src="obj/logo.gif" alt="logo">
                </a>
                </BR>
                NKWeb, Kaora 2013
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
  <b><FONT size=4>Etre un bon patron</FONT></b>
  </center>

  <br>
  <br>
  Vous êtes patron. Toutes mes félicitions !
  <br>
  Quelques petits conseils afin de ne vous laisser bouffer par ces bêtes assoiffées d'argent que sont les businessmen.
  <br>
  <br>
  Vous devez vous connecter à EcoMicro.
  <br>
  <br>
  <br>
    <li>Savoir ce que vous produisez et ce que vous avez besoin</b> 
    <li>Acheter des ressources</b> 
    <li>Produire des ressources pour les autres</b> 
    <li>Produire des produits en tout genre</b> 
    <li>Vendre</b> 
    <li>Payer les impôts et se versé un salaire bien mérité</b> 
  <br>
  <br>
  <br>
  <b>Savoir ce que vous produisez et ce que vous avez besoin</b>
  <br>
  <br>
  Vous avez deux solutions pour conna�tre quelles ressources sont n�cessaires pour produire un type d'unit� :
  <br>
  <br>
  - Dans le premier menu 'EcoMicro', via le choix 'Aide aux utilisateurs', cliquez sur '<a href="regles.php">R�gles de production</a>'. 
   <br> 
 <br>
  - Cliquer sur votre entreprise, via le choix 'Entreprises' que vous trouverez dans le menu 'Tout en D�tail', ou depuis l'�cran 'Vos Donn�es'.
  Vous arrivez alors sur un �cran pr�sentant votre enteprise. Vous avez une liste d'actions possibles, dont l'une qui s'appelle 'Stock/Productions'. 
  Cliquez dessus pour acc�der � l'<b>�cran de production de votre entreprise</b>.
  <br>
  <br>
  <CENTER><img src="obj/ecr_1detail_entreprise.gif"></CENTER>
  <br>
  <br>
  En s�lectionnant sur l'une des productions possibles, vous voyez apparaitre les ressources et la quantit� n�cessaire pour produire une certaine quantit� d'unit�s.
  <br>
  <br>
  <br>
  <br>
  <b>Acheter des ressources</b>
  <br>
  <br>
  Nous avons vu comment savoir ce que vous produisez et surtout ce qu'il vous est utile pour le produire.
  Nous allons maintenant voir comment achetez.
  <br>
  <br>
  Sur l'�cran de d�tail de votre entreprise vous avez au centre dans un lien 'Achat de stocks'. 
  Cliquer dessus.
  <br>
  Vous pouvez y acc�der via le menu de droite 'Achat Transaction', en cliquant sur 'Achat de stocks'.
  <br>
  <br>
  <CENTER><img src="obj/ecr_achat_stock.gif"></CENTER>
  <br>
  <br>
  Choisissez votre fournisseur en selectionnant le type d'unit� recherch� et cliquez dessus pour lui faire une proposition d'achat.
  <br>
  <br>
  <CENTER><img src="/obj/ecr_achat_1stock.gif"></CENTER>
  <br>
  <br>
  Il vous reste � choisisir le compte de l'acheteur (vous), celuidu vendeur, le nombre d'unit� souhait� et le prix unitaire propos�.
  <br>
  Cliquez ensuite sur calculer.
  <br>
  <br>
  Avant de cliquer sur Proposer, une petite relecture et go.
  <br>
  <br>
  Comme vous le voyez vous faites une proposition d'achat. Cette proposition doit �tre valid�e par le vendeur pour �tre effective.
  C'est seulement � ce moment que votre compte sera d�bit� et votre stock augment� du nombre d'unit� demand�.
  <br>
  <br>
  Renouveler l'op�ration pour chacun de vos achats.
  <br>
  <br>
  <br>
  <br>
  <b>Produire des ressources pour les autres</b>
  <br>
  <br>
  Votre stock est plein, voyons comment produire.
  Allez sur l'�cran de d�tail de votre entreprise (Cf. plus haut).
  <br>
  <br>
  <CENTER><img src="obj/ecr_1detail_entreprise.gif"></CENTER>
  <br>
  <br>
  De nouveau, s�lectionnez l'unit� de stock que vous souhaitez produire. 
  <br>
  Renseignez la quantit� d�sir�e. Et cliquez sur le bouton Donne pour visualiser combien de ressources vont �tre consomm�es.
  <br>
  Enfin, cliquez sur Lancer la production.
  <br>
  La production est directement ajout�e � votre stock (les ressources consomm�es d�duites).
  <br>
  <br>
  Simple non ?!
  <br>
  <br>
  <br>
  <br>
  <b>Produire des produits en tout genre</b>
  <br>
  <br>
  Et l� vous vous dites que produire des PE, PAL ou PMachin, c'est bien mais pas cool et que vous ce qui vous int�resse c'est de fabriquer des voitures de sport ou de la hifi.
  <br>
  Et bien relax, c'est possible :)
  <br>
  <br>
  Tout d'abord sachez que le type de produit que vous pouvez fabriquer d�pend du type d'unit� que vous produisez :
  <br>
  <br>
  - Les constructeurs de v�hicule produisent des PV�hicule et pourront produire tout type de v�hicule (bateau, avions, cabriolet, moto, quad...).
  <br>
  <br>
  - Les fabriques d'objets produisent des PObjet et pourront produire n'importe quel type de produit de faible technologie (v�tements, meubles, gadgets, ballons...).
  <br>
  <br>
  - Les fabriques de machines produisent des PMachine et pourront eux produire n'importe quel type de produit de plus forte technologie (hifi, electromenager, informatique...).
  <br>
  <br>
  - Les entreprises de BTP (B�timents et Travaux Publiques) produisent des PP et pourront fabriquer des immeubles, maisons, usines...
  <br>
  <br>
  Les autres entreprises ne peuvent pas produire � l'heure actuelle autre chose que leur unit� de stock. 
  Toutefois, EcoMicro �tant un outil assez souple, il est possible de rem�dier � cela sur simple demande et �tude de la par du responsable �conomique.
  Ainsi, les Fermes produisant des PA peuvent aussi produire des chevaux.
  <br>
  La liste de type de produit possible aujourd'hui est limit�, mais il est possible de tout ajouter assez rapidement.
  <br>
  <br>
  Ceci �tant dit, voyons comment faire concr�tement.
  <br>
  <br>
  Rendez vous sur l'�cran 'Catalogue de vente' du d�tail d'une entreprise (via 'Vos Donn�es' par exemple).
  <br>
  <br>
  <CENTER><img src="obj/ecr_produit_gere.gif"></CENTER>
  <br>
  <br>
  Cet �cran liste votre catalogue de produits en vente de la soci�t� s�lectionn�e.
  Pour ajouter un produit cliquez sur le lien 'Nouveau Prduit', juste au dessus de la liste.
  <br>
  <br>
  <CENTER><img src="obj/ecr_newproduit.gif"></CENTER>
  <br>
  <br>
  Choisissez l'entreprise qui fabriquera le produit que vous souhaitez ajouter et saisissez son nom.
  <br>
  Choisissez ensuite son type (automobile, bateau, moto... par exemple pour un constructeur de v�hicule).
  <br>
  Vous avez la possibilit�, sans mieux si vous voulez vendre, d'ajouter une image et une description.
  <br>
  <br>
  Enfin il vous faut indiquer le nombre d'unit� de stock qui vous faudra avoir en stock pour pouvoir fabriquer ce nouvel objet.
  <br>
  C'est moi qui d�cide ??!! Pas exactement en fait ;)
  <br>
  Ce co�t de production est en fonction du prix approximatif en euro d'un produit similaire dans la r�alit� et en fonction du type d'entreprise.
  <br>
  Utilisez le petit outil � droite en renseignant un prix et vous obtenez la quantit� d'unit� n�cessaire pour fabriquer votre produit.
  Il ne vous reste plus qu'a le reporter sur la partie gauche avant de cliquer sur 'Cr�er'.
  <br>
  Cette valeur sera � coup sur v�rifier par le responsable �conomique, donc demandez conseil plut�t que de vous faire attraper pour fraude.
  <br>
  <br>
  Autre pr�cision d'importance, les achats de produits effectu�s ne peuvent pas participer � la production. 
  Rien ne sert d'acheter un super camion benne pour votre soci�t�, enfin seulement pour le prestige de l'avoir !
  <br>
  <br>
  <br>
  <br>
  <b>Vendre</b>
  <br>
  <br>
  Et en fait, si vous avez du stock ou un catalogue bien rempli, vous n'avez rien � faire !
  <br>
  Ce sont les acheteurs qui vont vous faire des propositions.
  <br>
  Notez toutefois, qu'un petit peu de pub sur la ML ou le Forum, n'a jamais fait de mal � personne.
  <br>
  <br>
  Lorsque vous aurez une proposition, un mail vous sera envoy� vous indiquant un message dans EcoMicro.
  <br>
  <br>
  Pour visualiser votre message et donc votre proposition allez sur l'�cran 'Messagerie' en haut � droite.
  <br>
  <br>
  <CENTER><img src="obj/ecr_messagerie.gif"></CENTER>
  <br>
  <br>
  Tous vos messages y sont affich�s, les plus r�cents en t�te. Pour accepter, ou refuser une proposition, cliquez dessus.
  <br>
  <br>
  <CENTER><img src="obj/ecr_message.gif"></CENTER>
  <br>
  <br>
  Au bas vous avez la possibilit� de r�pondre.
  <br>
  <br>
  Pour qu'une acceptation puisse �tre op�r�e, il faut que l'acheteur est suffisament d'argent sur son compte et qe le vendeur dispose des stocks correspondant.
  <br>
  <br>
  <br>
  <br>
  <b>Payer ses imp�ts et se verser un salaire bien m�rit�</b>
  <br>
  <br>
  Pour payer ces imp�ts et surtout pour ne pas se faire attraper par le fisc, il vaut mieux effectuer une transaction p�riodique permanente.
  <br>
  De cette mani�re vous n'aurez plus � vous en pr�occuper par la suite.
  <br>
  <br>
  Allez sur l'�cran 'Effectuer une transaction', via le menu 'Achat Transaction'.
  <br>
  <br>
  <CENTER><img src="obj/ecr_transaction.gif"></CENTER>
  <br>
  <br>
  Choisissez le compte d'origine, celui qui sera d�bit� (le compte de votre entreprise) et saisissez le montant.
  <br>
  S�lectionnez ensuite le compte destinataire, celui qui sera cr�dit� (le compte 'Les imp�ts' grace au type 'Pays').
  <br>
  Saisissez un petit commentaire, par exemple 'voleur', pour les imp�ts.
  <br>
  <br>
  Il vous est propos� de choisir une p�riodicit�.
  <br>
  Avant de valider, v�rifiez les informations.
  <br>
  La transaction s'effectue imm�diatement.
  <br>
  <br>
  Pour votre salaire, renouvelez l'op�ration, par contre le compte crédité est le votre n'oubliez pas !
  <br>
  <br>
  <br>
  Pour visualiser votre compte, stopper une transaction p�riodique ou créer un nouveau compte, rendez vous sur l'écran 'Vos Données' et sélectionnez un de vos comptes à droite.
  <br>
  <br>
  <CENTER><img src="obj/ecr_cpte_user.gif"></CENTER>
  <br>
  <br>
  Cliquez simplement sur le n° du compte pour en voir afficher le d�tail.
 

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