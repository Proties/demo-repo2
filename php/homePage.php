<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('WebApp/Htmlfiles/Homepage.html');
    return;
}
$user=new Users();
if(isset($_SESSION['userid'])){
    $user->set_id($_SESSION['userid']);
    $user->read_user();
}
$userObjects=array();
function find_userObject($username){
    for($u=0;$u<count($userObjects);$u++){
        if($userObjects[$u]->get_username()===$username){
            return true;
        }
       
    }
    return false;
}
function get_userObject($username){
    for($u=0;$u<count($userObjects);$u++){
        if($userObjects[$u]->get_username()===$username){
            return $userObjects[$u];
        }
    }
    return false;
}
$action=$_POST['action'];
switch($action){
    case 'initialise_post_preview':
        $post=new Post();
        $post->set_postLink($_SERVER['REQUEST_URI']);
        $post->read_postID();
        $post->read_post();
        $data=array(
        'title'=>$post->get_title(),
        'authorName'=>$post->get_authorName(),
        'description'=>$post->get_description(),
        'img'=>$post->get_img(),
        'comments'=>$post->get_comments(),
        'postID'=>$post->get_id()
        );
        echo json_encode($data);
        break;
    case 'initialise_image':
        $data=array();
        $info=Ranking::chrono();
        print_r($info);
    for($x=0;$x<count($info);$x++){
        if(find_userObject($info[$x]['username'])==true){
            $user=get_userObject($info[$x]['username']);
            $secondary_post=new Post();
            $secondary_post->set_img($info[$x]['picture']);
            $secondary_post->set_title($info[$x]['postTitle']);
            $data[]=array(
            'secondary_post'=>array('img'=>base64_encode($secondary_post->get_img()),'title'=>$secondary_post->get_title())
            );
        }else{
            $user=new Users();
            $primary_post=new Post();
            $user->set_username($info[$x]['username']);
            $primary_post->set_img($info[$x]['picture']);
            $primary_post->set_title($info[$x]['postTitle']);
            $data[]=array('user'=>array(
                'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                'primary_post'=>array('img'=>base64_encode($primary_post->get_img()),'title'=>$primary_post->get_title())
            )
            );
            }
            }
        echo json_encode($data);
        break;
    case 'select_category':
        $category=new Category();
        $category->set_categoryName($_POST['categoryName']);
        $category->read_category();
        $info=$category->get_posts();
        $data=array();
        for($i=0;$i<count($info);$i++){
            $post=new Post();
            $user=new Users();
            $post->set_postLink($info[$i]['postLink']);
            $post->set_img($info[$i]['picture']);
            $user->set_username($info[$i]['username']);
            $data['posts']=array(
            $i=>array('postLink'=>$post->get_postLink(),'img'=>$post->get_img(),'username'=>$user->get_username())
           );
        }
        echo json_encode($data);
        break;
    case 'search':
        $target=$_POST['q'];
        $usernames=get_usernames($target);
        $data['searchResults']=$usernames;
        echo json_encode($data);
        break;
    case 'comment':
        $text=$_POST['text'];
        $postID=$_POST['postID'];
        $comment=new Comment();
        $comment->set_postID($postID);
        $comment->set_comment($text);
        $comment->write_comment();
        break;
    case 'like':
        $postID=$_POST['postID'];
        $post=new Post();
        $post->set_postID($postID);
        $post->write_like();
        break;
    case 'view_more_comments':
        $data;
        $post=new Post();
        $post->set_id($_POST['postID']);
        $info=$post->get_comments();
        for($c=0;$c<count($info);$c++){
            $comment=new Comment();
            $comment->set_id($info['id']);
            $comment->read_comment();
            $ele=array(
            "username"=>$post->get_authorName(),
            "comment"=>$comment->get_comment()
            );
            array_push($ele,$data);
        }
        echo json_encode($data);
        break; 
    case 'view_more_posts':
        for($x=0;$x<count($info);$x++){
            if(find_userObject($info[$x]['username'])==true){
                $user=get_userObject($info[$x]['username']);
                $secondary_post=new Post();
                $secondary_post->set_img($info[$x]['picture']);
                $secondary_post->set_title($info[$x]['postTitle']);
                $data[]=array(
                'secondary_post'=>array('img'=>base64_encode($secondary_post->get_img()),'title'=>$secondary_post->get_title())
                );
            }else{
                $user=new Users();
                $primary_post=new Post();
                $user->set_username($info[$x]['username']);
                $primary_post->set_img($info[$x]['picture']);
                $primary_post->set_title($info[$x]['postTitle']);
                $data[]=array('user'=>array(
                    'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                    'primary_post'=>array('img'=>base64_encode($primary_post->get_img()),'title'=>$primary_post->get_title())
                )
                );
                }
                }
        echo json_encode($data);
        break;
}
?>