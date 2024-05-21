<?php
// profile picture
// user bio 
// array of post 
// create a  directory that house all users profiles
// create a user specific directory that is a child that he user owns

// create a whole file of css that the user owns
// create a html that the user owns 
// add user profile to our usersProlie directory
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/Personalprofile.html');
    return;
}

include_once('php/user.php');
include_once('php/post.php');
$user=new Users();
$data=array();
$action=$_POST['action'];

switch($action){
    case 'initialise':
        $z='';
        $user->set_username($z);
        $user->read_user();
        for($i=0;$i<count($user->read_posts());$i++){
            $post=new Post();
            $post->read_post();
            array_push($data,$post);
        }
        
        $data=array("user"=>array(
            "userName"=>"",
            "userRealName"=>"",
            "userDescription"=>"",
            "userBio"=>""  
        ),"posts"=>array(
            "postLink"=>"",
            "postID"=>"",
            "img"=>"",
            "description"=>"",
            "title"=>"",
            "likeCount"=>""
        ));

        break;
    case 'addPost':
        $post=new Post();
        $post->set_image();
        $post->set_categoryName();
        $post->set_title();
        $post->set_description();
        break;
    case 'create_custom_profile':
        break;
}
return json_encode($data);
?>