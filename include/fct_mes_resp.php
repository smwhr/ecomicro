<?php
  // Envoi du message : Responsable

// $fct_mes_resp_type
// $fct_mes_resp_ncpte                  (fct_mes_resp_type = C, D)
// $fct_mes_resp_montant                  (fct_mes_resp_type = C, D)
// $fct_mes_resp_devise                    (fct_mes_resp_type = C, D)
// $fct_mes_resp_pays                       (fct_mes_resp_type = T, O, F, TAXE)
// $fct_mes_resp_taux                    (fct_mes_resp_type = T, TAXE)
// $fct_mes_resp_typetaxe                    (fct_mes_resp_type = TAXE)
// $fct_mes_resp_eco                    (fct_mes_resp_type = O, F)
// $fct_mes_resp_email                    (fct_mes_resp_type = E)

  $email = $fct_mes_resp_emaileco . "@googlegroups.com";

  $sujet = "EcoMicro - Responsable : ";
  if ($fct_mes_resp_type == 'C')       // Crédit responsable
  {
    $sujet .= "Crédit d'un compte";

    $corps = "Le responsable vient de créditer le compte : ";
    $corps .= $fct_mes_resp_ncpte;
    $corps .= ", de la somme de : ";
    $corps .= $fct_mes_resp_montant;
    $corps .= " ";
    $corps .= utf8_encode($fct_mes_resp_devise);
    $corps .= ".";

  }
  else if ($fct_mes_resp_type == 'D')       // Débit responsable
  {
    $sujet .= "Débit d'un compte";

    $corps = "Le responsable vient de débiter le compte : ";
    $corps .= $fct_mes_resp_ncpte;
    $corps .= ", de la somme de : ";
    $corps .= $fct_mes_resp_montant;
    $corps .= " ";
    $corps .= utf8_encode($fct_mes_resp_devise);
    $corps .= ".";
  }
  else if ($fct_mes_resp_type == 'T')       // Taux de change
  {
    $sujet .= "Définission d'un taux de change";

    $corps = "Le responsable vient de définir avec : ";
    $corps .= utf8_encode($fct_mes_resp_pays);
    $corps .= ", un Taux de change de : ";
    $corps .= $fct_mes_resp_taux;
    $corps .= ".";
  }
  else if ($fct_mes_resp_type == 'O')       // Ouverture relations diplomatiques
  {
    $sujet .= "Ouverture Relations";

    $corps = "Le responsable vient d'ouvrir avec : ";
    $corps .= utf8_encode($fct_mes_resp_pays);
    $corps .= ", des relations ";

    if ($fct_mes_resp_eco == '1')
      $corps .= "diplomatiques";
    else
      $corps .= "économiques";
    $corps .= ".";
  }
  else if ($fct_mes_resp_type == 'F')       // Fermeture relations diplomatiques
  {
    $sujet .= "Ouverture Relations";

    $corps = "Le responsable vient de fermer avec : ";
    $corps .= utf8_encode($fct_mes_resp_pays);
    $corps .= ", les relations ";

    if ($fct_mes_resp_eco == '1')
      $corps .= "diplomatiques";
    else
      $corps .= "économiques";
    $corps .= ".";
  }
  else if ($fct_mes_resp_type == 'E')       // Modification Email
  {
    $email = $fct_mes_resp_email_old . "@googlegroups.com";

    $sujet .= "ML éco";

    $corps = "Le responsable vient de modifier l'adresse de la ML éco pour : ";
    $corps .= $fct_mes_resp_email_new;
    $corps .= ".";
  }
  else if ($fct_mes_resp_type == 'TAXE')       // Modification Taxe
  {
    $sujet .= "TAXE";

    $corps = "Le responsable vient de positionner la taxe : ";
    $corps .= utf8_encode($fct_mes_resp_typetaxe);
    if ($fct_mes_resp_pays > '')
    {
      $corps .= " ";
      $corps .= "avec le pays : ";
      $corps .= utf8_encode($fct_mes_resp_pays);
    }
      $corps .= " ";
      $corps .= "à un taux de : ";
      $corps .= $fct_mes_resp_taux;
      $corps .= " ";
      $corps .= "%.";
  }

