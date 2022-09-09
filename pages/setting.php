<?php
require_once '../class/user.php';
require_once '../class/profil.php';
require_once '../class/followers.php';
require_once '../class/files.php';
$following=new Files();

$users=new Users();
$profil=new Profil();
$followers=new Followers();
$follow=$followers->compte(14);
$offset=isset($_GET["offset"])?$_GET["offset"]:0;


$all=$users->all($offset);


session_start();
$info=$_SESSION['mdp'];
$id_user=$info[0]['Id'];
$email=$info[0]['Email'];
$res=$users->signin($email,$id_user);

$id_user=$info[0]['Id'];
$email=$info[0]['Email'];
if(isset($_GET['id'])){
    $fol=$followers->follow($_GET['id'],$id_user);
    if(empty($fol)){
        $followers->add($_GET['id'],$info[0]["Id"]);
    }
   
}
$limit=$offset-5;
if (isset($_FILES['pdp'])){
    # code...
    
    $img_blob=$_FILES["pdp"]["tmp_name"];
    $img_type=$_FILES["pdp"]["type"];
    $img_taille=$_FILES["pdp"]["size"];
    $img_name=$_FILES["pdp"]["name"];
    $donnes=addslashes(fread(fopen($img_blob, "r"), $img_taille));  
    $profil->update($donnes,$img_taille,$img_name,$img_type,$id_user);
}
$member=$users->member();
$fic=$following->share();
$yours=$following->compte($id_user);
$int=($yours[0]["COUNT(*)"]/$fic[0]["COUNT(*)"])*100;

$member=$member[0]["COUNT(*)"];
$precedent=$member-$offset+2;
if(isset($_GET['c']) && $_GET['c'] !==''){
    $c=$_GET['c'];
    $human=$users->id($c);
    $fils=$following->one($c);
   // var_dump($fils);
    
}

