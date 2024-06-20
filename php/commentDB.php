<?php 
class CommentDB extends Database{
    private $comment;
    public function __construct(Comment $comment){
        Database::__construct();
        $this->comment=$comment;
    }
    public function get_comment(){
        return $this->comment;
    }
    public function read_comments(){
        try{
            $db=$this->get_connection();
            $query="
                SELECT * FROM Comment
                WHERE postID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->comment->get_postID());
            $this->set_status($statement->execute());
            $this->set_comments($statement->fetchall());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_comment(){
        try{
            $db=$this->get_connection();
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
        try{
            $db=$this->get_connection();
            $query="
                    INSERT INTO Comment
                    VALUES(:text,:date,:time,:userID,:postID);
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':time',$this->comment->get_time());
            $statement->bindValue(':date',$this->comment->get_date());
            $statement->bindValue(':text',$this->comment->get_comment());
            $statement->bindValue(':userID',$this->comment->get_userID());
            $this->set_status($statement->execute());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
}


?>