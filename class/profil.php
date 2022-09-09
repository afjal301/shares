<?php
class Profil{
    public function connect(){
        $host="localhost";
        $dbname="files";
        $user="root";
        $pass='';
        try {
            $pdo=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
            return $pdo;
        
        } catch (\Throwable $th) {
            echo"not connected";
        }
    
        
    }
    public function add($img_blob,$img_taille,$img_nom,$img_type,$id_user)
    {
        $pdo=$this->connect();
        $pdo->query("INSERT INTO pdp(img_blob,img_taille,img_nom,img_type,id_user) VALUES ('$img_blob','$img_taille','$img_nom','$img_type','$id_user')");
    }
    public function pdp($email){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * from pdp where id_user='$email'");
        $resultat=$query->fetch();
        if($resultat){
            $donnes=$resultat["img_blob"];
            $type=$resultat["img_type"];
            
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $donnes ).'" width="30%"/>';
        }
        

    }
    public function pic($email):array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * from pdp where id_user='$email'");
        $resultat=$query->fetchAll();
        return $resultat;
      

    }
    public function update($img_blob,$img_taille,$img_nom,$img_type,$id_user){
        $pdo=$this->connect();
        $query=$pdo->query("UPDATE pdp SET img_blob='$img_blob',img_taille='$img_taille',img_nom='$img_nom',img_type='$img_type' WHERE id_user='$id_user'");

     
    }
}

?>