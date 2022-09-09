<?php

class Users
{
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
    public function add($Nom,$Prenom,$Email,$Mdp,$Adresse)
    {
        $pdo=$this->connect();
        $pdo->query("INSERT INTO user(Nom,Prenom,Email,Mdp,Adresse) VALUES ('$Nom','$Prenom','$Email','$Mdp','$Adresse')");
    }
    public function select($email):array{
        $pdo=$this->connect();
        $query=$pdo->query("INSERT * FROM user WHERE Email = '$email'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function signin($email , $mdp):array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM user WHERE Email ='$email' and Mdp ='$mdp'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function all(int $offset):array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM user LIMIT 5 OFFSET $offset");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function id($id):array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT * FROM user WHERE Id ='$id'");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function member():array{
        $pdo=$this->connect();
        $query=$pdo->query("SELECT COUNT(*) FROM user ");
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getupdates($id,$Nom,$Prenom,$Email,$Mdp,$Adresse){
        $pdo=$this->connect();
        $query=$pdo->query("UPDATE user SET Nom='$Nom',Prenom='$Prenom',Email='$Email',Mdp='$Mdp',Adresse='$Adresse' WHERE Id='$id'");
    }
  
   
    
}
?>