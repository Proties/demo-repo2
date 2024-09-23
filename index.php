<?php
try{
    require_once 'php/database.php';
    require_once 'php/userCache.php';
    require_once 'php/template.php';
    require_once 'php/templateDB.php';
    require_once 'php/postsList.php';
    require_once 'php/error.php';
    require_once 'php/user.php';
    require_once 'php/userDB.php';
    require_once 'php/post.php';
    require_once 'php/postDB.php';

    require_once 'php/userFile.php';
    require_once 'php/userAuth.php';
    require_once 'php/image.php';
    require_once 'php/userAuth.php';
    require_once 'php/collaboratorList.php';
    require_once 'php/location.php';
    require_once 'php/imageFile.php';
    require_once 'php/imageDB.php';
    require_once 'php/collaborator.php';
    require_once 'php/collaboratorDB.php';
    require_once 'php/rank.php';
    require_once 'php/locationDB.php';
 
}catch(Exception $err){
    echo 'error while loading files';
    echo $err->getMessage();
    return;
}

use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Databases\Database;
use Insta\Posts\Post;
use Insta\Databases\Post\PostDB;


$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);
$txt=substr($f_txt,2);

$user=new Users();
$post=new Post();
$userDB=new UserDB($user);
$postDB=new PostDB($post);
if(($user->validate_username_url($f_txt)==true) && ($userDB->validate_username_in_database($txt)!==false)){
    include_once('php/profile.php');
    return;
}
   
$action=$_SERVER['REQUEST_URI'];
switch($action){
    case '/':
        include_once('php/homePage.php');
        break;
    case '/registration':
        include_once('php/registration.php');
        break;
    case '/profile':
        include_once('php/profile.php');
        break;
    case '/edit_profile':
        include_once('php/editPage.php');
        break;
    case '/upload_post':
        include_once('php/uploadPost.php');
        break;
     // case '/upload_template':
     //    include_once('php/uploadTemplate.php');
     //    break;
    default:
        include_once('php/homePage.php');
        break;
}
return;
?>