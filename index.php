<?php
session_start();
$txt=$_SERVER['REQUEST_URI'];

$userPattern="/\/@[a-zA-Z]{1,13}/i";
$postPattern="/(\/@[a-zA-Z]{1,13})(\/[a-zA-Z0-9]{1,})/i";
include_once('php/user.php');
include_once('php/post.php');
include_once('php/database.php');
if(preg_match($postPattern,$txt)){
    if(validate_user()==false){
        
    }
    if(validate_post()==false){
        return;
    }
    include_once('php/fullPagePost.php');
    return;
}
else if(preg_match($userPattern,$txt)){
        $f_txt=substr($txt,2);
        if(validate_username($f_txt)==true){
            include_once('php/profile.php');
            exit();
        }
        header('Location: /');;
        exit();
}else{

}

$action=$_SERVER['REQUEST_URI'];
switch($action){
    // case'/test':
    //     include_once('php/addimage.php');
    //     break;
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
    case '/settings':
        include_once('p');
        break;
    case '/editProfile':
        include_once('php/editPage.php');
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