<?php
  // Envoi du message : Nouveau message

  $email = $fct_mes_newmessage_email;

  $sujet = "EcoMicro - Nouveau Message";

  $corps = "Bonjour " . $fct_mes_newmessage_nom . "\n\n" . "Un message vient de vous être envoyé sur le site de EcoMicro : http://micromonde.ecomicro.net .\n\n";
  $corps .= "\n\n";
  $corps .= "EcoMicro\n";
  $corps .= "\n\n";
  $corps .= "\n\n";
  $corps .= "Si vous n'avez pas sollicité ce message, merci de le signaler à l'adresse suivante : http://forum.micromonde.net\n";


  $adr_origine = "From:ecomicro@lazag.com";

  mail($email,$sujet,$corps,$adr_origine);

?>