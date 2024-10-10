<?php
session_start();
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Ranking\Ranking;

$mainUser=new Users();

if(isset($_SESSION['username']) && $_SESSION['username']!==null && isset($_SESSION['userID'])){
    $mainUser->userAuth->set_authanticate(true);
    setcookie('user',json_encode($_SESSION['username']), time() + (86400 * 30), '/'); 
}else{
    unset($_SESSION['username']);
    setcookie('user','no account', time() - (86400 * 30), '/'); 
    setcookie('profile','no profile ', time() - (86400 * 30), '/'); 
}
try{


$arrayPosts=[];
$data=[];
$rank=new Ranking();
$info=$rank->chrono($arrayPosts);
$arrLen=count($info);
for($x=0;$x<$arrLen;$x++){
    $user=new Users();

    $primary_post=new Post();

    $user->set_username($info[$x]['username']);
    $string=$info[$x]['postLink'];
    $path=substr($string,0,strpos($string, '/'));
    $name=substr($string,strpos($string, '/'));
    $primary_post->set_postLinkID($info[$x]['postLinkID']);
    $primary_post->set_postID($info[$x]['postID']);

    $primary_post->get_image()->set_filename($name);
    $primary_post->get_image()->set_filePath($path);
    
    $secondary_post=new Post();
    $string_two=$info[$x]['post2Link'];
    $path_two=substr($string,0,strpos($string, '/'));
    $name_two=substr($string,strpos($string, '/'));
    $secondary_post->set_postID($info[$x]['post2ID']);
    $secondary_post->set_postLinkID($info[$x]['post2LinkID']);
    $primary_post->get_image()->set_filename($name_two);
    $secondary_post->get_image()->set_filePath($path_two);
    $data['users'][]=array(
        'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
        'primary_post'=>array('img'=>$primary_post->get_image()->get_filePath().$primary_post->get_image()->get_fileName(),
            'postID'=>$primary_post->get_postID(),
            'postLinkID'=>$primary_post->get_postLinkID()),
            'secondary_post'=>array('img'=>$secondary_post->get_image()->get_filePath().$secondary_post->get_image()->get_fileName(),
            'postID'=>$secondary_post->get_postID(),
            'postLinkID'=>$secondary_post->get_postLinkID()
        ));


    }
    setcookie('users',json_encode($data) , time() + (8640 * 1), '/');
}catch(Exception $err){
    echo $err->getMessage();
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Homepage.html');
    return;
}

$action=$_POST['action'];
switch($action){
    case 'view_post':
        try{
                if(!is_int($mainUser->get_id())){
                throw new Exception('create account first');
            }
            $view=new ViewedPost($post,$user);
            $view->addPost();
            $data['status']='success';
            $data['message']='its all right';
            echo $data;
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo $data;
        }
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
    case 'search':
        $data=[];
        try{
            $target=$_POST['q'];
            $user=new Users();
            $usernames=[];
            
            $userDB=new UserDB($user);
            $arrayData=$userDB->search_user($target);

            $data['status']='success';
            $data['searchResults']=$arrayData;
            $data['Results']=$arrayData;
            setcookie('usernameSearchResults',json_encode($data), time() + (864 * 1), '/');
        }
        catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            setcookie('usernameSearchResults',json_encode($data), time() + (864 * 1), '/');
        }
        
        break;
   
    case 'view_more_posts':
        try{
            $rank=Ranking();
            $rank->chrono($arrayPosts);
            $data['status']='success';
            for($i=0;$i<$len;$i++){
                $data['users'][]=array(
                    'username'=>array($user->get_username(),'userID'=>$user->get_id()),
                    'primary_post'=>array('img'=>$primary->get_filePath().$primary->get_fileName(),'postID'=>$primary->get_postID()),
                    'secondary_post'=>array('img'=>$secondary->get_filePath().$secondary->get_fileName(),'postID'=>$secondary->get_postID())
                );
                $postDB->addServeredPost($userID);
            }
            
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']='could not load more posts';
            echo json_encode($data);
        }
        
        break;
}
return;
// a function that will take an array of user arrays
// the function will check for arrays with the same username and join em
// it will produce a new array that has a primary and secondary post
function search_name($username,$arr){
    for($i=0;$i<count($arr);$i++){
        if($arr[$i]['username']==$username){
            print_r("worksssss");
            return $arr[$i];
        }
    }
}
?>