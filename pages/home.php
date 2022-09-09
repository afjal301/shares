<?php
require_once '../class/user.php';
require_once '../class/profil.php';
require_once '../class/files.php';
require_once '../class/followers.php';
require_once '../phpqrcode/qrlib.php';
//QRcode::png('my name ','filename.png');
$followers=new Followers();

$users=new Users();
$profil=new Profil();
$files=new Files();
session_start();
$info=$_SESSION['mdp'];
$id_user=$info[0]['Id'];

if (isset($_FILES['pdp'])){
    # code...
    
    
    $pic=$profil->pic($id_user);
    if(!empty($pic)){
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
        
    }else{
       try {
        //code...
        $img_blob=$_FILES["pdp"]["tmp_name"];
        $img_type=$_FILES["pdp"]["type"];
        $img_taille=$_FILES["pdp"]["size"];
        $img_name=$_FILES["pdp"]["name"];
        $donnes=addslashes(fread(fopen($img_blob, "r"), $img_taille)); 
        $profil->add($donnes,$img_taille,$img_name,$img_type,$id_user);
       } catch (\Throwable $th) {
        //throw $th;
        header("Location:picture.php" );
       }
       
    }
   
    
}
if (isset($_FILES['fichiers'])){
    # code...
   
    $id_droit=$_POST["droit"];
    $legende=isset($_POST["legende"])?$_POST["legende"]:" ";
    $date=new DateTime();
    $Addate=$date->format("Y-m-d");
    
    $img_blob=$_FILES["fichiers"]["tmp_name"];
    $img_type=$_FILES["fichiers"]["type"];
    $img_taille=$_FILES["fichiers"]["size"];
    $img_nom=$_FILES["fichiers"]["name"];
    /*
    $filePointer = fopen($img_blob, 'r');
    $fileData = fread($filePointer, filesize($img_blob));
    $fileData = addslashes($fileData);
    //$donnes=addslashes(fread(fopen($img_blob, "r"), $img_taille)); 
    //$pic=$profil->pic($id_user);*/
    try {
        //code...
        $fileData=addslashes(fread(fopen($img_blob, "r"), $img_taille)); 
    } catch (\Throwable $th) {
        //throw $th;
    }
    
    if(move_uploaded_file($img_blob,$img_nom)){
        $files->add($fileData,$img_taille,$img_nom,$img_type,$id_user,$legende,$Addate,$id_droit);
        unset($_FILES['fichiers']);
    }  
}
if(isset($_GET['search']) && $_GET['search']!==""){
    $all=$files->get($_GET['search']);
}else{
    $all=$files->public();
}

$member=$users->member();

$fic=$files->share();
$yours=$files->compte($id_user);
$int=($yours[0]["COUNT(*)"]/$fic[0]["COUNT(*)"])*100;
$identity=null;
if(isset($_GET['identity']) && $_GET['identity']!==""){
    $identity=$_GET['identity'];
    $_SESSION['files'] =$identity;
}
if(  isset($_GET['comment']) && $_GET['comment']!==""){
    
    $comment=$_GET['comment'];
    $files->comment($_SESSION['files'],$id_user,$comment);

}
if(isset($_SESSION['files'])){
    $publiate=$files->id($_SESSION['files']);
    $commented=$files->commented($_SESSION['files']);
    $allcmt=$files->allcmd($_SESSION['files']);
    $allcmt=$allcmt[0]["COUNT(*)"];
    $liked=$files->liked($_SESSION['files'],$id_user);
    $allike=$files->allike($_SESSION['files']);
    $allike=$allike[0]["COUNT(*)"];
}
if(isset($_GET['like'])){
    $files->like($_SESSION['files'],$id_user);
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
    <?php if (!empty($identity)) :?>
    <div class="details">
        <div class="by">
            <div class="by_title">
                <h5>shares files by :</h5>
            <div class="sary">
               <?php $publiate=$files->id($identity); 
                 $index=$publiate[0]["id_user"] ;
                 echo $profil->pdp($index);        
               ?>
                <h5 style="text-align:center;color:black"><?php $publiate=$files->id($identity); 
                 $index=$publiate[0]["id_user"] ;
                 $id=$users->id($index); 
                 echo $id[0]["Nom"]." ".$id[0]["Prenom"];
                        
               ?> <br>
               </h5>
               <h5 style="text-align:center;color:black"><?php $publiate=$files->id($identity); 
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
               <a href="home.php"> <h5>X </h5></a>

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
                <li> <img src="../img/icons8_settings_128px.png" width="20" alt=""> <a href="setting.php">Setting</a></li>
                <li> <img src="../img/icons8_shutdown_128px.png" width="20" alt=""> <a href="../index.php">LogOut</a></li>
            </ul>
            <div class="logo1">
                <img src="http://localhost:8000/code.php" alt="">

            </div>

        </div>
        <div class="action">
            <div class="publication">
               
                   <form action="" class='search'>
                   <input type="text" placeholder="You can search a file publiate here" name="search" class="input">
                   <input type="submit" value="Search" id='search' class="button"/>
                   </form>
               
                <div class="public">
                    <?php foreach ($all as $a) : ?>
                    <div class="personne">
                        <div class="personne_img">
                            
                        <?=$profil->pdp($a["id_user"])?>

                        </div>
                       <div class="description">
                           <div class="name">
                            <h5><?php $id=$users->id($a["id_user"]); echo $id[0]["Nom"]." ".$id[0]["Prenom"]?></h5>
                            <h6><?php $id=$users->id($a["id_user"]); echo $id[0]["Adresse"]." ".$a["Addate"]?></h6>
                            <h6> Nom : <?= $a['img_nom']?>  <br> Type : <?= $a['img_type']?> <br> Taille:<?= $a['img_taille']?> <br> Decription : <?=$a['legende']?></h6>
                           </div >
                           <div class="follow">
                               <a href="<?=$a["img_nom"]?>"> <button>DOWNLOAD</button></a>
                           </div>
                           <div class="follow">
                            <a href="home.php?identity=<?=$a["id"]?>"><button>MORE DETAILS</button></a>
                       </div>
                           
                       </div>

                    </div>
                    <?php endforeach ?>
                </div>   
                

            </div>

            <div class="stat">
                <div class="note">
                 <div class="part1">
                     <?=$member[0]["COUNT(*)"]?> <br> MEMBERS
 
                 </div>
                 <div class="part2">
                 <?php $followed=$files->share();$compte=$followed[0]["COUNT(*)"];echo $compte ?> <br> PUBLIC SHARES
                 </div>
                </div>
                <div class="note">
                 <div class="part3">
                 <?php $followed=$files->compte($id_user);$compte=$followed[0]["COUNT(*)"];echo $compte ?> <br> SHARES FILES <br>
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
                 <img src="http://localhost:8000/info.php" alt="">
 
                </div>
                
 
             </div>
        </div>

    </div>
</body>
</html>