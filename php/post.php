<?php declare(strict_types=1);
namespace Posts;
class Post{
    use validatePost;
    private string $caption;
    private string $status;
    private string $postStatus;
    private bool $previewStatus;
    private string $errorMessage;
    private int $postID;
    private string $postLinkID;
    private string $postLink;
    private int $authorID;
    private int $viewerID;
    private Location $location;
    private CollaboratorList $CollaboratorList;
    private string $date;
    private string $time;
    private CommentList $CommentList;
    private string $postFile;
    private Image $image;


public function __construct(){
    $this->errorMessage='';
    $this->caption='';
    $this->status='';
    $this->postID=0;
    $this->postLinkID='';
    $this->postLink='';
    $this->authorID=0;
    $this->viewerID=0;
    $this->previewStatus=false;

   
}

function initialise(array $arr){
    $this->set_authorID($arr['userID']);
    $this->set_caption($arr['postTitle']);
    $this->set_previewStatus($arr['postDescription']);
    $this->set_postID($arr['postID']);
    $this->set_postLink($arr['postLink']);
    $this->set_postLinkID($arr['postLinkID']);
}
public function set_category_id(int $id){
    $this->categoryID=$id;
}
public function set_categoryName(string $nm){
    $this->categoryName=$nm;
}
public function set_errorMessage(string $err){
    $this->errorMessage=$err;
}
public function set_postID(int $id){
    $this->postID=$id;
}
public function set_caption(string $cap){
    $this->caption=$cap;
}
public function set_status(string $stt){
    $this->status=$stt;
}
public function set_authorID(int $an){
    $this->authorID=$an;
}
public function set_viewerID(int $an){
    $this->viewerID=$an;
}
public function set_preview_status(bool $al){
    $this->previewStatus=$alt;
}
public function set_time(string $l){
    $this->time=$l;
}
public function set_date(string $dt){
    $this->date=$dt;
}
public function set_postLink(string $dt){
    $this->postLink=$dt;
}
public function set_posts($p){
    $this->posts=$p;
}
public function set_postLinkID(string $l){
    $this->postLinkID=$l;

}
public function get_postLinkID():string
{
    return $this->postLinkID;

}
public function get_categoryName():string
{
    return $this->categoryName;
}
public function get_postID():int
{
    return $this->postID;
}
public function get_caption():string
{
    return $this->caption;
}
public function get_preview_status():bool
{
    return $this->previewStatus;
}
public function get_status():string
{
    return $this->status;
}
public function get_authorID():int
{
    return $this->authorID;
}
public function get_viewerID():int
{
    return $this->viewerID;
}
public function get_time():string 
{
    $this->set_time(date('h:i'));
    return $this->time;
}
public function get_date():string 
{
    $this->set_date(date('Y:m:d'));
    return $this->date;
}
public function get_postLink():string 
{
    return $this->postLink;
}

public function get_errorMessage():string 
{
    return $this->errorMessage;
}
public function get_posts(){
    return $this->posts;
}
public function get_image(){
    $this->image=new Image();
    return $this->image;
}
public function get_category_id():int
{
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