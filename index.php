<?php
$action=$_SERVER['REQUEST_URI'];
switch($action){
    case '/':
        include_once('php/homePage.php');
        break;
    case '/profile':
        include_once('php/profile.php');
        break;
    case '/category':
        include_once('php/categories.php');
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