<?php

// Recherche des Election en cours
$sql = "SELECT idpays, nompays,emaileco ";
$sql .= "FROM eco_pays ";
$sql .= "WHERE election = 1 AND dateelection <= '$date_jour'";

$result = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche elections (trtresp) !!!");
$num = @mysqli_num_rows($result);

if ($num > 0){
    while($produit = mysqli_fetch_array($result)){

        $idpays = $produit["idpays"];
        $nompays = $produit["nompays"];
        $emaileco = $produit["emaileco"];

         // Recherche des votes
         $sql = "SELECT resp, count(resp) as voix ";
         $sql .= "FROM eco_user ";
         $sql .= "WHERE election = 1 AND idpays = '$idpays' AND inactif = 0 AND exclu = 0 ";
         $sql .= "GROUP BY resp ORDER BY voix DESC ";

         $res = @mysqli_query($conn, $sql)or die("Erreur dans la requete de recherche elections (trtresp) !!!");
         $num = @mysqli_num_rows($res);

        $count = 0;
        $a = 0;
        $resp1 = $resp2 = $resp1_voix = $resp2_voix = 0;
        $blanc = $voix_total = 0;

         if ($num > 0){
            while($produit1 = mysqli_fetch_array($res)){
                $resp = $produit1["resp"];
                $voix = $produit1["voix"];

                if ($resp == 0)
                    $blanc = $voix;
                else if ($a == 0){
                    $resp1 = $resp;
                    $resp1_voix = $voix;
                    $a++;
                    $voix_total += $voix;
                }
                else if ($a == 1){
                    $resp2 = $resp;
                    $resp2_voix = $voix;
                    $a++;
                    $voix_total += $voix;
                }
                else
                    $voix_total += $voix;
            }

            if ($resp1 != 0){
                $sql = "UPDATE eco_pays SET election = 0 WHERE idpays = '$idpays';";
                $res = @mysqli_query($conn, $sql) or die("<br> Màj du pays (trtresp) n'a pu être effectuée ! Veuillez contacter l'administrateur.");

                // Affectation du responsable
                $sql = "INSERT INTO eco_fonction (idfonction,iduser,fonction,auto1,auto2,auto3) VALUES('','$resp1','ETAT','1','5','1');";
                $res = @mysqli_query($conn, $sql) or die("Création fonction impossible. Contactez l'administrateur (trtresp)");
                $sql = "UPDATE eco_pays SET iduser = '$resp1' WHERE idpays = '$idpays';";
                $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre pays n'a pu être effectuée ! Veuillez contacter l'administrateur.(trtresp)");

                $sql = "SELECT nom ";
                $sql .= "FROM eco_user ";
                $sql .= "WHERE iduser = '$resp1'; ";
                $res = @mysqli_query($conn, $sql) or die("Erreur dans la requête de recherche elections (trtresp) !!!");
                $num = @mysqli_num_rows($res);
                $produit1 = mysqli_fetch_array($res);

                $nom_resp1 = $produit1["nom"];

                if ($resp2 != 0){
                    $sql = "SELECT nom ";
                    $sql .= "FROM eco_user ";
                    $sql .= "WHERE iduser = '$resp2'; ";
                    $res = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche elections (trtresp) !!!");
                    $num = @mysqli_num_rows($res);
                    $produit1 = mysqli_fetch_array($res);

                    $nom_resp2 = $produit1["nom"];
                } else
                    $nom_resp2 = "";

                $email = $emaileco . "@googlegroups.com";

                $sujet = "EcoMicro - Election responsable : ";
                $sujet .= $nompays;

                $corps = $nom_resp1;
                $corps .= " ";
                $corps .= "est le(a) nouveau(lle) responsable économique";
                $corps .= ", avec";
                $corps .= " ";
                $corps .= $resp1_voix;
                $corps .= " ";
                $corps .= "voix.";

                if ($resp2_voix > 0){
                    $corps .= "\n\n";
                    $corps .= $nom_resp2;
                    $corps .= " ";
                    $corps .= "est arrivé(e) second(e)";
                    $corps .= ", avec";
                    $corps .= " ";
                    $corps .= $resp2_voix;
                    $corps .= " ";
                    $corps .= "voix.";
                }

                $corps .= "\n\n";
                $corps .= "Il y a eu ";
                if ($blanc > 0){
                    $corps .= $blanc;
                    $corps .= " ";
                    $corps .= "votes blancs et";
                    $corps .= " ";
                }
                $corps .= $voix_total;
                $corps .= " ";
                $corps .= "votes au total (hors votes blancs).";

                $sql = "UPDATE eco_pays SET election = 0 WHERE idpays = '$idpays';";
                $res = @mysqli_query($conn, $sql) or die("<br> Màj du pays (trtresp) n'a pu être effectuée ! Veuillez contacter l'administrateur.");

            }
        }
        if ($resp1 == 0){
            $sql = "UPDATE eco_pays SET election = 1, dateelection = DATE_ADD(NOW(), INTERVAL 7 DAY) WHERE idpays = '$idpays';";
            $res = @mysqli_query($conn, $sql) or die("<br> Màj du pays (trtresp) n'a pu être effectuée ! Veuillez contacter l'administrateur.".$sql);

            $email = $emaileco . "@googlegroups.com";

            $sujet = "EcoMicro - Election responsable : ";
            $sujet .= $nompays;

            $corps = "\nAucun candidat n'a pu se démarquer.";
            $corps .= "\n\n";
            $corps .= "Il y a eu ";
            if ($blanc > 0){
                $corps .= $blanc;
                $corps .= " ";
                $corps .= "votes blancs et";
                $corps .= " ";
            }
            $corps .= $voix_total;
            $corps .= " ";
            $corps .= "votes au total.";

            $corps .= "\n\n";
            $corps .= "L'élection est relancé durant 7 jours.";

        }
        $corps .= "\n\n";
        $corps .= "EcoMicro\n";
        $corps .= "http://micromonde.ecomicro.net \n";
        $corps .= "\n\n";
        //  $corps .= $fct_mes_citoyen_type;

        $adr_origine = "From:ecomicro@lazag.com";

        if( MAIL_ENABLED) mail($email,$sujet,$corps,$adr_origine);

    }
}
?>