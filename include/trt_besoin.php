<?php





// Recherche des d�finition de besoin

$sql = "SELECT iddefbesoin,type,typeproduit,quantite,entite,typedata,nbdata ";

$sql .= "FROM eco_defbesoin;";



$result = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te de recherche besoin (trtcnx) !!!");

$num = @mysqli_num_rows($result);

if ($num > 0)

{



  $count = 0;

  while($produit = mysqli_fetch_array($result))

  {

    $iddefbesoin = $produit["iddefbesoin"];

    $type = $produit["type"];

    $typeproduit = $produit["typeproduit"];

    $quantite = $produit["quantite"];

    $entite = $produit["entite"];

    $typedata = $produit["typedata"];

    $nbdata = $produit["nbdata"];



    $idjoueur = $_SESSION['iduser'];



    // Trt des etats

    if ($entite == 'ETAT')
    {

      // Liste des �tat

      $sql1 = "SELECT eco_pays.idpays, identreprise ";

      $sql1 .= "FROM eco_pays, eco_entreprise ";

      $sql1 .= "WHERE eco_pays.idpays = eco_entreprise.idpays ";

      $sql1 .= "AND eco_entreprise.typeentreprise = '90000' ";

      $sql1 .= "ORDER BY eco_pays.idpays, identreprise;";

      $res1 = @mysqli_query($conn, $sql1)or die("Erreur dans la requ�te de recherche pays/province (trtcnx) !!!");

      $num1 = @mysqli_num_rows($res1);
      $count = 0;

      while($prod1 = mysqli_fetch_array($res1))

      {

          $idpays = $prod1["idpays"];

          $idprovince = $prod1["identreprise"];



          $nb = 0;

          if ($typedata == 'CITO')

          {

            // Compte les citoyens actifs

            $sql2 = "SELECT count(iduser) as nb ";

            $sql2 .= "FROM eco_user, eco_immo ";

            $sql2 .= "WHERE idpays = '$idpays' AND inactif = '0' ";

            $sql2 .= "AND ((eco_user.iduser = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_user.iduser <> eco_immo.idproprio AND eco_user.iduser = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche nb citoyens (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 < 1) continue;

            $prod2 = mysqli_fetch_array($res2);

            $nb = $prod2["nb"];

          }

          else if ($typedata == 'ENTE')

          {

            // Compte les entreprises actives

            $sql2 = "SELECT count(identreprise) as nb ";

            $sql2 .= "FROM eco_entreprise, eco_immo ";

            $sql2 .= "WHERE eco_entreprise.idpays = '$idpays' AND iduser > '0' ";

            $sql2 .= "AND ((eco_entreprise.identreprise = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_entreprise.identreprise <> eco_immo.idproprio AND eco_entreprise.identreprise = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche nb citoyens (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);



            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche nb entreprises (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche nb entreprises (trtcnx) !!!");

            $prod2 = mysqli_fetch_array($res2);

            $nb = $prod2["nb"];

          }

          else if ($typedata == 'PRIM')

          {

            // Compte les entreprises du primaire actives

            $sql2 = "SELECT count(identreprise) as nb ";

            $sql2 .= "FROM eco_entreprise, eco_immo ";

            $sql2 .= "WHERE idpays = '$idpays' AND (typeentreprise = '40000' OR (typeentreprise >= '10000' AND typeentreprise < '20000')) AND iduser > '0' ";

            $sql2 .= "AND ((eco_entreprise.identreprise = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_entreprise.identreprise <> eco_immo.idproprio AND eco_entreprise.identreprise = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche nb entreprises primaires (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 < 1) continue;

            $prod2 = mysqli_fetch_array($res2);

            $nb = $prod2["nb"];

          }

          else if ($typedata == 'SECO')

          {

            // Compte les entreprises du secondaire actives

            $sql2 = "SELECT count(identreprise) as nb ";

            $sql2 .= "FROM eco_entreprise, eco_immo ";

            $sql2 .= "WHERE idpays = '$idpays' AND ((typeentreprise >= '50000' AND typeentreprise < '60000') OR (typeentreprise >= '20000' AND typeentreprise < '30000')) AND iduser > '0' ";

            $sql2 .= "AND ((eco_entreprise.identreprise = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_entreprise.identreprise <> eco_immo.idproprio AND eco_entreprise.identreprise = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche nb entreprises secondaires (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 < 1) continue;

            $prod2 = mysqli_fetch_array($res2);

            $nb = $prod2["nb"];

          }

          else if ($typedata == 'TERT')

          {

            // Compte les entreprises du tertiaire actives

            $sql2 = "SELECT count(identreprise) as nb ";

            $sql2 .= "FROM eco_entreprise, eco_immo ";

            $sql2 .= "WHERE idpays = '$idpays' AND typeentreprise >= '30000' AND typeentreprise < '40000' AND iduser > '0' ";

            $sql2 .= "AND ((eco_entreprise.identreprise = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_entreprise.identreprise <> eco_immo.idproprio AND eco_entreprise.identreprise = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche nb entreprises secondaires (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 < 1) continue;

            $prod2 = mysqli_fetch_array($res2);

            $nb = $prod2["nb"];

          }

          else if ($typedata == 'PROV')

          {

            // Compte les provinces

            $sql2 = "SELECT count(identreprise) as nb ";

            $sql2 .= "FROM eco_entreprise, eco_immo ";

            $sql2 .= "WHERE idpays = '$idpays' AND typeentreprise = '90000' ";

            $sql2 .= "AND ((eco_entreprise.identreprise = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_entreprise.identreprise <> eco_immo.idproprio AND eco_entreprise.identreprise = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche nb entreprises secondaires (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 < 1) continue;

            $prod2 = mysqli_fetch_array($res2);

            $nb = $prod2["nb"];

          }

          else if ($typedata == 'AUTO')

          {

            // Compte les automobiles

            $sql2 = "SELECT count(eco_possession.idpossession) as nb ";

            $sql2 .= "FROM eco_possession,eco_user, eco_immo ";

            $sql2 .= "WHERE eco_possession.typeproduit = '10001' AND eco_possession.idpossesseur = eco_user.iduser AND eco_user.inactif = '0' AND eco_user.idpays = '$idpays' ";

            $sql2 .= "AND ((eco_user.iduser = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_user.iduser <> eco_immo.idproprio AND eco_user.iduser = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche possession1 (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 > 0)

            {

              $prod2 = mysqli_fetch_array($res2);

              $nb1 = $prod2["nb"];

            }

            else

              $nb1 = 0;

            $sql2 = "SELECT count(eco_possession.idpossession) as nb ";

            $sql2 .= "FROM eco_possession,eco_entreprise, eco_immo ";

            $sql2 .= "WHERE eco_possession.typeproduit = '10001' AND eco_possession.idpossesseur = eco_entreprise.identreprise AND eco_entreprise.idpays = '$idpays' AND iduser > '0' ";

            $sql2 .= "AND ((eco_entreprise.identreprise = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_entreprise.identreprise <> eco_immo.idproprio AND eco_entreprise.identreprise = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche possession2 (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 > 0)

            {

              $prod2 = mysqli_fetch_array($res2);

              $nb2 = $prod2["nb"];

            }

            else

              $nb2 = 0;

            $nb = $nb1 + $nb2;

          }

          else if ($typedata == 'BATE')

          {

            // Compte les citoyens actifs

            $sql2 = "SELECT count(eco_possession.idpossession) as nb ";

            $sql2 .= "FROM eco_possession,eco_user, eco_immo ";

            $sql2 .= "WHERE eco_possession.typeproduit = '10002' AND eco_possession.idpossesseur = eco_user.iduser AND eco_user.inactif = '0' AND eco_user.idpays = '$idpays' ";

            $sql2 .= "AND ((eco_user.iduser = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_user.iduser <> eco_immo.idproprio AND eco_user.iduser = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche possession3 (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 > 0)

            {

              $prod2 = mysqli_fetch_array($res2);

              $nb1 = $prod2["nb"];

            }

            else

              $nb1 = 0;

            $sql2 = "SELECT count(eco_possession.idpossession) as nb ";

            $sql2 .= "FROM eco_possession,eco_entreprise, eco_immo ";

            $sql2 .= "WHERE eco_possession.typeproduit = '10002' AND eco_possession.idpossesseur = eco_entreprise.identreprise AND eco_entreprise.idpays = '$idpays' AND iduser > '0' ";

            $sql2 .= "AND ((eco_entreprise.identreprise = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_entreprise.identreprise <> eco_immo.idproprio AND eco_entreprise.identreprise = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche possession4 (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 > 0)

            {

              $prod2 = mysqli_fetch_array($res2);

              $nb2 = $prod2["nb"];

            }

            else

              $nb2 = 0;

            $nb = $nb1 + $nb2;

          }

          else if ($typedata == 'AERO')

          {

            // Compte les citoyens actifs

            $sql2 = "SELECT count(eco_possession.idpossession) as nb ";

            $sql2 .= "FROM eco_possession,eco_user, eco_immo ";

            $sql2 .= "WHERE eco_possession.typeproduit = '10003' AND eco_possession.idpossesseur = eco_user.iduser AND eco_user.inactif = '0' AND eco_user.idpays = '$idpays' ";

            $sql2 .= "AND ((eco_user.iduser = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_user.iduser <> eco_immo.idproprio AND eco_user.iduser = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche possession5 (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 > 0)

            {

              $prod2 = mysqli_fetch_array($res2);

              $nb1 = $prod2["nb"];

            }

            else

              $nb1 = 0;

            $prod2 = mysqli_fetch_array($res2);

            $nb1 = $prod2["nb"];

            $sql2 = "SELECT count(eco_possession.idpossession) as nb ";

            $sql2 .= "FROM eco_possession,eco_entreprise, eco_immo ";

            $sql2 .= "WHERE eco_possession.typeproduit = '10003' AND eco_possession.idpossesseur = eco_entreprise.identreprise AND eco_entreprise.idpays = '$idpays' AND iduser > '0' ";

            $sql2 .= "AND ((eco_entreprise.identreprise = eco_immo.idproprio AND eco_immo.idlocataire = '0' AND eco_immo.occupe = '1') ";

            $sql2 .= "OR (eco_entreprise.identreprise <> eco_immo.idproprio AND eco_entreprise.identreprise = eco_immo.idlocataire AND eco_immo.occupe = '1')) ";

            $sql2 .= "AND eco_immo.province = '$idprovince';";

            $res2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requ�te de recherche possession6 (trtcnx) !!!");

            $num2 = @mysqli_num_rows($res2);

            if ($num2 > 0)

            {

              $prod2 = mysqli_fetch_array($res2);

              $nb2 = $prod2["nb"];

            }

            else

              $nb2 = 0;

            $nb = $nb1 + $nb2;

          }



          if ($nb == 0)

            continue;



          if ($nbdata != 0)

            $facteur = $nb / $nbdata;

          else

            $facteur = 1;





          $besoin = $quantite * $facteur;







          // Maj ou cr�ation Besoin

          $sql2 = "SELECT quantite FROM eco_besoin ";

          $sql2 .= "WHERE idpays = '$idpays' AND idtitulaire = '$idprovince' AND type = '$type' AND typeproduit = '$typeproduit';";

          $res2 = @mysqli_query($conn, $sql2)or die("Erreur dans la requ�te de recherche de la quantit� (trtcnx) !!!");

          if (!($num2 = @mysqli_num_rows($res2)))

          {

             $sql = "INSERT INTO eco_besoin (idpays,idtitulaire,type,typeproduit,quantite) VALUES ('$idpays','$idprovince','$type','$typeproduit','$besoin');";

             $res = @mysqli_query($conn, $sql)or die("Erreur dans la requ�te d'insertion d'un nouveau besoin (trtcnx) !!!");

          }

          else

          {

             $produit = mysqli_fetch_array($res2);



             $new_quantite = $produit['quantite'] + $besoin;

             $sql = "UPDATE eco_besoin SET quantite = '$new_quantite' WHERE idpays = '$idpays' AND idtitulaire = '$idprovince' AND type = '$type' AND typeproduit = '$typeproduit';";

             $res = @mysqli_query($conn, $sql) or die("<br> PB de m�j le besoin. (trtcnx)");

          }



        }

      }

  }

}





?>



