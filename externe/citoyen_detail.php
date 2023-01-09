<html>
<head>

<title> Citoyens </title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php
  require("gest_citoyen_detail.php");
  include("../include/style.php");
?>

</head>


<body onload="AfficheCitoyen();">

<script language="Javascript" type="text/javascript" src="gest_citoyen_detail.js"></script>

<br>
<br>

<table>
<tr>
<td width='200' class="texte3">
    <CENTER><img src="../obj/logo.gif" alt="logo"></CENTER>
    &nbsp;&nbsp;&nbsp;NKWeb, Kaora 2005
</td>
<td width='400' valign=top class='texte3'>
<ul>
    <li>Liste l'ensemble des citoyens.
    <li>Vous devez vous connecter � EcoMicro pour pouvoir agir (modifications...).
    <li>Possibilit� de filtrer selon l'activit�.
</ul>
</td>
<td width='200' valign=top>
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
<td valign=top width='150'>
    <br><br>
         <CENTER><img src="../obj/profil_1.jpg" width=200 height=135 alt="profil_1"></CENTER>
</td><td valign=top>
         <CENTER><div id="tabcentreb"> </div></CENTER>
</td><td valign=top>
    <br><br>
         <CENTER><img src="../obj/profil_2.jpg" width=200 height=135 alt="profil_1"></CENTER>
</td>
</tr>
</table>


</body>

</html>
