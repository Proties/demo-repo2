<?php
session_start();
use Insta\Posts\Post;
use Insta\Databases\Database;
use Insta\Databases\PostDB;
use Insta\Databases\User;
use Insta\Users\Users;
use Insta\Users\UserFile;
use Insta\Categories\Category;
use Insta\Databases\CategoryDB;
use Insta\Collaborators\Collaborator;
use Insta\Databases\CollaboratorDB;
use Insta\Databases\ImageDB;
use Insta\Images\Image;
use Insta\Location\location;
use Insta\Databases\Location\locationDB;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
    $errorMessages=[];
    $post=new Post();
    $category=new Category();
    $user=new Users();
    $database=new Database();
    $db=$database->get_connection();
    $image=new Image();
    $username;
    $db->beginTransaction();
    try{
        if($data_f['userID']=='' || empty($data_f['username'])){
                throw new Exception('create an account');
        }
        $username=$data_f['username'];
       
        // if(isset($_SESSION['userID'])){
        //     $user->set_username($_SESSION['username']);
        //     $user->set_id($_SESSION['userID']);
        //     $user->userAuth->set_authanticated(true);
        //     $username=$_SESSION['username'];

        // }
        // if($user->userAuth->is_authanticated()==false){
        //     throw new Exception('create an account');
        // }
        $data=[];
        $errorMessages=[];
            if($data_f['img']==''){
                $errorMessages=array('errImage'=>'no image');
            }

            if($post->validate_caption($post->get_caption())==false){
                $errorMessages=array('errcaption'=>'not valid caption');
            }
            if($category->validate_name($category->get_categoryName())==false){
                $errorMessages=array('errCategoryName'=>'not valid category name');
            }
            if(count($errorMessages)>1){
                throw new Exception('could not create post');
            }
            // check if user folder is present if not create new folder
            if(is_dir('userProfiles/'.$username)){

            }else{
                $user->create_user_folder();   
            }
            
            $image->file->make_file();
            $image->file->get_fileName();
            $base64string=substr($img,strpos($img,',')+1);
            $post->create_post_file();
            
            file_put_contents($user->get_dir().'/'.$post->get_file(),base64_decode($base64string));
            $n=strpos($post->get_file(),'.');
            $post->set_postLinkID(substr($post->get_file(),0,$n));
            $post->set_postLink($user->get_dir().'/'.$post->get_file());
            $post->set_authorID($_SESSION['userID']);
            $post->set_caption($data_f['caption']);
            $post->set_preview_status($data_f['preview_status']);
            $postDB=new PostDB($post);
            $postDB->set_db($db);
            $postDB->write_post();

             if(isset($data_f['location'])){
            $post->location->set_local($data_f['location']);
            $locationDB=new locationDB($post->location);
            $locationDB->set_db($db);
            $locationDB->write_location();
            $locationDB->write_locationPost($postDB->post->get_id());
            }

            if(isset($data_f['collaborators'])){
                if (is_array($data_f['collaborators'])){
                    $lenCol=count($data_f['collaborators']);
                    for($i=0;$i<$lenCol;$i++){
                        $collab=new Collaborator();
                        $collabDB=new CollaboratorDB();
                        $collabDB->set_db($db);
                        $collabDB->write_collaborator();
                        $collabDB->write_collaboratorUser($postDB->post->get_id());
                        $collab->set_userID();
                        $status=$post->get_collaboratorList()->add_collaborator($collab);
                    }
                }
                
            }
            $category->set_name($data_f['categoryName']);
            $categoryDB=new CategoryDB($category);
            $categoryDB->set_db($db);
            $categoryDB->write_category();
            $categoryDB->write_category_posts($postDB->post->get_id());
            $data_r=$data_f['img'];
            $img=$data_r['img'];
            $image->set_enoded_base64_string($img);
            $image->set_filePath($user->get_dir());
            $imageDB->set_db($db);
            $imageDB->write_image();
            $imageDB->write_image_post();
            $status=$user->get_postList()->add_post($post);
            $data['post']=json_encode($user->postList->get_last_added()->get_data());
            $data['status']='success';
            
            $db->commit();
            echo json_encode($data);
            return $data;
    }catch(Exception $err){
        $db->rollBack();
        //rollback
        $item=array('status'=>'failed','msg'=>$err->getMessage(),'errorArray'=>$errorMessages);
        echo json_encode($item);
        return;
    }


}
?>