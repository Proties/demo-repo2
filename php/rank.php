<?php
include_once('database.php');
class Ranking{

public static function chrono(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT Users.username,post.postTitle,post.postLink,post.picture FROM Users
                INNER JOIN post on Users.userID=post.userID
                LIMIT 2;

                
        ";
        $query_two="
                
        ";
        $d=$db->prepare($query);
        $d->execute();
        $arr=$d->fetchall();
        return $arr;
    }catch(PDOExecption $err){
        echo $err;
    }
}
}
?>