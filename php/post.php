<?php
class Post{
    use validatePost;
    private $description;
    private $title;
    private $status;
    private $errorMessage;
    private $errorMessages=array();
    private $postID;
    private $postLinkID;
    private $postLink;
    private $img;
    private $authorID;
    private $authorName;
    private $alt;
    private $likesCount;
    private $date;
    private $time;
    private $commentsCount;
    private $viewsCount;
    private $categoryName;
    private $comments=array();
    private $posts=array();


public function __construct(){
    $this->errorMessage;
    $this->description='';
    $this->title='';
    $this->status='';
    $this->postID='';
    $this->postLinkID='';
    $this->postLink='';
    $this->img='';
    $this->authorName='';
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
public function set_errorMessage($err){
    $this->errorMessage=$err;
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
public function set_authorName($im){
    $this->authorName=$im;
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
    $this->img=$im;
}
public function set_posts($p){
    $this->posts=$p;
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
public function get_authorName(){
    return $this->authorName;
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

public function get_errorMessage(){
    return $this->errorMessage;
}
public function get_errorMessages(){
    return $this->errorMessages;
}
public function get_posts(){
    return $this->posts;
}
public function read_postID(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT postID FROM post
                WHERE postLink=:link
        ";
        $stmt=$db->prepare($query);
        $stmt->bindValue(':link',$this->get_postLink());
        $stmt->execute();
        $id=$stmt->fetch();
        $this->set_postID($id);
    }catch(PDOExecption $err){
        echo $err->getMessage();
    }
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
        $stmt->bindValue(':id',$this->get_postID());
        $this->set_status($stmt->execute());
        $results=$stmt->fetch();
    }catch(PDOExecption $err){
        echo 'Database error '.$err->getMessage();
    }
}
public function read_posts(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT * FROM post
                WHERE userID=:userID;
        ";
        $stmt=$db->prepare($query);
        $stmt->bindValue(':userID',$this->get_authorID());
        $this->set_status($stmt->execute());
        $results=$stmt->fetchall();
        $this->set_posts($results);
    }catch(PDOExecption $err){
        echo 'Database error '.$err->getMessage();
    }
}
public function read_category_posts(){
    try{
        $query="
            SELECT post.picture,postID FROM post p1
            INNER JOIN category ON p1.postID=c1.postID
            INNER JOIN post_category
        ";
        $stmt=$db->prepare($query);
        $stmt->bindValue(':categoryID',$this->get_category_id());
        $stmt->execute();
        return $stmt->fecthall();
    }catch(PDOExecption $err){
        echo 'error reading post from category id '.$err->getMessage();
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
    }catch(PDOExecption $err){
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
public static function validate_in_db_postLink($link){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT postLink FROM post
                WHERE postLink=:link;
        ";
        $stmt=$db->prepare($query);
        $stmt->bindValue(':link',$link);
        $stmt->execute();
        return $stmt->fetch();
    }catch(PDOExecption $err){
        echo $err->getMessage();
        return false;
    }

}
public static function validate_postID($id){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT * FROM post
                WHERE postId=:id;
        ";
        $db->prepare($query);
        $db->bindValue(':id',$id);
        $result=$db->execute();
        return $result;
    }catch(PDOExecption $err){
        echo $err->getMessage();
        return false;
    }

}
    public function create_user_image_file(){}
}


trait validatePost{
function validate_image($txt){
    $pattern='//i';
    if(preg_match($pattern,$txt)){
        return true;
    }
    $msg='image not valid';
    return msg;
}
function validate_title($txt){
    $pattern='//i';
    if(preg_match($pattern,$txt)){
        return true;
    }
    $msg='not  a valid title';
    return $msg;
}
function validate_postLink($txt){
    $pattern="/(\/@[a-zA-Z]{1,13})(\/[a-zA-Z0-9]{1,})/i";
    if(preg_match($pattern,$txt)){
        return true;
    }
    $msg='';
    return false;
}
function validate_description($txt){
    $pattern='//i';
    if(preg_match($pattern,$txt)){
        return true;
    }
    $msg='not a valid description';
    return $msg;
}

}

?>