<?php
session_start();
$txt=$_SERVER['REQUEST_URI'];

$userPattern="/\/@[a-zA-Z]{1,13}/i";
$postPattern="/(\/@[a-zA-Z]{1,13})(\/[a-zA-Z0-9]{1,})/i";
include_once('php/user.php');
include_once('php/post.php');
if(preg_match($postPattern,$txt)){
    if(validate_user()==false){
        header('Location: /');
        exit();
    }
    if(validate_post()==false){
        return;
    }
    include_once('php/fullPagePost.php');
    return;
}
else if(preg_match($userPattern,$txt)){
    if(validate_user(preg_filter($userPattern,'$(0)',$txt))==false){
        header('Location: /');
        exit();
    }
    include_once('php/profile.php');
    return;
}else{

}

$action=$_SERVER['REQUEST_URI'];
switch($action){
    case'/test':
        include_once('php/addimage.php');
        break;
    case '/':
        include_once('php/homePage.php');
        break;
    case '/registration':
        include_once('php/registration.php');
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