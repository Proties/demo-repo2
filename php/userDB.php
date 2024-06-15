<?php
class UserDB extends PDO{
    private $user;
    public function __construct($user){
        $this->user=$user;
    }
    public static function search_user($user){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query='
            SELECT username FROM Users u1 USE INDEX(idx_username)
            WHERE username LIKE :name
            LIMIT 5;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':name',"%$user%");
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExecption $err){
            echo 'error looking for username '.$err->getMessages();
        }
    }
   
    public function write_user(){
        $database=new Database();
        $db=$database->get_connection();
        try{
            $query = "
            INSERT INTO Users(fullname, username, userPassword,dateMade,timeMade)
            VALUES(:name, :username, :userPassword, :dateMade, :timeMade);
        ";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $this->get_name());
        $statement->bindValue(':username', $this->get_username());
        $statement->bindValue(':userPassword', $this->get_password()); 
        $statement->bindValue(':dateMade', $this->get_date()); 
        $statement->bindValue(':timeMade', $this->get_time()); 

        
        $this->set_status($statement->execute());
        $this->set_id($db->lastInsertId());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
 
    public function read_user(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT * FROM Users
                    WHERE userID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->get_id());
            $this->set_status($statement->execute());
            $data=$statement->fetch();
            $this->set_username($data['username']);
            $this->set_name($data['fullname']);
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
  
    public function read_userID(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT userID FROM Users
                    WHERE username=:uname;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':uname',$this->get_username());
            $stmt->execute();
            $data=$stmt->fetch();
            $this->set_id($data['userID']);
        }catch(PDOExeception $err){
            echo 'Database error '.$err->getMessage();
        }
    }
  
    public function read_posts(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT postID FROM post
                    WHERE userID=:id;
            ";
            $statement->bindValue(':id',$this->get_authorID());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public static function get_usernames(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
            SELECT username FROM Users u1 USE INDEX(idx_username);
            ";
            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExeception $err){
            echo $err->getMessage();
        }
    }
   
   
    public function search_email_in_db($email){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
            SELECT email FROM Users u1 USE INDEX(idx_email)
            WHERE email=:mail;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':mail',$email);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOExeception $err){
            echo $err->getMessage();
        }
    }
    
    public function search_username_in_db($email){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
            SELECT username FROM Users u1 USE INDEX(idx_username)
            WHERE username=:user;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':user',$email);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOExeception $err){
            echo $err->getMessage();
        }
    }
    public static function validate_username_in_database($name){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT username FROM Users
                    WHERE username=:username;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':username',$name);
            $stmt->execute();
            $id=$stmt->fetch();
            if($id==true){
                return true;
            }
            return false;
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
            return false;
        }
    }
}


?>