/*
if(  isset($_GET['comment']) && $_GET['comment']!==""){
    
    $comment=$_GET['comment'];
    $files->comment($_SESSION['files'],$id_user,$comment);

}

if(isset($_SESSION['files'])){
    $publiate=$following->id($_SESSION['files']);
    $commented=$following->commented($_SESSION['files']);
    $allcmt=$following->allcmd($_SESSION['files']);
    $allcmt=$allcmt[0]["COUNT(*)"];
    $liked=$following->liked($_SESSION['files'],$id_user);
    x
}
if(isset($_GET['like'])){
    $following->like($_SESSION['files'],$id_user);
}*/
if(isset($_GET["Nom"]) && isset($_GET["Prenom"]) && isset($_GET["Email"]) && isset($_GET["Mdp"]) && isset($_GET["Adresse"])){
    $Nom=$_GET["Nom"];
    $Prenom=$_GET["Prenom"];
    $Email=$_GET["Email"];
    $Mdp=$_GET["Mdp"];
    $Adresse=$_GET["Adresse"];
    try {
        //code...
        $users->getupdates($id_user,$Nom,$Prenom,$Email,$Mdp,$Adresse);
        header('Location: files.php');
        var_dump("reussite");
    } catch (\Throwable $th) {
        //throw $th;
    }
   
   
    

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
    <link rel="stylesheet" href="../css/main.css">
    <title>Gestion de Fichier</title>
</head>
<body>
        <div class="setting">
            <div class="details1">
                <div class="details_title">
                    <h5>Setting your Information  :</h5>
                </div>
                <div class="exite">
                   <a href="member.php"><h5>X </h5></a>
                </div>
            </div>
            <div class="pdp">
                <a href="profil.php"><?=$profil->pdp($id_user)?></a>
            </div>
            <div class="set">
                <form action="">
               
                    <label for="">Nom</label>
                    <input type="text" value=<?=$info[0]['Nom']?> name="Nom">
                    <label for="">Prenom</label>
                    <input type="text" value=<?=$info[0]['Prenom']?> name="Prenom">
                    <label for="">Email</label>
                    <input type="email" value=<?=$info[0]['Email']?> name="Email">
                    <label for="">Mot de Passe</label>
                    <input type="password" value=<?=$info[0]['Mdp']?> name="Mdp">
                    <label for="">Adresse</label>
                    <input type="text" value=<?=$info[0]['Adresse']?> name="Adresse">
                    <input type="submit" Value="Changer">
                </form>
            </div>
              
        </div>
   
    <div class="files">
        <div class="by">
            <div class="by_title">
                <h5>Ajout de Fichier ICi </h5>
            </div>
            <div class="quit">
                <h5>X </h5>

            </div>

        </div>
        <form action="">
            <div class="div1">
                <input type="text" class="form-control" placeholder="Enter Your Name Here">
                <br>
                <input type="text" placeholder="Enter Your Name Here"><br>
                <input type="text" placeholder="Enter Your Name Here">

            </div>
            <div class="div2">
                <input type="text" placeholder="Enter Your Name Here">
                <br>
                <input type="text" placeholder="Enter Your Name Here"><br>
                <input type="text" placeholder="Enter Your Name Here">

            </div>
            <input type="button" value="Envoyer" class="envoyer">
        </form>
    </div>
    <div class="share">
        <div class="menu">
            <h5 style="text-align:center;color:white;margin-top:3vh;">SHARES FILES</h5>
            <div class="logo">
            <a href="profil.php"> <?=$profil->pdp($id_user)?></a>


            </div>
            <h5 style="text-align:center;color:white"><?=$info[0]["Prenom"]?></h5>
            <h5 style="text-align:center;color:white"><?=$info[0]["Nom"]?></h5>
            <ul>
                <li><a href="../pages/home.php"><img src="../img/icons8_home_48px.png" width="20" alt=""> Home</a></li>
                <li ><img src="../img/icons8_member_240px.png" width="20" alt="" style="margin-left: 8px;" > Member</li>
                <li  > <img src="../img/icons8_file_60px.png" width="20" alt=""> <a href="files.php">FILES</a></li>
                <li class="active"> <img src="../img/icons8_settings_128px.png" width="20" alt=""> <a href="setting.php">Setting</a></li>
                <li> <img src="../img/icons8_shutdown_128px.png" width="20" alt=""><a href="../index.php">LogOut</a></li>
            </ul>
            <div class="logo1">
                <img src="http://localhost:8000/info.php" alt="">

            </div>

        </div>
        <div class="action">
            <div class="publication">
            <form action="" class='search'>
                   <input type="text" placeholder="You can search a file publiate here" name="search" class="input">
                   <input type="submit" value="Search" id='search' class="button"/>
                   </form>
             
            <h5 style="text-align:center; margin-top:5vh">Votre fichiers partager et enregistrer</h5>
            <div class="table">
                <table>
                    <tr>
                        <td>Profil</td>
                        <td>Nom</td>
                        <td>Email</td>
                        <td>Followers</td>
                        <td>Droit</td>
                    </tr>
                    <?php foreach ($all as $user) :?>
                        <tr>
                        <td class="photo"><a href="member.php?c=<?=$user['Id']?>"><?=$profil->pdp($user["Id"])?></a></td>
                        <td><?=$user["Nom"]?></td>
                        <td><?=$user["Email"]?></td>
                        <td><?php $follow=$followers->compte($user["Id"]);$compte=$follow[0]["COUNT(*)"];echo $compte ?></td>
                        <?php $fol=$followers->follow($user["Id"],$id_user)?>
                        <?php if(empty($fol)):?>
                        <td><a href="member.php?id=<?=$user["Id"]?>"><Button style="height: 5vh;width: 100%;">Follow</Button></a></td>
                        <?php else: ?>
                            <td><Button style="height: 5vh;width: 100%;color:red">Follow</Button></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach?>                   
                </table>
                <div class="control">
                    <?php if($precedent > 0): ?>
                    <a href="member.php?offset=<?=$offset+5?>" style="box-shadow: 0 0 7px rgb(62, 43, 129);border: none;border-radius: 5px;width:10%;text-align: center"><button style="width: 100%;color:white;border-radius: 5px;background-color: rgb(62, 43, 129);">Next</button></a>
                    <?php endif?>
                    <?php if($offset !=0 || $limit == 0):?>
                    <a href="member.php?offset=<?=$offset-5?>" style="box-shadow: 0 0 7px rgb(62, 43, 129);border: none;border-radius: 5px;width:10%;text-align: center;margin-left:2%;"><button style="width: 100%; background-color: rgb(14, 6, 59);color:white;border-radius: 5px">Precedent</button></a>
                    <?php endif?>
                </div>

            </div>
            </div>
           

            <div class="stat">
               <div class="note">
                <div class="part1">
                <?=$member?> <br> MEMBERS

                </div>
                <div class="part2">
                <?php $followed=$following->share();$compte=$followed[0]["COUNT(*)"];echo $compte ?> <br> SHARES PUBLIC
                </div>
               </div>
               <div class="note">
                <div class="part3">
                <?php $followed=$following->compte($id_user);$compte=$followed[0]["COUNT(*)"];echo $compte ?> <br> SHARES FILES
                </div>
                <div class="part4">
                <?php $follow=$followers->compte($id_user);$compte=$follow[0]["COUNT(*)"];echo $compte ?> <br> Followers
                </div>
               </div>
               <h5 style="margin-top: 5vh;text-align: center;">Your personnal Information</h5>
               <div class="global">
                
                <div class="stat_pers">
                    <?=ceil($int)?>% <br>
                    Participation

                </div>
              </div>
              <h5 style="margin-top: 12vh;text-align: center;">Your personnal Information</h5>
              <div class="qr">
                <img src="http://localhost:8000/code.php" alt="">

               </div>
               

            </div>

        </div>

    </div>
</body>
</html>