<?php
include_once('php/database.php');

class Post{
    use validatePost;
    private $description;
    private $title;
    private $status;
    private $postID;
    private $postLinkID;
    private $postLink;
    private $img;
    private $authorID;
    private $alt;
    private $likesCount;
    private $commentsCount;
    private $viewsCount;
    private $comments=array();


public function __construct(){
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
    $this->authorName=$arr[''];
    $this->title=$arr[''];
    $this->description=$arr[''];
    $this->postID=$arr[''];
    $this->img=$arr[''];
    $this->userID=$arr[''];
    $this->likesCount=$arr[''];
    $this->comments=$arr[''];
}
public function set_categoryName($nm){
    $this->categoryName=$nm;
}
public function set_postID($id){
    $this->postID=$id;
}
public function set_caption($cap){
    $this->caption=$cap;
}
public function set_image($im){
    $this->image=$im;
}
public function set_status($stt){
    $this->status=$stt;
}
public function set_authorName($an){
    $this->authorName=$an;
}
public function set_authorImage($im){
    $this->authorImage=$im;
}
public function set_alt($al){
    $ths->alt=$alt;
}
public function set_likes($l){
    $this->likes=$l;
}
public function set_comments(){}

public function get_categoryName(){
    return $this->categoryName;
}
public function get_postID(){
    return $this->postiID;
}
public function get_caption(){
    return $this->caption;
}
public function get_image(){
    return $this->image;
}
public function get_status(){
    return $this->status;
}
public function get_authorName(){
    return $this->authorName;
}
public function get_authorImage(){
    return $this->authorImage;
}
public function get_alt(){
    return $this->alt;
}
public function get_likes(){
    return $this->likes;
}
public function get_comments(){
    return $this->comments;
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
        $stmt->execute();
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
        $stmt->execute();
    }catch(PDOExecption $err){
        echo 'Database error '.$err->getMessage();
    }
}
public function write_post(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                INSERT INTO post
                VALUES();
                ";
        $db->prepare($query);
        $db->bindValue(':title',$this->get_title);
        $db->bindValue(':description',$this->get_description);
        $db->bindValue(':image',$this->get_image);
        $db->bindValue(':userID',$this->get_authorID());
        $db->bindValue(':pdate',$this->get_date());
        $db->bindValue(':ptime',$this->get_time());
        $db->bindValue(':plink',$this->get_postLink());
        $db->execute();
        $query_two="
                INSERT INTO Category
                VALUES(:categoryName,:date,:time);
                
                ";
        $stmt=$db->prepare($query_two);
        $stmt->bindValue(':categoryName',$this->get_categoryName());
        $stmt->bindValue(':date',$this->get_date());
        $stmt->bindValue(':time',$this->get_time());
        $db->execute();
        $query_three="
                INSERT INTO post_category
                 VALUES();
                    ";
        $db->prepare($query_three);
        $db->execute();



    }catch(PDOExecption $err){
        echo $err->getMessage();
    }
}
public function write_like(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                INSERT INTO likes
                VALUES(:postID,userID);
        ";
    }catch(PDOExecption $err){
        echo $err->getMessage();
    }
}

}

function generate_ids(){
    $list = '1234567890abcdefghijklmnopqrstuvwzyABCDEFGHIJKLMNOPQRSTUVWZY';
    $random = str_shuffle($list);
    $str = substr($random, 5, 13);
}
trait validatePost{

}
?>