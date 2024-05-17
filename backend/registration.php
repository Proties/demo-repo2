<?php

// validate password
//validate email
//validate username
function addUser(){
    try{
        $query="
                INSERT INTO Users()
                VALUES ()
                ";
        $db->prepare($query);
        $d=$db->execute();
        return $d;
    }catch(PDOExecption $err){
       echo $err;
    }
}
?>