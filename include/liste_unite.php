<?php

$sql = "SELECT libelle,typeproduit,typeequi FROM eco_typeproduit WHERE (typeproduit > '30000' AND typeproduit < '40000') OR (typeproduit > '80000' AND typeproduit < '90000') ORDER BY libelle";



$res = @mysqli_query($conn, $sql) or die("<br>8- Impossible de selectionner");

$num = @mysqli_num_rows($res);



if ($num !=0)

{

        $tmp="var LIST_UNITE_NOMUNITE = new Array(";

        echo $tmp, $num,");";

        $tmp="var LIST_UNITE_IDUNITE = new Array(";

        echo $tmp, $num,");";

        $tmp="var LIST_UNITE_IDUNITEEQUI = new Array(";

        echo $tmp, $num,");";



        $count = 0;

	while($produit = mysqli_fetch_array($res))

        {

              $tmp="LIST_UNITE_NOMUNITE[";

              echo $tmp,$count,"]=\"",stripslashes($produit["libelle"]),"\";";

              $tmp="LIST_UNITE_IDUNITE[";

              echo $tmp,$count,"]=\"",$produit["typeproduit"],"\";";

              $tmp="LIST_UNITE_IDUNITEEQUI[";

              echo $tmp,$count,"]=\"",$produit["typeequi"],"\";";



              $count += 1;

        }

}

else

{

        $tmp="var LIST_UNITE_NOMUNITE = new Array(0);";

        echo $tmp;

        $tmp="var LIST_UNITE_IDUNITE = new Array(0);";

        echo $tmp;

        $tmp="var LIST_UNITE_IDUNITEEQUI = new Array(0);";

        echo $tmp;

}

?>















