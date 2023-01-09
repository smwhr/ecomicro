<?php

session_start();
if (!$_SESSION['perso_iduser']){
    $verification ="../formulaire.php?retour=menu/admin_menu.php";
    echo "<script language='JavaScript'>\n
    document.location.replace('$verification');
    </script>\n";
    die();
}

if (substr($_SESSION['perso_droituser'],1,1) <= '5')
{
    echo "<script language='JavaScript'>\n
    document.location.replace('../index.php');
    </script>\n";
    die();
}

  //**************************************************************************************************
  //        AUTEUR                : Pascal MANON
  //        MAIL                  : pascal.manon@caramail.com
  //        CREATION              : mai 2001
  //        VERSION               : 10.10.2001
  //        LANGAGES              : PHP, JavaScript, HTML
  //        Compatible            : Netscape 4 & 6, IE 4,5 & 6
  //        A VOIR                : lisezmoi.txt et licence.txt
  //**************************************************************************************************


  include ("config_menu.php") ;

  // Connection � la base de donn�es
  mysql_connect($hostname,$mysqluser,$mysqlpswd);
  mysql_selectdb($database) or die($diemessage);

  function generate ($top, $left, $height, $width, $widthMenuItem, $allwidth)
  {
   // Calcul des positions du menu principal
   $req1 = mysqli_query($conn, "SELECT * FROM eco_menu where id_node_menu = 0") ;
   $numr = mysqli_num_rows ($req1) ;
   $i = $left ;
   while ($menu = mysql_fetch_object($req1))
   {
          mysqli_query($conn, "UPDATE eco_menu SET pos_x = ".$i.", pos_y = $top where id_menu = $menu->id_menu") ;
          $i= $i + $width + ($allwidth=="yes"?2:1) ;
   }

   // Calcul des positions des sous-menus directs du menu principal
   $req1 = mysqli_query($conn, "SELECT DISTINCT a.id_menu, a.pos_x, a.pos_y, a.titre_menu from eco_menu a, eco_menu b where a.id_menu = b.id_node_menu AND a.id_node_menu = 0") ;
   while ($menu = mysql_fetch_object($req1))
   {
          $i = $menu->pos_y + $height + 1 ;
          $req2 = mysqli_query($conn, "SELECT DISTINCT * from eco_menu where id_node_menu = $menu->id_menu") ;
          $numr = mysqli_num_rows ($req2) ;
          while ($node = mysql_fetch_object($req2))
          {
           mysql_query ("UPDATE eco_menu SET pos_y = $i, pos_x = ".$menu->pos_x." where id_menu = $node->id_menu") ;
           $i+= $height + 1 ;
          }
   }

   // Calcul des positions des autres sous-menus
   $req1 = mysqli_query($conn, "SELECT DISTINCT a.id_menu, a.pos_x, a.pos_y from eco_menu a, eco_menu b where a.id_menu = b.id_node_menu AND a.id_node_menu <> 0") ;
   while ($menu = mysql_fetch_object($req1))
   {
          $i = $menu->pos_y ;
          $req2 = mysqli_query($conn, "SELECT DISTINCT * from eco_menu where id_node_menu = $menu->id_menu") ;
          $numr = mysqli_num_rows ($req2) ;
          while ($node = mysql_fetch_object($req2))
          {
           mysql_query ("UPDATE eco_menu SET pos_y = $i, pos_x = ".($menu->pos_x + $widthMenuItem + 1)." where id_menu = $node->id_menu") ;
           $i+= $height + 1 ;
          }
   }
  }
  if (isset($_GET['cmd']))
     $cmd = $_GET['cmd'];
  if (isset($_GET['id_menu']))
     $id_menu = $_GET['id_menu'];
  if (isset($_GET['cible_menu']))
     $cible_menu = $_GET['cible_menu'];
  if (isset($_GET['lien_menu']))
     $lien_menu = $_GET['lien_menu'];
  if (isset($_GET['titre_menu']))
     $titre_menu = $_GET['titre_menu'];
  if (isset($_GET['id_node_menu']))
     $id_node_menu = $_GET['id_node_menu'];


  if (isset($cmd))
  {
      // Cr�ation d'un menu
      if ($cmd == "CRE" and $titre_menu != null)
      {
       mysql_query ("INSERT INTO eco_menu (id_node_menu, titre_menu, lien_menu, cible_menu) VALUES ($id_node_menu, '$titre_menu', '$lien_menu', '$cible_menu')") ;
       header ("Location: admin_menu.php?message=Menu+cr�e+avec+succ�s") ;
      }
      // Suppression d'un menu et de ses d�pendants
      else if ($cmd == "DEL")
      {
       mysql_query ("DELETE FROM eco_menu WHERE id_menu = $id_menu") ;
       mysql_query ("DELETE FROM eco_menu WHERE id_node_menu = $id_menu") ;
       header ("Location: admin_menu.php?message=Menu+supprim�+avec+succ�s") ;
      }
      // Mise � jour
      else if ($cmd == "UPD")
      {
       mysql_query ("UPDATE eco_menu set titre_menu = '$titre_menu', lien_menu = '$lien_menu', cible_menu = '$cible_menu' where id_menu = $id_menu") ;
       header ("Location: admin_menu.php?message=Menu+modifi�+avec+succ�s") ;
      }
      // Changer la position vers le haut
      // Mise � jour
      else if ($cmd == "MOVE_UP")
      {
       // R�cup�ration de l'enregistrement � monter
       $req = mysqli_query($conn, "SELECT * FROM eco_menu WHERE id_menu = $id_menu") ;
       $menu_courant = mysql_fetch_object($req) ;

       // R�cup�ration de l'�lement pr�cedent
       $req = mysqli_query($conn, "SELECT * FROM eco_menu WHERE id_node_menu = $menu_courant->id_node_menu") ;
       $menu_prec = "" ;
       $ligne = mysql_fetch_object($req) ;

       while($ligne->id_menu != $id_menu)
       {
        $menu_prec = $ligne ;
        $ligne = mysql_fetch_object($req) ;
       }

       // Si le menu pr�c�dent n'est pas vide, alors on monte le menu
       if($menu_prec != "")
       {
        // SWAP des valeurs
        mysql_query ("UPDATE eco_menu set titre_menu = '$menu_courant->titre_menu', lien_menu = '$menu_courant->lien_menu', cible_menu = '$menu_courant->cible_menu' where id_menu = $menu_prec->id_menu") ;
        mysql_query ("UPDATE eco_menu set titre_menu = '$menu_prec->titre_menu', lien_menu = '$menu_prec->lien_menu', cible_menu = '$menu_prec->cible_menu' where id_menu = $menu_courant->id_menu") ;

        // SWAP des noeuds
        mysql_query ("UPDATE eco_menu set id_node_menu = '9999' WHERE id_node_menu = $menu_courant->id_menu") ;
        mysql_query ("UPDATE eco_menu set id_node_menu = '$menu_courant->id_menu' WHERE id_node_menu = $menu_prec->id_menu") ;
        mysql_query ("UPDATE eco_menu set id_node_menu = '$menu_prec->id_menu' WHERE id_node_menu = 9999") ;

        header ("Location: admin_menu.php?message=Menu+modifi�+avec+succ�s") ;
       }
      }
      else if ($cmd == "MOVE_DOWN")
      {
       // R�cup�ration de l'enregistrement � monter
       $req = mysqli_query($conn, "SELECT * FROM eco_menu WHERE id_menu = $id_menu") ;
       $menu_courant = mysql_fetch_object($req) ;

       // R�cup�ration de l'�lement pr�cedent
       $req = mysqli_query($conn, "SELECT * FROM eco_menu WHERE id_node_menu = $menu_courant->id_node_menu") ;
       $ligne = mysql_fetch_object($req) ;

       while($ligne->id_menu != $id_menu)
       {
        $ligne = mysql_fetch_object($req) ;
       }

       // Si le menu suivant n'est pas vide, alors on descend le menu
       if($menu_suiv = mysql_fetch_object($req))
       {
        // SWAP des valeurs
        mysql_query ("UPDATE eco_menu set titre_menu = '$menu_courant->titre_menu', lien_menu = '$menu_courant->lien_menu', cible_menu = '$menu_courant->cible_menu' where id_menu = $menu_suiv->id_menu") ;
        mysql_query ("UPDATE eco_menu set titre_menu = '$menu_suiv->titre_menu', lien_menu = '$menu_suiv->lien_menu', cible_menu = '$menu_suiv->cible_menu' where id_menu = $menu_courant->id_menu") ;

        // SWAP des noeuds
        mysql_query ("UPDATE eco_menu set id_node_menu = '9999' WHERE id_node_menu = $menu_courant->id_menu") ;
        mysql_query ("UPDATE eco_menu set id_node_menu = '$menu_courant->id_menu' WHERE id_node_menu = $menu_suiv->id_menu") ;
        mysql_query ("UPDATE eco_menu set id_node_menu = '$menu_suiv->id_menu' WHERE id_node_menu = 9999") ;

        header ("Location: admin_menu.php?message=Menu+modifi�+avec+succ�s") ;
       }
      }
      else if ($cmd == "MOVE_UPUP")
      {
       // R�cup�ration de l'enregistrement � monter
       $req = mysqli_query($conn, "SELECT * FROM eco_menu WHERE id_menu = $id_menu") ;
       $menu_courant = mysql_fetch_object($req) ;

       // R�cup�ration du premier enregistrement du dessus
       $req = mysqli_query($conn, "SELECT * FROM eco_menu WHERE id_menu = $menu_courant->id_node_menu") ;

       // Si le menu n'est pas � la racine
       if($menu_upup = mysql_fetch_object($req))
       {
        // Changement de noeud
        mysql_query ("UPDATE eco_menu set id_node_menu = '$menu_upup->id_node_menu' WHERE id_menu = $menu_courant->id_menu") ;

        header ("Location: admin_menu.php?message=Menu+modifi�+avec+succ�s") ;
       }
      }
      else if ($cmd == "MOVE_DODOWN")
      {
       // R�cup�ration de l'enregistrement � monter
       $req = mysqli_query($conn, "SELECT * FROM eco_menu WHERE id_menu = $id_menu") ;
       $menu_courant = mysql_fetch_object($req) ;

       // R�cup�ration de l'�lement pr�cedent
       $req = mysqli_query($conn, "SELECT * FROM eco_menu WHERE id_node_menu = $menu_courant->id_node_menu") ;
       $ligne = mysql_fetch_object($req) ;

       while($ligne->id_menu != $id_menu)
       {
        $ligne = mysql_fetch_object($req) ;
       }

       // Si le menu suivant n'est pas vide, alors on descend le menu
       if($menu_suiv = mysql_fetch_object($req))
       {
        // Changement de noeud
        mysql_query ("UPDATE eco_menu set id_node_menu = '$menu_suiv->id_menu' WHERE id_menu = $menu_courant->id_menu") ;

        header ("Location: admin_menu.php?message=Menu+modifi�+avec+succ�s") ;
       }
      }
      else header ("Location: admin_menu.php") ;

      generate ($top, $left, $height, $width, $widthMenuItem, $allwidth) ;
  }
