<?php
require_once 'phpqrcode/qrlib.php';

$path="C:/Users/Afjal Betsilah/Documents/projet/img/qr/";
$shares="Shares files is a application web to shares and store files " . "\n" ."you can download it Frome Playstore or use it on https://www.shares.com";
QRcode::png($shares);

?>