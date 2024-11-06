<?php
session_start();
date_default_timezone_set('Africa/Johannesburg');
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

use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;
use Insta\Pool\ProfilePool;

$pool=new ProfilePool();
$subscription=new Subscription();
$mainUser=new Users();
$template=new Template();
setcookie('users','', time() - (86400 * 30), '/'); 
// setcookie('myprofile','', time() - (86400 * 30), '/');
if(isset($_SESSION['username']) && $_SESSION['username']!==null){
    $mainUser->set_username($_SESSION['username']);
    $mainUser->set_id($_SESSION['userID']);
    $mainUser->userAuth->set_authanticate(true);
}

if(isset($_SESSION['subscriptionID'])){
    //unlock features
}

$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);

$u=new Users();
$udb=new UserDB($u);
if($f_txt==='/profile'){

    $data;
    $personal=[];

    
    $authorDB=new UserDB($mainUser);
    $authorDB->get_posts_with_username();
    $userDetails['userID']=$authorDB->user->get_id();
    $userDetails['username']=$authorDB->user->get_username();
    $userDetails['shortBio']=$authorDB->user->get_shortBio();
    $userDetails['fullname']=$authorDB->user->get_shortBio();
    $userDetails['longBio']=$authorDB->user->get_longBio();
    $userDetails['following']=$authorDB->user->get_followingNo();
    $userDetails['follower']=$authorDB->user->get_followersNo();

    $personal['userInfo']=$userDetails;
    $personal['posts']=$authorDB->user->postList->get_posts();
   setcookie('myprofile',json_encode($personal), time() + (86400 * 30), '/'); 
}
else if($u->validate_username_url($f_txt)==true ){
    
    try{
        $txt=substr($f_txt,2);
        $link=$txt;
        $data=[];
        $userPosts=array();
        $mainUser->set_username($link);
        $authorDB=new UserDB($mainUser);
        $date=date('Y:m:d');
        $time=date('H:i');
        $link=$f_txt;
        // this is the id of the current profile beign viewed
        $authorDB->read_userID();
        $id=$authorDB->user->get_id();
        $authorDB->add_profile_view($date,$time,$link,$id);
 
        $authorDB->get_posts_with_username();
        
        $data['user']=array('username'=>$authorDB->user->get_username(),'userProfilePicture'=>$authorDB->user->get_profilePicture(),
                                    'shortBio'=>$authorDB->user->get_shortBio(),'longBio'=>$authorDB->user->get_longBio());
        $data['posts']=$authorDB->user->postList->get_posts();
        // $pool->add_item($data);
        // $pool->load_data_to_file();
        setcookie('profile',json_encode($data), time() + (86 * 30), '/'); 
 }catch(Exception $err){
        $data['message']=$err->getMessage();
        $data['status']='failed';
        setcookie('profile',json_encode($data), time() + (86 * 30), '/');
      
    }
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    $username='';
    if(isset($_SERVER['REQUEST_URI'])){
        $start=strpos($_SERVER['REQUEST_URI'], '@');
        $username=substr($_SERVER['REQUEST_URI'], $start+1);
    }
    if(!isset($_SESSION['userID'])){
        include_once('Htmlfiles/Personalprofile.html');
        return;
    }
    $template->set_username($username);
    $tempdb=new TemplateDB($template);
    $results=$tempdb->get_current_template();
    if($results==false){
        $file=$template->get_directory().'/'.$template->get_filename();
        include_once($file);
    }

    $file=$tempdb->template->get_directory().'/'.$tempdb->template->get_filename();

}
$currentProfile=new Users();
$action='';
if(isset($_POST['actions'])){
    $action=$_POST['actions'];
}

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