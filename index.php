<?php
$txt=$_SERVER['REQUEST_URI'];

$userPattern="/\/@[a-zA-Z]{1,13}/i";
$postPattern="/(\/@[a-zA-Z]{1,13})(\/[0-9]{1,20})/i";
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
    }

}
echo preg_filter($userPattern,'($0)',$txt);
return;
$action=$_SERVER['REQUEST_URI'];
switch($action){
    case '/':
        include_once('php/homePage.php');
        break;
    case '/profile':
        include_once('php/profile.php');
        break;
    case '/category':
        include_once('php/categoryPage.php');
        break;
    case '/full_post':
        include_once('php/fullPagePost.php');
        break;
    default:
        include_once('php/homePage.php');
        break;
}

// user page 
// - addr/username
// post page 
// - addr/username/postid 
// category page 
// - addr/category#categoryname 
?>