<?php

$sql = "SELECT nomentreprise,entreprise.identreprise,typeentreprise,quantite,nomunite,unite.idunite FROM entreprise,unite,stock,user WHERE user.iduser = '$idjoueur' AND entreprise.idpays = user.idpays AND entreprise.identreprise = stock.identreprise AND stock.idunite = unite.idunite ORDER BY nomentreprise";

$res = @mysqli_query($conn, $sql) or die("<br>8- Impossible de selectionner");
$num = @mysqli_num_rows($res) or die("<br>8- Impossible de calculer le nombre");

if ($num !=0)
{
        $tmp="var tabSTN_NOMENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabSTN_IDENTREPRISE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabSTN_TYPE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabSTN_QUANTITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabSTN_IDUNITE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabSTN_NOMUNITE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="tabSTN_NOMENTREPRISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="tabSTN_IDENTREPRISE[";
              echo $tmp,$count,"]=\"",$produit["identreprise"],"\";";
              $tmp="tabSTN_TYPE[";
              echo $tmp,$count,"]=\"",$produit["typeentreprise"],"\";";
              $tmp="tabSTN_QUANTITE[";
              echo $tmp,$count,"]=\"",$produit["quantite"],"\";";
              $tmp="tabSTN_IDUNITE[";
              echo $tmp,$count,"]=\"",$produit["idunite"],"\";";
              $tmp="tabSTN_NOMUNITE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomunite"]),"\";";

              $count += 1;
        }
}

?>







