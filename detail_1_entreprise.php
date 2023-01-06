<?php
session_start();
if (!$_SESSION['perso_iduser']){
    $entreprise = addslashes(trim($_GET['entreprise']));
    $verification ="formulaire.php?retour=detail_1_entreprise.php?entreprise=" .$entreprise;
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}
?>

<html>
<head>

<title> Détail entité </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
  require("gestion/gest_detail_1_entreprise.php");
  include("include/style.php");
?>

<script language="javascript" type="text/javascript">

function modifentre()
{

  if ((document.getElementById('nomA').value == "") || (document.getElementById('capaA').value == ""))
  {
     alert("Le nom et la capacité sont obligatoires.");
  }
  else
  {
    if ((document.getElementById('nomA').value.length > 50))
    {
       alert("Le nom de l'entreprise est limité à 50 caract�res.");
    }
    else
    {
      if ((document.getElementById('logoA').value.length > 100))
      {
         alert("Le logo de l'entreprise est limité à 100 caract�res.");
      }
      else
      {
        if ((document.getElementById('siteA').value.length > 100))
        {
           alert("Le site de l'entreprise est limité à 100 caract�res.");
        }
        else
        {
          if ((isNaN(parseInt(document.getElementById("capaA").value))) || (parseInt(document.getElementById("capaA").value) <= 0))
          {
               alert("Il s'agit de saisir un nombre entier positif supérieur à zéro !");
          }
          else
          {
               document.modifentre1.action="gestion/modifentre.php";
               document.modifentre1.submit();
          }
        }
      }
    }
  }

}

</script>

</head>


<body onload="infojoueur(); AfficheEntreprise();">

<?php
  include("menu/airwick_menu.php");
?>

<script language="Javascript" type="text/javascript" src="gestion/gest_detail_1_entreprise.js"></script>
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
    <li>Affiche le détail d'une entreprise.
    <br>
    <br>
    <br>
    <li><a href="patron.php">Aide : Etre un bon patron</a>
    <br>
    <br>
    <li><a href="entreprise_detail.php">Liste des entreprises</a>
        &nbsp;-&nbsp;<a href="stock_detail.php">Stocks</a>
        &nbsp;-&nbsp;<a href="produit_detail.php">Produits</a>
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
