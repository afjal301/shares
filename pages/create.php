<?php
require_once '../class/user.php';
$users=new Users();
if(isset($_GET["Nom"]) && isset($_GET["Prenom"]) && isset($_GET["Email"]) && isset($_GET["Mdp"]) && isset($_GET["Adresse"])){
    $Nom=$_GET["Nom"];
    $Prenom=$_GET["Prenom"];
    $Email=$_GET["Email"];
    $Mdp=$_GET["Mdp"];
    $Adresse=$_GET["Adresse"];
    $add=$users->add($Nom,$Prenom,$Email,$Mdp,$Adresse);
    
        session_start();
        $result=$users->signin($Email , $Mdp);
        $_SESSION['mdp']=$result;
        header('Location: picture.php');
    

}


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
        <div class="create">
           <span>Create Compte</span> <br>
            <form action="" method="get">
                <input type="text" placeholder="Name" name="Nom">
                <input type="text" placeholder="Prename" name="Prenom">
                <input type="text" placeholder="Adresse" name="Adresse">
                <input type="email" placeholder="Email" name="Email">
                <input type="password" placeholder="Mot de Passe" name="Mdp">
                <input type="submit" value="Sign Up" style="margin-bottom: 5vh;">
            </form>
           <a href="../index.php" style="margin-top:5vh;text-decoration: none;color: rgb(8, 60, 105);">Sign In To Shares Files</a>

        </div>
    </div>
    
</body>
</html>