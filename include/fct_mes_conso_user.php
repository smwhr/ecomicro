
<?php
  // Envoi du message : Consommer

// $fct_mes_conso_nom
// $fct_mes_conso_nomproduit
// $fct_mes_conso_emaileco 

  $email = $fct_mes_conso_emaileco . "@googlegroups.com";

  $sujet = "EcoMicro - Consommation : ";
  $sujet .= $fct_mes_conso_nom;

    $corps = utf8_encode($fct_mes_conso_nom);
    $corps .= " vient de consommer : ";
    $corps .= utf8_encode($fct_mes_conso_nomproduit);
    $corps .= ".";

  $corps .= "\n\n";
  $corps .= "EcoMicro\n";
  $corps .= "http://micromonde.ecomicro.net \n";
  $corps .= "\n\n";
  $corps .= "http://forum.micromonde.net \n";

  $adr_origine = "From:ecomicro@lazag.com";

  if ($email == "ecoprya@googlegroups.com") {
  
	$db_id = @mysql_connect("localhost","ZZ_user_ZZ","ZZ_password_ZZ") or die("Impossible de se connecter à la base de données"); // Le @ ordonne a php de ne pas afficher de message d'erreur
	@mysqli_select_db("nationprya", $db_id);

	$sql = "SELECT * FROM a1_kunena_messages WHERE id = 6605;";
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
	
    $msg = $fct_mes_conso_nom;
    $msg .= " vient de consommer : ";
    $msg .= $fct_mes_conso_nomproduit;
    $msg .= ".";
	$msg = addslashes(Str_replace( "\"", " ", Str_replace( "'", " ", trim($msg))));

	$sql = "INSERT INTO a1_kunena_messages (id, parent, thread, catid, name, userid, email, subject, time, ip) ";
	$sql .= "VALUES (NULL, 6605, '$thread', '$catid', '$name', '$userid', '$email', '$subject', '$t', '10.10.10.101');";
	$res = @mysqli_query($conn, $sql, $db_id);

	$newid = mysql_insert_id($db_id);
	
	$sql = "INSERT INTO a1_kunena_messages_text (`mesid`, `message`) VALUES ('$newid', '$msg');";
	$res = @mysqli_query($conn, $sql, $db_id);
  
	$sql = "UPDATE a1_kunena_topics SET posts = posts + 1, last_post_id = '$newid', last_post_time = '$t', last_post_userid = '$userid', last_post_message = '$msg', last_post_guest_name = '$name' WHERE id = 6307;";
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


?>