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
        for ($i=0;$i<count($listOfPosts);$i++) {
            $post = new Post();
            $post->set_img($listOfPosts[$i][4]);
            $post->set_postID($listOfPosts[$i][0]);
            $post->set_title();
            $post->set_description();
            $post->set_postLink();
            
            $data[]=array('id'=>$post->get_postID(),'image'=>base64_encode($post->get_img()));
        }
        // header('Content-type: image/jpeg');
        echo json_encode($data);
        break;
    case 'initialise_posts':
        $info=array();
        $listOfPosts=chrono();
        $listOfUsers=topUsers();
        if(count($listOfPosts)==0){
           echo json_encode(array('status'=>'ok','message'=>'no post yet'));
            return;
        }
        for($i=0;$i<count($listOfPosts);$i++){
        $post=new Post();
        $Tuser=new Users();
        $Tuser->initialise($listOfUsers[$i]);
        $post->initialise($listOfPosts[$i]);
 
        $data = array(
            'posts' => array(
                'authorName' => 0,
                'description' => 'really hot go',
                'title' => 'hot'
            ),
            'user' => array(
                'userLink' => null
            ),
            'topUsers' => array(
                'userName' => 'hottie',
                'userImg' => '',
                'userLink' => null
            )
        );
        array_push($info,$data);
        }
        echo json_encode($info);
        
        break;
    case 'search':
        $target=$_POST['q'];
        $usernames=get_usernames();
        $pattern='//i';
        $data['searchResults']=$usernames;
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
        
        break;
}
?>