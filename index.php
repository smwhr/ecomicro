<?php
    include("include/config.php");
    $conn = mysqli_connect($host,$user,$pass) or die("Verif 9 - Impossible de se connecter");
    mysqli_select_db($conn, $bdd) or die("Verif 10 - Impossible de se connecter à la base de données");
    // traceIP
    $sql = "INSERT INTO eco_cnx (id_cnx,IP,date_cnx,ecran) VALUES (NULL, '{$_SERVER['REMOTE_ADDR']}',NOW(),'index');";
    $res = @mysqli_query($conn, $sql) or die("Erreur de connexion...");
    mysqli_close($conn);
    
    // Test de la connexion et enchainement direct sur l'écran du joueur le cas échéant
	$s = $_GET['i'] ?? "";
	if ($s > "")
		session_id($s);
	session_start();
//die(session_id());
    if (isset($_SESSION['perso_iduser'])) {
        $idjoueur = $_SESSION['perso_iduser'];
        $tmp = "new_detail_1_citoyen.php?citoyen=" . $idjoueur;
        echo "ici";
        echo $tmp;
        die();
        die ("<script language='JavaScript'>document.location.replace('$tmp');</script>");
    }
    
?>
<html>
<head>
    <title>EcoMicro</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <script language="Javascript" type="text/javascript" src="include/jquery-1.10.1.min.js"></script>

        
<script language="javascript" type="text/javascript">

function gotoForum(){
    $('#page-loader').show();
    $tmp = "http://forum.micromonde.net";
    document.location.replace($tmp);
}
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
        <td valign=top></td>
        <td valign=top width='200'>
            <div id="divPresentation" class="menuAccueil boutonOrange tailleDouble" onClick="gotoPresentation();">Présentation</div
        </td>
        <td valign=top width='100'></td>
        <td valign=top width='200'>
            <div id="divForum" class="menuAccueil boutonBleu tailleDouble" onClick="gotoForum();">Forum</div>
        </td>
        <td valign=top width='100'></td>
        <td valign=top width='200'>
            <div id="divJouer" class="menuAccueil boutonVert tailleDouble" onClick="gotoJouer();">Jouer !!</div>
        </td>
        <td valign=top></td>
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
                <div id="presentation" style="background-color:#FFFFFF; padding: 15px 15px;">
                    Bienvenue !

                    <BR>
                    <FONT color=red>
                        Mon hébergement arrive à échéance. Au vue de son coût et de ma disponibilité pour poursuivre les travaux sur la v2, il est très probable que je ferme Ecomicro (v1 et v2) ainsi que ce forum. Cela devrait intervenir fin de semaine prochaine. Je tacherais, comme je l'avais déjà fait, de mettre à disposition avant la fermeture une copie de la base de données et des sources de la v1.
                        <BR>Ce fut pour ma part une belle aventure que de développer Ecomicro et j'espère au fond de moi pouvoir un jour reprendre les travaux.
                        <BR>Yoann G.
                    </FONT>
                    <BR>

                    <ul>
                        <li>EcoMicro est un système de gestion économique pour nations virtuelle
                        <br>&nbsp;
                        <li>Pour avoir accès, il vous est nécessaire d'être citoyen d'une des nations virtuelles utilisant ce système
                        <br>&nbsp;
                        <li>Pour devenir citoyen d'une nation virtuelle commencez par visualiser chacun des sites dans la <a href="etat_membre.php">liste des pays membres</A>.
                        <br>&nbsp;
                        <li>S'il s'agit de votre première visite, nous vous proposons une <a href ="presentation.php">présentation</A> d'EcoMicro et nous vous invitons à prendre connaissance du <a href="systeme_eco.php">système économique</a>.
                        <br>&nbsp;
                    </ul>

                    <CENTER>
                        <img src="obj/business.jpg" alt="Le monde appartient aux optimistes."/>
                    </CENTER>
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
