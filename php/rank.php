<?php
include_once('database.php');
class Ranking{

public static function chrono(){
    try{
        $database=new Database();
        $db=$database->get_connection();
        $query="
         
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