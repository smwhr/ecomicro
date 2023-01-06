<?php



session_start();

if (!$_SESSION['perso_iduser']){

    $verification ="formulaire.php?retour=produit_gere.php";

    echo "<script language='JavaScript'>\n

    document.location.replace('$verification');

    </script>\n";

    die();

}
?>


<html>

<head>



<title> Produits g�r�s </title>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<?php

  require("gestion/gest_produit_gere.php");

  include("include/style.php");

?>







<script language="javascript" type="text/javascript" >



function majproduit(i)

{

    if (isNaN(document.getElementById('nbunite').value))

    {

      alert("Il semble que le nombre d'unit� ne soit pas un nombre. Si vous pouviez faire quelque chose...");

    }

    else

    {

      if (parseInt(document.getElementById('nbunite').value) <= 0)

      {

         alert("Le nombre d'unit� doit �tre positif...");

      }

      else

      {

      	if (document.getElementById('description').value.length > 250)

      	{

      	  alert("La description ne peut exc�der 250 caract�res.");

      	}

        else

        {

          if (document.getElementById('image').value.length > 150)

          {

             alert("L'URL de l'image ne peut exc�der 150 caract�res.");

          }

          else

          {

            if (document.getElementById('nomproduit').value.length > 50)

            {

               alert("Le nom du produit ne peut exc�der 50 caract�res.");

            }

            else

            {

              if ((document.getElementById('nomproduit').value == "") || (document.getElementById('description').value == "") || (document.getElementById('image').value == ""))

              {

                 alert("Vous devez renseigner tous les champs.");

              }

              else

              {

                 document.modifproduit.action="gestion/modifproduit.php";

                 document.modifproduit.submit();

              }

            }

          }

        }

      }

    }



}

function supprproduit(i)

{

    document.modifproduit.action="gestion/supprproduit.php";

    document.modifproduit.submit();

}



function newproduit()

{

    if (isNaN(document.getElementById('nbunite').value))

    {

      alert("Il semble que le nombre d'unit� ne soit pas un nombre ! Si vous pouviez faire quelque chose...");

    }

    else

    {

      if (parseInt(document.getElementById('nbunite').value) < 0)

      {

         alert("Le nombre d'unit� doit �tre positif...");

      }

      else

      {

      	if (document.getElementById('description').value.length > 250)

      	{

      	  alert("La description ne peut exc�der 250 caract�res.");

      	}

        else

        {

          if (document.getElementById('image').value.length > 150)

          {

             alert("L'URL de l'image ne peut exc�der 150 caract�res.");

          }

          else

          {

            if (document.getElementById('nomproduit').value.length > 50)

            {

               alert("Le nom du produit ne peut exc�der 50 caract�res.");

            }

            else

            {

              if ((document.getElementById('nomproduit').value == "") || (document.getElementById('description').value == "") || (document.getElementById('image').value == ""))

              {

                 alert("Vous devez renseigner tous les champs.");

              }

              else

              {

                 document.newproduit1.action="gestion/newproduit.php";

                 document.newproduit1.submit();

              }

            }

          }

        }

      }

    }

}

</script>



</head>





<body onload="infojoueur(); AfficheProduitPro();">



<?php

  include("menu/airwick_menu.php");

?>



<script language="Javascript" type="text/javascript" src="gestion/gest_produit_gere.js"></script>

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

    <li>Liste tous les produits en vente des soci�t�s que vous g�rez.

    <li>Vous pouvez en ajouter.

        En cliquant sur le nom d'un produit vous pouvez le modifier ou le supprimer.

    <br>

    <br>

    <li>Pour savoir si votre entreprise peut mettre en vente un produit ou pour d�finir la valeur et l'unit�,

        interrogez le responsable �conomique.

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

