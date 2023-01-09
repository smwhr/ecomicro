<?php
  //**************************************************************************************************
  //        AUTEUR                : Pascal MANON
  //        MAIL                  : pascal.manon@caramail.com
  //        CREATION              : mai 2001
  //        VERSION               : 23.09.2001
  //        LANGAGES              : PHP, JavaScript, HTML
  //        Compatible            : Netscape 4 & 6, IE 4,5 & 6
  //        A VOIR                : lisezmoi.txt et licence.txt
  //**************************************************************************************************

  include ("config_menu.php") ;

  // Connection � la base de donn�es
  mysql_connect($hostname,$mysqluser,$mysqlpswd);
  mysql_selectdb($database) or die($diemessage);

  function recurpop ($id)
  {
           if ($id != 0)
           {

            if (mysql_fetch_object(mysqli_query($conn, "SELECT DISTINCT a.id_menu from eco_menu a, eco_menu b where a.id_menu = b.id_node_menu and a.id_menu=$id")))
            {
             $result = mysql_fetch_object(mysqli_query($conn, "SELECT * FROM eco_menu where id_menu = $id")) ;
             $id_node = $result->id_node_menu ;

             echo "     pop('MENU$id', 'visible')\n" ;
             recurpop ($id_node) ;
            }
            else
            {
             $result = mysql_fetch_object(mysqli_query($conn, "SELECT * FROM eco_menu where id_menu = $id")) ;
             $id_node = $result->id_node_menu ;

             recurpop ($id_node) ;
            }
           }
  }

  // Mise en place du javascript
  echo "<script language='javascript'>\n" ;
  echo " function pop(id, visible)\n" ;
  echo " {\n" ;
  echo "   if (document.layers) document.layers[id].visibility = visible ;\n" ;
  echo "   else if (document.getElementById(id)) document.getElementById(id).style.visibility = visible ;\n" ;
  echo "   else if (document.all[id]) document.all[id].style.visibility = visible ;\n" ;
  echo " }\n" ;
  echo " function change(obj, color)\n" ;
  echo " {\n" ;
  echo "   if (document.all || document.getElementById) obj.style.background = color ;\n" ;
  echo " }\n" ;

  // Creation d'une fonction d'effacement total
  echo " function killall()\n" ;
  echo " {\n" ;
  $req1 = mysqli_query($conn, "SELECT DISTINCT a.id_menu from eco_menu a, eco_menu b where a.id_menu = b.id_node_menu") ;
  while ($menu = mysql_fetch_object($req1)) echo "        pop('MENU$menu->id_menu', 'hidden')\n" ;
  echo " }\n" ;

  // Creation des fonctions d'affichage (en javascript) des noeuds
  $req1 = mysqli_query($conn, "SELECT DISTINCT id_menu from eco_menu") ;
  while ($temp = mysql_fetch_object($req1))
  {
     echo " function pop$temp->id_menu()\n" ;
     echo " {\n" ;
     echo "     killall () ;\n" ;
     recurpop ($temp->id_menu) ;
     echo " }\n" ;
  }

  //Feuille de style
  echo "document.writeln(\"<style type='text/css'>\") ;\n" ;
  echo "document.writeln(\"a:hover.menu {color: $mstxtclr ; text-decoration:none;}\") ;\n" ;
  echo "document.writeln(\"a.menu {color: $textcolor ; text-decoration:none;}\") ;\n" ;
  echo "document.writeln(\"#menu {font-family: $fontfamily ; font-size: $fontsize ; font-weight: $fontweight;}\") ;\n" ;
  echo "document.writeln(\"</style>\") ;\n" ;

  // Menu principal
  $req1 = mysqli_query($conn, "SELECT * FROM eco_menu where id_node_menu = 0") ;
  $numr = mysqli_num_rows ($req1) ;
  echo "if (document.all || document.getElementById) document.writeln(\"<DIV id='menu_principal' style='position:absolute;top:$top"."px;left:$left"."px'>\") ;\n" ;
  echo "else document.writeln(\"<layer name='menu_principal' position='absolute' top='$top' left='$left'>\") ;\n" ;
  echo "document.writeln(\"<table cellspading='1' cellspacing='0' border='0' bgcolor='$bordercolor' width='".($allwidth!="yes"?($numr*$width + $numr +2):"100%")."'><tr><td>\") ;\n" ;
  echo "document.writeln(\"<table cellspading='0' cellspacing='0' border='0' bgcolor='$background' width='".($allwidth!="yes"?($numr*$width + $numr):"100%")."'><tr>\") ;\n" ;
  while ($menu = mysql_fetch_object($req1))
  {
          echo "document.writeln(\"<td onMouseOver='change(this,\\\"$msbackgnd\\\");killall() ; pop(\\\"MENU$menu->id_menu\\\",\\\"visible\\\")' onMouseOut='change(this,\\\"$background\\\")' width='$width' height='$height' align='center'><a href='$menu->lien_menu#' ".($menu->cible_menu!=""?"target='$menu->cible_menu'":"")."onMouseOver='killall() ; pop(\\\"MENU$menu->id_menu\\\",\\\"visible\\\")' class='menu' id='menu'>$menu->titre_menu</a></td>\") ;\n" ;
  }
  echo "document.writeln(\"".($allwidth=="yes"?"<td><font id='menu'>&nbsp;</font></td>":"")."</tr></table>\") ;\n" ;
  echo "document.writeln(\"</td></tr></table>\") ;\n" ;
  echo "document.writeln(\"<table cellspading='0' cellspacing='0' border='0' width='100%'><tr><td onMouseOver='killall()'>\") ;\n" ;
  echo "document.writeln(\"&nbsp;</td></tr></table>\") ;\n" ;
  echo "if (document.layers) document.writeln(\"</layer>\") ;\n" ;
  echo "else document.writeln(\"</div>\") ;\n" ;

  //Sous-menus directs du menu principal
  $req1 = mysqli_query($conn, "SELECT DISTINCT a.id_menu, a.pos_x, a.pos_y, a.titre_menu from eco_menu a, eco_menu b where a.id_menu = b.id_node_menu AND a.id_node_menu = 0") ;
  while ($menu = mysql_fetch_object($req1))
  {
          $req2 = mysqli_query($conn, "SELECT DISTINCT * from eco_menu where id_node_menu = $menu->id_menu") ;
          $numr = mysqli_num_rows ($req2) ;
          echo "if (document.all || document.getElementById) document.writeln(\"<DIV id='MENU$menu->id_menu' style='position:absolute;top:".($menu->pos_y + $height+1)."px;left:$menu->pos_x"."px;visibility:hidden'>\") ;\n" ;
          echo "else document.writeln(\"<layer name='MENU$menu->id_menu' position='absolute' top='".($menu->pos_y + $height+1)."' left='$menu->pos_x' visibility='hidden' >\") ;\n" ;
          echo "document.writeln(\"<table cellspading='1' cellspacing='0' border='0' bgcolor='$bordercolor' height='".($height*$numr + 2)."' width='".($widthMenuItem + 2)."'><tr><td align='center' valign='middle'>\") ;\n" ;
          echo "document.writeln(\"<table cellspading='0' cellspacing='0' border='0' bgcolor='$background' width='$widthMenuItem'>\") ;\n" ;
          while ($node = mysql_fetch_object($req2))
          {
           if (mysqli_num_rows(mysql_query ("SELECT * FROM eco_menu WHERE id_node_menu = $node->id_menu")) != 0)
           {
                   echo "document.writeln(\"<tr><td onMouseOver='change(this,\\\"$msbackgnd\\\");pop$node->id_menu()' onMouseOut='change(this,\\\"$background\\\")' width='$widthMenuItem' height='$height' align='left'><table cellspacing='0' cellspading='0' border='0' width='100%'><tr><td width='100%'><a href='$node->lien_menu#' ".($node->cible_menu!=""?"target='$node->cible_menu'":"")."onMouseOver='pop$node->id_menu()' id='menu' class='menu'>&nbsp;&nbsp;$node->titre_menu</a></td><td><font id='menu' color='$textcolor'>&gt</font></td></tr></table></td></tr>\") ;\n" ;
           }
           else
           {
               echo "document.writeln(\"<tr><td onMouseOver='change(this,\\\"$msbackgnd\\\");pop$node->id_menu()' onMouseOut='change(this,\\\"$background\\\")' width='$widthMenuItem' height='$height' align='left'><a href='$node->lien_menu#' ".($node->cible_menu!=""?"target='$node->cible_menu'":"")."onMouseOver='pop$node->id_menu()' id='menu' class='menu'>&nbsp;&nbsp;$node->titre_menu</a></td></tr>\") ;\n" ;
           }
          }
          echo "document.writeln(\"</table>\") ;\n" ;
          echo "document.writeln(\"</td></tr></table>\") ;\n" ;
          echo "document.writeln(\"<table cellspading='0' cellspacing='0' border='0' width='100%'><tr><td onMouseOver='killall()'>\") ;\n" ;
          echo "document.writeln(\"&nbsp;</td></tr></table>\") ;\n" ;
          echo "if (document.all || document.getElementById) document.writeln(\"</div>\") ;\n" ;
          echo "else document.writeln(\"</layer>\") ;\n" ;
  }

  // Autres sous-menus
  $req1 = mysqli_query($conn, "SELECT DISTINCT a.id_menu, a.pos_x, a.pos_y from eco_menu a, eco_menu b where a.id_menu = b.id_node_menu AND a.id_node_menu <> 0") ;
  while ($menu = mysql_fetch_object($req1))
  {
          $req2 = mysqli_query($conn, "SELECT DISTINCT * from eco_menu where id_node_menu = $menu->id_menu") ;
          $numr = mysqli_num_rows ($req2) ;
          echo "if (document.all || document.getElementById) document.writeln(\"<DIV id='MENU$menu->id_menu' style='position:absolute;top:$menu->pos_y"."px;left:".($menu->pos_x + $widthMenuItem +1)."px;visibility:hidden'>\") ;\n" ;
          echo "else document.writeln(\"<layer name='MENU$menu->id_menu' position='absolute' top='$menu->pos_y' left='".($menu->pos_x + $widthMenuItem +1)."' visibility='hidden' >\") ;\n" ;
          echo "document.writeln(\"<table cellspading='0' cellspacing='0' border='0' bgcolor='$bordercolor' height='".($height*$numr + 2)."' width='".($widthMenuItem + 2)."'><tr><td align='center' valign='middle'>\") ;\n" ;
          echo "document.writeln(\"<table cellspading='0' cellspacing='0' border='0' bgcolor='$background' width='$widthMenuItem'>\") ;\n" ;
          while ($node = mysql_fetch_object($req2))
          {
           if (mysqli_num_rows(mysql_query ("SELECT * FROM eco_menu WHERE id_node_menu = $node->id_menu")) != 0)
               echo "document.writeln(\"<tr><td onMouseOver='change(this,\\\"$msbackgnd\\\");pop$node->id_menu()' onMouseOut='change(this,\\\"$background\\\")' width='$widthMenuItem' height='$height' align='left'><table cellspacing='0' cellspading='0' border='0' width='100%'><tr><td width='100%'><a href='$node->lien_menu#' ".($node->cible_menu!=""?"target='$node->cible_menu'":"")."onMouseOver='pop$node->id_menu()' id='menu' class='menu'>&nbsp;&nbsp;$node->titre_menu</a></td><td><font id='menu' color='$textcolor'>&gt</font></td></tr></table></td></tr>\") ;\n" ;
           else
               echo "document.writeln(\"<tr><td onMouseOver='change(this,\\\"$msbackgnd\\\");pop$node->id_menu()' onMouseOut='change(this,\\\"$background\\\")' width='$widthMenuItem' height='$height' align='left'><a href='$node->lien_menu#' ".($node->cible_menu!=""?"target='$node->cible_menu'":"")."onMouseOver='pop$node->id_menu()' id='menu' class='menu'>&nbsp;&nbsp;$node->titre_menu</a></td></tr>\") ;\n" ;
          }
          echo "document.writeln(\"</table>\") ;\n" ;
          echo "document.writeln(\"</td></tr></table>\") ;\n" ;
          echo "document.writeln(\"<table cellspading='0' cellspacing='0' border='0' width='100%'><tr><td onMouseOver='killall()'>\") ;\n" ;
          echo "document.writeln(\"&nbsp;</td></tr></table>\") ;\n" ;
          echo "if (document.layers) document.writeln(\"</layer>\") ;\n" ;
          echo "else document.writeln(\"</div>\") ;\n" ;
  }

  echo "document.onclick = killall ;\n" ;
  echo "</script>\n" ;
  mysqli_close($conn);
?>
