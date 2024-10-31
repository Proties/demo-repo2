<?php
try{
    require_once 'php/database.php';

    require_once 'php/template.php';
    require_once 'php/HtmlTemplate.php';
    require_once 'php/templateDB.php';
    require_once 'php/postsList.php';

    require_once 'php/user.php';
    require_once 'php/userDB.php';
    require_once 'php/post.php';
    require_once 'php/postDB.php';

    require_once 'php/ViewPostPool.php';
    require_once 'php/MostViewPostPool.php';
    require_once 'php/ProfilePool.php';
    require_once 'php/profileRank.php';


    require_once 'php/FollowerDB.php';

    require_once 'php/Video.php';
    require_once 'php/VideoDB.php';
    require_once 'php/Plan.php';




    require_once 'php/Order.php';
    require_once 'php/OrderDB.php';

    require_once 'php/Merchant.php';



    require_once 'php/Subscription.php';
    require_once 'php/SubscriptionDB.php';

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
$url=urldecode($_SERVER['REQUEST_URI']);

$pattern='/\/@([a-zA-Z0-9%\s\t]){2,}\/([a-zA-Z]){3,}/';
// validate_post_link();
// setcookie('postPreview','',time()-(36*10),'/');

    if(preg_match($pattern,$url)){
    var_dump('works');
    include_once('php/previewPost.php');
   
    return;
}



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
    case '/login':
        include_once('php/login.php');
        break;
     case '/search_page':
        include_once('php/profile.php');
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
    case '/upload_template':
        include_once('php/uploadTemplate.php');
        break;
    case '/checkout':
        include_once('php/checkout.php');
        break;
    case '/subscribe_to_premiunm':
        include_once('php/subscribe.php');
        break;
    case '/buy_template':
        include_once('php/buyTemplate.php');
        break;
    case '/donate':
        include_once('php/donate.php');
        break;
    case '/setup_profile':
        include_once('php/setupProfile.php');
        break;
    default:
        include_once('php/homePage.php');
        break;
}
return;
?>