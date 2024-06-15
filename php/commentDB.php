<?php 
class CommentDB extends PDO{
    private $comment;
    public function __construct($comment){
        $this->comment=$comment;
    }
    public function read_comments(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                SELECT * FROM Comment
                WHERE postID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':id',$this->get_postID());
            $this->set_status($statement->execute());
            $this->set_comments($statement->fetchall());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_comment(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                SELECT * FROM Comment
                WHERE commentID=:id;
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(":id",$this->get_id());
            $this->set_status($statement->execute());
            $this->set_comment($statement->fetch());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function write_comment(){
        try{
            $database=new Database();
            $db=$database->get_connection();
            $query="
                    INSERT INTO Comment
                    VALUES(:text,:date,:time,:userID,:postID);
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(':time',$this->get_time());
            $statement->bindValue(':date',$this->get_date());
            $statement->bindValue(':text',$this->get_comment());
            $statement->bindValue(':userID',$this->get_userID());
            $this->set_status($statement->execute());
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
}


?>