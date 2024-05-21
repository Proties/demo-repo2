<?php
include_once('database.php');
$database=new Database();
$db=$database->get_connection();

function chrono(){
    try{
        $query="
                SELECT * FROM Post
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