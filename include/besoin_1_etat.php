<?php

$sql = "SELECT eco_besoin.idpays,eco_besoin.idtitulaire,eco_besoin.type,eco_besoin.typeproduit,eco_besoin.quantite, nomentreprise ";
$sql .= "FROM eco_besoin, eco_entreprise ";
$sql .= "WHERE eco_besoin.idpays = '$etat' AND eco_besoin.idtitulaire = eco_entreprise.identreprise ";
$sql .= "ORDER BY eco_besoin.idtitulaire, eco_besoin.typeproduit;";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (BES_ETAT_).");
$num = @mysqli_num_rows($res);

if ($num !=0){

        $tmp="var BES_ETAT_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var BES_ETAT_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var BES_ETAT_LIBTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var BES_ETAT_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var BES_ETAT_TYPEPRODUIT = new Array(";
        echo $tmp, $num,");";
        $tmp="var BES_ETAT_QUANTITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var BES_ETAT_LIBTYPEPRODUIT = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res)){
              $tmp="BES_ETAT_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="BES_ETAT_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="BES_ETAT_LIBTITULAIRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="BES_ETAT_TYPE[";
              echo $tmp,$count,"]=\"",$produit["type"],"\";";
              $tmp="BES_ETAT_TYPEPRODUIT[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="BES_ETAT_QUANTITE[";
              echo $tmp,$count,"]=\"",$produit["quantite"],"\";";


              $typeproduit = $produit["typeproduit"];
              $sql1 = "SELECT libelle ";
              $sql1 .= "FROM eco_typeproduit ";
              $sql1 .= "WHERE typeproduit = '$typeproduit' ";

              $res1 = @mysqli_query($conn, $sql1) or die("Erreur dans la requête eco_typeproduit(BES_ETAT_).");
              $num1 = @mysqli_num_rows($res1);
              if ($num1 !=0){
                  $produit1 = mysqli_fetch_array($res1);
                  $tmp="BES_ETAT_LIBTYPEPRODUIT[";
                  echo $tmp,$count,"]=\"",stripslashes($produit1["libelle"]),"\";";
              }
              else{
                  $tmp="BES_ETAT_LIBTYPEPRODUIT[";
                  echo $tmp,$count,"]=\"??\";";
              }

              $count += 1;
        }
}
else{
        $tmp="var BES_ETAT_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var BES_ETAT_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var BES_ETAT_LIBTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var BES_ETAT_TYPE = new Array(0);";
        echo $tmp;
        $tmp="var BES_ETAT_TYPEPRODUIT = new Array(0);";
        echo $tmp;
        $tmp="var BES_ETAT_QUANTITE = new Array(0);";
        echo $tmp;
        $tmp="var BES_ETAT_LIBTYPEPRODUIT = new Array(0);";
        echo $tmp;
}
?>