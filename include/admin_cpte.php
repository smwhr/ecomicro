<?php

$sql = "SELECT idcompte,idtitulaire,solde,devise,nomentreprise FROM banque,entreprise WHERE banque.idtitulaire = entreprise.identreprise";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (CPTEA_)");
$num = @mysqli_num_rows($res) or die("<br>8- Impossible de calculer le nombre");

if ($num !=0)
{
        $tmp="var tabCPTEA_NCPTE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabCPTEA_IDTITULAIRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabCPTEA_NOMENTRE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabCPTEA_SOLDE = new Array(";
        echo $tmp, $num,");";
        $tmp="var tabCPTEA_DEVISE = new Array(";
        echo $tmp, $num,");";

        $count = 0;
	while($produit = mysqli_fetch_array($res))
        {
              $tmp="tabCPTEA_NCPTE[";
              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
              $tmp="tabCPTEA_IDTITULAIRE[";
              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
              $tmp="tabCPTEA_NOMENTRE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["nomentreprise"]),"\";";
              $tmp="tabCPTEA_SOLDE[";
              echo $tmp,$count,"]=\"",$produit["solde"],"\";";
              $tmp="tabCPTEA_DEVISE[";
              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";

              $count += 1;
        }
}

?>







