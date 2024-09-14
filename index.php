<?php

try{

    require_once 'php/userCache.php';
    require_once 'php/postsList.php';
    require_once 'php/error.php';
    require_once 'php/user.php';
    require_once 'php/userDB.php';
    require_once 'php/post.php';
    require_once 'php/postDB.php';
    require_once 'php/database.php';
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
    default:
        include_once('php/homePage.php');
        break;
}
return;
// $list=apache_request_headers();
// var_dump($list);

$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);
$txt=substr($f_txt,2);

$user=new Users();
$post=new Post();
$userDB=new UserDB($user);
$postDB=new PostDB($post);
if($post->validate_postLink($f_txt)==true){
    if( $postDB->validate_in_db_postLink($txt)==true){
    var_dump('happy birthday');
    return;
    $data=[];
    $cs;
    if(isset($_POST['action'])){
       $cs=$_POST['action']; 
    switch($cs){
        case 'initialise_preview':
            echo 'preview window works';
            return;
        break;
        case 'get_more_comments':
            $c=new Comment();
            $cDB=new CommentDB($c);
            $c->set_id($_POST['commentID']);
            $c->read_more();
            echo json_encode($data);
            break;
        default:
            echo 'things just works';
        break;
    }
    }   
    try{
        $post=new Post();
        $postDB=new PostDB($post);
        $link=substr($f_txt,strrpos($f_txt,"/")+1);
        

        $postID=$postDB->get_postID_from_link($link);
       
        $comment=new Comment();
        $comment->set_postID($postID['postID']);
        $commentDB=new CommentDB($comment);
        $commentDB->read_comments();
        $arrayComment=$commentDB->comment->get_comments();
        if(!is_array($arrayComment)){
            echo 'empty';
            return;
        }
        $len=count($arrayComment);
        for($c=0;$c<$len;$c++){
            $user->set_username($arrayComment[$c]['username']);
            $comment->set_id($arrayComment[$c]['commentID']);
            $comment->set_comment($arrayComment[$c]['commentText']);
            $data['comments'][$c]=array('username'=>$arrayComment[$c]['username'],'comment'=>$comment->get_comment());
        }
        $data['status']='success';
        echo json_encode($data);
    }catch(Exception $err){
        $data['status']='failed';
        $data['message']=$err->getMessage();
        echo json_encode($data);
    }
   return;
}
}   
else if($user->validate_username_url($f_txt)==true){
    if($userDB->validate_username_in_database($txt)!==false){
        include_once('php/profile.php');
        return;
    }
    
}else{

}


?>