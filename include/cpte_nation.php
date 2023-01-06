<?php
// liste des comptes

$sql = "SELECT idcompte,idtitulaire,solde,devise,nomcpte FROM eco_banque;";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (CPTE_NAT_)");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
        $tmp="var CPTE_NAT_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_NAT_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_NAT_NOMCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var CPTE_NAT_DEVISE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="CPTE_NAT_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="CPTE_NAT_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="CPTE_NAT_NOMCPTE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomcpte"]),"\";";
              $tmp="CPTE_NAT_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";

              $count += 1;
        }

}
else
{
        $tmp="var CPTE_NAT_NCPTE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_NAT_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_NAT_NOMCPTE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_NAT_SOLDE = new Array(0);";
        echo $tmp;
        $tmp="var CPTE_NAT_DEVISE = new Array(0);";
        echo $tmp;
}
?>







