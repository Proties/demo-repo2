<?php
//returns the most recent post
function chrono(){
    try{
        $query="
                SELECT * FROM Post
                LIMIT 5;
        ";
        $db->prepare($query);
        $arr=$db->execute();
        $arr->fetchall();
        return $arr;
    }catch(PDOExecption $err){
        echo $err;
    }
}

?>