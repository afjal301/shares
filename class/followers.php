<?php
class Followers{
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
    public function add($id_user,$followers){
        $pdo=$this->connect();
        $query=$pdo->query("INSERT INTO follow(id_user,followers) VALUES ('$id_user','$followers')");
    }
    public function compte($id_user):array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM follow WHERE id_user = '$id_user'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function follow($id_user,$followers){
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM follow WHERE id_user = '$id_user' AND followers = '$followers'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   
}

?>