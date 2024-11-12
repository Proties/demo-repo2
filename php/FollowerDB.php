<?php 
namespace Insta\Database\Follower;
use Insta\Follower\Follower;
use Insta\Databases\Database;
use PDOException;

class FollowerDB extends Database{
    private Follower $follower;
    private $db;
    public function __construct(Follower $follower)
    {
        $this->db=Database::get_connection();
        $this->follower=$follower;
    }
    public function addFollower(){
        $db=$this->db;
        try{
            $query='

                    INSERT INTO followers()
                    VALUES(:userId,:followerID,:dataMade,:timeMade);
            ';
            $statement=$db->prepare($query);
            $statement->bindValue(':userId',$this->follower->get_current_userID());
            $statement->bindValue(':followerID',$this->follower->get_follower_userID());
            $statement->bindValue(':dataMade',$this->follower->get_date());
            $statement->bindValue(':timeMade',$this->follower->get_time());
            return $statement->execute();

        }catch(PDOException $err){
            return $err;
        }
    }
    public function unFollowUser(){
        try{
            $query='
                    DELETE FROM followers
                    WHERE userID=:userID AND followerID=:followID
            ';
            $statement=$db->prepare($query);
            $statement->bindValue(':userID',$this->follower->get_current_userID());
            $statement->bindValue(':userID',$this->follower->get_follower_userID());
            return $statement->execute();
        }catch(PDOException $err){
            return $err;
        }
    }
    public function getFollowerList(){
        $db=$this->db;
        try{

            $query='
                    SELECT u.username,u.fullname FROM followers f
                    INNER JOIN User u ON f.userID=u.userID
                    WHERE userID=:userID;
            ';
            $statement=$db->prepare($query);
            $statement->bindValue(':userID',$this->follower->get_current_userID());
            $statement->execute();
            return $statement->fetchall();
        }catch(PDOException $err){
            return $err;
        }
    }
    public function getFollowingList(){
        $db=$this->db;
        try{
            $query='
                    SELECT u.username,u.fullname FROM followers f
                    INNER JOIN User u ON f.userID=u.userID
                    WHERE userID=:userID;
            ';
            $statement=$db->prepare($query);
            $statement->bindValue(':userID',$this->follower->get_current_userID());
            $statement->execute();
            return $statement->fetchall();

        }catch(PDOException $err){
            return $err;
        }
    }

}


?>