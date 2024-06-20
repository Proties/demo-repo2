<?php

require_once 'vendor/autoload.php';

$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);
$txt=substr($f_txt,2);

// echo $txt.' \n';
// echo $f_txt;
// return;
$user=new Users();
$post=new Post();
$userDB=new UserDB($user);
$postDB=new PostDB($post);

if($post->validate_postLink($f_txt)==true and $postDB->validate_in_db_postLink($txt)==true){
        $data=[];
        $case=$_POST['action'];
        switch($case){
            case 'initialise_preview':
                echo json_encode($data);
            break;
            case 'get_more_comments':
                $c=new Comment();
                $c->set_id($_POST['commentID']);
                $c->read_more();
                echo json_encode($data);
                break;
            default:
            break;
        }
        $comment=new Comment();
        $comment->set_id();
        $coms=$comment->read_comments();
        $data=array('username'=>$user->get_username(),'comments'=>$coms,'likes'=>443);
        echo json_encode($data);
        return;
   
    
    }
    
elseif($user->validate_username_url($f_txt)==true){
    if($userDB->validate_username_in_database($txt)==true){
        include_once('php/profile.php');
        exit();
    }
    
}else{

}


$action=$_SERVER['REQUEST_URI'];
switch($action){
    case '/test':
        include_once('testForm.php');
        break;
    case '/':
        include_once('php/homePage.php');
        break;
    case '/registration':
        include_once('php/registration.php');
        break;
    case '/profile':
        include_once('php/profile.php');
        break;
    case '/edit_profile':
        include_once('php/editPage.php');
        break;
    case '/upload_post':
        include_once('php/uploadPost.php');
        break;
    default:
        include_once('php/homePage.php');
        break;
}
?>