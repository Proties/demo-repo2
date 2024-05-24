<?php
$post=new Post();
$user=new Users();
$commentArray=array();
 

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/fullPage.html');
    echo 'full post page';
    return;
}

$data=array();
$action=$_POST['action'];
switch($action){
    case 'initialise':
        $_SERVER['REQUEST_URI'];
        $post->set_id();
        $post->read_post();
        for($i=0;$i<count($post->get_comments);$i++){
            $comments=new Comment();
            $comments->set_postID();
            $comments->read_comment();
            array_push($post,$data);
        }
        break;
    case 'like':
        $post=new Post();
        $post->set_id($_POST['postID']);
        $post->write_like();
        break;
    case 'comment':
        $comment=new Comment();
        $comment->set_postID($_POST['postID']);
        $comment->set_text($_POST['text']);
        $comment->write_comment();
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
}

?>