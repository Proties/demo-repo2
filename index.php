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

// var_dump($txt);
// return ;
if($post->validate_postLink($f_txt)==true){
    // if($postDB->validate_in_db_postLink($txt)==true){
        $data=[];
        $cs;
        if(isset($_POST['action'])){
           $cs=$_POST['action']; 
        
        
        switch($cs){
            case 'initialise_preview':
                echo 'works';
                return;
            break;
            case 'get_more_comments':
                $c=new Comment();
                $c->set_id($_POST['commentID']);
                $c->read_more();
                echo json_encode($data);
                break;
            default:
                echo 'things just works';
            break;
        }
    }
        $postDB=new PostDB();
        $comment=new Comment();
        $comment->set_id();
        $comment->set_postID();
        $commentDB=new CommentDB($comment);
        $arrayComment=$commentDB->read_comments();
        $len=count($arrayComment);
        for($c=0;$c<$len;$c++){
            $user->set_username($arrayComment[$c]['username']);
            $comment->set_commentID($arrayComment[$c]['commentID']);
            $comment->set_comment($arrayComment[$c]['comment']);
            $data['comments'][$c]=array('username'=>$user->get_username(),'comment'=>$comment->get_comment());
        }
        $data=array('status'=>'success');
        echo json_encode($data);
        var_dump($data);
        return;
   
    

// }
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