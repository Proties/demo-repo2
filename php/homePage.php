<?php
session_start();
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Ranking\Ranking;
use Insta\Template\Template;
use Insta\Template\HtmlTemplate;
use Insta\Database\Template\TemplateDB;

use Insta\Pool\MostViewPostPool;
use Insta\Pool\ProfilePool;


use Insta\Subscription\Subscription;
use Insta\Database\Subscription\SubscriptionDB;

$subscription=new Subscription();
$mainUser=new Users();

$bigPool=new MostViewPostPool();
$profilesPool=new ProfilePool();

function compareViewedPosts(Users $user){
    $max=$user->viewedPosts->getSize();
    $arr=$user->viewedPosts->getPool();
    $c=0;
    while($c<$max){
        if($bigPool[$a]['posts'][$b]==$arr[$c]){

            $c++;
        }
        
    }
    return false;
}

function compareServedPosts(Users $user){
    $max=$user->viewedPosts->getSize();
    $arr=$user->viewedPosts->getPool();
    $c=0;
    while($c<$max){
        if($bigPool[$a]['posts'][$b]==$arr[$c]){

            $c++;
        }
        
    }
    return false;
}

function compareFollowingIds(Users $user){
    $max=$user->viewedPosts->getSize();
    $arr=$user->viewedPosts->getPool();
    $c=0;
    while($c<$max){
        if($bigPool[$a]['posts'][$b]==$arr[$c]){

            $c++;
        }

        
    }
     return false;
}


$template=new Template();
setcookie('profile','no profile ', time() - (86400 * 30), '/'); 
// setcookie('myprofile','', time() - (86400 * 30), '/');
if(isset($_SESSION['subscriptionID'])){
    //unlock features
}
if(isset($_SESSION['username']) && $_SESSION['username']!==null && isset($_SESSION['userID'])){
    $mainUser->userAuth->set_authanticate(true);
    setcookie('user',json_encode($_SESSION['username']), time() + (86400 * 30), '/'); 
}else{
    unset($_SESSION['username']);
    setcookie('user','no account', time() - (86400 * 30), '/'); 
    
}
/*
this function will take an array or posts and will group the post made by the same user in a single  nested array

*/

