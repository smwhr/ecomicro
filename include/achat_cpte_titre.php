<?php

$sql = "SELECT eco_banque.idcompte,eco_banque.idtitulaire,eco_banque.solde,eco_banque.devise,eco_banque.nomcpte,eco_entreprise.idpays ";
$sql .= "FROM eco_banque,eco_entreprise ";
$sql .= "WHERE eco_banque.idtitulaire = eco_entreprise.identreprise ";
$sql .= "UNION SELECT eco_banque.idcompte,eco_banque.idtitulaire,eco_banque.solde,eco_banque.devise,eco_banque.nomcpte,eco_user.idpays ";
$sql .= "FROM eco_banque,eco_user ";
$sql .= "WHERE eco_banque.idtitulaire = eco_user.iduser ";
$sql .= "AND eco_user.inactif = '0' ";
$sql .= "UNION SELECT eco_banque.idcompte,eco_banque.idtitulaire,eco_banque.solde,eco_banque.devise,eco_banque.nomcpte,eco_pays.idpays ";
$sql .= "FROM eco_banque,eco_pays ";
$sql .= "WHERE eco_banque.idtitulaire = eco_pays.idpays ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (ACHAT_CPTE_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var ACHAT_CPTE_IDPAYS = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_CPTE_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_CPTE_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_CPTE_NOMCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var ACHAT_CPTE_DEVISE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="ACHAT_CPTE_IDPAYS[";
              echo $tmp,$count,"]=\"",$produit["idpays"],"\";";
              $tmp="ACHAT_CPTE_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="ACHAT_CPTE_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="ACHAT_CPTE_NOMCPTE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomcpte"]),"\";";
              $tmp="ACHAT_CPTE_DEVISE[";
              echo $tmp,$count,"]=\"",$produit["devise"],"\";";

              $count += 1;
        }

}
else
{
        $tmp="var ACHAT_CPTE_IDPAYS = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_CPTE_NCPTE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_CPTE_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_CPTE_NOMCPTE = new Array(0);";
        echo $tmp;
        $tmp="var ACHAT_CPTE_DEVISE = new Array(0);";
        echo $tmp;
}
?>

