<?php

include("config.php");
$conn = mysqli_connect($host,$user,$pass) or die("Verif 9 - Impossible de se connecter");
@mysqli_select_db($conn, $bdd) or die("Verif 10 - Impossible de se connecter à la base de données");

    $tab_identreprise = array();
    $tab_nbtitre = array();
    $tab_cotation = array();
    $tab_devise = array();
    $tab_dernierecotation = array();
    $tab_evol3mois = array();
    $tab_evol12mois = array();
    $tab_new_cotation = array();

    $idjoueur = $_SESSION['iduser'];

// Recherche des cotations
//------------------------

$sql2 = "SELECT eco_cotation.identreprise,nbtitre,cotation,eco_cotation.devise,dernierecotation,evol3mois,evol12mois,eco_entreprise.nomentreprise ";
$sql2 .= "FROM eco_cotation, eco_entreprise ";
$sql2 .= "WHERE eco_cotation.identreprise = eco_entreprise.identreprise;";

$result2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requète de recherche besoin (trt_bourse) !!!");
$num2 = @mysqli_num_rows($result2);
if ($num2 > 0){

  $count = 0;
  while($produit2 = mysqli_fetch_array($result2))  {
    $identreprise = $produit2["identreprise"];
    $nomentreprise = $produit2["nomentreprise"];

    valorisation($identreprise,$nomentreprise);
    $count++;
  }
}

// Màj des cotations
//------------------
for($i=0;$i<$count;$i++){
   $sql2 = "SELECT nomentreprise ";
   $sql2 .= "FROM eco_entreprise WHERE identreprise = '$tab_identreprise[$i]';";
   $result2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requète de recherche besoin (trt_bourse) !!!");
   $num2 = @mysqli_num_rows($result2);
   if ($num2 > 0)   {
     $produit2 = mysqli_fetch_array($result2);

     $new_cotation = round($tab_new_cotation[$i] / $tab_nbtitre[$i]);

     echo $produit2['nomentreprise'],"  -> ",$new_cotation,"<br>";

     $sql2 = "UPDATE eco_cotation SET cotation = '$new_cotation',dernierecotation = '$tab_cotation[$i]', datemaj = NOW() ";
     $sql2 .= "WHERE identreprise = $tab_identreprise[$i] ;";

//	$result2 = @mysqli_query($conn, $sql2) or die("Erreur dans la requète de màj cotation (trt_bourse) !!!");
   }
}