//  else
//    $message="toto";
?>
<html>
<head>
<title>Airwick Menu - Administration des menus</title>
</head>
<body>
<?php
  echo "<h1>AIRWICK MENU ver $ver</h1>\n" ;
  echo "<hr>\n" ;
  echo "<form><input type='hidden' name='cmd' value='GEN'><b>ATTENTION !!!</b> n'oubliez pas de <b>cliquer sur le bouton suivant</b> avant de quitter, celui-ci va g�n�rer les positions des diff�rents menus dans la fen�tre<br><input type='Submit' value='G�nerer'></form>\n" ;
  echo "<hr>\n" ;
  echo "<style type='text/css'>\n" ;
  echo "a:hover.menu {color: $mstxtclr ; text-decoration:none;}\n" ;
  echo "a.menu {color:  $tabtxtclr ; text-decoration:none;}\n" ;
  echo "#menu {font-family: $fontfamily ; font-size: $fontsize ; font-weight: $fontweight;}\n" ;
  echo "</style>\n" ;

  if(isset($message))
     echo "<code><font color='#009900'>** $message</font></code><br><br>\n" ;

  function menus ($id_master, $msbackgnd, $height, $marge, $PHP_SELF, $color1, $color2, $state)
  {

   $req1 = mysqli_query($conn, "SELECT DISTINCT * from eco_menu where id_node_menu = $id_master") ;
   while ($menu = mysql_fetch_object($req1))
   {

     if($state == "" && $state2 == "")
         $image ="<img src='plus06.gif' border='0' align='absbottom'>" ;
     else if($state == "")
         $image ="<img src='plus05.gif' border='0' align='absbottom'>" ;
     else
         $image ="<img src='plus02.gif' border='0' align='absbottom'>" ;


     echo "<form method='GET' action='#'><input type='hidden' name='cmd' value='UPD'><input type='hidden' name='id_menu' value='$menu->id_menu'><tr bgcolor='$msbackgnd' valign='middle'><td height='$height' align='left' width='100%'>$marge$state$image<input type='text' name='titre_menu' value='$menu->titre_menu'>
            <a href='admin_menu.php?id_menu=$menu->id_menu&cmd=MOVE_UPUP'><img src='upup.gif' border='0' align='absmiddle' alt='Monter dans la branche du menu sup�rieur'></a>
            <a href='admin_menu.php?id_menu=$menu->id_menu&cmd=MOVE_DODOWN'><img src='dodown.gif' border='0' align='absmiddle' alt='Descendre dans la branche du menu suivant'></a>
            <a href='admin_menu.php?id_menu=$menu->id_menu&cmd=MOVE_UP'><img src='up.gif' border='0' align='absmiddle' alt=\"Monter d'un rang dans la branche\"></a>
            <a href='admin_menu.php?id_menu=$menu->id_menu&cmd=MOVE_DOWN'><img src='down.gif' border='0' align='absmiddle' alt=\"Descendre d'un rang dans la branche\"></a></td>
            <td><input type='text' name='lien_menu' value='$menu->lien_menu'></td><td><input type='text' name='cible_menu' value='$menu->cible_menu'></td><td align='center'><a href=\"admin_menu.php?cmd=DEL&id_menu=$menu->id_menu\" id='menu' class='menu'>&nbsp;&nbsp;Supprimer&nbsp;&nbsp;</a></td><td><input type='submit' value='  Modifier  '</td><td align='center'>&nbsp;</td></tr></form>\n" ;

     $marge2 = $marge."<img src='barre01.gif' border='0' align='absbottom'>" ;

     if (!mysql_fetch_row (mysql_query ("SELECT DISTINCT * from eco_menu where id_node_menu = $menu->id_menu")))
         $state2 = "<img src='barre01.gif' border='0' align='absbottom'>" ;
     else
         $state2 = "<img src='barre02.gif' border='0' align='absbottom'>" ;


     menus ($menu->id_menu, ($msbackgnd==$color1?$color2:$color1), $height, $marge2, $PHP_SELF, $color1, $color2, $state2) ;
   }
   echo "<form method='GET' action='#'><input type='hidden' name='cmd' value='CRE'><input type='hidden' name='id_node_menu' value='$id_master'><tr bgcolor='$msbackgnd' valign='middle'><td height='$height' align='left' width='100%'>$marge<img src='barre04.gif' border='0' align='absbottom'><input type='text' name='titre_menu'><font color='#990000'> *</font></td><td><input type='text' name='lien_menu'></td><td><input type='text' name='cible_menu'></td><td align='center'>&nbsp;</td><td align='center'>&nbsp;</td><td><input type='submit' value='  Cr�er   '</td></tr></form>\n" ;
  }

  echo "<table cellspading='0' cellspacing='1' border='0' width='100%'>\n" ;

  echo "<tr bgcolor='$tabhead' valign='middle'><td align='left' width='100%'><font color='$tabtxtclr' id='menu'>&nbsp;&nbsp; Titre du menu</font></td><td>&nbsp;&nbsp;<font id='menu' color='$textcolor' size='".($fontsize+1)."'>Lien du menu</font></td><td>&nbsp;&nbsp;<font id='menu' color='$textcolor' size='".($fontsize+1)."'>Cible du lien</font></td><td align='center'>&nbsp;&nbsp;<font id='menu' color='$textcolor'>Suppression</font>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<font id='menu' color='$textcolor'>Modification</font>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<font id='menu' color='$textcolor'>Cr�ation</font>&nbsp;&nbsp;</td></tr></form>\n" ;
  menus (0, $tabbackgnd, $height, "", "admin_menu.php", $tabbackgnd2, $tabbackgnd, "") ;
  echo "</table>\n" ;
  echo "<hr>\n" ;
  echo "<form><input type='hidden' name='cmd' value='GEN'><b>ATTENTION !!!</b> n'oubliez pas de <b>cliquer sur le bouton suivant</b> avant de quitter, celui-ci va g�n�rer les positions des diff�rents menus dans la fen�tre<br><input type='Submit' value='G�nerer'></form>\n" ;
  echo "<hr>\n" ;
?>
</body>
