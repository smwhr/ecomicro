<?php



session_start();

if (!$_SESSION['perso_iduser']){

    $verification ="formulaire.php?retour=stock_gere.php";

    echo "<script language='JavaScript'>\n

    document.location.replace('$verification');

    </script>\n";

    die();

}

?>



<html>

<head>

<title> Stocks g�r�s </title>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<?php

  require("gestion/gest_stock_gere.php");

  include("include/style.php");

?>





</head>





<body onload="infojoueur(); StockPro();">



<?php

  include("menu/airwick_menu.php");

?>

<script language="Javascript" type="text/javascript" src="gestion/gest_stock_gere.js"></script>

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

    <li>Liste les stocks des entreprises et provinces que vous g�rez.

    <li>Cliquez sur une entreprise pour en voir le d�tail et effectuer des transformations.

    <li>La cr�ation d'entreprise est effectu�e par le responsable �conomique.

    <br>

    <br>

    <li><a href="stock_detail.php">Tous les Stocks</a>

        &nbsp;-&nbsp;<a href="achat_stock.php">Achat de stocks</A>

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



<table width='1000'>

<tr>

<td valign=top>

    <br><br>

    <CENTER><img src="obj/stock_1.jpg" width=200 height=136 alt="stock_1"></CENTER>

    <br><br>

    <CENTER><img src="obj/stock_3.jpg" width=200 height=136 alt="stock_3"></CENTER>

</td><td valign=top>

         <CENTER><div id="tabcentreb"> </div></CENTER>

</td><td valign=top>

    <br><br>

    <CENTER><img src="obj/stock_2.jpg" width=200 height=136 alt="stock_2"></CENTER>

    <br><br>

    <CENTER><img src="obj/stock_6.jpg" width=200 height=136 alt="stock_6"></CENTER>

</td>

</tr>

</table>





</body>



</html>

