<?php 
include_once('php/database.php');
class Comment{
    use validateComment;
    private $date;
    private $time;
    private $comment;
    private $comments;
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
    public function set_comment($txt){
        $this->comment=$txt;
    }
    public function set_comments($txt){
        $this->comments=$txt;
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
    public function get_comment(){
        return $this->comment;
    }
    public function get_comments(){
        return $this->comments;
    }

    public function initialise($arr){
        $this->set_time();
    }

    
    
  
}
trait validateComment{
    function validate_comment($txt){
        $pattern='//i';
        if(preg_match($txt,$pattern)){
            return true;
        }
        return false;
    }
}
?>