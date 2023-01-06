<?php



session_start();

if (!$_SESSION['perso_iduser']){

    $verification ="formulaire.php?retour=produit_detail.php";

    echo "<script language='JavaScript'>\n

    document.location.replace('$verification');

    </script>\n";

    die();

}


?>



<html>

<head>


<title> Produits en vente</title>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<?php

  require("gestion/gest_produit_detail.php");

  include("include/style.php");

?>



</head>





<body onload="infojoueur(); AfficheProduit();">



<?php

  include("menu/airwick_menu.php");

?>



<script language="Javascript" type="text/javascript" src="gestion/gest_produit_detail.js"></script>

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

    <li>Liste l'ensemble des produits en vente.

    <li>En cliquant sur le nom d'une entreprise, vous pouvez visualiser et modifier (selon vos droits) le d�tail.

    <li>Possibilit� de filtrer par pays, entreprise et type de produit.

    <br>

    <br>

    <li><a href="achat_produit.php">Achat de produits</A>

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

