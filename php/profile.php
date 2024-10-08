<?php
session_start();
use Monolog\Handler\StreamHandler;
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Databases\Post\PostDB;
use Insta\Template\Template;
use Insta\Template\HtmlTemplate;
use Insta\Database\Template\TemplateDB;

use Insta\Follower\Follower;
use Insta\Database\Follower\FollowerDB;

$mainUser=new Users();
$template=new Template();
if(isset($_SESSION['username']) && $_SESSION['username']!==null){
    $mainUser->userAuth->set_authanticate(true);
}
$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);

$u=new Users();
$udb=new UserDB($u);
if($f_txt==='/profile'){
    $data;
   setcookie('profile','no account', time() - (86400 * 30), '/'); 
}
else if($u->validate_username_url($f_txt)==true ){
    try{
        $txt=substr($f_txt,2);
        $link=$txt;
        $data=[];
        $userPosts=array();
        $author=new Users();
        $author->set_username($link);
        $authorDB=new UserDB($author);
        $authorDB->get_posts_with_username();
       
        $data['user'][0]=array('username'=>$authorDB->user->get_username(),'userProfilePicture'=>$authorDB->user->get_profilePicture(),
                                    'shortBio'=>$authorDB->user->get_shortBio(),'longBio'=>$authorDB->user->get_longBio());

        $arr=$authorDB->user->postList->get_posts();
        if(!is_array($arr)){
            throw new Exception('not array');
        }
        if(($arr==null) || ($arr[0]['filename']==null)){
            $data['posts']=$arr;

        }else{
        $lenArr=count($arr);
        for ($i = 0; $i < $lenArr; $i++) {
            $postItem = new Post();
            $postItem->set_postID($arr[$i]['postID']);
            $filename=$arr[$i]['filename'];
            $path=$arr[$i]['filepath'];
            $postItem->get_image()->file->set_filePath($path);
            $postItem->get_image()->file->set_fileName($filename);
            $data['posts'][$i] = array(
                'filename' => $postItem->get_postID(),
                'img' => $postItem->get_image()->file->get_filePath().$postItem->get_image()->file->get_fileName()
            );
        }
        }
    
        setcookie('profile',json_encode($data), time() + (86400 * 30), '/'); 
    }catch(Exception $err){
        echo $err->getMessage();
      
    }
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    $username='';
    if(isset($_SERVER['REQUEST_URI'])){
        $start=strpos($_SERVER['REQUEST_URI'], '@');
        $username=substr($_SERVER['REQUEST_URI'], $start+1);
    }
    $template->set_username($username);
    $tempdb=new TemplateDB($template);
    $results=$tempdb->get_current_template();
    if($results==false){
        $file=$template->get_directory().'/'.$template->get_filename();
        include_once($file);
    }
    var_dump($results);
    return;
    $file=$tempdb->template->get_directory().'/'.$tempdb->template->get_filename();
    var_dump($file);
    return;
}
$currentProfile=new Users();
$action=$_POST['actions'];
switch($action){
    case 'view_post':
        break;
    case 'follow_user':
        try{
            $userID=$_POST['userID'];
            $followerID=$_POST['followerID'];
         
            if(!is_int($userID) or !is_int($followerID)){
                throw new Exception('make an account');
            }
            if($userID==$mainUser->get_id()){
                $f=new Follower($mainUser,$currentProfile);
                $fDB=new FollowerDB($f);
                $fDB->addFollower();
            }
            else{
                throw new Exception('user not allowed to perform action');
            }
            $data['status']='success';
            $data['message']='its all right';
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        break;
    case 'unfollow_user':
        try{
            $userID=$_POST['userID'];
            $followerID=$_POST['followerID'];
            if($userID==$mainUser->get_id()){
                
            }
            else{
                throw new Exception('user not allowed to perform action');
            }
            $data['status']='success';
            $data['message']='its all right';
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        break;
    case 'get_following_list':
        break;
    case 'get_followers_list':
        break;

    case 'edit_post':
        $data=[];
        try{
            if($mainUser->get_auth()->is_authenticated()==false){
                throw new Exception('user not registered');
            }
            if(!isset($_POST['postID'])){
                throw new Exception('post id not set');
            }
            $postID=$_POST['postID'];
            $post=new Post();
            $post->set_id($postID);
            $postDB=new PostDB($post);
            $postDB->read_post();
            $data=array("cpation"=>$post->get_caption(),"categoryName"=>$category->get_categoryName(),
                        "img"=>$post->get_filePath().$post->get_fileName(),"previewStatus"=>$post->get_preview_status());
            echo json_encode($data);
        }catch(Exception $err){
            $log->Warning($err->getMessage());
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        break;
    
}
?>