function valorisation($entreprise,$nomentreprise1){

	global $tab_identreprise;
	global $tab_nbtitre;
	global $tab_cotation;
	global $tab_devise;
	global $tab_dernierecotation;
	global $tab_evol3mois;
	global $tab_evol12mois;
	global $tab_new_cotation;

echo "entreprise : ",$nomentreprise1,"<br>";

    // Recherche infos entreprise
    //---------------------------

    $sql = "SELECT eco_cotation.identreprise,nbtitre,cotation,eco_cotation.devise,dernierecotation,evol3mois,evol12mois,eco_entreprise.nomentreprise ";
    $sql .= "FROM eco_cotation,eco_entreprise ";
    $sql .= "WHERE eco_cotation.identreprise = '$entreprise' ";
    $sql .= "AND eco_cotation.identreprise = eco_entreprise.identreprise;";

    $result = @mysqli_query($conn, $sql)or die("Erreur dans la requète de recherche besoin (trt_bourse) !!!");
    $num = @mysqli_num_rows($result) or die("Erreur dans la requète de recherche info (trt_bourse) !!!");
    $produit = mysqli_fetch_array($result);

    $deja = 0;	

    $count1 = 0;
    While($tab_identreprise[$count1] > "")    {
        if ($tab_identreprise[$count1] == $entreprise){
           $deja = 1;
           break;
        }
        $count1++;
    }

    $tab_identreprise[$count1] = $produit["identreprise"];
    $tab_nbtitre[$count1] = $produit["nbtitre"];
    $tab_cotation[$count1] = $produit["cotation"];
    $tab_devise[$count1] = $produit["devise"];
    $tab_dernierecotation[$count1] = $produit["dernierecotation"];
    $tab_evol3mois[$count1] = $produit["evol3mois"];
    $tab_evol12mois[$count1] = $produit["evol12mois"];

//    $tab_new_cotation[$count1] = 0;

    // Cas entreprise déjà traitée ou participation croisée
    //-----------------------------------------------------
    if ($deja == 1)    {

      if ($tab_new_cotation[$count1] > 0)
         return($tab_new_cotation[$count1]);
      else
         return($tab_cotation[$count1] * $tab_nbtitre[$count1]);
    }

    // Recherche des participations
    //-----------------------------
    $val = 0;

    $sql = "SELECT eco_bourse.identreprise,nbaction,nbtitre ";
    $sql .= "FROM eco_bourse, eco_cotation ";
    $sql .= "WHERE eco_bourse.idactionnaire = '$entreprise' AND eco_bourse.identreprise = eco_cotation.identreprise;";

    $result = @mysqli_query($conn, $sql)or die("Erreur dans la requète de recherche besoin (trt_bourse actionnaire) 1 !!!");
    $num = @mysqli_num_rows($result);

    if ($num > 0)    {
      while($produit = mysqli_fetch_array($result)) {

        $identreprise = $produit["identreprise"];
        $nbaction = $produit["nbaction"];
        $nbtitre = $produit["nbtitre"];

echo "--><br>";

           // Recherche taux de change
           $sql1 = "SELECT taux,b.nomentreprise ";
           $sql1 .= "FROM eco_tauxchange, eco_entreprise a, eco_entreprise b, eco_pays c, eco_pays d ";
           $sql1 .= "WHERE a.identreprise = '$entreprise' AND b.identreprise = '$identreprise' ";
		   $sql1 .= "AND a.idpays = eco_tauxchange.idpays1 ";
           $sql1 .= "AND a.idpays = c.idpays AND b.idpays = d.idpays ";
           $sql1 .= "AND eco_tauxchange.devise2 = d.devise AND eco_tauxchange.devise1 = c.devise;";

           $result1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requète de recherche besoin (trt_bourse actionnaire) 2 !!!");
           $num1 = @mysqli_num_rows($result1);
           $taux = 1;
           if ($num1 > 0)           {
              $produit1 = mysqli_fetch_array($result1);
              $taux = $produit1["taux"];
              $nomentreprise2 = $produit1["nomentreprise"];
           }
$tmp_val = round(valorisation($identreprise,$nomentreprise2));

        $val += round((($tmp_val * $taux) / $nbtitre) * $nbaction);

echo "<-- ",$nbaction,", ",$tmp_val,"<br>";

      }  
    }

echo " - val : ",$val,"<br>";


    // pas/plus de participation
    //--------------------------

       // Recherche du solde des comptes bancaires
       //-----------------------------------------

       $new_solde = 0;
       $new_devise = "";

       $sql = "SELECT devise, sum(solde) as solde ";
       $sql .= "FROM eco_banque ";
       $sql .= "WHERE eco_banque.idtitulaire = '$entreprise' ";
       $sql .= "GROUP BY devise;";

       $result = @mysqli_query($conn, $sql)or die("Erreur dans la requète de recherche besoin (trt_bourse solde) !!! 1");
       $num = @mysqli_num_rows($result);
       if ($num > 0)       {
         while($produit = mysqli_fetch_array($result))         {
           $devise = $produit["devise"];
           $solde = $produit["solde"];

           // Recherche taux de change
           $sql = "SELECT taux,eco_pays.devise ";
           $sql .= "FROM eco_tauxchange, eco_entreprise, eco_pays ";
           $sql .= "WHERE eco_entreprise.identreprise = '$entreprise' AND eco_entreprise.idpays = eco_tauxchange.idpays1 ";
           $sql .= "AND eco_entreprise.idpays = eco_pays.idpays ";
           $sql .= "AND eco_tauxchange.devise2 = '$devise' AND eco_tauxchange.devise1 = eco_pays.devise;";

           $result = @mysqli_query($conn, $sql) or die("Erreur dans la requète de recherche besoin (trt_bourse solde) !!! 2");
           $num = @mysqli_num_rows($result);
           $taux = 1;
           if ($num > 0)           {
              $produit = mysqli_fetch_array($result);
              $taux = $produit["taux"];
              $new_devise = $produit["devise"];
           }

           $new_solde += $solde * $taux;

         }
       }

echo " - solde : ",$new_solde,"<br>";

       // Recherche des possessions hors stocks
       //--------------------------------------

       $val_poss = 0;

       $sql = "SELECT idunite, sum(nbunite) as nbunite, devise ";
       $sql .= "FROM eco_possession ";
       $sql .= "WHERE eco_possession.idpossesseur = '$entreprise' ";
       $sql .= "GROUP BY idunite, devise ;";

       $result = @mysqli_query($conn, $sql) or die("Erreur dans la requète de recherche besoin (trt_bourse poss) !!!");
       $num = @mysqli_num_rows($result);
       if ($num > 0){
         while($produit = mysqli_fetch_array($result)){
           $idunite = $produit["idunite"];
           $nbunite = $produit["nbunite"];
           $deviseunite = $produit["devise"];

           // Recherche taux de change / Prix conseillé
           $sql = "SELECT taux ";
           $sql .= "FROM eco_tauxchange, eco_entreprise, eco_pays ";
           $sql .= "WHERE eco_entreprise.identreprise = '$entreprise' AND eco_entreprise.idpays = eco_tauxchange.idpays1 ";
           $sql .= "AND eco_entreprise.idpays = eco_pays.idpays ";
           $sql .= "AND eco_tauxchange.devise2 = '$deviseunite' AND eco_tauxchange.devise1 = eco_pays.devise;";

           $result1 = @mysqli_query($conn, $sql) or die("Erreur dans la requète de recherche besoin (trt_bourse taux prix 1) !!!");
           $num = @mysqli_num_rows($result1);
           $taux = 1;
           if ($num > 0){
              $produit1 = mysqli_fetch_array($result1);
              $taux = $produit1["taux"];
           }

           if ($idunite == '80001')		//PA
              $val_poss += $nbunite * $taux * 90;
           if ($idunite == '80002')		//PE
              $val_poss += $nbunite * $taux * 90;
           if ($idunite == '80003')		//MP
              $val_poss += $nbunite * $taux * 110;
           if ($idunite == '80004')		//PP
              $val_poss += $nbunite * $taux * 190;
           if ($idunite == '80005')		//PAL
              $val_poss += $nbunite * $taux * 150;
           if ($idunite == '80009')		//PAlcool
              $val_poss += $nbunite * $taux * 190;
           if ($idunite == '30001')		//PObjet
              $val_poss += $nbunite * $taux * 50;
           if ($idunite == '30002')		//PMachine
              $val_poss += $nbunite * $taux * 120;
           if ($idunite == '30003')		//PVéhicule
              $val_poss += $nbunite * $taux * 140;
         }
       }

echo " - poss : ",$val_poss,"<br>";

       // Recherche valeur stock
       //-----------------------

       $val_stock = 0;

       $sql = "SELECT idunite, sum(quantite) as nbunite, devise ";
       $sql .= "FROM eco_stock ";
       $sql .= "WHERE eco_stock.identreprise = '$entreprise' ";
       $sql .= "GROUP BY idunite;";

       $result = @mysqli_query($conn, $sql)or die("Erreur dans la requète de recherche besoin (trt_bourse stock) !!!");
       $num = @mysqli_num_rows($result);
       if ($num > 0)       {
         while($produit = mysqli_fetch_array($result))         {
           $idunite = $produit["idunite"];
           $nbunite = $produit["nbunite"];
           $deviseunite = $produit["devise"];

           // Recherche taux de change / Prix conseillé
           $sql1 = "SELECT taux, eco_entreprise.typeentreprise ";
           $sql1 .= "FROM eco_tauxchange, eco_entreprise, eco_pays ";
           $sql1 .= "WHERE eco_entreprise.identreprise = '$entreprise' AND eco_entreprise.idpays = eco_tauxchange.idpays1 ";
           $sql1 .= "AND eco_entreprise.idpays = eco_pays.idpays ";
           $sql1 .= "AND eco_tauxchange.devise2 = '$deviseunite' AND eco_tauxchange.devise1 = eco_pays.devise;";

           $result1 = @mysqli_query($conn, $sql1)or die("Erreur dans la requète de recherche besoin (trt_bourse taux prix 2) !!!");
           $num1 = @mysqli_num_rows($result1);
           $taux = 1;
           if ($num1 > 0)           {
              $produit1 = mysqli_fetch_array($result1);
              $taux = $produit1["taux"];
              $typeentreprise = $produit1["typeentreprise"];
           }

           if ($idunite == '80001')		//PA
              $val_stock += $nbunite * $taux * 90;
           if ($idunite == '80002')		//PE
              $val_stock += $nbunite * $taux * 90;
           if ($idunite == '80003')		//MP
              $val_stock += $nbunite * $taux * 110;
           if ($idunite == '80004')		//PP
              $val_stock += $nbunite * $taux * 190;
           if ($idunite == '80005')		//PAL
              $val_stock += $nbunite * $taux * 150;
           if (($idunite == '80008') && ($typeentreprise != '40000'))	//PDt
              $val_stock -= $nbunite * $taux * 10;
           if (($idunite == '80008') && ($typeentreprise == '40000'))	//PDt
              $val_stock += $nbunite * $taux * 10;
           if ($idunite == '80009')		//PAlcool
              $val_stock += $nbunite * $taux * 190;
           if ($idunite == '30001')		//PObjet
              $val_stock += $nbunite * $taux * 50;
           if ($idunite == '30002')		//PMachine
              $val_stock += $nbunite * $taux * 120;
           if ($idunite == '30003')		//PVéhicule
              $val_stock += $nbunite * $taux * 140;

         }
       }

echo " - stock : ",$val_stock,"<br>";


       // Recherche Dette
       //-----------------------

       $val_dette = 0;

       $sql = "SELECT dette ";
       $sql .= "FROM eco_dette ";
       $sql .= "WHERE eco_dette.identreprise = '$entreprise';";

       $result = @mysqli_query($conn, $sql)or die("Erreur dans la requète de recherche besoin (trt_bourse stock) !!!");
       $num = @mysqli_num_rows($result);
       if ($num > 0)       {
         $produit = mysqli_fetch_array($result);
         $val_dette = $produit["dette"];
       }

echo " - dette : ",$val_dette,"<br>";

   $new_val = $val + $new_solde + $val_poss + $val_stock - $val_dette;
   $tab_new_cotation[$count1] = $new_val;

echo "new valorisation : ",$tab_new_cotation[$count1],"<br>";

   return ($new_val);
}

?>