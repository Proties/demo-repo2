<?php
class Post{
    private $caption;
    private $status;
    private $postID;
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
    $this->postID=$arr[''];
    $this->picture=$arr[''];
    $this->userID=$arr[''];
    $this->likes=$arr[''];
    $this->comments=$arr[''];
}
public function set_categoryName(){}
public function set_postID(){}
public function set_caption(){}
public function set_image(){}
public function set_status(){}
public function set_authorName(){}
public function set_authorImage(){}
public function set_alt(){}
public function set_likes(){}
public function set_comments(){}

public function get_categoryName(){}
public function get_postID(){}
public function get_caption(){}
public function get_image(){}
public function get_status(){}
public function get_authorName(){}
public function get_authorImage(){}
public function get_alt(){}
public function get_likes(){}
public function get_comments(){}
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
public function write_comment($msg){
    try{
        $query="
                INSERT INTO comment
                VALUES(:postID,:comment,:userID);
        ";
    }catch(PDOExecption $err){
        echo $err->getMessage();
    }
}
}

?>