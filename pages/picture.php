<?php
require_once '../class/user.php';
$users=new Users();
session_start();
$result=$_SESSION['mdp'];
$member=$users->member();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.png">
    
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="../css/index.css">
    <title>Gestion de Fichier</title>
</head>
<body>
    <div class="logo">
        <img src="../img/logo.png" alt="">
    </div>
    <h3 style="text-align: center;padding-top: 3vh;color: rgb(62, 43, 129);">SHARES FILES</h3>
    
    <div class="formulaire">
        <div class="picture">
           <span>Set a Picture Profil</span> <br>
            <form enctype="multipart/form-data" action="home.php" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="700000" class="form-control" style="margin-top: 15vh;">
                <input type="file" name="pdp" size="20" >
                
                <input type="submit" value="Add profil Picture" style="margin-bottom: 5vh;">
             </form>
             
            
           <a href="../index.php" style="margin-top:5vh;text-decoration: none;color: rgb(8, 60, 105);">Sign In To Shares Files</a>

        </div>
    </div>
    
</body>
</html>