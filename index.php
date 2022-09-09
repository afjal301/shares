<?php
require_once 'class/user.php';
$users=new Users();
if(isset($_GET['email']) && isset($_GET['mdp'])){
    $email=$_GET['email'];
    $mdp=$_GET['mdp'];
    $result=$users->signin($email , $mdp);
    if(!empty($result)){
        session_start();
        $_SESSION['mdp']=$result;
        header('Location: pages/home.php');
    }
   

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png">
    
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <title>Gestion de Fichier</title>
</head>
<body>
    <div class="logo">
        <img src="img/logo.png" alt="">
    </div>
    <h3 style="text-align: center;padding-top: 3vh;color: rgb(62, 43, 129);">SHARES FILES</h3>
    
    <div class="formulaire">
        <div class="connect">
           <span>Login</span> <br>
          <form action="">
             <input type="text" placeholder="email" name="email">
             <input type="password" placeholder="mot de passe" name="mdp">
             <input type="submit" value="Se connecter" style="margin-bottom: 5vh;"> 
          </form>
           <a href="pages/create.php" style="margin-top:5vh;text-decoration: none;color: rgb(8, 60, 105);">Creer un Compte</a>

        </div>
    </div>
    
</body>
</html>