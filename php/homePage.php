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

$postsObjects=array();
$data=array();

// store posts and user data on session object

$action=$_POST['action'];
switch($action){
    case 'initialise_image':
        $listOfPosts=chrono();
        $listOfUsers=topUsers();
        for($i=0;$i<count($listOfPosts);$i++){

        }
        header('Content-Type: image/jpeg');
        echo '';
        return ;
        break;
    case 'initialise_posts':
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
        $postsObjects[]=$post;
 
        $data["data"]=array("posts"=>array(
            "authorName"=>$post->get_authorID(),
            "description"=>$post->get_description(),
            "title"=>$post->get_title(),
            "img"=>$post->get_img()
        ),"user"=>array(
            "userLink"=>$user->get_profileLink()
        ),"topUsers"=>array(
            "userName"=>$Tuser->get_username(),
            "userImg"=>$Tuser->get_profilePicture(),
            "userLink"=>$Tuser->get_profileLink()
        ));
        }
        
        
        break;
    case 'search':
        $target=$_POST['q'];
        $usernames=get_usernames();
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

echo json_encode($data);
// echo json_encode(array('works'));
function find_post_obj($id){
    for($i=0;$i<count($postsObjects);$i++){
        if($postsObjects[$i]->get_id()==$id){
            return $postsObjects[$i];
        }
    }
    }
?>