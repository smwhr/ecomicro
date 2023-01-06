<?php


session_start();

if (!$_SESSION['perso_iduser']){

    $verification ="formulaire.php?retour=user_profile.php";

    echo "<script language='JavaScript'>\n

    document.location.replace('$verification');

    </script>\n";

    die();

}

?>



<html>

<head>



<title> Profil </title>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<?php

  require("gestion/gest_user_profile.php");

  include("include/style.php");

?>







<script language="javascript" type="text/javascript" >



function majprofil()

{

  if (document.getElementById('login').value.length > 20)

  {

    alert("Le login ne peut exc�der 20 caract�res.");

  }

  else

  {

    if (document.getElementById('email').value.length > 50)

    {

      alert("L'email ne peut exc�der 50 caract�res.");

    }

    else

    {

      if (document.getElementById('nom').value.length > 50)

      {

        alert("Le nom ne peut exc�der 50 caract�res.");

      }

      else

      {

        if (document.getElementById('portrait').value.length > 100)

        {

          alert("Le portrait ne peut exc�der 100 caract�res.");

        }

        else

        {

          if ((document.getElementById('nom').value == "") || (document.getElementById('login').value == "") || (document.getElementById('email').value == ""))

          {

            alert("Vous devez renseigner le login et l'email.");

          }

          else

          {

            for (ind01 = 0; ind01 < LIST_CIT_LOGIN.length; ind01++)

            {

            	if ((LIST_CIT_LOGIN[ind01] == document.getElementById('login').value) && (LIST_CIT_IDUSER[ind01] != IDUSER))

            	{

            		alert("Ce login n'est pas valide, d�sol�.");

            		return;

            	}

            	if ((LIST_CIT_NOM[ind01] == document.getElementById('nom').value) && (LIST_CIT_IDUSER[ind01] != IDUSER))

            	{

            		alert("Ce nom n'est pas valide, d�sol�.");

            		return;

            	}

            }



            document.modifprofil.action="gestion/modifprofil.php";

            document.modifprofil.submit();

          }

        }

      }

    }

  }

}



</script>



</head>





<body onload="infojoueur(); Profil();">



<?php

        include("menu/airwick_menu.php") ;

?>

<script language="Javascript" type="text/javascript" src="gestion/gest_user_profile.js"></script>

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

    <li>Un login et un mot de passe pour vous connecter, rien de bien original !

    <li>L'Email saisi sera affich�. C'est le moyen dont dispose l'ensemble des utilisateurs pour vous contacter.

        En cas d'oubli de votre mot de passe, il vous est possible de le r�cup�rer gr�ce � cet Email.

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

