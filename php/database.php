<?php
try{
$password='w1]WEw?J@|N';
$user='u203973307_dbaAdmin';
$dsn='mysql:host=localhost;dbnameu203973307_wholedata;';
$db=new PDO($dsn,$user,$password);
return $db;
}catch(PDOExecption $err)
{
    echo $err;
}


?>