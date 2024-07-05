<?php
namespace Insta\Ranking;
use Insta\Databases\Database;
class Ranking extends Database{



public function chrono(Array $arr){
    try{

        $db=$this->get_connection();
        $query="
        SELECT DISTINCT u1.username,p1.postLink,p1.postID,p1.postLinkID,p1.postLinkID as post2LinkID,p2.postLink AS post2Link,p2.postID AS post2ID FROM Users AS u1
        INNER JOIN post AS p1 ON u1.userID=p1.userID
        INNER JOIN post AS p2 ON p1.userID=u1.userID
        WHERE p1.postID<>p2.postID
        AND p1.previewStatus=1 AND p2.previewStatus=1
        GROUP BY (u1.username);
        ";
       
        $stmt=$db->prepare($query);
        $stmt->execute();
        return $stmt->fetchall();
    }catch(PDOExecption $err){
        echo $err->getMessage();
    }catch(Execption $errM){
        echo $errM->getMessage();
    }
}


public function Basic(Array $arr){
    try{
        $db=$this->get_connection();
        $query='
            SELECT username,imageFilePath,imageFileName,imageFilePath as image2FilePath,imageFileName as image2FileName FROM Users
            INNER JOIN Post ON postID
            INNER JOIN Image ON imageID
            INNER JOIN PostImage ON imageID
            WHERE p1.previewStatus=true AND p2.previewStatus=true ;
        ';
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