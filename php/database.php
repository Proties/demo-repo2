<?php
class Database{
    private $dsn='mysql:host=191.96.56.52;dbname=u203973307_wholedata;';
    private $user='u203973307_dbaAdmin';
    private $password='w1]WEw?J@|N';
    private $pdo;
    
    public function __construct(){
        $this->connect();
    }
    public function get_dsn(){
        return $this->dsn;
    }
    public function get_user(){
        return $this->user;
    }
    public function get_password(){
        return $this->password;
    }
    

    public function connect(){
        try{
            $this->pdo=new PDO($this->dsn,$this->user,$this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $err){
            echo "database error ".$err->getMessage();
            exit();
        }
    }
    public function get_connection(){
        return $this->pdo;
    }
}






?>