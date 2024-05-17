<?php
include_once('backend/database.php');
// array of post 

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('front/home.html');
    return;
}else{
    
}
$post=array();
$list=chrono();

$user;
$data;
// store posts and user data on session object

for($i=0;$i<5;$i++){
    $post[$i]=new Post();

    $post[$i]->initialise($list[$i]);
    array_push($data,array("posts"=>array(
                array("likes"=>$post[$i]->set_likes(),
                    "img"=>$post[$i]->set_postImage(),
                    "caption"=>$post[$i]->set_caption(),
                    "alt"=>$post[$i]->set_postImageAlt(),
                    "userPic"=>$post[$i]->set_userPic(),
                    "userName"=>$post[$i]->set_userName()),
            )));
}
$action=$_POST['q'];
$postID=$_POST['id'];
$comment=$_POST['comment'];
$category=$_POST['category'];
$search_term=$_POST['search'];
switch($action){
    case 'view_full_post':
        break;
    case 'search':
        break;
    case 'view_category':
        break;
    case 'comment':
         break;
    case 'like':
        break;
    case 'view_more_posts':
        break;
    default:
    break;
}
return json_encode($data);

?>