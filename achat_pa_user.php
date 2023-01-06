<?php

session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="formulaire.php?retour=achat_pa.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}

?>

<html>
<head>

<title> Achat Petites Annonces </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
  require("gestion/gest_achat_pa_user.php");
  include("include/style.php");
?>

<script language="javascript" type="text/javascript" >

function valachat(i)
{

  var tmp = "";
  if (parseInt(document.getElementById("rescalcul1").value) >= 0)
  {
     Calcul();

     if ((parseInt(document.getElementById('soldeA').value) - parseInt(document.getElementById('rescalcul1').value)) < 0)
     {
        alert("Le solde ne le permet pas...");
     }
     else
     {
        document.achatpa.action="gestion/mes_achatpa.php";
        document.achatpa.submit();
     }
  }
  else
  {
     alert("Faites le calcul d'abord...");
  }
}
</script>

</head>


<body onload="infojoueur(); AffichePA();">

<?php
  include("menu/airwick_menu.php");
?>

<script language="Javascript" type="text/javascript" src="gestion/gest_achat_pa.js"></script>
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
    <li>Cet écran vous permet de proposer l'achat de produit d'occasion.
        Cette proposition doit encore être validée par le vendeur pour que l'achat soit effectif.
    <li>Le tarif unitaire hors taxe (HT) doit être saisi. Il est préférable de le négocier au préalable avec le vendeur, c'est le montant qu'il va percevoir.
    <li>Le tarif toutes taxes comprises (TTC) est indiqué en appliquant la taxe d'état, mais il sera recalculé lors de la validation par le vendeur.
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
