<?php



$sql = "SELECT a.identreprise, a.nomentreprise ";

$sql .= "FROM eco_entreprise as a, eco_user as b ";

$sql .= "WHERE a.typeentreprise = '90000' ";

$sql .= "AND b.idpays = a.idpays AND b.iduser = '$idjoueur' ";

$sql .= "ORDER BY a.nomentreprise";



$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (LIST_PROV_)");

$num = @mysqli_num_rows($res);



if ($num !=0)

{

        $tmp="var LIST_PROV_IDPROV = new Array(";

        echo $tmp, $num,");";

        $tmp="var LIST_PROV_LIBPROV = new Array(";

        echo $tmp, $num,");";



        $count = 0;

	while($produit = mysqli_fetch_array($res))

        {

              $tmp="LIST_PROV_IDPROV[";

              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";

              $tmp="LIST_PROV_LIBPROV[";

              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";



              $count += 1;

        }

}

else

{

        $tmp="var LIST_PROV_IDPROV = new Array(0);";

        echo $tmp;

        $tmp="var LIST_PROV_LIBPROV = new Array(0);";

        echo $tmp;

}

?>















