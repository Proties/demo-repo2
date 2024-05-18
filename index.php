<?php
$action=$_GET;
switch($action){
    case 'home':
        include_once('backend/homePage.php');
        break;
    case 'profile':
        include_once('backend/profile.php');
        break;
    case 'category':
        include_once('backend/categories.php');
        break;
    case 'full_post':
        include_once('backend/fullPagePost.php');
        break;
    default:
        include_once('backend/homePage.php');
        break;
}
?>