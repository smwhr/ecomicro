<?php

// Recherche des Messages expir�s
$sql = "SELECT idmsg ";
$sql .= "FROM eco_message ";
$sql .= "WHERE dateexpir <= '$date_jour' AND reponse <= ' '";

$result = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche message (trtcnx) !!!");
$num = @mysqli_num_rows($result);
if ($num > 0)
{
  while($produit = mysqli_fetch_array($result))
  {
    $idmsg = $produit["idmsg"];

    $sql = "UPDATE eco_message SET reponse = 'E' WHERE idmsg = '$idmsg';";
    $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le message. (trtcnx)");
  }
}


?>