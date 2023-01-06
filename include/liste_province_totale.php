<?php

$sql = "SELECT a.identreprise, a.nomentreprise, a.idpays ";
$sql .= "FROM eco_entreprise as a ";
$sql .= "WHERE a.typeentreprise = '90000' ";
$sql .= "ORDER BY a.idpays, a.nomentreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (LIST_PROV_)");
$num = @mysqli_num_rows($res);


if ($num !=0){

        $tmp="var LIST_PROV_IDPROV = new Array(";
        echo $tmp, $num,");";

        $tmp="var LIST_PROV_LIBPROV = new Array(";
        echo $tmp, $num,");";

        $tmp="var LIST_PROV_IDPAYS = new Array(";
        echo $tmp, $num,");";

        $count = 0;

	      while($produit = mysqli_fetch_array($res)){
              $tmp="LIST_PROV_IDPROV[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";

              $tmp="LIST_PROV_LIBPROV[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";

              $tmp="LIST_PROV_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";

              $count += 1;
        }
}
else{
        $tmp="var LIST_PROV_IDPROV = new Array(0);";
        echo $tmp;

        $tmp="var LIST_PROV_LIBPROV = new Array(0);";
        echo $tmp;
        
        $tmp="var LIST_PROV_IDPAYS = new Array(0);";
        echo $tmp;
}
