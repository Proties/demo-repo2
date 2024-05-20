<?php
// a single post object 
$post=new Post();
$user=new User();

$commentArray=array();

// more info on post like comments, 

// http url 
// authorName(username)/postID 

if($_SERVER['REQUEST_METHOD']=='GET'){
    include('Htmls/fullPage.html');
    return;
}

$data=array();
$action=$_POST['action'];
switch($action){
    case 'initialise':
        $post->set_id();
        $post->read_post();
        for($i=0;$i<$post->count($post->get_comments);$i++){
            $comments=new Comment();
            $comments->set_id();
            $comments->read_comment();
            array_push($post,$data);
        }
        break;
    case 'like':
        $post->write_like();
        break;
    case 'comment':
        $comment=new Comment();
        $comment->set_post($post->get_id());
        $comment->set_text($_POST['text']);
        $comment->write_comment();
        break; 
    case 'view_more_comments':
        for($c=0;$c<count($post->get_comments());$c++){
            $comment=new Comment();
            $comment->read_comment();
            array_push($comments,$data);
        }
       
        break; 
}
return json_encode($data);
?>