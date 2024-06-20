<?php
class Ranking extends Database{

public function chrono(Array $arr){
    if(count($arr)==0){

    }
    try{

        $db=$this->get_connection();
        $query="
        SELECT username,p1.postLink,p2.postLink AS post2Link FROM Users u1
        INNER JOIN post p1 ON u1.userID=p1.userID
        INNER JOIN post p2 ON p1.userID=u1.userID
        WHERE p1.postID<>p2.postID
        AND p1.previewStatus=1 AND p2.previewStatus=1;
        ";
       
        $d=$db->prepare($query);
        $d->execute();
        $arr=$d->fetchall();
        return $arr;
    }catch(PDOExecption $err){
        echo $err;
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