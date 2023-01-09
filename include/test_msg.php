<?php

// $email = "armara_eco@googlegroups.com";
//$email = "martin_dutois@yahoo.fr";
$email = "julienzamor@gmail.com";

$sujet = "Test msg via programmation";

$corps = "Nouveau test";
$corps .= "\n\n";
$corps .= "EcoMicro\n";
$corps .= "http://micromonde.ecomicro.net \n";
$corps .= "\n\n";

$adr_origine = "From:ecomicro@lazag.com";
//$adr_origine .="\n".'Content-Type: text/plain;'."\n";

mail($email,$sujet,$corps,$adr_origine);
?>