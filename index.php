<?php
require_once 'vendor/autoload.php';
session_start();
$txt=$_SERVER['REQUEST_URI'];

$user=new Users();
$post=new Post();


if($post->validate_postLink($txt)==true){
    if(Post::validate_postLink($_SERVER['REQUEST_URI'])==true){
        include_once('php/homePage.php');
        exit();
    }
    }
elseif($user->validate_username($txt)==true){
    if(Users::validate_username_in_database($txt)==true){
        include_once('php/profile.php');
        exit();
    }
    
}else{

}


$action=$_SERVER['REQUEST_URI'];
switch($action){
    case '/test':
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
?>