<?php
include_once('php/database.php');
class Post{
    use validatePost;
    private $description;
    private $title;
    private $status;
    private $errMsg;
    private $postID;
    private $postLinkID;
    private $postLink;
    private $img;
    private $authorID;
    private $alt;
    private $likesCount;
    private $date;
    private $time;
    private $commentsCount;
    private $viewsCount;
    private $categoryName;
    private $comments=array();


public function __construct(){
    $this->errMsg;
    $this->description='';
    $this->title='';
    $this->status='';
    $this->postID='';
    $this->postLinkID='';
    $this->postLink='';
    $this->img='';
    $this->authorID='';
    $this->alt='';

   
}
function initialise($arr){
    $this->authorID=$arr['userID'];
    $this->title=$arr['postTitle'];
    $this->description=$arr['postDescription'];
    $this->postID=$arr['postID'];
    $this->set_img($arr['picture']);
    $this->postLink=$arr['postLink'];
    $this->postLinkID=$arr['postLinkID'];
}
public function set_categoryName($nm){
    $this->categoryName=$nm;
}
public function set_errMsg($err){
    $this->errMsg=$err;
}
public function set_postID($id){
    $this->postID=$id;
}
public function set_title($cap){
    $this->title=$cap;
}
public function set_description($cap){
    $this->description=$cap;
}
public function set_image($im){
    $this->image=$im;
}
public function set_status($stt){
    $this->status=$stt;
}
public function set_authorID($an){
    $this->authorID=$an;
}
public function set_authorImage($im){
    $this->authorImage=$im;
}
public function set_alt($al){
    $ths->alt=$alt;
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
public function set_img($im){
    return $this->img=$im;
}
public function get_categoryName(){
    return $this->categoryName;
}
public function get_postID(){
    return $this->postID;
}
public function get_title(){
    return $this->title;
}
public function get_description(){
    return $this->description;
}
public function get_image(){
    return $this->image;
}
public function get_status(){
    return $this->status;
}
public function get_authorID(){
    return $this->authorID;
}
public function get_authorImage(){
    return $this->authorImage;
}
public function get_alt(){
    return $this->alt;
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
public function get_postLinkID(){
    return $this->postLinkID;
}
public function get_img(){
    return $this->img;
}
public function get_errMsg(){
    return $this->errMsg;
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
        $stmt->bindValue(':id',$this->get_id());
        $this->set_status($stmt->execute());
        $results=$stmt->fetch();
    }catch(PDOExecption $err){
        echo 'Database error '.$err->getMessage();
    }
}
public function read_comments(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT * FROM comment
                WHERE commentID=:id;
        ";
        $stmt=$db->prepare($query);
        $stmt->bindValue(':id',$this->get_id());
        $this->set_status($stmt->execute());
    }catch(PDOExecption $err){
        echo 'Database error '.$err->getMessage();
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
public function write_post(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $db->beginTransaction();
        $query="
                INSERT INTO post(postLinkID,postDescription,postTitle,picture,userID,postDate,postTime,postLink)
                VALUES(:postLinkID,:description,:title,:image,:userID,:date,:time,:postLink);
                ";
        $stmt=$db->prepare($query);
        $stmt->bindValue(':title',$this->get_title());
        $stmt->bindValue(':description',$this->get_description());
        $stmt->bindValue(':image',$this->get_image());
        $stmt->bindValue(':userID',$this->get_authorID());
        $stmt->bindValue(':date',$this->get_date());
        $stmt->bindValue(':time',$this->get_time());
        $stmt->bindValue(':postLink',$this->get_postLink());
        $stmt->bindValue(':postLinkID',$this->get_postLinkID());
        $stmt->execute();
        $postID=$db->lastInsertId();
        $query_two="
                INSERT INTO category(categoryName)
                VALUES(:categoryName);
                ";
        $stmt_two=$db->prepare($query_two);
        $stmt_two->bindValue(':categoryName',$this->get_categoryName());
        $stmt_two->execute();
        $categoryID=$db->lastInsertId();
        $query_three="
                INSERT INTO post_category
                 VALUES(:categoryID,:postID);
                    ";
        $stmt_three=$db->prepare($query_three);
        $stmt_three->bindValue(':postID',$postID);
        $stmt_three->bindValue(':categoryID',$categoryID);
        $stmt_three->execute();
        $db->commit();
    }catch(PDOExecption $err){
        $db->rollBack();
        echo $err->getMessage();
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
    public function create_user_image_file(){}
}


trait validatePost{
function validate_image(){}
function validate_title(){}
function validate_description(){}

}
?>