<?php
  //**************************************************************************************************
  //        AUTEUR                : Pascal MANON
  //        MAIL                  : pascal.manon@caramail.com
  //        CREATION              : mai 2001
  //        LANGAGES              : PHP, JavaScript, HTML
  //        Compatible            : Netscape 4 & 6, IE 4,5 & 6
  //        A VOIR                : lisezmoi.txt et licence.txt
  //**************************************************************************************************

  //**************************************************************************************************
  // ATTENTION ! LORSQUE VOUS CHANGEZ L'UNE DE CES OPTIONS, REGENEREZ LE MENU GRACE A "admin_menu.php"
  //**************************************************************************************************
  // D�claration des variables de configuration
  $background = "#B0C4DE" ;                                 // Couleur de fond
  $msbackgnd = "#C0C0C0" ;                                  // Couleur de fond lors du passage de la souris
  $bordercolor = "#000000" ;                                // Couleur de la bordure du menu

  $hostname="localhost" ;                                   // Nom du serveur mysql
  $mysqluser="mysqluser" ;                                       // login
  $mysqlpswd="mysqlpswd" ;                                           // password
  $mysqluser="mysqluser" ;                                       // login
  $mysqlpswd="mysqlpswd" ;                                           // password
                                 // Nom de la base de donn�es
  $database="micromonde" ;                                  // Nom de la base de donn�es
  $diemessage="Connection refus�e" ;                        // Message d'erreur

  $widthMenuItem = 190 ;                                    // Largeur des sous-menus
  $allwidth = "no" ;                                        // Indique si le menu prend toute la largeur de la page (yes/no)
                                                            // ATTENTION, n'utilisez cette option si et seulement
                                                            // si vous �tes s�r que l'utilisateur utilisera
                                                            // exclusivement I.E. !!!
                                                            // A CHAQUE CHANGEMENT REGENERER LES POSITIONS DU MENU !
  $width = 125 ;                                            // Largeur du menu principal
  $height = 20 ;                                            // Hauteur des menus
  $top = 10 ;                                               // Position haut de d�part
  $left = 10 ;                                              // Position gauche de d�part

  $textcolor = "#000000" ;                                  // Couleur du texte des menus
  $mstxtclr = "#FFFFFF" ;                                   // Couleur du texte lors du passage de la souris (Internet Explorer seulement)
  $fontfamily = "Georgia" ;                                   // Police d'�cran
  $fontsize = "12px" ;                                      // Taille de la police (en "px" ou en "pt")
  $fontweight = "bold" ;                                    // Style de la police

  $tabtxtclr = "#FFFFFF" ;                                  // Couleur du texte du tableau d'administration
  $tabhead   = "#808080" ;                                  // Couleur de l'ent�te du tableau
  $tabbackgnd = "#C0C0C0" ;                                 // couleur de fond du tableau
  $tabbackgnd2 = "#dddddd" ;                                // deuxi�me couleur de fond du tableau

  $ver = "2.7 (19.07.2002)" ;
?>
