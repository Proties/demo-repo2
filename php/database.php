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


?>