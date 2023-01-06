<?php
$autojoueur = substr($_SESSION['perso_droituser'],1,1);
$toutautojoueur = $_SESSION['perso_droituser'];
$paysjoueur = $_SESSION['perso_idpays'];
$sql = "SELECT idcompte,idtitulaire,solde,devise,nomcpte,iduser ";
$sql .= "FROM eco_banque,eco_entreprise ";
$sql .= "WHERE idtitulaire = '$entreprise' AND eco_entreprise.identreprise = idtitulaire ";
$sql .= "AND (eco_entreprise.iduser = '$idjoueur' OR ('$autojoueur' > 4 AND eco_entreprise.idpays = '$paysjoueur') OR ('$toutautojoueur' = '999'));";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te DET_ENTRE_CPT_");
$num = @mysqli_num_rows($res);

if ($num !=0)
{
	        $tmp="var DET_ENTRE_CPT_IDCPTE = new Array(";
	        echo $tmp, $num,");";
	        $tmp="var DET_ENTRE_CPT_IDTITULAIRE = new Array(";
	        echo $tmp, $num,");";
	        $tmp="var DET_ENTRE_CPT_NOMCPTE = new Array(";
	        echo $tmp, $num,");";
	        $tmp="var DET_ENTRE_CPT_SOLDE = new Array(";
	        echo $tmp, $num,");";
	        $tmp="var DET_ENTRE_CPT_DEVISE = new Array(";
	        echo $tmp, $num,");";
	
	        $count = 0;
					while($produit = mysqli_fetch_array($res))
	        {
	              $tmp="DET_ENTRE_CPT_IDCPTE[";
	              echo $tmp,$count,"]=\"",$produit["idcompte"],"\";";
	              $tmp="DET_ENTRE_CPT_IDTITULAIRE[";
	              echo $tmp,$count,"]=\"",$produit["idtitulaire"],"\";";
	              $tmp="DET_ENTRE_CPT_NOMCPTE[";
	              echo $tmp,$count,"]=\"",stripslashes($produit["nomcpte"]),"\";";
	              $tmp="DET_ENTRE_CPT_SOLDE[";
	              echo $tmp,$count,"]=\"",$produit["solde"],"\";";
	              $tmp="DET_ENTRE_CPT_DEVISE[";
	              echo $tmp,$count,"]=\"",stripslashes($produit["devise"]),"\";";
	
	              $count += 1;
 		       }
}
else
{
        $tmp="var DET_ENTRE_CPT_IDCPTE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_CPT_IDTITULAIRE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_CPT_NOMCPTE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_CPT_SOLDE = new Array(0);";
        echo $tmp;
        $tmp="var DET_ENTRE_CPT_DEVISE = new Array(0);";
        echo $tmp;
}
?>







