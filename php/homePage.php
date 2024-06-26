<?php
session_start();

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Users\Users;
use Posts\Post;
use Categories\Category;
use Categories\CategoryDB;

$log=new Logger('start');
$log->pushHandler(new StreamHandler('php/file.log',Level::Warning));
$mainUser=new Users();
if(isset($_SESSION['username'])){
    $mainUser->get_auth()->set_authanticate(true);
    setcookie('username',$_SESSION['username'], time() + (86400 * 30), '/'); 
}else{
     setcookie('username','no account', time() - (86400 * 30), '/'); 
}
try{
 $categories=[];
$category=new Category();
$categoryDB=new CategoryDB($category);
$categories=$categoryDB->read_category();
$catLen=count($categories);
    for($i=0;$i<$catLen;$i++){
        $data['categories'][]=array('categoryName'=>$categories[$i]['categoryName'],'categoryId'=>$categories[$i]['categoryID']);
    } 
        
$arrayPosts=[];
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

            
        // if(isset($_SESSION['userID'])){
        //     $postDB->addServeredPost($_SESSION['userID']);
        // }
    }
    setcookie('users',json_encode($data) , time() + (864 * 30), '/');
}catch(Exception $err){
    $log->info($err->getMessage().'\n'.$err->getCode());
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Homepage.html');
    return;
}

$action=$_POST['action'];
switch($action){
    case 'select_category':
        $data=[];
        $category=new Category();
        $category->set_categoryName($_POST['categoryName']);
        $categoryDB=new CategoryDB($category);
        $categoryDB->read_posts();
        $arrData=$category->get_posts();
        $len=count($arrData);
        for($i=0;$i<$len;$i++){
            $user=$arrData[$i]['user'];
            $primary_post=$arrData[$i]['primaryPost'];
            $secondary_post=$arrData[$i]['secondaryPost'];

            $data['users'][]=array(
                'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                'primary_post'=>array('img'=>($primary_post->get_filePath().$primary_post->get_fileName())),
                'secondary_post'=>array('img'=>($secondary_post->get_filePath().$secondary_post->get_fileName()))
            );
        }
        echo json_encode($data);
        break;
    case 'search':
        $data=[];
        try{
            $target=$_POST['q'];
            $userDB=new UserDB($user);
            $usernames=$userDB->search_user($target);
            $data['searchResults']=$usernames;
            echo json_encode($data);
        }
        catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        
        break;
    case 'comment':
        $data=[];
        try{ 
        $post=new Post();
        $post->set_postLinkID($_POST['postID']);
        $postDB=new PostDB($post);
        if($mainUser->get_auth()->is_authanticated()==false){
           throw new Exception('user not registered');
        }
       if(!isset($_POST['postID'])){
            throw new Exception('post doesn not exist');
        }
        

        if($post->validate_postLinkID($_POST['postID'])==false){
            throw new Exception('post id not valid');
        }
        else{

        }
        if($postDB->validate_postLinkID_in_db($_POST['postID'])==false){
            throw new Exception('postID not in database');
        }else{

        }
        $text=$_POST['text'];
        $comment=new Comment();
        $postID=$postDB->get_postID_from_link($_POST['postID']);
        $comment->set_postID($postID['postID']);
        $comment->set_comment($text);
        $comment->set_userID($_SESSION['userID']);
      
        $commentDB=new CommentDB($comment);
        $commentDB->write_comment();
        $data['status']='success';
        echo json_encode($data);
        }catch(Exception $err){
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
       
        break;
    case 'like':
        $data=[];
        $post=new Post();
        $post->set_postID($_POST['postID']);
        $postDB=new PostDB($post);
        try{

        if($mainUser->get_auth()->is_authanticated()==false){
            throw new Exception('user not registered');
        }
        if(!isset($_POST['postID'])){
            throw new Exception('post doesn not exist');
        }
        

        if($post->validate_postLinkID($_POST['postID'])==false){
            throw new Exception('post id not valid');
        }
        else{

        }
        if($postDB->validate_postLinkID_in_db($_POST['postID'])==false){
            throw new Exception('postID not in database');
        }else{

        }
        $postID=$postDB->get_postID_from_link($_POST['postID']);
        $postID=$postID['postID'];
    

        $like=new Like($_SESSION['userID'],$postID);
        $likeDB=new LikeDB($like);
        $likeDB->write_like();
        $data['status']='success';
        echo json_encode($data);
        }catch(Exception $err){
            $msg=$err->getMessage();
            $data['message']=$msg;
            $data['status']='failed';
            $data['obj']=$_POST['postID'];
            echo json_encode($data);
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