<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/Homepage.html');
    return;
}
$user=new Users();
if(isset($_SESSION['userid'])){
    $user->set_id($_SESSION['userid']);
    $user->read_user();
}
// store posts and user data on session object

$action=$_POST['action'];
switch($action){
    case 'initialise_post_preview':
        $post=new Post();
        $post->set_postLink($_SERVER['REQUEST_URI']);
        $post->read_postID();
        $post->read_post();
        $data=array(
        'authorName'=>$post->get_authorName(),
        'img'=>$post->get_img(),
        'comments'=>$post->get_comments(),
        'postID'=>$post->get_id()
        );
        echo json_encode($data);
        break;
    case 'initialise_image':
        $data=array();
        for($x=0;$x<count(Ranking::chrono());$x++){
            $user=new Users();
            $primary_post=new Post();
            $secondary_post=new Post();
        
                $data[]=array('user'=>array(
                    'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                    'primary_post'=>array('img'=>$primary_post->base64_encode(get_img()),'title'=>$primary_post->get_title()),
                    'secondary_post'=>array('img'=>$secondary_post->base64_encode(get_img()),'title'=>$secondary_post->get_title())
                )
                );
        }
        echo json_encode($data);
      
        break;
    case 'select_category':
        $category=new Category();
        $category->set_categoryName($_POST['categoryName']);
        $category->read_category();
        $data=array();
        for($i=0;$i<count($category->get_posts());$i++){
            $data[]=array('user'=>array(
                'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                'primary_post'=>array('img'=>$primary_post->base64_encode(get_img()),'title'=>$primary_post->get_title()),
                'secondary_post'=>array('img'=>$secondary_post->base64_encode(get_img()),'title'=>$secondary_post->get_title())
            ));
        }
        echo json_encode($data);
        break;
    case 'search':
        $target=$_POST['q'];
        $usernames=get_usernames();
        $pattern='//i';
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
        $post->set_id($_POST['postID']);
        for($c=0;$c<count($post->get_comments());$c++){
            $comment=new Comment();
            $comment->set_id($post->get_comments()['id']);
            $comment->read_comment();
            $ele=array(
            "username"=>post->get_authorName(),
            "comment"=>$comment->get_comment()
            );
            array_push($ele,$data);
        }
        echo json_encode($data);
        break; 
    case 'view_more_posts':
        $more=chrono();
        for($i=0;$i<5;$i++){
            $data[]=array('user'=>array(
                'user_info'=>array('username'=>$user->get_username(),'userprofilePic'=>$user->get_profilePicture()),
                'primary_post'=>array('img'=>$primary_post->base64_encode(get_img()),'title'=>$primary_post->get_title()),
                'secondary_post'=>array('img'=>$secondary_post->base64_encode(get_img()),'title'=>$secondary_post->get_title())
            ));
        }
        echo json_encode($data);
        break;
}
?>