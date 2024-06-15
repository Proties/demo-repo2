<?php 
class PostDB extends PDO{
    private $post;
    public function __construct($post){
        $this->post=$post;
    }
    public static function validate_postID($id){
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
    public static function validate_in_db_postLink($link){
        try{
            $database=new Database();
            $db=$database->get_connection();
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
    public function write_like(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    INSERT INTO likes(postID,userID)
                    VALUES(:postID,:userID);
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':postID',$this->get_postID());
            $stmt->bindValue(':userID',$this->get_authorID());
            $stmt->execute();
        }catch(PDOExecption $err){
            echo $err->getMessage();
        }
    }
    public function write_post(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    INSERT INTO post(postLinkID,postCaption,userID,postDate,postTime,postLink)
                    VALUES(:postLinkID,:caption,:userID,:date,:time,:postLink);
                    ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':caption',$this->get_caption());
            $stmt->bindValue(':userID',$this->get_authorID());
            $stmt->bindValue(':date',$this->get_date());
            $stmt->bindValue(':time',$this->get_time());
            $stmt->bindValue(':postLink',$this->get_postLink());
            $stmt->bindValue(':postLinkID',$this->get_postLinkID());
            $this->set_status($stmt->execute());
        }catch(PDOExecption $err){
            echo $err->getMessage();
        }
    }
    public function read_likes(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT count(*) FROM likes
                    WHERE id=:id;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':id',$this->get_id());
            $this->set_status($stmt->execute());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_category_posts(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
            SELECT * FROM USER_POST up1
            INNER JOIN post_category pc1 ON up1.postID=pc1.postID
            INNER JOIN post_category pc2 ON pc1.postID=up1.post2ID
            INNER JOIN category c1 ON pc1.categoryID=c1.categoryID
            WHERE c1.categoryName=:name;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':name',$this->get_categoryName());
            $stmt->execute();
            return $stmt->fetchall();
        }catch(PDOExecption $err){
            echo 'error reading post from category id '.$err->getMessage();
        }
    }
    public function read_posts(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT * FROM post
                    WHERE userID=:userID;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':userID',$this->get_authorID());
            $this->set_status($stmt->execute());
            $results=$stmt->fetchall();
            $this->set_posts($results);
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_postID(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT postID FROM post
                    WHERE postLink=:link
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':link',$this->get_postLink());
            $stmt->execute();
            $id=$stmt->fetch();
            $this->set_postID($id);
        }catch(PDOExecption $err){
            echo $err->getMessage();
        }
    }
    
    public function read_post(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    SELECT * FROM post
                    WHERE id=:postID;
            ";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':id',$this->get_postID());
            $this->set_status($stmt->execute());
            $results=$stmt->fetch();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
}


?>