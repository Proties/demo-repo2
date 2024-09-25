<?php
session_start();
use Monolog\Handler\StreamHandler;
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Databases\Post\PostDB;
use Insta\Template\Template;
use Insta\Template\HtmlTemplate;
use Insta\Database\Template\TemplateDB;

$mainUser=new Users();
$template=new Template();
if(isset($_SESSION['username']) && $_SESSION['username']!==null){
    $mainUser->userAuth->set_authanticate(true);
}
$f_txt=$_SERVER['REQUEST_URI'];
$f_txt=urldecode($f_txt);

$u=new Users();
$udb=new UserDB($u);
$tempdb;

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
        if(($arr==null) || ($arr[0]['filename']==null)){
            $data['posts']=$arr;

        }else{
        $lenArr=count($arr);
        for ($i = 0; $i < $lenArr; $i++) {
            $postItem = new Post();
            $postItem->set_postID($arr[$i]['postID']);
            $filename=$arr[$i]['filename'];
            $path=$arr[$i]['filepath'];
            $postItem->get_image()->file->set_filePath($path);
            $postItem->get_image()->file->set_fileName($filename);
            $data['posts'][$i] = array(
                'filename' => $postItem->get_postID(),
                'img' => $postItem->get_image()->file->get_filePath().$postItem->get_image()->file->get_fileName()
            );
        }
        }
        $tempdb=new TemplateDB($template);
        $list=$tempdb->getTemplateList();
        if(is_array($list)){
            $data['templateList']=$list;
        }
        else{
             $data['templateList']=[];
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
    case 'delete_template':
        break;
    case 'get_template_list':
        $tempdb=new TemplateDB($template);
        $list=$tempdb->getTemplateList();

        echo json_encode($list);
        break;
    case 'loadTemplate':
        $filename=$_POST['filename'];
        $htmlData=$_POST['htmlData'];

        $uploadDir='./templates';
        try{
            $uploadDirDestination=$uploadDir.'/'.$filename;
            if(file_exists($uploadDirDestination)){
                throw new Exception('File already exists');
            }
            $file=fopen($uploadDirDestination,'x');
            fclose($file);

            file_put_contents($uploadDirDestination, $htmlData);
            $data=['status'=>'succes'];
            $template->set_filename($filename);
            $tempdb=new TemplateDB($template);
            $tempdb->addTemplate();
            echo $data;
        }catch(Exception $err){
           
            $data=['status'=>'failed','error'=>$err->getMessage()];
            echo json_encode($data);

        }
        
        
        break;
    case 'selectTemplate':
        $name='./templates/Personalprofile.html';
        $htmlTemplate=new HtmlTemplate($name);
        $data=$htmlTemplate->getContainer();

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