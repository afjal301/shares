<?php
require_once '../class/user.php';
require_once '../class/profil.php';
require_once '../class/followers.php';
require_once '../class/files.php';
$followers=new Followers();
$users=new Users();
$profil=new Profil();
$files=new Files();
session_start();
$info=$_SESSION['mdp'];
$id_user=$info[0]['Id'];
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


$fic=$files->share();
$yours=$files->compte($id_user);
$int=($yours[0]["COUNT(*)"]/$fic[0]["COUNT(*)"])*100;

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
<div class="profil">
        <div class="by">
            <div class="by_title">
                <h5>Updates your Profil Picture here  </h5>
            </div>
            <div class="quit">
               <a href="home.php"> <h5>X </h5></a>

            </div>
        </div>
        <div class="change">
        <form enctype="multipart/form-data" action="home.php" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="700000" class="form-control">
                <input type="file" name="pdp" size="20" >
                <input type="submit" value="Changer">
        </form>

        </div>
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
                <li  class="active" ><img src="../img/icons8_home_48px.png" width="20" alt=""> Home</li>
                <li><img src="../img/icons8_member_240px.png" width="20" alt="" style="margin-left: 8px;"> <a href="member.php">Member</a></li>
                <li > <img src="../img/icons8_file_60px.png" width="20" alt=""> <a href="files.php">FILES</a></li>
                <li> <img src="../img/icons8_settings_128px.png" width="20" alt=""> Setting</li>
                <li> <img src="../img/icons8_shutdown_128px.png" width="20" alt=""> <a href="../index.php">LogOut</a></li>
            </ul>
            <div class="logo1">
                <img src="http://localhost:8000/code.php" alt="">

            </div>

        </div>
        <div class="action">
            <div class="publication">
                <div class="search">
                    <input type="text" placeholder="You can search a file publiate here">
                    <button>Search</button>
                </div>
                <div class="public">
                    <div class="personne">
                        <div class="personne_img">
                            <img src="../img/walpaper/hd_13a9fef77389699e0c777407a3d609c7.jpg" alt="">

                        </div>
                       <div class="description">
                           <div class="name">
                            <h5>Tojo Randrianasolo</h5>
                            <h6>Fianarantsoa il y a une heure</h6>
                           </div >
                           <div class="follow">
                                <button>FILES VIEW</button>
                           </div>
                           <div class="follow">
                            <button>FOLLOW THIS</button>
                       </div>
                           
                       </div>

                    </div>
                    <div class="personne">
                        <div class="personne_img">
                            <img src="../img/walpaper/fonds-ecran-hd-gratuits_87.jpg" alt="">

                        </div>
                       <div class="description">
                           <div class="name">
                            <h5>Tojo Randrianasolo</h5>
                            <h6>Fianarantsoa il y a une heure</h6>
                           </div >
                           <div class="follow">
                                <button>FILES VIEW</button>
                           </div>
                           <div class="follow">
                            <button>FOLLOW THIS</button>
                       </div>
                           
                       </div>

                    </div>
                    <div class="personne">
                        <div class="personne_img">
                            <img src="../img/walpaper/hd_0526746866d93fe42482337bd9343375.jpg" alt="">

                        </div>
                       <div class="description">
                           <div class="name">
                            <h5>Tojo Randrianasolo</h5>
                            <h6>Fianarantsoa il y a une heure</h6>
                           </div >
                           <div class="follow">
                                <button>FILES VIEW</button>
                           </div>
                           <div class="follow">
                            <button>FOLLOW THIS</button>
                       </div>
                           
                       </div>

                    </div>
                    <div class="personne">
                        <div class="personne_img">
                            <img src="../img/walpaper/4k_pc_wallpapers_160_6cd0d.jpg" alt="">

                        </div>
                       <div class="description">
                           <div class="name">
                            <h5>Tojo Randrianasolo</h5>
                            <h6>Fianarantsoa il y a une heure</h6>
                           </div >
                           <div class="follow">
                                <button>FILES VIEW</button>
                           </div>
                           <div class="follow">
                            <button>FOLLOW THIS</button>
                       </div>
                           
                       </div>

                    </div>
                    <div class="personne">
                        <div class="personne_img">
                            <img src="../img/walpaper/hd_02793390b2e928644388e9578741b14c.jpg" alt="">

                        </div>
                       <div class="description">
                           <div class="name">
                            <h5>Tojo Randrianasolo</h5>
                            <h6>Fianarantsoa il y a une heure</h6>
                           </div >
                           <div class="follow">
                                <button>FILES VIEW</button>
                           </div>
                           <div class="follow">
                            <button>FOLLOW THIS</button>
                       </div>
                           
                       </div>

                    </div>

                </div>
                

            </div>

            <div class="stat">
                <div class="note">
                 <div class="part1">
                 <?=$member[0]["COUNT(*)"]?> <br> MEMBERS
 
                 </div>
                 <div class="part2">
                 <?php $follow=$files->share();$compte=$follow[0]["COUNT(*)"];echo $compte ?><br> LIKES
                 </div>
                </div>
                <div class="note">
                 <div class="part3">
                 <?php $followed=$files->compte($id_user);$compte=$followed[0]["COUNT(*)"];echo $compte ?>  <br> SHARES FILES
                 </div>
                 <div class="part4">
                 <?php $follow=$followers->compte($id_user);$compte=$follow[0]["COUNT(*)"];echo $compte ?>  <br> Followers
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
                 <img src="http://localhost:8000/info.php" alt="">
 
                </div>
                
 
             </div>
        </div>

    </div>
</body>
</html>