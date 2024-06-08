<?php
class Post{
    use validatePost;
    private $caption;
    private $status;
    private $previewStatus;
    private $errorMessage;
    private $postID;
    private $postLinkID;
    private $postLink;
    private $img;
    private $authorID;
    private $authorName;
    private $date;
    private $time;
    private $categoryName;
    private $posts;
    private $postFile;


public function __construct(){
    $this->errorMessage;
    $this->caption='';
    $this->status='';
    $this->postID='';
    $this->postLinkID=null;
    $this->postLink='';
    $this->img='';
    $this->authorName='';
    $this->authorID=null;
    $this->previewStatus=false;

   
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
public function set_authorName($im){
    $this->authorName=$im;
}
public function set_preview_status($al){
    $this->preview_status=$alt;
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
    return $this->preview_status;
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
public function get_img(){
    return $this->img;
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
        $database=new Database();
        $db=$database->get_connection();
        $query="
        SELECT * FROM USER_POST up1
        INNER JOIN post_category pc1 ON up1.postID=pc1.postID
        INNER JOIN post_category pc2 ON pc1.postID=up1.post2ID
        INNER JOIN category c1 ON pc1.categoryID=c1.categoryID
        WHERE c1.categoryName=:name;
        ";
        $stmt=$db->prepare($query);
        $stmt->bindValue(':name',$this->get_categoryName());
        $stmt->execute();
        return $stmt->fetchall();
    }catch(PDOExecption $err){
        echo 'error reading post from category id '.$err->getMessage();
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
    public function create_post_file(){
        try{

        
        $f=fopen('php/ids.json','r') or die('file doesnt exist');
        
        $ids=fread($f,filesize("php/ids.json"));
        $ids_array=json_decode($ids,true);
        if(!is_array($ids_array)){
            
            throw new Exception('data is not array');
        }
        
        $this->set_postLinkID($ids_array[0]);
        array_splice($ids_array,0,1);
        fclose($f);
        
        $f_two=fopen('php/ids.json','w') or die('file doesnt exist');
        fwrite($f_two,json_encode($ids_array));
        fclose($f_two);
        
        $this->set_file($this->get_postLinkID().'.png');
        }catch(Execption $err){
            echo $err->getMessage();
        }
    }
    public function set_file($file){
        $this->postFile=$file;
    }
    public function get_file(){
        return $this->postFile;
    }
}


trait validatePost{
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
    $pattern="/(\/@[a-zA-Z]{1,13})(\/[a-zA-Z0-9]{1,})/";
    if(preg_match($pattern,$txt)){
        return true;
    }
    $msg='';
    return false;
}


}

?>