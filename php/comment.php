<?php 

class Comment{
    private $date;
    private $time;
    private $text;
    private $userID;
    private $postID;
    private $id;

    public function __construct(){}
    public function set_id($id){}
    public function set_date($dt){}
    public function set_time($tm){}
    public function set_postID($id){}
    public function set_userID($id){}
    public function set_text($txt){}

    public function get_id(){}
    public function get_date(){}
    public function get_time(){}
    public function get_postID(){}
    public function get_userID(){}
    public function get_text(){}

    public function write_comment(){
        try{
            $query="
                    INSERT INTO Comment
                    VALUES(:text,:date,:time,:userID,:postID);
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(":text",$this->text);
            $statement->execute();
        }catch(PDOExecption $err){
            echo 'Database error '.$err->getMessage();
        }
    }
    public function read_comment(){
        try{
            $query="
                SELECT * FROM Comment
                WHERE postID=:id
            ";
            $statement=$db->prepare($query);
            $statement->bindValue(":id",$this->get_id());
            $statement->execute();
        }catch(PDOExecption $err){
            echo 'db error '.$err->getMessage();
        }
    }
}

?>