function formatProfileObject(array $bigData){
    // $newArray=[];

    $cont=[];
    $countItem=0;
    $maxLen=count($bigData);
    $i=0;
    $c=0;
    try{
        while($maxLen>$i){
        $currentUsername=$bigData[$i]['username'];
        if($i==0){
            $newArray=[];
            $username=$bigData[$i]['username'];
            $userID=$bigData[$i]['userID'];
           
            $posts=[];
            if(isset($bigData[$i]['imageFileName']) OR $bigData[$i]['imageFileName']!==NULL){
                $posts['postLink']=$bigData[$i]['postLink'];
                $posts['postID']=$bigData[$i]['postID'];
                $posts['imageFileName']=$bigData[$i]['imageFileName'];
                $posts['imageFilePath']=$bigData[$i]['imageFilePath'];
            }
            if(isset($bigData[$i]['videoFileName']) or $bigData[$i]['videoFileName']!==null){
                $posts['postLink']=$bigData[$i]['postLink'];
                $posts['postID']=$bigData[$i]['postID'];
                $posts['VideoFileName']=$bigData[$i]['videoFileName'];
                $posts['videoFilePath']=$bigData[$i]['videoFilePath'];
            }
          
            $newArray['username']=$username;
            $newArray['userID']=$userID;
            $newArray['profilePicture']='/Image/Test Account.png';
            $newArray['post']=$posts;
            $cont[]=$newArray;    
            $i++; 
        }
        else if($bigData[$i]['username']!==$cont[$c]['username']){
            $newArray=[];
            $placeholder=[];
            $posts=[];
            $username=$bigData[$i]['username'];
            $userID=$bigData[$i]['userID'];

            if(isset($bigData[$i]['imageFileName']) or $bigData[$i]['imageFileName']!==null){
                $posts['postLink']=$bigData[$i]['postLink'];
                $posts['postID']=$bigData[$i]['postID'];
                $posts['imageFileName']=$bigData[$i]['imageFileName'];
                $posts['imageFilePath']=$bigData[$i]['imageFilePath'];
            }
            if(isset($bigData[$i]['videoFileName']) or $bigData[$i]['videoFileName']!==null){
                $posts['postLink']=$bigData[$i]['postLink'];
                $posts['postID']=$bigData[$i]['postID'];
                $posts['VideoFileName']=$bigData[$i]['videoFileName'];
                $posts['videoFilePath']=$bigData[$i]['videoFilePath'];
            }
            $newArray['username']=$username;
            $newArray['userID']=$userID;
            $newArray['profilePicture']='/Image/Test Account.png';
            $newArray['posts'][]=$posts;
            $cont[]=$newArray;
            // var_dump(json_encode($cont));
            // return;
            $i++;
            $c++;
        }
        else{
            
            $posts=[];
            $currentContent=[];
            if(isset($bigData[$i]['imageFileName']) ){
                if($bigData[$i]['imageFileName']!==null){
                $posts['postLink']=$bigData[$i]['postLink'];
                $posts['postID']=$bigData[$i]['postID'];
                $posts['imageFileName']=$bigData[$i]['imageFileName'];
                $posts['imageFilePath']=$bigData[$i]['imageFilePath'];
            }
        }
            if(isset($bigData[$i]['videoFileName'])){
                if( $bigData[$i]['videoFileName']!==null){
                $posts['postLink']=$bigData[$i]['postLink'];
                $posts['postID']=$bigData[$i]['postID'];
                $posts['VideoFileName']=$bigData[$i]['videoFileName'];
                $posts['videoFilePath']=$bigData[$i]['videoFilePath'];
            }
        }

            if(isset($cont[$c]['post'])){
                
                if(isset($cont[$c]['post']['videoFilePath']) ){
                    if($cont[$c]['post']['videoFilePath']!==null){
                    $currentContent=$cont[$c]['postLink'];
                    $currentContent=$cont[$c]['postID'];
                    $currentContent=$cont[$c]['post']['videoFilePath'];
                    $currentContent=$cont[$c]['post']['videoFileName'];
                }
            }
                else{
                    $currentContent=$cont[$c]['post']['postLink'];
                    $currentContent=$cont[$c]['post']['postID'];
                    $currentContent=$cont[$c]['post']['imageFilePath'];
                    $currentContent=$cont[$c]['post']['imageFileName'];
                }

                $cont[$c]['post']=null;
                unset($cont[$c]['post']);
                $cont[$c]['posts']=[];
                array_push($cont[$c]['posts'],$currentContent);
                array_push($cont[$c]['posts'],$posts);
            }
            else{
                if(isset($cont[$c]['posts'])){
                    array_push($cont[$c]['posts'],$posts);
                }  
                
            }
            $i++;
        }
    }
    }catch(Exception $err){
       return $err;
    }  
    return $cont;
    
}
$newData=[];
try{
    $arrayPosts=[];
   
    
    $commonPostsTwo=compareServedPosts($mainUser);
    $commonFollowing=compareFollowingIds($mainUser);
    $commonPosts=compareViewedPosts($mainUser);
    


    $rank=new Ranking();
    $info=$rank->chronoTwo($arrayPosts);
    $arrLen=count($info);
    $newData=formatProfileObject($info);
    // $mainUser->servedPosts->add_item($newData[0]);
    // $mainUser->servedPosts->add_item($newData[1]);
    // $mainUser->servedPosts->add_item($newData[2]);
    // $mainUser->servedPosts->add_item($newData[3]);
    // $mainUser->servedPosts->add_item($newData[4]);
    // $bigPool->add_item($newData[0]);
    // $bigPool->add_item($newData[1]);
    // $bigPool->add_item($newData[2]);
    // $bigPool->add_item($newData[3]);
    // $bigPool->add_item($newData[4]);
    
    setcookie('users',json_encode($newData) , time() + (8640 * 1), '/');
}catch(Exception $err){
    echo $err->getMessage();
    setcookie('users','' , time() - (8640 * 1), '/');
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Homepage.html');
    return;
}

$action=$_POST['action'];
switch($action){
    case 'get_templates':
        $data=[];
        try{
 
            $tempdb=new TemplateDB($template);
            $list=$tempdb->getTemplateList();

            $data['templateList']=$list;
            $data['status']='success';
            $data['message']='its all right';
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        return;
        break;
    case 'pick_template':
        $data=[];
        try{
            if(!isset($_SESSION['userID'])){
                throw new Exception('create account first');
            }
            if(!isset($_POST['templateFileName'])){
                throw new Exception('template must be selected');
            }

            $template->set_fileName($_POST['templateFileName']);
            $template->set_userID($_SESSION['userID']);
            $tempdb=new TemplateDB($template);
            $tempdb->switchUserTemplate();
            $data['status']='success';
            $data['message']='its all right';
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        break;
    case 'view_post':
        try{
                if(!is_int($mainUser->get_id())){
                throw new Exception('create account first');
            }
            $view=new ViewedPost($post,$user);
            $view->addPost();
            $data['status']='success';
            $data['message']='its all right';
            echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        break;
    case 'follow_user':
        try{
            
            $followerID=$_POST['followerID'];
         
            if(empty($_SESSION['userID']) or empty($_POST['followerID'])){
                throw new Exception('make an account');
            }
           
            $f=new Follower($mainUser,$currentProfile);
            $fDB=new FollowerDB($f);
            $fDB->addFollower();
            
          
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
           
            if(!isset($_POST['followerID']) OR empty($_SESSION['userID'])){
                 throw new Exception('make an account');
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
            $profiles;
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