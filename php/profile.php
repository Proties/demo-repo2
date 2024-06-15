<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmlfiles/Personalprofile.html');
    return;
}
$mainUser=new Users();
if(isset($_SERVER['userID']) && $_SERVER['userID']!==null){
    $mainUser->set_userID($_SERVER['userID']);
    $mainUser->set_username($_SERVER['username']);
    $mainUserDB=new UserDB();
    $mainUserDB->read_user();
}
$userPosts=array();

$action=$_POST['action'];
switch($action){
    case 'initialise_user':
        $data=array();
        $link=substr($_SERVER['REQUEST_URI'],2);

        $author=new Users();
        
        if(($author->validate_username_url($_SERVER['REQUEST_URI'])==true) && (Users::validate_username_in_database($link)==true)){
            $author->set_username($link);
            $authorDB=new UserDB($author);
            $authorDB->read_userID();
            $authorDB->read_user();
        if(!is_array($)){
            echo json_encode($data);
            return;
        }
        $data['user'][0]=array('username'=>$authorDB->$author->get_username(),'userProfilePicture'=>$authorDB->$author->get_profilePicture(),
                            'bio'=>$authorDB->$author->get_bio(),'post'=>array());
        $post=new Post();
       
        $post->set_authorID($authorDB->$author->get_id());
        $postDB=new PostDB();
        $p=$postDB->read_posts();
        
        $info=$post->get_posts();
        $lenArr=count($info);
        if($lenArr==0){

            echo json_encode($data);
            return ;
        }
       
        
        
        for ($i = 0; $i < $lenArr; $i++) {
            $postItem = new Post();
            $image=new Image();
            $postItem->set_postID($info[$i]['postID']);
            $postItem->set_postLink($info[$i]['postLink']);
            $image->set_filePath($info[$i]['filePath']);
            $f=file_get_contents($image->get_fileName());

            $data['post'][$i] = array(
                'postLink' => $postItem->get_postLink(),
                'img' => $postItem->get_filePath().$postItem->get_fileName()
            );
        }
        echo json_encode($data);
        return;
    }else{
        echo 'no user profile';
        return;
    }
        
        break;
    case 'initialise_post_preview':
        $post=new Post();
        if($post->validate_postLink()){
            $post->set_postLink($_SERVER['REQUEST_URI']);
            $postDB=new PostDB($post);
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
        $data=array("cpation"=>$post->get_caption(),"categoryName"=>$category->get_categoryName(),
                    "img"=>$post->get_filePath().$post->get_fileName(),"previewStatus"=>$post->get_preview_status());
        echo json_encode($data);
        break;
    case 'create_custom_profile':
        break;
}
?>