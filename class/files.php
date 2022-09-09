<?php
class Files{
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
    public function add($img_blob,$img_taille,$img_nom,$img_type,$id_user,$legende,$Addate,$id_droit)
    {
        $pdo=$this->connect();
        $pdo->query("INSERT INTO files(img_blob,img_taille,img_nom,img_type,id_user,legende,Addate,id_droit) VALUES ('$img_blob','$img_taille','$img_nom','$img_type','$id_user','$legende','$Addate','$id_droit')");
    }
    public function all():array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM files  ");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function share():array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM files ");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function public():array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM files WHERE id_droit ='1' ");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function upload($id):array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM files WHERE id_user ='$id'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function compte($id){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM files WHERE id_user ='$id'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function id($id){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM files WHERE id ='$id'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function comment($id_files,$id_user,$commentaire){
        $pdo=$this->connect();
        $pdo->query("INSERT INTO comment(id_files,id_user,commentaire) VALUES ('$id_files','$id_user','$commentaire')");
    }
    public function commented($id_files){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM comment WHERE id_files ='$id_files' ");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get($var){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM files WHERE id_droit ='1' AND img_nom='$var' OR img_type='$var' OR legende='$var' ");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function file($id){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM files WHERE id_user ='$id' AND id_droit=1");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function delete($id){
        $pdo=$this->connect();
        $query=$pdo->query("DELETE FROM files WHERE id=$id");
        
    }
    public function publiate($id){
        $pdo=$this->connect();
        $query=$pdo->query("UPDATE files SET id_droit=1 WHERE id='$id' ");
    }
    public function prive($id){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM files WHERE id_user ='$id' AND id_droit=2");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function unir($id){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM files WHERE id_user ='$id'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function one($id){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM files WHERE id_user ='$id' AND id_droit=1 ");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function allcmd($id){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM comment WHERE id_files ='$id'");;
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function liked($id_files,$id_user){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM aime WHERE id_files ='$id_files' AND id_user ='$id_user'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function like($id_files,$id_user){
        $pdo=$this->connect();
        $pdo->query("INSERT INTO aime(id_files,id_user) VALUES ('$id_files','$id_user')");
    }
    public function allike($id){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM aime WHERE id_files ='$id'");;
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
}
?>