<?php

session_start();

if (!$_SESSION['perso_iduser']){

    $entreprise = mysql_escape_string(trim($_GET['entreprise']));

    $verification ="formulaire.php?retour=produire.php?entreprise=" .$entreprise;

    echo "<script language='JavaScript'>\n

    document.location.replace('$verification');

    </script>\n";

    die();

}



?>



<html>

<head>



<title> Production de matières </title>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<?php

  require("gestion/gest_produire.php");

  include("include/style.php");

?>



<script language="javascript" type="text/javascript">



function Lancer(i)

{

  Donne(i);



  if (valide == 1)

  {

     document.produire1.action="gestion/produire.php";

     document.produire1.submit();

  }

}



</script>



</head>





<body onload="infojoueur(); AfficheProduire();">



<?php

  include("menu/airwick_menu.php");

?>



<script language="Javascript" type="text/javascript" src="gestion/gest_produire.js"></script>

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

    <li>Cet écran permet la production de mati�res.

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

