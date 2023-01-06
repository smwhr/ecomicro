<?php
session_start();
if (!$_SESSION['perso_iduser'])
    die();
if (substr($_SESSION['perso_droituser'],1,1) <= '5')
{
    echo "<script language='JavaScript'>\n
    document.location.replace('../index.php');
    </script>\n";
    die();
}
?>

<html>
<head>

<title> Add Immo </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
  require("gestion/gest_add_immo.php");
  include("include/style.php");
?>



<script language="javascript" type="text/javascript" >

function addimmo()
{
  document.add_immo.action="gestion/add_immo.php";
  document.add_immo.submit();
}

</script>

</head>


<body onload="immo();">

<?php
//infojoueur(); 
//        include("menu/airwick_menu.php") ;
?>
<script language="Javascript" type="text/javascript" src="gestion/gest_add_immo.js"></script>

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
    <li>
    <li>
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
<td valign=top width='25%'>
    <br><br>
         <CENTER><img src="obj/profil_1.jpg" width=200 height=135 alt="profil_1"></CENTER>
</td><td valign=top width='50%'>
         <CENTER><div id="tabcentrec"></div></CENTER>
</td><td valign=top width='25%'>
    <br><br>
         <CENTER><img src="obj/profil_2.jpg" width=200 height=135 alt="profil_1"></CENTER>
</td>
</tr>
</table>

<table>
<tr>
<td valign=top>
         <CENTER><div id="tabgaucheb"> </div></CENTER>
</td><td valign=top>
         <CENTER><div id="tabcentreb"> </div></CENTER>
</td><td valign=top>
         <CENTER><div id="tabdroiteb"> </div></CENTER>
</td>
</tr>
</table>


</body>

</html>
