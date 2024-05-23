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
function topUsers(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT * FROM Users
                LIMIT 5;
        ";

        $stmt=$db->prepare($query);
        $stmt->execute();
        return $stmt->fetchall();
    }catch(PDOExecption $err){
        echo 'Database error '.$err->getMessage();
    }
}
function get_usernames(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT username FROM Users
        ";
        $stmt=$db->prepare($query);
        $stmt->execute();
        return $stmt->fetchall();
    }catch(PDOExeception $err){
        echo $err->getMessage();
    }
}
function get_categories(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT categoryName FROM category
            ";
        $stmt=$db->prepare($query);
        $stmt->execute();
        return $stmt->fetchall();
    }catch(PDOExecption $err){
        echo 'Database error '.$err->getMessage();
    }
}
function validate_user($name){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT * FROM user
                WHERE username=:username;
        ";
        $db->prepare($query);
        $db->bindValue(':username',$name);
        $result=$db->execute();
        return $result;
    }catch(PDOExecption $err){
        echo $err->getMessage();
        return false;
    }
}
function validate_post($id){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT * FROM post
                WHERE postId=:id;
        ";
        $db->prepare($query);
        $db->bindValue(':id',$id);
        $result=$db->execute();
        return $result;
    }catch(PDOExecption $err){
        echo $err->getMessage();
        return false;
    }

}
?>