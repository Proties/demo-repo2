<?php

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/Homepage.html');
    return;
}
include_once('php/database.php');
include_once('php/post.php');
include_once('php/user.php');
include_once('php/comment.php');
include_once('php/rank.php');

$user=new Users();
$postsObjects=array();
$data=array();
// store posts and user data on session object

$action=$_POST['action'];
switch($action){
    case 'initialise':
        for($i=0;$i<5;$i++){
        $post[$i]=new Post();
        // $base=chrono();
        $post[$i]->initialise($list[$i]);
        
        }
        
        
        break;
    case 'search':
        $target=$_POST['q'];
        $usernames=get_usernames();

        break;
    case 'comment':
        $text=$_POST['text'];
        $postID=$_POST['postID'];
        $comment=new Comment();
        $comment->set_comment($text);
        $comment->write_comment($text);
        break;
    case 'like':
        $postID=$_POST['postID'];
        $post=find_post_obj($postID);
        $post->write_like();
        break;
    case 'view_more_posts':
        $more=chrono();
        for($i=0;$i<5;$i++){
            array(
                "postID"=>$post->get_id(),
                "image"=>$post->get_image(),
                "username"=>$post->get_authorName(),
                "description"=>$post->get_description(),
                "title"=>$post->get_title()
            );
        }
        array_push($data,$more);
        break;
}
return json_encode($data);

function find_post_obj($id){
    for($i=0;$i<count($postsObjects);$i++){
        if($postsObjects[$i]->get_id()==$id){
            return $postsObjects[$i];
        }
    }
    }
?>