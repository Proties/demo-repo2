<?php
namespace Insta\Databases\User;
use Insta\Databases\Database;
use Insta\Users\Users;
use Exception;
class UserDB extends Database{
    public $user;
    private $db;
    public function __construct(Users $user){
        $this->user=$user;
        $this->db=Database::get_connection();
    }
    public function get_user(){
        return $this->user;
    }
    public function set_db($db){
        $this->db=$db;

    }
    public function get_userID_from_username($ids) 
    {
        $db=$this->db;
        try{
            // throw new Exception($line);
            $query=
            '
                SELECT userID FROM Users 
                WHERE username=:id
            ';
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$ids);
            $statement->execute();
            return $statement->fetch();
        }catch(PDOException $err){
            return $err;
        }
    }
    public function search_user($user){
        try{
            $db=$this->db;
            $query = '
                SELECT username,i.filename,i.filepath FROM Users u
                INNER JOIN ProfileImages pi ON  pi.userID=u.userID 
                INNER JOIN Images i ON i.imgeID=pi.imageID
                WHERE username LIKE :name 
                LIMIT 5;
            ';

            $stmt = $db->prepare($query);
            $stmt->bindValue(':name', '%' . $user . '%'); // Add wildcards
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOException $err){
            return $err;
        }
    }
   
    public function write_user(){
        
        $db=$this->db;
        try{
            $query = "
            INSERT INTO Users(email,name, username, password, dataMade, timeMade,lastName)
            VALUES(:email,:name, :username, :userPassword, :dateMade, :timeMade,:lastName);
        ";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $this->user->get_email());
        $statement->bindValue(':name', $this->user->get_name());
        $statement->bindValue(':lastName', $this->user->get_lastName());
        $statement->bindValue(':username', $this->user->get_username());
        $statement->bindValue(':userPassword', $this->user->get_password()); 
        $statement->bindValue(':dateMade', $this->user->get_date()); 
        $statement->bindValue(':timeMade', $this->user->get_time());
        $this->user->set_status($statement->execute());
        $this->user->set_id($db->lastInsertId());
        }catch(PDOException $err){
            echo 'Database error while writing to user '.$err->getMessage();
            return $err;
        }
    }
    public function read_user_with_username(){
          $db=$this->db;
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
                throw new PDOException('no user selected');
            }
            $this->user->set_id($data['userID']);
            $this->user->set_username($data['username']);
            // $this->user->set_name($data['fullname']);
        }catch(PDOException $err){
            echo 'Database error while read user'.$err->getMessage();
            return $err;
        }
    }
    public function get_posts_with_username(){
        $db=$this->db;
        try{
            $query='
                SELECT p.postID,p.postLink,i.filepath as imageFilePath,i.filename as imageFileName,
                v.filepath as videoFilePath,v.filename as videoFileName FROM Posts as p
                LEFT JOIN PostImages as ip ON p.postID=ip.postID
                LEFT JOIN VideoPost as vp ON p.postID=vp.postID
                LEFT JOIN Images as i ON ip.imageID=i.imageID  
                LEFT JOIN Videos as v ON vp.videoID=v.id  
                INNER JOIN Users as u ON p.userID=u.userID
                WHERE u.username=:username;
            ';
        $statement=$db->prepare($query);
        $statement->bindValue(':username',$this->user->get_username());
        $statement->execute();
        $data=$statement->fetchall();
        $this->user->get_posts($data);
        }catch(PDOException $err){
            echo 'Database error while read user'.$err->getMessage();
            return $err;
        }
    }
    public function read_user(){
        try{
    
            $db=$this->db;
            $query='
                    SELECT * FROM Users
                    WHERE userID=:id;
            ';
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->user->get_id());
            $statement->execute();
            $data=$statement->fetch();
            if($data==false){
                throw new PDOException('no user selected');
            }
            $this->user->set_id($data['userID']);
            $this->user->set_username($data['username']);
            $this->user->set_name($data['fullname']);
        }catch(PDOExcepion $err){
            echo 'Database error while read user'.$err->getMessage();
            return $err;
        }
    }
  
    public function read_userID(){
        try{

            $db=$this->db;
            $query='
                    SELECT userID FROM Users
                    WHERE username=:uname;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':uname',$this->user->get_username());
            $stmt->execute();
            $data=$stmt->fetch();
            if($data==false){
                throw new PDOException('user id not found');
            }
            if(is_int($data['userID'])){
                 $this->user->set_id($data['userID']);
            }
           throw new PDOException('not valid user id ');
           
        }catch(PDOException $err){
            echo 'Database error while reading id'.$err->getMessage();
            return $err;
        }
    }
    public static function get_usernames(){
        try{

            $db=$this->db;
            $query='
            SELECT username FROM Users u1 USE INDEX(idx_username);
            ';
            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOException $err){
            echo $err->getMessage();
            return $err;
        }
    }
   
   
    public function search_email_in_db($email){
        try{

            $db=$this->db;
            $query='
            SELECT email FROM Users
            WHERE email=:mail;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':mail',$email);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOException $err){
            echo $err->getMessage();
            return $err;
            
        }
    }
    
    public function search_username_in_db($email){
        try{

            $db=$this->db;
            $query='
            SELECT username FROM Users
            WHERE username=:user;
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':user',$email);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOException $err){
            echo $err->getMessage();
            return $err;
            
        }
    }
    public function validate_username_in_database($name){
        try{
            $db=$this->db;
            $query="
                    SELECT username FROM Users
                    WHERE username=:username;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':username',$name);
            $stmt->execute();
            $id=$stmt->fetch();
            
            return $id;
        }catch(PDOException $err){
            echo 'Database error while validating username'.$err->getMessage();
            return $err;;
        }
    }
    public function validate_email_in_database(){
        try{
            $db=$this->db;
            $query="
                    SELECT email FROM Users
                    WHERE email=:username;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':username',$this->user->get_email());
            $stmt->execute();
            $id=$stmt->fetch();
            
            return $id;
        }catch(PDOException $err){
            echo 'Database error while validating username'.$err->getMessage();
            return $err;;
        }
    }
     public function validate_password_in_database(){
        try{
            $db=$this->db;
            $query="
                    SELECT email,userID,username,shortBio,i.filename,i.filepath FROM Users u
                    LEFT JOIN ProfileImages p FROM p.userID=u.userID
                    INNER JOIN Images i FROM i.imageID=p.imageID
                    WHERE password=:password
                    AND email=:email;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':password',$this->user->get_password());
            $stmt->bindValue(':email',$this->user->get_email());
            $stmt->execute();
            $id=$stmt->fetch();
            $this->user->set_id($id['userID']);
            $this->user->set_username($id['username']);
            $this->user->set_profilePicture($id['filepath'].'/'.$id['filename']);
            $this->user->set_email($id['email']);
            $this->user->set_shortBio($id['shortBio']);
            return $id;
        }catch(PDOException $err){
            return $err;;
        }
    }
}


?>