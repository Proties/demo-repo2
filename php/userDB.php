<?php
namespace Insta\Databases\User;
require 'php/database.php';
use Insta\Databases\Database;
use Insta\Users\Users;
use Exception;
class UserDB extends Database{
    public $user;
    public function __construct(Users $user){
        Database::__construct();
        $this->user=$user;
    }
    public function get_user(){
        return $this->user;
    }
    public function search_user($user){
        try{
            $db=$this->get_connection();
            $query='
            SELECT username FROM Users u1 USE INDEX(idx_username)
            WHERE username LIKE :name
            LIMIT 5;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':name',"%$user%");
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExcepion $err){
            echo 'error looking for username '.$err->getMessages();
            return $err;
        }
    }
   
    public function write_user(){
        
        $db=$this->get_connection();
        try{
            $query = "
            INSERT INTO Users(fullname, username, userPassword,dateMade,timeMade)
            VALUES(:name, :username, :userPassword, :dateMade, :timeMade);
        ";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $this->user->get_name());
        $statement->bindValue(':username', $this->user->get_username());
        $statement->bindValue(':userPassword', $this->user->get_password()); 
        $statement->bindValue(':dateMade', $this->user->get_date()); 
        $statement->bindValue(':timeMade', $this->user->get_time());
        $this->user->set_status($statement->execute());
        $this->user->set_id($db->lastInsertId());
        }catch(PDOExcepion $err){
            echo 'Database error while writing to user '.$err->getMessage();
            return $err;
        }
    }
    public function read_user_with_username(){
          $db=$this->get_connection();
          try{
            $query='
                    SELECT username,userID FROM Users
                    WHERE username=:id;
            ';
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->user->get_username());
            $statement->execute();
            $data=$statement->fetch();
            if($data==false){
                throw new PDOExcepion('no user selected');
            }
            $this->user->set_id($data['userID']);
            $this->user->set_username($data['username']);
            $this->user->set_name($data['fullname']);
        }catch(PDOExcepion $err){
            echo 'Database error while read user'.$err->getMessage();
            return $err;
        }
    }
    public function get_posts_with_username(){
        $db=$this->get_connection();
        try{
            $query='
                SELECT u.username,u.userID,p.postID,i.filepath,i.filename FROM Users u
                INNER JOIN Posts as p ON u.userID=p.userID 
                INNER JOIN PostImages as ip ON p.postID=ip.postID
                INNER JOIN Images as i ON ip.imageID=i.imageID  
                WHERE u.username=:id;
            ';
        $statement=$db->prepare($query);
        $statement->bindValue(':id',$this->user->get_username());
        $statement->execute();
        $data=$statement->fetch();

        if($data==false){
            throw new Exception('no user selected');
        }
        $this->user->set_id($data['userID']);
        $this->user->set_username($data['username']);
        $this->user->get_posts($data);
            
        }catch(PDOExcepion $err){
            echo 'Database error while read user'.$err->getMessage();
        }
    }
    public function read_user(){
        try{
    
            $db=$this->get_connection();
            $query='
                    SELECT * FROM Users
                    WHERE userID=:id;
            ';
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->user->get_id());
            $statement->execute();
            $data=$statement->fetch();
            if($data==false){
                throw new PDOExcepion('no user selected');
            }
            $this->user->set_id($data['userID']);
            $this->user->set_username($data['username']);
            $this->user->set_name($data['fullname']);
        }catch(PDOExcepion $err){
            echo 'Database error while read user'.$err->getMessage();
        }
    }
  
    public function read_userID(){
        try{

            $db=$this->get_connection();
            $query='
                    SELECT userID FROM Users
                    WHERE username=:uname;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':uname',$this->user->get_username());
            $stmt->execute();
            $data=$stmt->fetch();
            if($data==false){
                throw new PDOExcepion('user id not found');
            }
            if(is_int($data['userID'])){
                 $this->user->set_id($data['userID']);
            }
           throw new PDOExcepion('not valid user id ');
           
        }catch(PDOExcepion $err){
            echo 'Database error while reading id'.$err->getMessage();
        }
    }
    public static function get_usernames(){
        try{

            $db=$this->get_connection();
            $query='
            SELECT username FROM Users u1 USE INDEX(idx_username);
            ';
            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExcepion $err){
            echo $err->getMessage();
            return $err;
        }
    }
   
   
    public function search_email_in_db($email){
        try{

            $db=$this->get_connection();
            $query='
            SELECT email FROM Users
            WHERE email=:mail;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':mail',$email);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOExcepion $err){
            echo $err->getMessage();
            
        }
    }
    
    public function search_username_in_db($email){
        try{

            $db=$this->get_connection();
            $query='
            SELECT username FROM Users
            WHERE username=:user;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':user',$email);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOExcepion $err){
            echo $err->getMessage();
            
        }
    }
    public function validate_username_in_database($name){
        try{
            $db=$this->get_connection();
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
        }catch(PDOExcepion $err){
            echo 'Database error while validating username'.$err->getMessage();
            return false;
        }
    }
}


?>