<?php
include_once('database.php');
class Ranking{

public static function chrono(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
        SELECT username, postTitle, picture, postLink
        FROM Users
        INNER JOIN post ON Users.userID = post.userID
        WHERE CASE
            WHEN (SELECT COUNT(*) FROM post AS p2 WHERE p2.userID = Users.userID) <= 1 THEN 1
            ELSE 0
        END = 1
        LIMIT 10;
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
// query that will two post per user
?>