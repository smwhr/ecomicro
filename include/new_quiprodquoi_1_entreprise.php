<?php

$sql = "SELECT eco_entreprise.identreprise, eco_quiprodquoi.typeentreprise, eco_quiprodquoi.typeproduit, eco_quiprodquoi.typeunite,a.libelle as libprod,b.libelle as libunite ";
$sql .= "FROM eco_quiprodquoi,eco_entreprise,eco_typeproduit as a,eco_typeproduit as b ";
$sql .= "WHERE eco_entreprise.typeentreprise = eco_quiprodquoi.typeentreprise AND eco_entreprise.identreprise = '$entreprise' ";
$sql .= "AND a.typeproduit = eco_quiprodquoi.typeproduit AND b.typeproduit = eco_quiprodquoi.typeunite ;";


$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (DET_ENTRE_QUIPRODQUOI_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var DET_ENTRE_QUIPRODQUOI_TYPEENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_QUIPRODQUOI_TYPEPROD = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_QUIPRODQUOI_TYPEUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_QUIPRODQUOI_LIBPROD = new Array(";
        echo $tmp, $num,");";
        $tmp="var DET_ENTRE_QUIPRODQUOI_LIBUNITE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="DET_ENTRE_QUIPRODQUOI_TYPEENTRE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="DET_ENTRE_QUIPRODQUOI_TYPEPROD[";
              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";
              $tmp="DET_ENTRE_QUIPRODQUOI_TYPEUNITE[";
              echo $tmp,$count,"]=\"",$produit["typeunite"],"\";";
              $tmp="DET_ENTRE_QUIPRODQUOI_LIBPROD[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libprod"]),"\";";
              $tmp="DET_ENTRE_QUIPRODQUOI_LIBUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["libunite"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var DET_ENTRE_QUIPRODQUOI_TYPEENTRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_QUIPRODQUOI_TYPEPROD = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_QUIPRODQUOI_TYPEUNITE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_QUIPRODQUOI_LIBPROD = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_QUIPRODQUOI_LIBUNITE = new Array(0);";
        echo $tmp;
}
?>







