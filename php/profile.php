<?php
session_start();
use Monolog\Handler\StreamHandler;
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Databases\Post\PostDB;
use Insta\Template\Template;
use Insta\Database\Template\TemplateDB;

$mainUser=new Users();

if(isset($_SESSION['username']) && $_SESSION['username']!==null){
    $mainUser->userAuth->set_authanticate(true);
}
$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);

$u=new Users();
$udb=new UserDB($u);
$tempdb;
$htmlTemplate=new Template();
if($f_txt==='/profile'){
    $data;
   setcookie('profile','no account', time() - (86400 * 30), '/'); 
}
else if($u->validate_username_url($f_txt)==true ){
    try{
        $txt=substr($f_txt,2);
        $link=$txt;
        $data=[];
        $userPosts=array();
        $author=new Users();
        echo
        $author->set_username($link);
        $authorDB=new UserDB($author);
        $authorDB->get_posts_with_username();
       
        $data['user'][0]=array('username'=>$authorDB->user->get_username(),'userProfilePicture'=>$authorDB->user->get_profilePicture(),
                                    'bio'=>$authorDB->user->get_bio());

        $arr=$authorDB->user->postList->get_posts();
        if(!is_array($arr)){
            throw new Exception('not array');
        }
        if(($arr==null) || ($arr[0]==null) || ($arr[0]['postLink']==null)){
            $data['posts']=array();

        }else{
        $lenArr=count($arr);
        for ($i = 0; $i < $lenArr; $i++) {
            $postItem = new Post();
            $postItem->set_postID($arr[$i]['postID']);
            $string=$arr[$i]['postLink'];
            $path=substr($string,0,strpos($string, '/'));
            $name=substr($string,strpos($string,'/'));
            $postItem->get_image()->set_filePath($path);
            $postItem->get_image()->set_fileName($name);
            $data['posts'][$i] = array(
                'postID' => $postItem->get_postID(),
                'img' => $postItem->get_image()->get_filePath().$postItem->get_image()->get_fileName()
            );
        }
        }
        setcookie('profile',json_encode($data), time() + (86400 * 30), '/'); 
    }catch(Exception $err){
        echo $err->getMessage();
        // echo 'error retriveing posts';
       echo $err->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Personalprofile.html');
    return;
}

$action=$_POST['actions'];
switch($action){
    case 'view_post':
        break;
    case 'delete_post':
        break;
    case 'loadTemplate':

        $htmlTemplate->set_owner();
        $htmlTemplate->set_name();
        $htmlTemplate->set_id();
        $htmlTemplate->set_dateMade();
        $htmlTemplate->set_timeMade();
        $htmlTemplate->set_directory();
        $htmlTemplate->set_html();
        $htmlTemplate->set_css();
        $tempdb=new TemplateDB($htmlTemplate);
        $tempdb->addTemplate();
        break;
    case 'selectTemplate':
        $name=$_POST['templateName'];
        $htmlTemplate->set_name($name);
        ;
        $data=['newTemplate'=>'','templateName'=>$htmlTemplate->get_name()];
        echo json_encode($data);
        break;
    case 'edit_post':
        $data=[];
        try{
            if($mainUser->get_auth()->is_authenticated()==false){
                throw new Exception('user not registered');
            }
            if(!isset($_POST['postID'])){
                throw new Exception('post id not set');
            }
            $postID=$_POST['postID'];
            $post=new Post();
            $post->set_id($postID);
            $postDB=new PostDB($post);
            $postDB->read_post();
            $data=array("cpation"=>$post->get_caption(),"categoryName"=>$category->get_categoryName(),
                        "img"=>$post->get_filePath().$post->get_fileName(),"previewStatus"=>$post->get_preview_status());
            echo json_encode($data);
        }catch(Exception $err){
            $log->Warning($err->getMessage());
            $data['status']='failed';
            $data['message']=$err->getMessage();
            echo json_encode($data);
        }
        break;
    
}
?>