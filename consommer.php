<?php

session_start();

if (!$_SESSION['perso_iduser']){

    $entreprise = mysql_escape_string(trim($_GET['entreprise']));

    $verification ="formulaire.php?retour=consommer.php?entreprise=" .$entreprise;

    echo "<script language='JavaScript'>\n

    document.location.replace('$verification');

    </script>\n";

    die();

}



?>



<html>

<head>



<title> Consommation de matières </title>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<?php

  require("gestion/gest_consommer.php");

  include("include/style.php");

?>



<script language="javascript" type="text/javascript">



function majconso(i)

{

  if ((isNaN(parseInt(document.getElementById("nbdeduite").value))) || (parseInt(document.getElementById("nbdeduite").value) <= 0))

  {

     alert("Le nombre d'unité à consommer n'est pas valide.");

  }

  else

  {

     document.consommer1.action="gestion/consommer.php";

     document.consommer1.submit();

  }

}



</script>



</head>





<body onload="infojoueur(); AfficheConsommer();">



<?php

  include("menu/airwick_menu.php");

?>



<script language="Javascript" type="text/javascript" src="gestion/gest_consommer.js"></script>

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

    <li>Cet écran permet la consommation de matières.

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <li><a href="achat_stock.php">Achat de stocks</A>

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

         <CENTER><div id="tabgaucheh"> </div></CENTER>

</td><td valign=top>

         <CENTER><div id="tabcentreh"> </div></CENTER>

</td>

</tr>

</table>



<table>

<tr>

<td valign=top>

         <CENTER><div id="tabgauchec"> </div></CENTER>

</td><td valign=top>

         <CENTER><div id="tabcentrec"> </div></CENTER>

</td><td valign=top>

         <CENTER><div id="tabdroitec"> </div></CENTER>

</td>

</td><td valign=top>

         <CENTER><div id="xtabdroitec"> </div></CENTER>

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

