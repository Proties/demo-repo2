<?php
session_start();
use Insta\Posts\Post;
use Insta\Databases\Post;
use Insta\Databases\User;
use Insta\Users\Users;
use Insta\Users\UserFile;
use Insta\Categories\Category;
use Insta\Databases\Category;
use Insta\Collaborators\Collaborator;
use Insta\Databases\Collaborator;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
    $errorMessages=[];
    $post=new Post();
    $category=new Category();
    $user=new Users();

    $username=$data_f['username'];
    $user->set_username($username);
    $database=new Database();
    $db=$database->get_connection();
    try{
        $db->begin_transaction();
        //start transaction 
        if($user->get_auth()->is_authanticated()){
            throw new Exception('create an account');
        }
        if(isset($_POST['collaborators'])){
           if (is_array($_POST['collaborators'])){
                $lenCol=count($_POST['collaborators']);
                for($i=0;$i<$lenCol;$i++){
                    $collab=new Collaborator();
                    $collab->set_userID();
                    $status=$post->get_collaboratorList()->add_collaborator($collab);
                }
            }
            
        }
        if(isset($_POST['location'])){
            $post->get_location()->set_local($_POST['location']);
            $post->set_location()->add_location();
        }
        $post->set_caption($data_f['caption']);
        $post->set_preview_status($data_f['preview_status']);
        $category->set_name($data_f['categoryName']);
        $categoryDB=new CategoryDB($category);
        $categoryDB->write_category();
        $categoryDB->write_category_posts();
        $post->set_authorID($_SESSION['userID']);
        $data_r=$data_f['img'];
        $img=$data_r['img'];
        $post->image->set_enoded_base64_string($img);
        $post->image->set_filePath($user->get_dir());
        $status=$user->get_postList()->add_post($post);
        $data['post']=json_encode($user->get_postList()->get_last_added()->get_data());
        $data['status']='success';
        echo json_encode($data);
        $db->commit();
    }catch(ErrorObjectList $err){
        $db->rollBack();
        //rollback
        $item=array('status'=>'failed','msg'=>$err->getMessage(),'errorArray'=>$errorMessages);
        echo json_encode($item);
        return;
    }
}

?>