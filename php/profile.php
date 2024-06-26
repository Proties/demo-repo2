<?php
session_start();
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Users\Users;
use Users\UserDB;
use Posts\Post;

$log=new Logger('start');
$log->pushHandler(new StreamHandler('php/file.log',Level::Warning));

$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);

$u=new Users();
$udb=new UserDB($u);
if($f_txt==='/profile'){
   setcookie('profile','no account', time() - (86400 * 30), '/'); 
}
if($u->validate_username_url($f_txt)==true ){
    try{
    $f_txt=substr($f_txt,2);
    $link=$f_txt;
    $data=[];
    $userPosts=array();
    $author=new Users();
    $authorDB=new UserDB($author);
    $author->set_username($link);
    $authorDB->user->set_username($author->get_username());
    $authorDB->read_userID();
    $authorDB->read_user();
    $data['user'][0]=array('username'=>$authorDB->user->get_username(),'userProfilePicture'=>$authorDB->user->get_profilePicture(),
                                'bio'=>$authorDB->user->get_bio());
    $post=new Post();
    $post->set_authorID($authorDB->user->get_id());
    $postDB=new PostDB($post);
    $postDB->read_posts();
    $info=$postDB->post->get_posts();
    $lenArr=count($info);
    for ($i = 0; $i < $lenArr; $i++) {
                $postItem = new Post();
                $postItem->set_postID($info[$i]['postID']);
                $string=$info[$i]['postLink'];
                $path=substr($string,0,strpos($string, '/'));
                $name=substr($string,strpos($string,'/'));
                $postItem->image->set_filePath($path);
                $postItem->image->set_fileName($name);
                $data['posts'][$i] = array(
                    'postID' => $postItem->get_postID(),
                    'img' => $postItem->image->get_filePath().$postItem->image->get_fileName()
                );
            }
    setcookie('profile',json_encode($data), time() + (86400 * 30), '/'); 
    }catch(Exception $err){
        $log->Warning($err->getMessage());
    }
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Personalprofile.html');
    return;
}


switch($action){
    case 'initialise_user':
        $data=array();
        $link=substr($_SERVER['REQUEST_URI'],2);
        $link=urldecode($link);
        $author=new Users();
        $authorDB=new UserDB($author); 
        if((Users::validate_username_url($_SERVER['REQUEST_URI'])==true) && ($authorDB->validate_username_in_database($link)==true)){

            // var_dump($link);
            // return
            $author->set_username($link);
            $authorDB->user->set_username($author->get_username());
            $authorDB->read_userID();
            $authorDB->read_user();

        $data['user'][0]=array('username'=>$authorDB->user->get_username(),'userProfilePicture'=>$authorDB->user->get_profilePicture(),
                            'bio'=>$authorDB->user->get_bio());
        $post=new Post();
       
        $post->set_authorID($authorDB->user->get_id());
        $postDB=new PostDB($post);
        $p=$postDB->read_posts();
        
        $info=$post->get_posts();
        $lenArr=count($info);
        if(!is_array($info)){
            echo 'error';
            // echo json_encode($data);
            return ;
        }      
        for ($i = 0; $i < $lenArr; $i++) {
            $postItem = new Post();
            $postItem->set_postID($info[$i]['postID']);
            $string=$info[$i]['postLink'];
            $path=substr($string,0,strpos($string, '/'));
            $name=substr($string,strpos($string,'/'));
            $postItem->image->set_filePath($path);
            $postItem->image->set_fileName($name);
            $data['posts'][$i] = array(
                'postID' => $postItem->get_postID(),
                'img' => $postItem->image->get_filePath().$postItem->image->get_fileName()
            );
        }
        echo json_encode($data);
        return;
    }else{
        $data['status']='no user profile';
        echo json_encode($data);
        return;
    }
        
        break;
    case 'initialise_post_preview':
        $post=new Post();
        $post->set_postLink($_SERVER['REQUEST_URI']);
        $postDB=new PostDB($post);
        $link=$_SERVER['REQUEST_URI'];
        if($post->validate_postLink($link) && $postDB->validate_post($link)){
            $postDB->read_postID();
            $postDB->read_post();
        }
        
        $data=array(
        'authorName'=>$postDB->$post->get_authorName(),
        'caption'=>$postDB->$post->get_caption(),
        'img'=>$postDB->$post->get_filePath().$post->get_fileName(),
        'comments'=>$postDB->$post->get_comments(),
        'postID'=>$postDB->$post->get_id()
        );
        echo json_encode($data);
        break;

    case 'edit_post':
        if(!$mainUser->is_authenticated()){
            $msg='user not registered';
            echo $msg;
            return;
        }
        $postID=$_POST['postID'];
        $post=new Post();
        $post->set_id($postID);
        $postDB=new PostDB($post);
        $postDB->read_post();
        $data=array("cpation"=>$post->get_caption(),"categoryName"=>$category->get_categoryName(),
                    "img"=>$post->get_filePath().$post->get_fileName(),"previewStatus"=>$post->get_preview_status());
        echo json_encode($data);
        break;
    case 'create_custom_profile':
        break;
}
?>