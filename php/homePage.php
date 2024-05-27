<?php
session_start();

$mainUser=new Users();
$GLOBALS['mainUser']=$mainUser;

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Homepage.html');
    return;
}

if(isset($_SESSION['userID'])){
    $GLOBALS['mainUser']->set_id($_SESSION['userID']);
    $GLOBALS['mainUser']->read_user();
   
}
function find_userObject($username){
    $info=$GLOBALS['mainUser']->get_userObjects();
    for($u=0;$u<count($info);$u++){
        if($info[$u]->get_username()==$username){
            return true;
        }
       
    }
    return false;
}
function get_userObject($username){
    for($u=0;$u<count($GLOBALS['mainUser']->get_userObjects());$u++){
        if($GLOBALS['mainUser']->get_userObjects()[$u]->get_username()==$username){
            return $GLOBALS['mainUser']->get_userObjects()[$u];
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
            print_r(json_encode($GLOBALS['mainuser']));
            return;
            $GLOBALS['mainUser']->get_userObjects()['users']=$user;
            print_r(json_encode($GLOBALS['mainUser']->get_userObjects()));
            return;
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