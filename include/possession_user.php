<?php



$sql = "SELECT idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.typeproduit,a.typeequi,eco_possession.image,description,nbunite,b.libelle,datehachat,eco_possession.etat, 'a' as pro ";

$sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b ";

$sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur = '$idjoueur' ";

$sql .= "AND eco_possession.typeproduit = a.typeproduit ";

$sql .= "UNION SELECT eco_possession.idpossession,eco_possession.idproduit,eco_possession.nomproduit,a.typeproduit,a.typeequi,eco_possession.image,description,nbunite,b.libelle,datehachat,eco_possession.etat, 'b' as pro ";

$sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b, eco_immo ";

$sql .= "WHERE b.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur <> '$idjoueur' ";

$sql .= "AND eco_possession.typeproduit = a.typeproduit ";

$sql .= "AND eco_possession.idpossession = eco_immo.idpossession AND eco_immo.idlocataire = '$idjoueur' ";

$sql .= "ORDER BY nomproduit";



$res = @mysqli_query($conn, $sql) or die("Erreur dans la requète (POSSP_).");

$num = @mysqli_num_rows($res);



if ($num !=0)

{

        $tmp="var POSSP_IDPOSS = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_IDPRODUIT = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_NOMPRODUIT = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_TYPE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_TYPEEQUI = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_IMAGE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_DESCRIPTION = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_NBUNITE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_NOMUNITE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_DATEH = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_ETAT = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSP_PRO = new Array(";

        echo $tmp, $num,");";



        $count = 0;

	while($produit = mysqli_fetch_array($res))

        {

              $tmp="POSSP_IDPOSS[";

              echo $tmp,$count,"]=\"",$produit["idpossession"],"\";";

              $tmp="POSSP_IDPRODUIT[";

              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";

              $tmp="POSSP_NOMPRODUIT[";

              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";

              $tmp="POSSP_TYPE[";

              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";

              $tmp="POSSP_TYPEEQUI[";

              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";

              $tmp="POSSP_IMAGE[";

              echo $tmp,$count,"]=\"",$produit["image"],"\";";

              $tmp="POSSP_DESCRIPTION[";

              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";

              $tmp="POSSP_NBUNITE[";

              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";

              $tmp="POSSP_NOMUNITE[";

              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";

              $tmp="POSSP_DATEH[";

              echo $tmp,$count,"]=\"",$produit["datehachat"],"\";";

              $tmp="POSSP_ETAT[";

              echo $tmp,$count,"]=\"",$produit["etat"],"\";";

              $tmp="POSSP_PRO[";

              echo $tmp,$count,"]=\"",$produit["pro"],"\";";



              $count += 1;

        }

}

else

{

        $tmp="var POSSP_IDPOSS = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_IDPRODUIT = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_NOMPRODUIT = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_TYPE = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_TYPEEQUI = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_IMAGE = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_DESCRIPTION = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_NBUNITE = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_NOMUNITE = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_DATEH = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_ETAT = new Array(0);";

        echo $tmp;

        $tmp="var POSSP_PRO = new Array(0);";

        echo $tmp;

}

?>















