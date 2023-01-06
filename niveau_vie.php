<?php

session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=niveau_vie.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}

?>

<html>
<head>

<title> Niveau de vie </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
  require("gestion/gest_niveau_vie.php");
  include("include/style.php");
?>

</head>


<body onload="infojoueur(); AfficheNiveau();">

<?php
  include("menu/airwick_menu.php");
?>

<script language="Javascript" type="text/javascript" src="gestion/gest_niveau_vie.js"></script>
<script language="Javascript" type="text/javascript" src="gestion/infojoueur.js"></script>

<br>
<br>

<table>
<tr>
<td width='200' class="texte3">
    <CENTER><img src="obj/logo.gif" alt="logo"></CENTER>
    &nbsp;&nbsp;&nbsp;NKWeb, Kaora 2005
</td>
<td width='500' valign=top class='texte3'>
<ul>
    <li>Niveau de vie des citoyens.
    <br>
    <br>
    <li><a href="patron.php">Aide : Etre un bon patron</a>
    <br>
</ul>
</td>
<td width='300' valign=top>
         <CENTER><div id="tabdroiteh"> </div></CENTER>
</td></tr>
</table>

<table><tr>
<td width='100%' valign=top class='Titre99'></td>
</tr></table>

<table>
<tr>
<td valign=top>
         <CENTER><div id="tabgauchec"> </div></CENTER>
</td><td valign=top>
         <CENTER><div id="tabcentrec"> </div></CENTER>
</td><td valign=top>
         <CENTER><div id="tabdroitec"> </div></CENTER>
</td>
</tr>
</table>

<table>
<tr>
<td valign=top>
    <br><br>
    <CENTER><img src="obj/profil_1.jpg" alt="logo"></CENTER>
         <CENTER><div id="tabgaucheb"> </div></CENTER>
</td><td valign=top>
         <CENTER><div id="tabcentreb"> </div></CENTER>
</td><td valign=top>
    <br><br>
    <CENTER><img src="obj/profil_2.jpg" alt="logo"></CENTER>
         <CENTER><div id="tabdroiteb"> </div></CENTER>
</td>
</tr>
</table>


</body>

</html>
