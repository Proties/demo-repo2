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

// use Insta\Challenge\Challenge;
// use Insta\Database\Challenge\ChallengeDB;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
    $errorMessages=[];
    $post=new Post();
    $data=[];
    // $challenge=new Challenge();
    $user=new Users();
    $database=new Database();
    $db=$database->get_connection();
    $image=new Image();
    try{
        $db->beginTransaction();
        if(empty($_SESSION['userID'])  OR empty($_SESSION['username'])){
            throw new Exception('create an account');
        }
        $user->set_username($_SESSION['username']);
        $user->set_id($_SESSION['userID']);
        $post->set_caption($_POST['caption']);

        
       
     

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

            if(isset($data_f['challengeTag'])){
                $challenge->set_challengeTag($data_f['challengeTag']);
                $challengeDB=new ChallengeDB($challenge);
                $challengeDB;
            }
        
            $img=$data_f['img'];
            // $image->set_enoded_base64_string($img);
            // $image->file->set_filePath($user->get_dir());
            $imageDB=new ImageDB($image);
            $imageDB->set_db($db);
            $imageDB->write_image();
            $imageDB->write_image_post($postDB->post->get_postID());
            $data['status']='success';
            $db->commit();
            echo json_encode($data);
    }catch(Exception $err){
        $db->rollBack();
        //rollback
        $item=array('status'=>'failed','msg'=>$err->getMessage(),'trace'=>$err->getTraceAsString(),'errorArray'=>$errorMessages);
        echo json_encode($item);
    }
}
?>