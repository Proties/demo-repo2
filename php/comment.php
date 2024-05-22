<?php 
include_once('php/database.php');
class Comment{
    use validateComment;
    private $date;
    private $time;
    private $text;
    private $userID;
    private $postID;
    private $id;

    public function __construct(){}
    public function set_id($id){
        $this->id=$id;
    }
    public function set_date($dt){
        $this->date=$dt;
    }
    public function set_time($tm){
        $this->time=$tm;
    }
    public function set_postID($id){
        $this->postID=$id;
    }
    public function set_userID($id){
        $this->userID=$id;
    }
    public function set_text($txt){
        $this->text=$txt;
    }

    public function get_id(){
        return $this->id;
    }
    public function get_date(){
        return $this->date;
    }
    public function get_time(){
        return $this->time;
    }
    public function get_postID(){
        return $this->postID;
    }
    public function get_userID(){
        return $this->userID;
    }
    public function get_text(){
        return $this->text;
    }

    public function initialise($arr){
        $this->set_time();
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
            $statement->bindValue(':text',$this->get_text());
            $statement->bindValue(':userID',$this->get_userID());
            $statement->execute();
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
                WHERE postID=:id
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(":id",$this->get_id());
            $statement->execute();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
}
trait validateComment{
    function validate_text(){}
}
?>