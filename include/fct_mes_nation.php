<?php
  // Envoi du message : Nation

// $fct_mes_citoyen_type
// $fct_mes_citoyen_nom
// $fct_mes_citoyen_login
// $fct_mes_citoyen_email


  $email = "ecomicro_site@googlegroups.com";

  $sujet = "EcoMicro - Citoyen : ";
  $sujet .= $fct_mes_citoyen_nom;

    $corps = "Un nouveau citoyen vient d'être enregistré : ";
    $corps .= utf8_encode($fct_mes_citoyen_nom);
    $corps .= ".\n\nLogin : ";
    $corps .= $fct_mes_citoyen_login;
    $corps .= "\nEmail : ";
    $corps .= $fct_mes_citoyen_email;

  $corps .= "\n\n";
  $corps .= "EcoMicro\n";
  $corps .= "http://micromonde.ecomicro.net \n";
  $corps .= "\n\n";
  $corps .= "http://forum.micromonde.net \n";

//  $corps .= $fct_mes_citoyen_type;

  $adr_origine = "From:ecomicro@lazag.com";

  if ($email == "ecoprya@googlegroups.com") {
    $sujet = "=?utf-8?B?".base64_encode($sujet)."?=";
    $adr_origine .= "\n";
    $adr_origine .='Content-Type: text/plain; charset="utf-8"'."\n";
    $corps = "[£££ECOMICRO£££]" . $corps;
  	if( MAIL_ENABLED) mail("prya-forum@micromonde.net",$sujet,$corps,$adr_origine);
  } 
  else
    if( MAIL_ENABLED) mail($email,$sujet,$corps,$adr_origine);


  // email au joueur
  $email = $fct_mes_citoyen_email;

  $sujet = "EcoMicro - Enregistrement : ";
  $sujet .= $fct_mes_citoyen_nom;

    $corps = "Bonjour";
    $corps .= $fct_mes_citoyen_nom;
    $corps = ",\n\n";
    $corps .= "Vous venez d'être enregistré(e) sur le système économique EcoMicro. Votre Login est : ";
    $corps .= $fct_mes_citoyen_login;
    $corps .= ".\nPour obtenir votre mot de passe allez sur le site, sur un écran quelconque, et cliquez sur le bouton correspondant.";

  $corps .= "\n\n";
  $corps .= "EcoMicro\n";
  $corps .= "http://micromonde.ecomicro.net \n";
  $corps .= "\n\n";
  $corps .= "http://forum.micromonde.net \n";

//  $corps .= $fct_mes_citoyen_type;

  $adr_origine = "From:ecomicro@lazag.com";

  if( MAIL_ENABLED) mail($email,$sujet,$corps,$adr_origine);

?>