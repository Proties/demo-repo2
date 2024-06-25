<?php
class Post{
    use validatePost;
    private $caption;
    private $status;
    private $postStatus;
    private $previewStatus;
    private $errorMessage;
    private $postID;
    private $postLinkID;
    private $postLink;
    private $authorID;
    public $location;
    public $collaborator;
    private $date;
    private $time;
    private $posts;
    private $postFile;
    public $image;


public function __construct(){
    $this->image=new Image();
    $this->location=new Location();
    $this->collab=new Collaborator();
    $this->errorMessage;
    $this->caption='';
    $this->status='';
    $this->postID='';
    $this->postLinkID=null;
    $this->postLink='';
    $this->authorID=null;
    $this->previewStatus=false;

   
}

function initialise($arr){
    $this->set_authorID($arr['userID']);
    $this->set_caption($arr['postTitle']);
    $this->set_previewStatus($arr['postDescription']);
    $this->set_postID($arr['postID']);
    $this->set_postLink($arr['postLink']);
    $this->set_postLinkID($arr['postLinkID']);
}
public function set_category_id($id){
    $this->categoryID=$id;
}
public function set_categoryName($nm){
    $this->categoryName=$nm;
}
public function set_errorMessage($err){
    $this->errorMessage=$err;
}
public function set_postID($id){
    $this->postID=$id;
}
public function set_caption($cap){
    $this->caption=$cap;
}
public function set_status($stt){
    $this->status=$stt;
}
public function set_authorID($an){
    $this->authorID=$an;
}
public function set_preview_status($al){
    $this->previewStatus=$alt;
}
public function set_time($l){
    $this->time=$l;
}
public function set_date($dt){
    $this->date=$dt;
}
public function set_postLink($dt){
    $this->postLink=$dt;
}
public function set_posts($p){
    $this->posts=$p;
}
public function set_postLinkID($l){
    $this->postLinkID=$l;

}
public function get_postLinkID(){
    return $this->postLinkID;

}
public function get_categoryName(){
    return $this->categoryName;
}
public function get_postID(){
    return $this->postID;
}
public function get_caption(){
    return $this->caption;
}
public function get_preview_status(){
    return $this->previewStatus;
}
public function get_status(){
    return $this->status;
}
public function get_authorID(){
    return $this->authorID;
}
public function get_time(){
    $this->set_time(date('h:i'));
    return $this->time;
}
public function get_date(){
    $this->set_date(date('Y:m:d'));
    return $this->date;
}
public function get_postLink(){
    return $this->postLink;
}

public function get_errorMessage(){
    return $this->errorMessage;
}
public function get_posts(){
    return $this->posts;
}
public function get_category_id(){
    return $this->categoryID;
}
  
}


trait validatePost{
function validate_postID(){}
function validate_preview_status($txt){
    $pattern='//i';
    if(preg_match($pattern,$txt)){
        return true;
    }
    $msg='image not valid';
    return msg;
}
function validate_caption($txt){
    $pattern='//i';
    if(preg_match($pattern,$txt)){
        return true;
    }
    $msg='not  a valid title';
    return $msg;
}
function validate_postLink($txt){
   $pattern='/^\/\@([a-zA-Z\s\-\_]+)(\/[a-zA-Z0-9]+)$/i';
    if(preg_match($pattern,$txt)){
        return true;
    }
    return false;
}
function validate_postLinkID($txt){
    $pattern='/(?=.*[a-zA-Z])(?=.*[0-9])?/';
    if(preg_match($pattern,$txt)){
        return true;
    }
    return false;
}

}

?>