<?php
class Post{
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

public function read_post(){}
public function read_comments(){}
public function read_likes(){}
public function write_post(){
    try{
        $query="
                INSERT INTO post
                VALUES();
                ";
        $db->prepare($query);
        $db->bindValue(':caption',$caption);
        $db->bindValue(':picture',$pict);
        $db->bindValue(':userID',$id);
        $db->bindValue(':pdate',$pd);
        $db->bindValue(':ptime',$pt);
        $db->bindValue(':plink',$pl);
        $db->execute();
        $query_two="
                INSERT INTO Category
                VALUES();
                
                ";
        $db->prepare($query_two);
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
        $query="
                INSERT INTO likes
                VALUES(:postID,userID);
        ";
    }catch(PDOExecption $err){
        echo $err->getMessage();
    }
}

}

?>