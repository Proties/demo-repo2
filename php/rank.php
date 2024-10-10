<?php
namespace Insta\Ranking;
use Insta\Databases\Database;
class Ranking extends Database{
    private $db;
    public function __construct(){
        $this->db=Database::get_connection();
    }


public function chrono(Array $arr,int $userID=0){
    $p='';
    $db=$this->db;
    try{
        
        // $len=count($arr);
        // for($i=0;$i<$len;$i++){
        //     $p.='AND userID='.$arr[$i];
        // }
        
        // $query="
        // SELECT DISTINCT u1.username,p1.postLink,p1.postID,p1.postLinkID,p1.postLinkID as post2LinkID,p2.postLink AS post2Link,p2.postID AS post2ID FROM Users AS u1
        // INNER JOIN Posts AS p1 ON u1.userID=p1.userID
        // INNER JOIN Posts AS p2 ON p1.userID=u1.userID
        // WHERE p1.postID<>p2.postID 
        
        // AND p1.previewStatus=1 AND p2.previewStatus=1 GROUP BY (u1.username);
        // ";
       
       $query='
                SELECT u.userID,u.username,i.fileName,i.filePath,v.fileName,v.filePath FROM Users u
                INNER JOIN followers f ON u.userID=f.followerID
                INNER JOIN Posts p ON f.userID=p.userID
                INNER JOIN PostImages ip ON p.postID=ip.postID
                INNER JOIN Images i ON ip.imageID=i.imageID
                INNER JOIN VideoPost vp ON p.postID=vp.postID
                INNER JOIN Videos v ON vp.videoID=v.id
                WHERE u.userID=:userID;
       ';
        $stmt=$db->prepare($query);
        $stmt->bindValue(':userID',$userID);
        $stmt->execute();
        return $stmt->fetchall();
    }catch(PDOExecption $err){
        echo $err->getMessage();
    }catch(Execption $errM){
        echo $errM->getMessage();
    }
}
//this function will return a list of post that are similar to the person who shared a post to a current visiting user


public function Basic(Array $arr){
    $p='';
    try{
        $db=$this->get_connection();
        $len=count($arr);
        for($i=0;$i<$len;$i++){
            $p.='AND userID='.$arr[$i];
        }
        $query="
            SELECT username,imageFilePath,imageFileName,imageFilePath as image2FilePath,imageFileName as image2FileName FROM Users
            INNER JOIN Post ON postID
            INNER JOIN Image ON imageID
            INNER JOIN PostImage ON imageID
            WHERE p1.previewStatus=true AND p2.previewStatus=true 
            $p;
        ";
        $stmt=$db->prepare($query);
        $stmt->execute();
        return $stmt->fetchall();
    }catch(PDOExecption $err){
        echo 'error while ranking '.$err->getMessage();
    }


}
}
// query that will two post per user
?>