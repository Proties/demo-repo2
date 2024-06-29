<?php  declare(strict_types=1);
namespace Insta\Posts;
class Comment{
    use validateComment;
    private string $date;
    private string $time;
    private string $comment;
    private bool $status;
    private int $id;

    public function __construct(){
        $this->id=null;
        $this->status='';
        $this->date=date('Y:m:d');
        $this->time=date('h:i');
    }
    public function set_status(bool $id){
        $this->status=$id;
    }
    public function set_id(int $id){
        $this->id=$id;
    }
    public function set_date(string $dt){
        $this->date=$dt;
    }
    public function set_time(string $tm){
        $this->time=$tm;
    }
    public function set_postID(int $id){
        $this->postID=$id;
    }
    public function set_userID(int $id){
        $this->userID=$id;
    }
    public function set_comment(string $txt){
        $this->comment=$txt;
    }
    public function set_comments(array $txt){
        $this->comments=$txt;
    }

    public function get_id():int
    {
        return $this->id;
    }
    public function get_date():string
    {
        return $this->date;
    }
    public function get_time():string
    {
        return $this->time;
    }
    public function get_postID():int
    {
        return $this->postID;
    }
    public function get_userID():int
    {
        return $this->userID;
    }
    public function get_comment():string
    {
        return $this->comment;
    }
    public function get_status():bool
    {
        return $this->status;
    }

    
    public function initialise(array $arr){
        $this->set_time();
    }

    
    
  
}
trait validateComment{
    function  static validate_comment($txt){
        $pattern='/[a-z]{4,}/i';
        if(preg_match($txt,$pattern)){
            return true;
        }
        return false;
    }
}
?>