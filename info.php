<?php
    require_once 'phpqrcode/qrlib.php';
    session_start();
    $info=$_SESSION['mdp'];
    $connected= new DateTime();
    $connected=$connected->format('Y-m-d H:i:s');
    $info="Email : " . $info[0]['Email'] . " \n" ."Nom : " . $info[0]['Nom'] . " \n" ."Prenom : " . $info[0]['Prenom'] . " \n"."Mdp: " . $info[0]['Mdp'] . " \n"."Connected : " . $connected . " \n"  ;

    $path="C:/Users/Afjal Betsilah/Documents/projet/img/qr/";
    QRcode::png($info);
    
    ?>
?>