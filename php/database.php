<?php
try{
    $password='w1]WEw?J@|N';
    $user='u203973307_dbaAdmin';
    $dsn='mysql:host=191.96.56.52;dbnameu203973307_wholedata;';
    $db=new PDO($dsn,$user,$password);
    return $db;
}catch(PDOException $err){
    echo $err->getMessage();
}

function get_usernames(){
    try{
        $query="
                SELECT username FROM user
        ";
        $db->prepare($query);
        $results=$db->execute();
        return $results->fetchall();
    }catch(PDOExeception $err){
        echo $err->getMessage();
    }
}
function get_categories(){
    
}
function validate_user($name){
    try{
        $query="
                SELECT * FROM user
                WHERE username=:username;
        ";
        $db->prepare($query);
        $db->bindValue(':username',$name);
        $result=$db->execute();
        return $result;
    }catch(PDOExecption $err){
        echo $err->getMessage();
        return false;
    }
}
function validate_post($id){
    try{
        $query="
                SELECT * FROM post
                WHERE postId=:id;
        ";
        $db->prepare($query);
        $db->bindValue(':id',$id);
        $result=$db->execute();
        return $result;
    }catch(PDOExecption $err){
        echo $err->getMessage();
        return false;
    }

}
?>