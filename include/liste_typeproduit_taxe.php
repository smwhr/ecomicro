<?php



$sql = "SELECT a.typeproduit,a.libelle,a.typeequi,b.libelle as libelleequi ";

$sql .= "FROM eco_typeproduit as a,eco_typeproduit as b ";
$sql .= "WHERE a.typeequi = b.typeproduit ";

$sql .= "ORDER BY a.libelle";



$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_TYPEPROD_TAXE_)");

$num = @mysqli_num_rows($res);



if ($num !=0)

{

        $tmp="var LIST_TYPEPROD_TAXE_TYPEPROD = new Array(";

        echo $tmp, $num,");";

        $tmp="var LIST_TYPEPROD_TAXE_LIBELLE = new Array(";

        echo $tmp, $num,");";

        $tmp="var LIST_TYPEPROD_TAXE_TYPEEQUI = new Array(";

        echo $tmp, $num,");";

        $tmp="var LIST_TYPEPROD_TAXE_LIBELLEEQUI = new Array(";

        echo $tmp, $num,");";



        $count = 0;

	while($produit = mysqli_fetch_array($res))

        {

              $tmp="LIST_TYPEPROD_TAXE_TYPEPROD[";

              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";

              $tmp="LIST_TYPEPROD_TAXE_LIBELLE[";

              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";

              $tmp="LIST_TYPEPROD_TAXE_TYPEEQUI[";

              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";

              $tmp="LIST_TYPEPROD_TAXE_LIBELLEEQUI[";

              echo $tmp,$count,"]=\"",stripslashes($produit["libelleequi"]),"\";";



              $count += 1;

        }

}

else

{

        $tmp="var LIST_TYPEPROD_TAXE_TYPEPROD = new Array(0);";

        echo $tmp;

        $tmp="var LIST_TYPEPROD_TAXE_LIBELLE = new Array(0);";

        echo $tmp;

        $tmp="var LIST_TYPEPROD_TAXE_TYPEEQUI = new Array(0);";

        echo $tmp;

        $tmp="var LIST_TYPEPROD_TAXE_LIBELLEEQUI = new Array(0);";

        echo $tmp;

}

?>















