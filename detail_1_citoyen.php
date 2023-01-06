<?php

session_start();

if (!$_SESSION['perso_iduser']){

    $citoyen = mysql_escape_string(trim($_GET['citoyen']));

    $verification ="formulaire.php?retour=detail_1_citoyen.php?citoyen=" .$citoyen;

    echo "<script language='JavaScript'>\n

    document.location.replace('$verification');

    </script>\n";

    die();

}



?>



<html>

<head>



<title> Détail d'un citoyen </title>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<?php

  require("gestion/gest_detail_1_citoyen.php");

  include("include/style.php");

?>



<script language="javascript" type="text/javascript">



function valmodifcitoyen(i)

{

  if ((document.getElementById('nomA').value == "") || (document.getElementById('loginA').value == ""))

  {

     alert("Le nom et le login sont obligatoires.");

  }

  else

  {

    if ((document.getElementById('loginA').value != DET_CIT_LOGIN[i]) && (document.getElementById('pwdA').value == ""))

    {

       alert("Vous devez changer le mot de passe si vous changer le login.");

    }

    else

    {

      if ((AUTORISATION == '999') || (AUTORISATION.substring(1,2) > '5'))

      {

           document.modifcitoyen.action="gestion/modifcitoyen.php";

           document.modifcitoyen.submit();

      }

      else

      {

        if ((AUTORISATION.substring(1,2) == '5') && (document.getElementById('idpaysA').value == tabLC_IDPAYS[i]))

        {

             document.modifcitoyen.action="gestion/modifcitoyen.php";

             document.modifcitoyen.submit();

        }

        else

           alert("Vous n'avez pas l'autorisation de changer le pays");

      }

    }

  }

}



function valnewcitoyen()

{



  if ((document.getElementById('nomA').value == "") || (document.getElementById('loginA').value == ""))

  {

     alert("Le nom, le login et le mot de passe sont obligatoires.");

  }

  else

  {

     document.newcitoyen.action="gestion/newcitoyen.php";

     document.newcitoyen.submit();

  }

}



function modifresidence()

{

  if (document.getElementById('residence1').value == "")

  {

     alert("Choix de la r�sidence invalide.");

  }

  else

  {

     document.modifresidence1.action="gestion/modifcitoyenresidence.php";

     document.modifresidence1.submit();

  }



}





</script>



</head>





<body onload="infojoueur(); AfficheCitoyen();">



<?php

  include("menu/airwick_menu.php");

?>



<script language="Javascript" type="text/javascript" src="gestion/gest_detail_1_citoyen.js"></script>

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

    <li>Affiche le détail d'un citoyen.

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <li><a href="citoyen_detail.php">Liste des citoyens</a>

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

