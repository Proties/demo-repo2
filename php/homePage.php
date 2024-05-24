<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/Homepage.html');
    return;
}
include_once('php/post.php');
include_once('php/user.php');
include_once('php/comment.php');
include_once('php/database.php');
include_once('php/rank.php');

$user=new Users();
if(isset($_SESSION['userid'])){
    $user->set_id($_SESSION['userid']);
    $user->read_user();
}
// store posts and user data on session object

$action=$_POST['action'];
switch($action){
    case 'initialise_image':
       
        $listOfPosts = chrono();
        $data;
        $a=array();
        $b=array();
        $c=array();
        if(count($listOfPosts)==0){
            echo json_encode(array('status'=>'ok','message'=>'no post yet'));
             return;
         }
        for ($i=0;$i<count($listOfPosts);$i++) {
            $post = new Post();
            $post->set_img($listOfPosts[$i][4]);
            $post->set_postID($listOfPosts[$i][0]);
        
            $a[]=array(
                'id'=>$post->get_postID(),
                'image'=>base64_encode($post->get_img()),
                'authorName'=>$post->get_authorName(),
                'description'=>$post->get_description()
            );
           
            
            $b[]=array(
                'userLink' => null
            );
            $c[]=array(
                'userName' => 'hottie',
                'userImg' => '',
                'userLink' => null
            );

        }
        $data['posts']=$a;
        $data['users']=$b;
        $data['topUsers']=$c;
        // header('Content-type: image/jpeg');
        echo json_encode($data);
        break;
    case 'initialise_posts':
        $info=array();
        $listOfPosts=chrono();
        $listOfUsers=topUsers();
        
        for($i=0;$i<count($listOfPosts);$i++){
        $post=new Post();
        $Tuser=new Users();
        $post->set_title();
        $post->set_description();
        $post->set_postLink();
        $Tuser->initialise($listOfUsers[$i]);
        $post->initialise($listOfPosts[$i]);
 
       
        }
        
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
            $post=new Post();
            $post->initialise($more[$i]);
            array_push($post,$postsObjects);
            $x=array(
                'postID'=>$post->get_id(),
                'image'=>$post->get_image(),
                'username'=>$post->get_authorName(),
                'description'=>$post->get_description(),
                'title'=>$post->get_title()
            );
            array_push($data,$x);
        }
        echo json_encode($data);
        break;
}
?>