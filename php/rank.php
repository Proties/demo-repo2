<?php
class Ranking extends Database{

public function chrono(Array $arr){
    if(count($arr)==0){

    }
    try{

        $db=$this->get_connection();
        $query="
        SELECT * FROM USER_POST;
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