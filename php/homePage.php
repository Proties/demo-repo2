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
if(isset($_SESSION['userObject'])){
    $mainUser->unserialize($_SESSION['userObject']);
    // var_dump($mainUser->servedPosts);
    // return;
}


$bigPool=new MostViewPostPool();
$profilesPool=new ProfilePool();


function compareViewedPosts(Users $user,array $bigData){
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

function compareServedPosts(Users $mainUser,array $bigData){
    $max=$mainUser->servedPosts->getSize();
    $arr=$mainUser->servedPosts->getPool();
    $max=count($arr);
    $matching=[];
    $data=[];
    try{
        for($a=0;$a<$max;$a++){
            for ($i=0; $i < count($bigData); $i++) { 
                if(isset($bigData[$i]['posts'])){
                    for($b=0;$b<count($bigData[$i]['posts']);$b++){

                        if($arr[$a]==$bigData[$i]['posts'][$b]['postID']){
                            array_push($matching,$bigData[$i]['posts'][$b]['postID']);
                            // throw new Exception('repeating posts');
                        }
                    }
                }else{
                    if($arr[$a]==$bigData[$i]['post']['postID']){
                        array_push($matching,$bigData[$i]['post']['postID']);
                        // throw new Exception('repeating posts');
                    }
                }
                
               
            }
        }
        if(count($matching)>1){
            throw new Exception('throw hands');
        }
        return true;
    }catch(Exception $err){
        $data['message']=$err->getMessage();
        $data['matchingIDs']=$matching;
        return $data;
    }
}

/**
 * 
 * this is a test function that will deleted when i get the site working
 * Compares two nested arrays and returns postIDs of matching posts.
 *
 * @param array $data
 * @param array $bigData
 * @return array|bool Repeat post IDs or FALSE on error
 */
// function compareServedPostsWithSaved(array $data, array $bigData) {
//     $repeatPosts = [];
//     try {
//         foreach ($data as $key => $datum) {
//             if (!isset($bigData[$key])) {
//                 continue;
//             }
//             foreach ($datum['posts'] as $post) {
//                 foreach ($bigData[$key]['posts'] as $bigPost) {
//                     if ($post['postID'] === $bigPost['postID']) {
//                         $repeatPosts[] = $post['postID'];
//                     }
//                 }
//             }
//         }
//         return $repeatPosts;
//     } catch (Exception $err) {
//         // Log or handle error
//         return false;
//     }
// }
//this function will take 2 large nested arrays and see the array that are equal to each are other add
// thier postIDs to a new array repeatPosts and return that arrat
function compareServedPostsWithSaved(array $data,array $bigData){
    $max=count($data);
    $maxReq=count($bigData);
    $repeatPosts=[];
    try{
        for($a=0;$a<$max;$a++){
            for ($b=0;$b<$maxReq;$b++) { 
                if($data[$a]['posts'][$b]['postID']==$bigData[$b]['posts'][$b]['postID']){
                    }  
                    array_push($repeatPosts,$data[$a]['posts'][$b]['postID']);
                    }
        }
        return true;
    }catch(Exception $err){
        return false;
    }
}

function compareFollowingIds(Users $user,array $bigData){
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

function load_more_data(){
        try{
            $info=$rank->chronoTwo($arrayPosts);
            $newNewData=formatProfileObject($info);

            $status=compareServedPostsWithSaved($bigPool->getPool(),$newData);
            if(!is_array($status)){
                throw new Exception('no new posts');
            }
            for($i=0;$i<count($newNewData);$i++){
                $bigPool->add_item($newData[$i]);
            }
            $bigPool->load_data_to_file();
        }catch(Exception $err){
            return $err;
        }
        
        
}

$template=new Template();
setcookie('profile','no profile ', time() - (86400 * 30), '/'); 
// setcookie('myprofile','', time() - (86400 * 30), '/');
if(isset($_SESSION['subscriptionID'])){
    //unlock features
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
$newData;
try{
    $arrayPosts=[];
    $rank=new Ranking();
    $newData=$bigPool->getPool();
    
    if(count($newData)==0){

        $info=$rank->chronoTwo($arrayPosts);
        $newData=formatProfileObject($info);

        $status=compareServedPostsWithSaved($bigPool->getPool(),$newData);
       
        if(is_array($status)){
            throw new Exception('no new posts even after looking in the database');
        }
       
        for($i=0;$i<count($newData);$i++){
            if(isset($newData[$i])){
                $bigPool->add_item($newData[$i]);
            }
            
        }
        $bigPool->load_data_to_file();
        }
    // if(count($newData)<=3){
    //     throw new Exception('no more new posts');
    // }
    $commonFollowing=compareFollowingIds($mainUser,$newData);
    $commonPosts=compareViewedPosts($mainUser,$newData);
    
    $status=compareServedPosts($mainUser,$newData);
    if(is_array($status)){
        throw new Exception('all the posts have been viewed');
    }
        if(isset($newData[0])){
            if($newData[0]!==NULL){
                if(isset($newData[0]['posts'])){
                    $mainUser->servedPosts->add_item($newData[0]['posts'][0]['postID']);
                    if(isset($newData[0]['posts'][1])){
                        $mainUser->servedPosts->add_item($newData[0]['posts'][1]['postID']);
                    }
                    if(isset($newData[0]['posts'][2])){
                        $mainUser->servedPosts->add_item($newData[0]['posts'][2]['postID']);
                    }
                }
                else{
                    $mainUser->servedPosts->add_item($newData[0]['post']['postID']);
                }
                
                
        }
        }
        if(isset($newData[1])){
            if($newData[1]!==NULL){
                if(isset($newData[1]['posts'])){
                    $mainUser->servedPosts->add_item($newData[1]['posts'][0]['postID']);
                    if(isset($newData[1]['posts'][1])){
                        $mainUser->servedPosts->add_item($newData[1]['posts'][1]['postID']);
                    }
                    if(isset($newData[1]['posts'][2])){
                        $mainUser->servedPosts->add_item($newData[1]['posts'][2]['postID']);
                    }
                }else{
                    if($newData[1]['post']['postID']!==null){
                        $mainUser->servedPosts->add_item($newData[1]['post']['postID']);
                    }
                    
                }
               
        }
        }
        
        if(isset($newData[2])){
            if($newData[2]!==NULL){
                if(isset($newData[0]['posts'])){
                    $mainUser->servedPosts->add_item($newData[2]['posts'][0]['postID']);
                    if(isset($newData[2]['posts'][1])){
                        $mainUser->servedPosts->add_item($newData[2]['posts'][1]['postID']);
                    }
                    if(isset($newData[2]['posts'][2])){
                        $mainUser->servedPosts->add_item($newData[2]['posts'][2]['postID']);
                    }
                }else{
                    $mainUser->servedPosts->add_item($newData[2]['post']['postID']);
                }
                
        } 
        }
        if(isset($newData[3])){
            if($newData[3]!==NULL){
                if(isset($newData[3]['posts'])){
                    $mainUser->servedPosts->add_item($newData[3]['posts'][0]['postID']);
                    if(isset($newData[3]['posts'][1])){
                        $mainUser->servedPosts->add_item($newData[3]['posts'][1]['postID']);
                    }
                    if(isset($newData[3]['posts'][2])){
                        $mainUser->servedPosts->add_item($newData[3]['posts'][2]['postID']);
                    }
                }else{
                    $mainUser->servedPosts->add_item($newData[3]['post']['postID']);
                }
                
         } 
        }
        if(isset($newData[4])){
            if($newData[4]!==NULL ){
                if(isset($newData[0]['posts'])){
                    $mainUser->servedPosts->add_item($newData[4]['posts'][0]['postID']);
                    if(isset($newData[4]['posts'][1])){
                        $mainUser->servedPosts->add_item($newData[4]['posts'][1]['postID']);
                    }
                    if(isset($newData[4]['posts'][2])){
                        $mainUser->servedPosts->add_item($newData[4]['posts'][2]['postID']);
                    }
                }else{
                    $mainUser->servedPosts->add_item($newData[4]['post']['postID']);
                }
               
        } 
        
        
    }
   
        
    
    
   
   
    $_SESSION['userObject']=$mainUser->serialize();
    setcookie('users',json_encode($newData) , time() + (86 * 1), '/');
}catch(Exception $err){
    $data['status']='failed';
    $data['message']=$err->getMessage();
    setcookie('users',json_encode($data) , time() + (86 * 1), '/');
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Homepage.html');
    return;
}

$action=$_POST['actions'];
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
           
            if(!isset($_SESSION['userID']) OR empty($_SESSION['userID'])){
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