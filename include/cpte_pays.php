<?php
// liste des �tats
$sql = "SELECT idcompte,idtitulaire,solde,eco_banque.devise,nomcpte,idpays,nompays FROM eco_banque,eco_pays WHERE idtitulaire = idpays";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te CPTE_PAYS_");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var CPTE_PAYS_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_PAYS_NOMPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_PAYS_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_PAYS_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_PAYS_NOMCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_PAYS_SOLDE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_PAYS_DEVISE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="CPTE_PAYS_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="CPTE_PAYS_NOMPAYS[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nompays"]),"\";";
              $tmp="CPTE_PAYS_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="CPTE_PAYS_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="CPTE_PAYS_NOMCPTE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomcpte"]),"\";";
              $tmp="CPTE_PAYS_SOLDE[";
              echo $tmp,$count,"]=\"",$produit["solde"],"\";";
              $tmp="CPTE_PAYS_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";

              $count += 1;
        }
}
else
{
        $tmp="var CPTE_PAYS_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_PAYS_NOMPAYS = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_PAYS_NCPTE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_PAYS_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_PAYS_NOMCPTE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_PAYS_SOLDE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_PAYS_DEVISE = new Array(0);";
        echo $tmp;
}
?>







