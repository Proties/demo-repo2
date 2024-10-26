<?php 
namespace Insta\Databases\Post;
use Insta\Databases\Database;
use Insta\Posts\Post;
use Exception;
class PostDB extends Database{
    public Post $post;
    private $db;
    public function __construct(Post $post){
        $this->post=$post;
        $this->db=Database::get_connection();
    }
    public function get_post(){
        return $this->post;
    }
    public function addViewedPost($useID){
        $db=$this->get_connection();
        try{
            $query='
                    INSERT INTO ViewedPost
                    VALUES (:postID,:userID);
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':postID',$this->post->get_postID());
            $stmt->bindValue(':postID',$useID);
        }catch(PDOExecption $err){
            echo 'Database error while writing to viewed post: '.$err->getMessage();

        }
    }
    public function sharePost(){
        $db=$this->db;
        try{
            
        }catch(PDOExecption $err){
            return $err;
        }
    }
    public function viewSharedPost(){}
    public function delete_post(int $id){
         $db=$this->get_connection();
        try{
            $query='
                    UPDATE post 
                    WHERE postID=:id 
                    status=:hide
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':id',$id);
            $stmt->bindValue(':hide','hidden');
        }catch(PDOExecption $err){
            return $err;

        }

    }
    public function addServeredPost($useID){
        $db=$this->get_connection();
        try{
            $query='
                    INSERT INTO ServeredPost
                    VALUES (:postID,:userID);
            ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':postID',$this->post->get_postID());
            $stmt->bindValue(':postID',$useID);
        }catch(PDOExecption $err){
            echo 'Database error while writing to viewed post: '.$err->getMessage();

        }
    }
    public static function validate_postID($id){
        try{
            $db=$this->get_connection();
            $query="
                    SELECT * FROM post
                    WHERE postId=:id;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':id',$id);
            $result=$stmt->execute();
            return $result;
        }catch(PDOExecption $err){
            echo $err->getMessage();
            return false;
        }
    
    }
    public function validate_in_db_postLink($link){
        try{
            $db=$this->get_connection();
            $query="
                    SELECT postLink FROM post
                    WHERE postLink=:link;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':link',$link);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOExecption $err){
            echo $err->getMessage();
            return false;
        }
    
    }
    public function validate_postLinkID_in_db($link){
        try{
        $db=$this->get_connection();
        $query="
                SELECT postLinkID FROM post
                WHERE postLinkID=:link;
        ";
        $stmt=$db->prepare($query);
        $stmt->bindValue(':link',$link);
        $stmt->execute();
        
        if(is_array($stmt->fetch())){
            return true;
        }
        else{
            throw new Exception("Error Processing Request");
            
        }
        }catch(PDOExecption $err){
        echo $err->getMessage();
        return false;
        }

    }
    public function set_db($d){
        $this->db=$d;
    }

    public function write_post(){
        $db=$this->db;
        try{

            
            $query="
                    INSERT INTO Posts(postLinkId,caption,userID,postDate,postTime,postLink,previewStatus,postStatus)
                    VALUES(:postLinkID,:caption,:userID,:pdate,:ptime,:postLink,:preview,:status);
                    ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':caption',$this->post->get_caption());
            $stmt->bindValue(':userID',$this->post->get_authorID());
            $stmt->bindValue(':pdate',$this->post->get_date());
            $stmt->bindValue(':ptime',$this->post->get_time());
            $stmt->bindValue(':postLink',$this->post->get_postLink());
            $stmt->bindValue(':postLinkID',$this->post->get_postLinkID());
            $stmt->bindValue(':preview',$this->post->get_preview_status());
            $stmt->bindValue(':status',$this->post->get_status());
            $stmt->execute();
            $id=(int)$db->lastInsertId();
            $this->post->set_postID($id);
            
        }catch(PDOExecption $err){

            echo $err->getMessage();
            return $err;
        }
    }
 

    public function read_posts(){
         $db=$this->db;
        try{

            
            $query="
                    SELECT * FROM post
                    WHERE userID=:userID;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':userID',$this->post->get_authorID());
            $this->post->set_status($stmt->execute());
            $results=$stmt->fetchall();
            return $results;
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_postID(){
         $db=$this->db;
        try{
  
            
            $query="
                    SELECT p.postID,v.fileName,v.filePath,i.fileName,i.filePath FROM Posts p
                    LEFT JOIN PostImages pi ON p.postID=pi.postID
                    LEFT JOIN VideoPost vp ON p.postID=vp.postID
                    INNER JOIN Videos v On vp.videoID=v.id 
                    INNER JOIN Images i On pi.imageID=i.ImageID 
                    WHERE postLink=:link
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':link',$this->post->get_postLink());
            $stmt->execute();
            $id=$stmt->fetch();
            if($id==false){
                throw new Exception('error');
            }
            $this->post->set_postID($id['postID']);
        }catch(PDOExecption $err){
            return $err;
        }
        catch(Exception $err){
            return $err;
        }
    }
 
    public function get_postID_from_link(){
         $db=$this->db;
        try{ 
            $query='

                    SELECT postID,postLink FROM Posts
                    WHERE postLink=:id;

                    ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':id',$this->post->get_postLink());
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOExecption $err){
           return $err;
        }
    }
    public function read_post(){
         $db=$this->db;
        try{
   
              $query="
                    SELECT * FROM post
                    WHERE id=:postID;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':id',$this->post->get_postID());
            $this->post->set_status($stmt->execute());
            $results=$stmt->fetch();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function getVideo(){
        $db=$this->db;
        try{
   
            
            $query='
                    SELECT id FROM VideoPost
                    WHERE postID=:postID;

                    ';
            $stmt=$db->prepare($query);
            $stmt->bindValue(':postID',$this->post->get_postID());
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOExecption $err){
            return $err;
        }
    } 
}


?>