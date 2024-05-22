<?php
include_once('database.php');

function top_users(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT * FROM Users
                LIMIT 5;
        ";
        $d=$db->prepare($query);
        $d->execute();
        $arr=$d->fetchall();
        return $arr;
    }catch(PDOExecption $err){
        echo $err;
    }
}
function chrono(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
                SELECT * FROM post
                LIMIT 5;
        ";
        $d=$db->prepare($query);
        $d->execute();
        $arr=$d->fetchall();
        return $arr;
    }catch(PDOExecption $err){
        echo $err;
    }
}

?>