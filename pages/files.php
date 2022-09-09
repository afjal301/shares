<?php
require_once '../class/user.php';
require_once '../class/profil.php';
require_once '../class/files.php';
require_once '../class/followers.php';
$followers=new Followers();

$users=new Users();
$profil=new Profil();
$user=new Files();
session_start();
$info=$_SESSION['mdp'];
$id_user=$info[0]['Id'];
if (isset($_FILES['pdp'])){
    # code...
    
  try {
    //code...
    $img_blob=$_FILES["pdp"]["tmp_name"];
    $img_type=$_FILES["pdp"]["type"];
    $img_taille=$_FILES["pdp"]["size"];
    $img_name=$_FILES["pdp"]["name"];
    $donnes=addslashes(fread(fopen($img_blob, "r"), $img_taille));  
    $profil->update($donnes,$img_taille,$img_name,$img_type,$id_user);
  } catch (\Throwable $th) {
    //throw $th;
  }
}
$files=$user->upload($id_user);
//var_dump($files);
$member=$users->member();

if(isset($_GET['delete']) && $_GET['delete'] !== ""){
$user->delete($_GET['delete']);
}
if(isset($_GET['update']) && $_GET['update'] !== ""){
$user->publiate($_GET['update']);

}
if(isset($_GET['identity']) && $_GET['identity']!==""){
    $identity=$_GET['identity'];
    $_SESSION['files'] =$identity;
}
if(  isset($_GET['comment']) && $_GET['comment']!==""){
    
    $comment=$_GET['comment'];
    $user->comment($_SESSION['files'],$id_user,$comment);

}
if(isset($_SESSION['files'])){
    $publiate=$user->id($_SESSION['files']);
    $commented=$user->commented($_SESSION['files']);
    $allcmt=$user->allcmd($_SESSION['files']);
    $allcmt=$allcmt[0]["COUNT(*)"];
    $liked=$user->liked($_SESSION['files'],$id_user);
    $allike=$user->allike($_SESSION['files']);
    $allike=$allike[0]["COUNT(*)"];
}
if(isset($_GET['like'])){
    $user->like($_SESSION['files'],$id_user);
}

