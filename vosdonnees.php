<?php
    session_start();
    if (isset($_SESSION['perso_iduser']))
        $idjoueur = $_SESSION['perso_iduser'];
    else
        $idjoueur = "";
    $tmp = "new_detail_1_citoyen.php?citoyen=" . $idjoueur;
    echo "<script language='JavaScript'>document.location.replace('$tmp');</script>";
?>