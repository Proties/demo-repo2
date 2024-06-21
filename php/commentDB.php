<?php 
class CommentDB extends Database{
    public $comment;
    public function __construct(Comment $comment){
        Database::__construct();
        $this->comment=$comment;
    }
    public function get_comment(){
        return $this->comment;
    }
    public function read_comments(){
        $db=$this->get_connection();
        try{
            
            $query="
                SELECT u1.username,c1.commentText,c1.commentID FROM comment as c1
                INNER JOIN Users as u1 ON c1.userID=u1.userID
                WHERE postID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->comment->get_postID());
            $statement->execute();
            $arr=$statement->fetchall();
            $this->comment->set_comments($arr);
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_comment(){
        $db=$this->get_connection();
        try{
           
            $query="
                SELECT * FROM Comment
                WHERE commentID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(":id",$this->comment->get_id());
            $this->set_status($statement->execute());
            $this->set_comment($statement->fetch());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function write_comment(){
        $db=$this->get_connection();
        try{
            
            $query="
                    INSERT INTO comment(commentText,commentDate,commentTime,userID,postID)
                    VALUES(:comment,:dateMade,:timeMade,:userID,:postID);
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':timeMade',$this->comment->get_time());
            $statement->bindValue(':dateMade',$this->comment->get_date());
            $statement->bindValue(':comment',$this->comment->get_comment());
            $statement->bindValue(':userID',$this->comment->get_userID());
            $statement->bindValue(':postID',$this->comment->get_postID());
            $statement->execute();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
}


?>