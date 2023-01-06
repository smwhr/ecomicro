<?php

    $moisa = $moisj - 2;
    $anneea = $anneej;

    if ($moisa <= 0){
        $moisa += 12;
        $anneea -= 1;
    }
    if ($moisa < 10)
        $moisa = "0" . $moisa;

    $date_cnx = $anneea . "-" . $moisa . "-" . $jourj;

    // Recherche des users inactifs de plus 2 mois
    $sql = "SELECT eco_user.iduser, eco_user.nom, eco_user.email, eco_pays.emaileco ";
    $sql .= "FROM eco_user,eco_pays ";
    $sql .= "WHERE substr(datecnx,1,10) <= '$date_cnx' AND inactif = 0 ";
    $sql .= "AND eco_user.idpays = eco_pays.idpays ";

    $result = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche user inactif (trtcnx) !!!");
    $num = @mysqli_num_rows($result);

    if ($num > 0){
        while($produit = mysqli_fetch_array($result)){
            $iduser = $produit["iduser"];
            $emaileco = $produit["emaileco"];

            $fct_mes_citoyen_type = "INACTIF";
            $fct_mes_citoyen_nom = $produit["nom"];
            $fct_mes_citoyen_email = $produit["email"];

            $sql = "UPDATE eco_user SET inactif = 1 WHERE iduser = '$iduser';";
            $res = @mysqli_query($conn, $sql) or die("<br> Màj de votre profil n'a pu être effectuée ! Veuillez contacter l'administrateur.");

            // Envoi du message
            $email = $emaileco . "@googlegroups.com";

            $sujet = "EcoMicro - Citoyen : ";
            $sujet .= $fct_mes_citoyen_nom;

            $corps = $fct_mes_citoyen_nom;
            $corps .= " ";
            $corps .= "est passé(e) inactif(ve).";

            $corps .= "\n\n";
            $corps .= "EcoMicro\n";
            $corps .= "http://micromonde.ecomicro.net \n";
            $corps .= "\n\n";
            //  $corps .= $fct_mes_citoyen_type;

            $adr_origine = "From:ecomicro@lazag.com";

            mail($email,$sujet,$corps,$adr_origine);

            $email = $fct_mes_citoyen_email;

            $sujet = "EcoMicro - Inactif : ";
            $sujet .= $fct_mes_citoyen_nom;

            $corps = "Bonjour ";
            $corps .= $fct_mes_citoyen_nom;
            $corps .= ",\n\n";
            $corps .= "Vous venez de passer inactif(ve) sur le système économique EcoMicro. Il vous suffit de vous connecter de nouveau pour redevenir actif.";

            $corps .= "\n\n";
            $corps .= "EcoMicro\n";
            $corps .= "http://micromonde.ecomicro.net \n";
            $corps .= "\n\n";
            //  $corps .= $fct_mes_citoyen_type;

            $adr_origine = "From:ecomicro@lazag.com";

            mail($email,$sujet,$corps,$adr_origine);
        }
    }
    
    // Transfert des titres des inactifs de plus de 4 mois
    $moisTitre = $moisj - 4;
    $anneeTitre = $anneej;
    if ($moisTitre <= 0){
        $moisTitre += 12;
        $anneeTitre -= 1;
    }
    if ($moisTitre < 10)
        $moisTitre = "0" . $moisTitre;
    $dateTitre = $anneeTitre . "-" . $moisTitre . "-" . $jourj;

    // Recherche des users avec des titres et inactifs depuis plus de 4 mois
    $sql = "SELECT eco_user.iduser, eco_bourse.identreprise, eco_bourse.nbaction, eco_entreprise.idpays ";
    $sql .= "FROM eco_user,eco_pays, eco_bourse, eco_entreprise ";
    $sql .= "WHERE substr(datecnx,1,10) <= '$dateTitre' ";
    $sql .= "AND eco_user.idpays = eco_pays.idpays ";
    $sql .= "AND eco_user.iduser = eco_bourse.idactionnaire ";
    $sql .= "AND eco_bourse.identreprise = eco_entreprise.identreprise ";
    $sql .= "AND eco_bourse.nbaction > 0 ";

    $result = @mysqli_query($conn, $sql)or die("Erreur dans la requête de recherche user titre 4 mois (trtcnx) !!!");
    $num = @mysqli_num_rows($result);

    if ($num > 0){
        while($produit = mysqli_fetch_array($result)){
            $iduser = $produit["iduser"];
            $identreprise = $produit["identreprise"];
            $nbaction = $produit["nbaction"];
            $idpays = $produit["idpays"];

            $sql = "SELECT * FROM eco_bourse WHERE idactionnaire = '$idpays' AND identreprise = '$identreprise';";
            $res = @mysqli_query($conn, $sql) or die("<br> Select de nb titre n\'a pas pu être effectuée ! Veuillez contacter l'administrateur. ".$sql);
            $num = @mysqli_num_rows($res);
            if ($num > 0){
                $sql = "UPDATE eco_bourse SET nbaction = nbaction + '$nbaction', datederniereope = NOW() WHERE idactionnaire = '$idpays' AND identreprise = '$identreprise';";
                $res = @mysqli_query($conn, $sql) or die("<br> Màj1 de nb titre n\'a pas pu être effectuée ! Veuillez contacter l'administrateur. ".$sql);
            }
            else {
                $sql = "INSERT INTO eco_bourse (identreprise, idactionnaire, nbaction, datederniereope) ";
                $sql .= " VALUES( '$identreprise', '$idpays', '$nbaction', NOW());";
                $res = @mysqli_query($conn, $sql) or die("<br> Insert de nb titre n\'a pas pu être effectuée ! Veuillez contacter l'administrateur. ".$sql);
            }
            $sql = "UPDATE eco_bourse SET nbaction = 0, datederniereope = NOW() WHERE idactionnaire = '$iduser' AND identreprise = '$identreprise';";
            $res = @mysqli_query($conn, $sql) or die("<br> Màj2 de nb titre n\'a pas pu être effectuée ! Veuillez contacter l'administrateur. ".$sql);
        }
    }

?>