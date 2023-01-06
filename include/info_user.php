<?php

if ($_SESSION['perso_iduser'])
{
        $tmp="var IDUSER = '";
        echo $tmp, $_SESSION['perso_iduser'],"';";
        $idjoueur = $_SESSION['perso_iduser'];

        $tmp="var AUTORISATION = '";
        echo $tmp, $_SESSION['perso_droituser'],"';";

        $sql = "SELECT email,nom,login,nompays,devise,eco_user.idpays,portrait,eco_user.election,eco_user.resp FROM eco_user,eco_pays WHERE eco_user.iduser = '$idjoueur' AND eco_user.idpays = eco_pays.idpays";

        $res = @mysqli_query($conn, $sql) or die("Erreur, requête non valide");
        $num = @mysqli_num_rows($res) or die("Vous n'éxistez pas !!");
        $produit = mysqli_fetch_array($res);
        $tmp="var EMAIL = '";
        echo $tmp, $produit['email'],"';";
        $tmp="var NOM = '";
        echo $tmp, stripslashes($produit['nom']),"';";
        $tmp="var LOGIN = '";
        echo $tmp, $produit['login'],"';";
        $_SESSION['perso_login'] = $produit['login'];

        $tmp="var NOMPAYS = '";
        echo $tmp, stripslashes($produit['nompays']),"';";
        $tmp="var DEVISEPAYS = '";
        echo $tmp, stripslashes($produit['devise']),"';";
        $tmp="var IDPAYS = '";
        echo $tmp, $produit['idpays'],"';";
        $tmp="var PORTRAIT = '";
        echo $tmp, $produit['portrait'],"';";
        
        
        $sql = "SELECT eco_immo.idpossession,eco_immo.province,eco_immo.adresse_immo,eco_immo.occupe,eco_entreprise.nomentreprise ";
				$sql .= "FROM eco_immo, eco_entreprise ";
				$sql .= "WHERE ((eco_immo.idproprio = '$idjoueur' AND eco_immo.idlocataire = '0') ";
				$sql .= "OR eco_immo.idlocataire = '$idjoueur') ";
				$sql .= "AND eco_immo.province = eco_entreprise.identreprise AND eco_immo.occupe = 1;";

				$res = @mysqli_query($conn, $sql) or die("Erreur dans la requ�te (RES DET_CIT_)");
				$num = @mysqli_num_rows($res);

				if ($num >= 1)
				{
        	 $produit = mysqli_fetch_array($res);

        	 $tmp="var CIT_ADR=\"";
        	 echo $tmp,$produit["adresse_immo"],"\";";
        	 $tmp="var CIT_PROVINCE=\"";
        	 echo $tmp,$produit["nomentreprise"],"\";";

				}
				else
				{
        	 $tmp="var CIT_ADR='SDF !!';";
        	 echo $tmp;
        	 $tmp="var CIT_PROVINCE='';";
        	 echo $tmp;
				}
        
        $tmp="var ELECTION = '";
        echo $tmp, $produit['election'],"';";
        $tmp="var RESP = '";
        echo $tmp, $produit['resp'],"';";

        $sql = "SELECT count(*) as msg FROM eco_message WHERE destinataire = '$idjoueur' AND reponse = '' AND dateexpir > NOW()";
        $res = @mysqli_query($conn, $sql) or die("Erreur, requête non valide");
        $num = @mysqli_num_rows($res) or die("Vous n'éxistez pas !!");
        if ($num == 1)
        {
          $produit = mysqli_fetch_array($res);
          $tmp="var MSG = '";
          echo $tmp, $produit['msg'],"';";
        }
        else
        {
          echo "var MSG = '0';";
        }
}

?>

