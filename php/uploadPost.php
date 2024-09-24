<?php
session_start();
use Insta\Posts\Post;
use Insta\Databases\Database;
use Insta\Databases\Post\PostDB;
use Insta\Databases\User;
use Insta\Users\Users;
use Insta\Users\UserFile;
use Insta\Images\Image;
use Insta\Databases\Images\ImageDB;
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
    
    $post->set_caption($data_f['caption']);
    try{
        $db->beginTransaction();
        if($data_f['userID']=='' || empty($data_f['username'])){
                throw new Exception('create an account');
        }
        $user->set_username($data_f['username']);
        $user->set_id($data_f['userID']);
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

            if($post->validate_caption($data_f['caption'])==false){
                $errorMessages=array('errcaption'=>'not valid caption');
            }
            if($category->validate_name($data_f['categoryName'])==false){
                $errorMessages=array('errCategoryName'=>'not valid category name');
            }
            if(count($errorMessages)>1){
                throw new Exception('could not create post');
            }
            if($user->get_username()==''){
                throw new Exception('no username');
            }
            // check if user folder is present if not create new folder
            if($user->userFolder->get_dir()==null){
                  $user->userFolder->create_user_folder($user->get_username());   
            }
        
            $image->file->make_filename();
            $img=$data_f['img'];
            $base64string=substr($img,strpos($img,',')+1);
       
            $user->userFolder->set_folderName($user->get_username());
            $removed_mime=substr($img,strrpos($img,',')+1);
            
            $decode_string=base64_decode($removed_mime);
            file_put_contents($user->userFolder->get_dir().'/'.$image->file->get_fileName(),$decode_string);

            $post->set_postLinkID($image->file->get_postLinkID());
            $post->set_postLink('/@'.$user->get_username().'/'.$image->file->get_postLinkID());
            $post->set_authorID($user->get_id());
            
          
            $postDB=new PostDB($post);
            $postDB->set_db($db);
            $postDB->write_post();
            if($postDB->post->get_postID()==null){
                throw new Exception('post id not defined');
            }
            if(isset($data_f['location'])){
            $post->location->set_local($data_f['location']);
            $locationDB=new locationDB($post->location);
            $locationDB->set_db($db);
            $locationDB->write_location();
            $locationDB->write_locationPost($postDB->post->get_postID());
            }

            if(isset($data_f['collaborators'])){
                    $lenCol=count($data_f['collaborators']);
                    $usernames=$data_f['collaborators'];
                    
                    for($i=0;$i<$lenCol;$i++){
                        $userid=$userDB->get_userID_from_username($usernames[$i]);
                        $collab=new Collaborator();
                        $collab->set_userID($userid['userID']);
                        $collab->set_postID($postDB->post->get_postID());
                        $collabDB=new CollaboratorDB($collab);
                        $collabDB->set_db($db);
                        $collabDB->write_collaborator();
                       
                }
                
            }
            $category->set_categoryName($data_f['categoryName']);
            $categoryDB=new CategoryDB($category);
            $results=$categoryDB->search_category();
            if(is_array($results)){
                //get category id
                $categoryDB->set_db($db);
                $categoryDB->write_category_post($postDB->post->get_postID());
            }
            else{
                $categoryDB->set_db($db);
                $categoryDB->write_category();
                $categoryDB->write_category_post($postDB->post->get_postID());
            }
            $img=$data_f['img'];
            // $image->set_enoded_base64_string($img);
            // $image->file->set_filePath($user->get_dir());
            $imageDB=new ImageDB($image);
            $imageDB->set_db($db);
            $imageDB->write_image();
            $imageDB->write_image_post($postDB->post->get_postID());
            $data['status']='success';
            echo json_encode($data);
            $db->commit();
            
            return;
    }catch(Exception $err){
        $db->rollBack();
        //rollback
        $item=array('status'=>'failed','msg'=>$err->getMessage(),'trace'=>$err->getTraceAsString(),'errorArray'=>$errorMessages);
        echo json_encode($item);
    }


}
?>