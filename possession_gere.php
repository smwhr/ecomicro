<?php



session_start();

if (!$_SESSION['perso_iduser']){

    $verification ="formulaire.php?retour=possession_gere.php";

    echo "<script language='JavaScript'>\n

    document.location.replace('$verification');

    </script>\n";

    die();

}



?>



<html>

<head>

<title> Possessions gérées </title>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<?php

  require("gestion/gest_possession_gere.php");

  include("include/style.php");

?>





<script language="javascript" type="text/javascript" >



function majvendreposs()

{

    document.vendreposs.action="gestion/modifpossession.php";

    document.vendreposs.submit();

}



</script>







</head>





<body onload="infojoueur(); AffichePossessionPro();">



<?

  include("menu/airwick_menu.php");

?>



<script language="Javascript" type="text/javascript" src="gestion/gest_possession_gere.js"></script>

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

    <li>Liste tous les produits possedés par les sociétés et provinces que vous gérez.

    <li>Possibilité de filtrer par entité et par type de produit.

    <li>La colonne action vous permet de mettre aux petites annonces (PA) votre biens pour le vendre, ou de le metrre en location selon le type de produit.

    <li>La création d'entreprise est effectuée par le responsable économique.

    <br>

    <br>

    <li><a href="produit_detail.php">Produit en vente</a>

        &nbsp;-&nbsp;<a href="achat_produit.php">Achat de produits</a>

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

