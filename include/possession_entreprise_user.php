<?php



$sql = "SELECT idpossession,identreprise,nomentreprise,eco_possession.idproduit,eco_possession.nomproduit,b.typeproduit,b.typeequi,eco_possession.image,description,nbunite,a.libelle,datehachat,eco_possession.etat,eco_possession.etat, 'a' as pro  ";

$sql .= "FROM eco_possession,eco_typeproduit as a,eco_entreprise,eco_typeproduit as b ";

$sql .= "WHERE a.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur = eco_entreprise.identreprise ";

$sql .= "AND eco_possession.typeproduit = b.typeproduit AND eco_entreprise.iduser = '$idjoueur' ";



$sql .= "UNION SELECT eco_possession.idpossession,identreprise,nomentreprise,eco_possession.idproduit,eco_possession.nomproduit,b.typeproduit,b.typeequi,eco_possession.image,description,nbunite,a.libelle,datehachat,eco_possession.etat,eco_possession.etat, 'b' as pro  ";
$sql .= "FROM eco_possession,eco_typeproduit as a,eco_typeproduit as b, eco_entreprise, eco_immo ";

$sql .= "WHERE a.typeproduit = eco_possession.idunite AND eco_possession.idpossesseur <> eco_entreprise.identreprise ";

$sql .= "AND eco_possession.typeproduit = b.typeproduit AND eco_entreprise.iduser = '$idjoueur' ";

$sql .= "AND eco_possession.idpossession = eco_immo.idpossession AND eco_immo.idlocataire = eco_entreprise.identreprise ";



$sql .= "ORDER BY nomentreprise,nomproduit";



$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (POSSE_)");

$num = @mysqli_num_rows($res);



if ($num !=0)

{

        $tmp="var POSSE_IDPOSS = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_IDENTRE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_NOMENTRE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_IDPRODUIT = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_NOMPRODUIT = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_TYPE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_TYPEEQUI = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_IMAGE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_DESCRIPTION = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_NBUNITE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_NOMUNITE = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_DATEH = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_ETAT = new Array(";

        echo $tmp, $num,");";

        $tmp="var POSSE_PRO = new Array(";

        echo $tmp, $num,");";



        $count = 0;

	while($produit = mysqli_fetch_array($res))

        {

              $tmp="POSSE_IDPOSS[";

              echo $tmp,$count,"]=\"",$produit["idpossession"],"\";";

              $tmp="POSSE_IDENTRE[";

              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";

              $tmp="POSSE_NOMENTRE[";

              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $tmp="POSSE_IDPRODUIT[";

              echo $tmp,$count,"]=\"",$produit["idproduit"],"\";";

              $tmp="POSSE_NOMPRODUIT[";

              echo $tmp,$count,"]=\"",stripslashes($produit["nomproduit"]),"\";";

              $tmp="POSSE_TYPE[";

              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";

              $tmp="POSSE_TYPEEQUI[";

              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";

              $tmp="POSSE_IMAGE[";

              echo $tmp,$count,"]=\"",$produit["image"],"\";";

              $tmp="POSSE_DESCRIPTION[";

              echo $tmp,$count,"]=\"",stripslashes($produit["description"]),"\";";

              $tmp="POSSE_NBUNITE[";

              echo $tmp,$count,"]=\"",$produit["nbunite"],"\";";

              $tmp="POSSE_NOMUNITE[";

              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";

              $tmp="POSSE_DATEH[";

              echo $tmp,$count,"]=\"",$produit["datehachat"],"\";";

              $tmp="POSSE_ETAT[";

              echo $tmp,$count,"]=\"",$produit["etat"],"\";";

              $tmp="POSSE_PRO[";

              echo $tmp,$count,"]=\"",$produit["pro"],"\";";



              $count += 1;

        }

}

else

{

        $tmp="var POSSE_IDPOSS = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_IDENTRE = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_NOMENTRE = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_IDPRODUIT = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_NOMPRODUIT = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_TYPE = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_TYPEEQUI = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_IMAGE = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_DESCRIPTION = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_NBUNITE = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_NOMUNITE = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_DATEH = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_ETAT = new Array(0);";

        echo $tmp;

        $tmp="var POSSE_PRO = new Array(0);";

        echo $tmp;



}

?>

