<?php
  $t1 = time();
  $tjour = $t1;
  $moisj = date("m",$t1);
  $jourj = date("d",$t1);
  $anneej = date("Y",$t1);
  $date_jour = $anneej . "-" . $moisj . "-" . $jourj;
  $date_indic = $anneej . "-" . $moisj . "-" . $jourj;

  // Traitement des transactions périodiques
  include("include/trt_periodique.php");

  // Traitement des Messages
  include("include/trt_message.php");

  // Traitement des Citoyens
  include("include/trt_citoyen.php");

  // Traitement élection du responsable
  include("include/trt_responsable.php");

  // Traitement de la bourse
  include("include/trt_bourse.php");
//echo "Après trt bourse";

  // Recherche paramètre
  $sql = "SELECT param,valeur ";
  $sql .= "FROM eco_param ";
  $sql .= "WHERE param = 'DATE_DERNIER_TRT';";
  $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche param (trtcnx) !!!");
  $num = @mysqli_num_rows($res) or die("<br> Pas de param (trtcnx) !!!");
  $produit = mysqli_fetch_array($res);
  $param = $produit['param'];
  $date_trt = $produit['valeur'];
//echo "date trt : ",$date_trt,"<BR/>";
//echo "date jour : ",$date_jour,"<BR/>";
  if ($date_trt <= $date_jour){

    // Traitement déterminant la capacité mensuelle des entreprises du primaire
    include("include/trt_capacite.php");
//echo "Après trt capacité";

    // Traitement des besoins
    include("include/trt_besoin.php");
//echo "Après trt besoin";

    // Traitement de la bourse
//    include("include/trt_bourse.php");

    $joura = substr($date_trt,8,2);
    $anneea = substr($date_trt,0,4);
    $moisa = substr($date_trt,5,2) + 1;

    if ($moisa > 12){
    	$moisa = $moisa - 12;
    	$anneea++;
    }
    if ($moisa < 10)
       $moisa = "0" . $moisa;

    $valeur = $anneea . "-" . $moisa . "-" . $joura;

    $sql1 = "UPDATE eco_param SET valeur = '$valeur' WHERE param = '$param';";
    $res1 = @mysqli_query($conn, $sql1) or die("<br> PB de maj cnx. (trtcnx)");
  }
?>
