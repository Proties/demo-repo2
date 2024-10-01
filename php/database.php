<?php
namespace Insta\Databases;
use PDO;
use PDOException;
class Database{
    private static $dsn='mysql:host=191.96.56.66;dbname=u203973307_Insta;';
    private static $user='u203973307_basic';
    private static $password='j.p7dVXk3NC3X8k';
    private static $pdo;
    
    // public function __construct(){
    //     // $this->dsn='mysql:host=191.96.56.52;dbname=u203973307_wholedata;';
    //     $this->dsn='mysql:host=191.96.56.66;dbname=u203973307_Insta;';
    //     // $this->user='u203973307_dbaAdmin';
    //     $this->user='u203973307_basic';
    //     // $this->password='w1]WEw?J@|N';
    //     $this->password='j.p7dVXk3NC3X8k';
    //     $this->pdo;
    // }

    // public function get_dsn(){
    //     return $this->dsn;
    // }
    // public function get_user(){
    //     return $this->user;
    // }
    // public function get_password(){
    //     return $this->password;
    // }
    

    // public function connect(){
    //     try{

    //         $this->pdo=new PDO($this->dsn,$this->user,$this->password);
    //         $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     }catch(PDOException $err){
    //         if($err->getCode()==2002){
    //             echo 'database network is down';
    //         }else{
    //             echo 'database error '.$err->getMessage() .' error code '.$err->getCode();
    //         }
            
    //         exit();
    //     }catch(Exeception $er){
    //         echo 'general error occured '.$er->getMessage();
    //     }
    // }

    public static function static_connect(){
        try{

            self::$pdo=new PDO(self::$dsn,self::$user,self::$password);
             self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $err){
            if($err->getCode()==2002){
                echo 'database network is down';
            }else{
                echo 'database error '.$err->getMessage() .' error code '.$err->getCode();
            }
            exit();
        }catch(Exeception $er){
            echo 'general error occured '.$er->getMessage();
        }
    }
    public static function get_connection(){
        if(!self::$pdo){
            self::static_connect();
        }
        return self::$pdo;
    }
}






?>