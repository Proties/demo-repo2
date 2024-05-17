<?php
$action=$_GET;
switch($action){
    case 'home':
        include_once('backend/homePage.php');
        break;
    case 'profile':
        include_once('backend/profile.php');
        break;
    case 'post':
        include_once('backend/addImage.php');
        break;
    case 'search':
        include_once('backend/search.php');
        break;
    case 'category':
        include_once('backend/category.php');
        break;
    default:
        include_once('backend/addImage.php');
        break;
}
?>