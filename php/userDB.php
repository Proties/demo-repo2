<?php
namespace Insta\Databases\User;
use Insta\Databases\Database;
use Insta\Users\Users;
use Exception;
use PDOException;
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
                SELECT u.userID,u.username,i.filename as filename,i.filepath as filepath FROM Users u
                LEFT JOIN ProfileImages pi ON  pi.userID=u.userID 
                LEFT JOIN Images i ON i.imageID=pi.imageID
                WHERE u.username LIKE :name
                LIMIT 5;
            ';

            $stmt = $db->prepare($query);
            $stmt->bindValue(':name', '%' . $user . '%');
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
                    SELECT username,userID,i.filename,i.filepath FROM Users u
                    LEFT JOIN ProfileImages pi ON pi.userID=u.userID
                    LEFT JOIN Images i ON i.imageID=pi.imageID
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
            $this->user->set_profilePicture($data['filepath'].'/'.$data['filename']);
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
            $query='
                    SELECT email,u.userID as userID,username,shortBio,i.filename as filename,i.filepath as filepath FROM Users u
                    LEFT JOIN ProfileImages p ON p.userID=u.userID
                    LEFT JOIN Images i ON i.imageID=p.imageID
                    WHERE u.password=:password AND email=:email;
                    ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':password',$this->user->get_password());
            $stmt->bindValue(':email',$this->user->get_email());
            $stmt->execute();
            $id=$stmt->fetch();
            if($id==false){
                throw new PDOException('user info not defined');
            }
            $this->user->set_id($id['userID']);
            $this->user->set_username($id['username']);
            $this->user->set_profilePicture($id['filepath'].'/'.$id['filename']);
            $this->user->set_email($id['email']);
            $this->user->set_shortBio($id['shortBio']);
            
        }catch(PDOException $err){
            $data=array('errorMessage'=>$err->getMessage());
            return $data;
        }
    }
    public function add_profile_view($date,$time,$link,$id){
        try{
            $db=$this->db;
            $query='
                    INSERT INTO ProfileViews(userID,profileLink,dateVisited,timeVisited,profileID)
                    VALUES(:userID,:link,:dateV,:timeV,:profileID);
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':userID',$this->user->get_id());
            $stmt->bindValue(':link',$link);
            $stmt->bindValue(':dateV',$date);
            $stmt->bindValue(':timeV',$time);
            $stmt->bindValue(':profileID',$id);
            $stmt->execute();
        }catch(PDOException $err){
            return $err;
        }
    }
    
//this sql query gets the profiles with the most visits 
//that are not in hiddenProfile table
//that are also not in follower table
public function get_popular_profiles(){
        try{
            $db=$this->db;
            $query='
                SELECT u.username,i.filename as filename,i.filepath as filepath,u.userID FROM ProfileViews pv
                INNER JOIN Users u ON u.userID=pv.profileID
                LEFT JOIN ProfileImages pi ON pi.userID=u.userID
                LEFT JOIN Images i ON i.imageID=pi.imageID
                LIMIT 4;
                ';

            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetchall();
    }catch(PDOException $err){
        return $err;
    }
}
    public function add_hidden_profile(){
        try{
            $db=$this->db;
            $query='
                INSERT INTO HiddenProfiles(profileID,userID,dateMade)
                VALUES(:profile,:userID,:dateM);
            ';
            $stmt=$db->prepare($query);
            $stmt->execute();

    }catch(PDOException $err){
        return $err;
    }

}
}
?>