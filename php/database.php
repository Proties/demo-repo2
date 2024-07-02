<?php
namespace Insta\Databases;
use PDO;
use PDOExcepion;
class Database{
    private $dsn;
    private $user;
    private $password;
    private $pdo;
    
    public function __construct(){
        // $this->dsn='mysql:host=191.96.56.52;dbname=u203973307_wholedata;';
        $this->dsn='mysql:host='.$_ENV['IPADDRESS'].';dbname='.$_ENV['DATABASENAME'].';';
        // $this->user='u203973307_dbaAdmin';
        $this->user=$_ENV['DATABASEUSER'];
        // $this->password='w1]WEw?J@|N';
        $this->password=$_ENV['DATABASEPASSWORD'];
        $this->pdo;
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
            echo 'database error '.$err->getMessage() .' error code '.$err->getCode();
            exit();
        }catch(Exeception $er){
            echo 'general error occured '.$er->getMessage();
        }
    }
    public function get_connection(){
        return $this->pdo;
    }
}






?>