$fic=$user->share();
$yours=$user->compte($id_user);
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
    <?php if(isset($_GET["identity"]) && $_GET["identity"] !==" "):?>
        <div class="details">
        <div class="by">
            <div class="by_title">
                <h5> My shares files by :</h5>
            <div class="sary">
               <?php $publiate=$user->id($_GET['identity']); 
                 $index=$publiate[0]["id_user"] ;
                 echo $profil->pdp($index);        
               ?>
                <h5 style="text-align:center;color:black"><?php $publiate=$user->id($_GET['identity']); 
                 $index=$publiate[0]["id_user"] ;
                 $id=$users->id($index); 
                 echo $id[0]["Nom"]." ".$id[0]["Prenom"];
                        
               ?> <br>
               </h5>
               <h5 style="text-align:center;color:black"><?php $publiate=$user->id($_GET['identity']); 
                 $index=$publiate[0]["Addate"] ;
                 $id=$publiate[0]["id_user"] ;
                 $id=$users->id($id); 
                 echo $index." ".$id[0]["Adresse"];        
               ?></h5>
               <span>
                <?=$publiate[0]["legende"]?>
               </span>
              
    
            </div>
            </div>
            <div class="quit">
               <a href="files.php"> <h5>X </h5></a>

            </div>
        </div>
        <div class="down">   
                <img src="../img/icons8_check_file_96px.png" alt=""> 
        </div>
        <div class="cmt">
        <div class="like">
                <?php if(empty($liked)):?>
                <a href="home.php?like=<?=$id_user?>"><img src="../img/icons8_facebook_like_48px.png" alt="" ></a>
                <?php else:?>
                <img src="../img/icons8_facebook_like_60px.png" alt="">
                <?php endif;?>
                <?=$allike?>


            </div>
            <div >
                <img src="../img/icons8_topic_48px.png" alt=""> <?=$allcmt?>
            </div>
            <div>
            <a href="<?=$publiate[0]['img_nom']?>"><img src="../img/icons8_downloading_updates_96px.png" alt=""></a>
            </div>

        </div>
        <div class="down1">
            <h6>commentaire : </h6>
            <div class="cmd">
               <?php if(!empty($commented)) :?>
                <?php foreach($commented as $come) :?>
                <div class="atao">
                <div class="cmt1">
                  <?php $ed=$come['id_user']; echo $profil->pdp($ed);?>
                  </div>
                  <div class="cmt2">
                  
                    <span style='font-size:10px;margin-top:2vh'><b><?php $ed=$come['id_user'];$id=$users->id($ed); echo $id[0]["Nom"]." ".$id[0]["Prenom"]?></b></span><br>
                    
                        <?=$come['commentaire']?>
  
                  </div>
                </div>
              <?php endforeach;?>
                <?php endif?>
            </div>
            <form action="">
                <input type="text" class="texto" name="comment">
                <input type="submit" class="send">
            </form>

        </div>
    </div>
    <?php endif?>
    <div class="files">
        <div class="by">
            <div class="by_title">
                <h5>Ajout de Fichier ICi </h5>
            </div>
            <div class="quit">
                <h5>X </h5>

            </div>

        </div>
        <form enctype="multipart/form-data" action="home.php" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="700000" class="form-control" style="margin-top: 15vh;">
                <input type="file" name="fichiers" size="20" >
                <input type="text" name="legende" placeholder="legende">
                <select name="droit" id="">
                    <option value="1">Public</option>
                    <option value="2">Private</option>
                </select>
                <input type="submit" value="Add fichiers" style="margin-bottom: 5vh;">
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
                <li><img src="../img/icons8_member_240px.png" width="20" alt="" style="margin-left: 8px;"><a href="member.php">Member</a></li>
                <li  class="active" > <img src="../img/icons8_file_60px.png" width="20" alt=""> FILES</li>
                <li> <img src="../img/icons8_settings_128px.png" width="20" alt=""> <a href="setting.php">Setting</a></li>
                <li> <img src="../img/icons8_shutdown_128px.png" width="20" alt=""><a href="../index.php">LogOut</a></li>
            </ul>
            <div class="logo1">
                <img src="http://localhost:8000/code.php" alt="">

            </div>

        </div>
        <div class="action">
            <div class="publication">
                <h5 style="text-align:center; margin-top: 2vh">Apropos de votre partage de Fichiers</h5>
                <div class="style">
                    <div class="rond_1">                    
                        <div class="s">
                            <?php $pub=$user->file($id_user);$pub=$pub[0]["COUNT(*)"];echo $pub?><br>                            
                        </div>
                        <h6 style='text-align:center;margin-top:5px'>My public file</h6>                 
                    </div>
                    
                    
                <div class="rond_1">
                        <div class="s">
                            <?php $pub=$user->unir($id_user);$pub=$pub[0]["COUNT(*)"];echo $pub?><br>                            
                        </div>
                        <h6 style='text-align:center;margin-top:5px'>All My file</h6>    

                </div>
                <div class="rond_1">
                         <div class="s">
                            <?php $pub=$user->prive($id_user);$pub=$pub[0]["COUNT(*)"];echo $pub?><br>                            
                        </div>
                        <h6 style='text-align:center;margin-top:5px'>My private file</h6>    

                </div>
            </div>
            <h5 style="text-align:center; margin-top:5vh">Votre fichiers partager et enregistrer</h5>
            <div class="table">
                <table>
                    <tr>
                        <td>Nom</td>
                        <td>legende</td>
                        <td>Date</td>
                        <td>Droit</td>
                        <td>Details</td>
                        <td>Delete</td>
                    </tr>
                    <?php foreach ($files as $file): ?>
                        <tr>
                        <td><?=$file["img_nom"]?></td>
                        <td><?=$file["legende"]?></td>
                        <td><?=$file["Addate"]?></td>
                        <td><?php if($file["id_droit"]==1):?><?="public"?><?php else :?><?="prive"?><?php endif?></td>
                        <td> 
                            <div class="follow">
                                <?php if($file["id_droit"]==1):?>
                                    <a href="files.php?identity=<?=$file["id"]?>"> <button> MORE DETAILS </button></a>
                                <?php else : ?>
                                    <a href="files.php?update=<?=$file["id"]?>"> <button> PUBLIATE IT  </button></a>
                                <?php endif?> 
                                </div>
                        </td>
                        <td> 
                            <div class="follow">
                                <a href="files.php?delete=<?=$file["id"]?>"> <button style=" background-color: rgb(231, 138, 50);border:none;width:100%;color:white;border-radius:5px;"> DELETE </button></a>
                            </div>
                        </td>
                        
                    </tr>

                    <?php endforeach?>
                  
                </table>
                <div class="control">
                    <button style="box-shadow: 0 0 7px rgb(62, 43, 129);border: none;border-radius: 5px;">Next</button>
                    <button class="add" style="box-shadow: 0 0 7px rgb(62, 43, 129);border: none;border-radius: 5px;background-color: rgb(93, 208, 228);">Ajouter</button>
                    <button style="box-shadow: 0 0 7px rgb(62, 43, 129);border: none;border-radius: 5px">Precedent</button>
                </div>

            </div>
            </div>
           

            <div class="stat">
               <div class="note">
                <div class="part1">
                <?=$member[0]["COUNT(*)"]?> <br> MEMBERS

                </div>
                <div class="part2">
                <?php $followed=$user->share($id_user);$compte=$followed[0]["COUNT(*)"];echo $compte ?> <br> PUBLIC SHARE
                </div>
               </div>
               <div class="note">
                <div class="part3">
                <?php $followed=$user->compte($id_user);$compte=$followed[0]["COUNT(*)"];echo $compte ?> <br> SHARES FILES
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