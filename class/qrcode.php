<?php
function qr($code){
    
    require_once "../phpqrcode/qrlib.php";
   QRcode::png($code);
    //echo '<img src="data:image/png;base64,'.base64_encode( $res ).'" width="30"  height="30" style="border-radius:50%"/>';

}
session_start();
$img=$_SESSION["mdp"];
qr($img);

?>