<?php

$sql = "SELECT eco_entreprise.typeentreprise, eco_typeentreprise.libelle, eco_entreprise.identreprise,nompays,eco_pays.idpays,nomentreprise,eco_entreprise.iduser, eco_user.nom, logo,capacite,capacitemens,site ";
$sql .= "FROM eco_entreprise,eco_pays,eco_user, eco_typeentreprise ";
$sql .= "WHERE eco_entreprise.identreprise = '$entreprise' AND eco_entreprise.idpays = eco_pays.idpays AND eco_entreprise.iduser = eco_user.iduser AND eco_entreprise.typeentreprise = eco_typeentreprise.typeentreprise ";
$sql .= "UNION SELECT eco_entreprise.typeentreprise, eco_typeentreprise.libelle, eco_entreprise.identreprise,nompays,eco_pays.idpays,nomentreprise,eco_entreprise.iduser, '' as nom, logo,capacite,capacitemens,site ";
$sql .= "FROM eco_entreprise,eco_pays,eco_user, eco_typeentreprise ";
$sql .= "WHERE eco_entreprise.identreprise = '$entreprise' AND eco_entreprise.idpays = eco_pays.idpays AND eco_entreprise.iduser = 0 AND eco_entreprise.typeentreprise = eco_typeentreprise.typeentreprise ";

$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (DET_ENTRE_)");
$num = @mysqli_num_rows($res);


if ($num == 1)
{
        $produit = mysqli_fetch_array($res);

        $tmp="var DET_ENTRE_IDENTRE=\"";
        echo $tmp,$produit["identreprise"],"\";";
        $tmp="var DET_ENTRE_IDUSER=\"";
        echo $tmp,$produit["iduser"],"\";";
        $tmp="var DET_ENTRE_TYPE=\"";
        echo $tmp,$produit["typeentreprise"],"\";";
        $tmp="var DET_ENTRE_TYPELIB=\"";
        echo $tmp,$produit["libelle"],"\";";
        $tmp="var DET_ENTRE_NOMUSER=\"";
        echo $tmp,$produit["nom"],"\";";
        $tmp="var DET_ENTRE_NOMPAYS=\"";
        echo $tmp,stripslashes($produit["nompays"]),"\";";
        $tmp="var DET_ENTRE_IDPAYS=\"";
        echo $tmp,$produit["idpays"],"\";";
        $tmp="var DET_ENTRE_NOM=\"";
        echo $tmp,stripslashes($produit["nomentreprise"]),"\";";
        $tmp="var DET_ENTRE_LOGO=\"";
        echo $tmp,stripslashes($produit["logo"]),"\";";
        $tmp="var DET_ENTRE_SITE=\"";
        echo $tmp,stripslashes($produit["site"]),"\";";
        $tmp="var DET_ENTRE_CAPACITE";
        echo $tmp,"=\"",$produit["capacite"],"\";";
        $tmp="var DET_ENTRE_CAPACITEMENS";
        echo $tmp,"=\"",$produit["capacitemens"],"\";";

        $sql = "SELECT eco_immo.idpossession,eco_immo.province,eco_immo.adresse_immo,eco_immo.occupe,eco_entreprise.nomentreprise ";
				$sql .= "FROM eco_immo, eco_entreprise ";
				$sql .= "WHERE ((eco_immo.idproprio = '$entreprise' AND eco_immo.idlocataire = '0') ";
				$sql .= "OR eco_immo.idlocataire = '$entreprise') ";
				$sql .= "AND eco_immo.province = eco_entreprise.identreprise AND eco_immo.occupe = 1;";

				$res = @mysqli_query($conn, $sql) or die("Erreur dans la requête (RES DET_ENTRE_)");
				$num = @mysqli_num_rows($res);

				if ($num >= 1)
				{
        	 $produit = mysqli_fetch_array($res);

        	 $tmp="var DET_ENTRE_ADR=\"";
        	 echo $tmp,$produit["adresse_immo"],"\";";
        	 $tmp="var DET_ENTRE_PROVINCE=\"";
        	 echo $tmp,$produit["nomentreprise"],"\";";

				}
				else
				{
        	 $tmp="var DET_ENTRE_ADR='Sans adresse !!';";
        	 echo $tmp;
        	 $tmp="var DET_ENTRE_PROVINCE='';";
        	 echo $tmp;
				}

        $tt = time();
        $mois = date("m",$tt);
        $annee = date("y",$tt);
        $sql1 = "SELECT nb as conso FROM eco_histo ";
        $sql1 .= "WHERE identreprise = '$entreprise' AND action = '2' AND mois = '$mois' AND SUBSTR(datemaj,3,2) = '$annee';";
        $res1 = @mysqli_query($conn, $sql1) or die("Problème dans la requ�te histo (DET_ENTRE_)");
        $num1 = @mysqli_num_rows($res1);
        if ($num1 == 1)
        {
          $produit1 = mysqli_fetch_array($res1);
          $tmp="var DET_ENTRE_CAPACITECONSO";
          echo $tmp,"=\"",$produit1["conso"],"\";";
        }
        else
        {
          $tmp="var DET_ENTRE_CAPACITECONSO";
          echo $tmp,"='0';";
        }

}
else
{
        $tmp="var DET_ENTRE_IDENTRE = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_IDUSER = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMUSER = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_NOMPAYS = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_IDPAYS = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_NOM = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_ADR = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_PROVINCE = '';";
        echo $tmp;
        $tmp="var DET_ENTRE_LOGO = '';";
        echo $tmp;
}
?>







