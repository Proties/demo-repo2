<?php

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/Homepage.html');
    return;
}
include_once('php/database.php');
include_once('post.php');

$user;
$data=array("home"=>"happy");
// store posts and user data on session object

// for($i=0;$i<5;$i++){
//     $post[$i]=new Post();

//     $post[$i]->initialise($list[$i]);
//     array_push($data,array("posts"=>array(
//                 array("likes"=>$post[$i]->set_likes(),
//                     "img"=>$post[$i]->set_postImage(),
//                     "caption"=>$post[$i]->set_caption(),
//                     "alt"=>$post[$i]->set_postImageAlt(),
//                     "userPic"=>$post[$i]->set_userPic(),
//                     "userName"=>$post[$i]->set_userName()),
//             )));
// }

$action=$_POST['action'];
switch($action){
    case 'search':
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