$msg = $corps;

  $corps .= "\n\n";
  $corps .= "EcoMicro\n";
  $corps .= "http://micromonde.ecomicro.net \n";
  $corps .= "\n\n";
  $corps .= "http://forum.micromonde.net \n";

//  $corps .= $fct_mes_resp_type;

  $adr_origine = "From:ecomicro@lazag.com";

  if ($email == "ecoprya@googlegroups.com") {
  
	$db_id = @mysql_connect("localhost","ZZ_user_ZZ","ZZ_password_ZZ") or die("Impossible de se connecter à la base de données"); // Le @ ordonne a php de ne pas afficher de message d'erreur
	@mysqli_select_db("nationprya", $db_id);

	$sql = "SELECT * FROM a1_kunena_messages WHERE id = 6609;";
	$res = @mysqli_query($conn, $sql, $db_id);
    $dataMsg = @mysqli_fetch_array($res);

	$parent = $dataMsg['parent'];
	$thread = $dataMsg['thread'];
	$catid = $dataMsg['catid'];
	$name = $dataMsg['name'];
	$userid = $dataMsg['userid'];
	$email = $dataMsg['email'];
	$subject = $dataMsg['subject'];
	
/*
	$sql = "SELECT max(id) as maxid FROM a1_kunena_messages;";
	$res = @mysqli_query($conn, $sql, $db_id);
    $dataMax = @mysqli_fetch_array($res);
	
	$newid = $dataMax['maxid'] + 1;
*/
	$t = time();
	
	$msg = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($msg))));

	$sql = "INSERT INTO a1_kunena_messages (id, parent, thread, catid, name, userid, email, subject, time, ip) ";
	$sql .= "VALUES (NULL, 6609, '$thread', '$catid', '$name', '$userid', '$email', '$subject', '$t', '10.10.10.101');";
	$res = @mysqli_query($conn, $sql, $db_id);

	$newid = mysql_insert_id($db_id);
	
	$sql = "INSERT INTO a1_kunena_messages_text (`mesid`, `message`) VALUES ('$newid', '$msg');";
	$res = @mysqli_query($conn, $sql, $db_id);
  
	$sql = "UPDATE a1_kunena_topics SET posts = posts + 1, last_post_id = '$newid', last_post_time = '$t', last_post_userid = '$userid', last_post_message = '$msg', last_post_guest_name = '$name' WHERE id = 6311;";
	$res = @mysqli_query($conn, $sql, $db_id);

	@mysql_close($db_id);
  
    $sujet = "=?utf-8?B?".base64_encode($sujet)."?=";
    $adr_origine .= "\n";
    $adr_origine .='Content-Type: text/plain; charset="utf-8"'."\n";
    $corps = "[£££ECOMICRO£££]" . $corps;
  	mail("prya-forum@micromonde.net",$sujet,$corps,$adr_origine);
  } 
  else
    mail($email,$sujet,$corps,$adr_origine);



  if ($fct_mes_resp_type == 'E')       // Modification ML éco
  {
    $email = $fct_mes_resp_email_new . "@googlegroups.com";

    $corps = "L'ancienne adresse de la ML éco était : ";
    $corps .= $fct_mes_resp_email_old;
    $corps .= ".";

    $corps .= "\n\n";
    $corps .= "EcoMicro\n";
    $corps .= "http://micromonde.ecomicro.net \n";
  $corps .= "\n\n";
  $corps .= "http://forum.micromonde.net \n";

//    $corps .= $fct_mes_resp_type;

    $adr_origine = "From:ecomicro@lazag.com";

	if ($email == "ecoprya@googlegroups.com") {
		$sujet = "=?utf-8?B?".base64_encode($sujet)."?=";
		$adr_origine .= "\n";
		$adr_origine .='Content-Type: text/plain; charset="utf-8"'."\n";
		$corps = "[£££ECOMICRO£££]" . $corps;
		mail("prya-forum@micromonde.net",$sujet,$corps,$adr_origine);
	  } 
	  else
		mail($email,$sujet,$corps,$adr_origine);

  }

?>