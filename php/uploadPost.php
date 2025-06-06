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
use Insta\Video\Video;
use Insta\Database\Video\VideoDB;

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');
// use Insta\Pool\ProfilePool;


/*
this function will check if profile is in pool if it is it will append the post to the post array 
if the post array exceeds 10 the last post will be pushed out
*/


// function profileInPool(){
//     $mainUser=new Users();
//     $mainUser->set_id($_SESSION['userID']);
//     $status=$profilesPool->search_item($mainUser);
//     if($status==false){
//         return false;
//     }else{
//         return true;
//     }
// }
function is_image_created(string $dir,string $filename){
     // search $dir for $filename if found return true else return false
    try{
        $files=scandir($dir);
        foreach ($files as $fils) {
            if($files==$filename){
                return true;
            }

        }
        return false;
    }catch(Exception $err){
        return false;
    }
   
    
}
function is_video_created(string $dir,string $filename){
     // search $dir for $filename if found return true else return false
    try{
        $files=scandir($dir);
        foreach ($files as $fils) {
            if($files==$filename){
                return true;
            }
        }
        return false;
    }catch(Exception $err){
        return false;
    }
   
    
}
if($_SERVER['REQUEST_METHOD']=='POST'){
   
    $errorMessages=[];
    $post=new Post();
    $data=[];

    $user=new Users();
    $database=new Database();
    $db=$database->get_connection();
    $image=new Image();
    $video=new Video();
    try{
        $db->beginTransaction();
        if(empty($_SESSION['userID'])  OR !isset($_SESSION['userID'])){
            throw new Exception('create an account');
        }
        $user->set_username($_SESSION['username']);
        $user->set_id($_SESSION['userID']);
        $post->set_caption($_POST['post-caption']);

        $errorMessages=[];
            if(isset($_FILES['image']) OR isset($_FILES['video'])){
                $errorMessages=array('errImage'=>'no image');
            }

            if($post->validate_caption($_POST['post-caption'])==false){
                $errorMessages=array('errcaption'=>'not valid caption');
            }
      
            if(count($errorMessages)>1){
                throw new Exception('could not create post');
            }
            if(empty($_SESSION['userID']) OR empty($_SESSION['username'])){
                throw new Exception('no username no account');
            }
            $user->userFolder->set_folderName($user->get_username());
            // check if user folder is present if not create new folder
            if($user->userFolder->get_dir()==null){
                  $user->userFolder->create_user_folder($user->get_username());   
            }
            $id=$post->make_filename();

            $post->set_postLinkID($id);
            $post->set_postLink('/@'.$user->get_username().'/'.$id);
            $post->set_authorID($user->get_id());
            
          
            $postDB=new PostDB($post);
            $postDB->set_db($db);
            $postDB->write_post();
            if($postDB->post->get_postID()==null){
                throw new Exception('post id not defined');
            }
            // $video->set_postID($postDB->post->get_postID());
            if(isset($_FILES['image'])){
                $image->set_imageName('image');
                $image->set_postLinkID($id);

                $image->make_fileExtension();
                $file=$id.$image->get_fileExtension();
                $image->set_filename($file);
                $image->set_filePath($user->userFolder->get_dir());
                $image->set_imageName('image');
                
                // if(is_image_created($user->userFolder->get_dir(),$image->get_filename())==false){
                //     throw new Exception('image was not created');
                // }
                $imageDB=new ImageDB($image);
                $imageDB->set_db($db);
                $imageDB->write_image();
                $imageDB->write_image_post($postDB->post->get_postID());
                $data['data']=['postID'=>$imageDB->image->get_postID(),'filename'=>$imageDB->image->get_filename(),
                'filepath'=>$imageDB->image->get_filepath(),'postLink'=>$imageDB->image->get_postLink()];
                $imageUpload=$image->load_image();
                if(is_array($imageUpload)){
                    throw new Exception($imageUpload['errorMessage']);
                }
                
            }
            if(isset($_FILES['video'])){
                $video->set_postLinkID($id);
                $video->set_videoName('video');
                $video->make_fileExtension();
                $file=$video->get_postLinkID().$video->get_fileExtention();
                $video->set_filename($file);

                $video->set_filepath($user->userFolder->get_dir());
                $video->set_videoName('video');
                $videoUpload=$video->load_video();
                
                // if(is_video_created($user->userFolder->get_dir(),$video->get_filename())==false){
                //     throw new Exception('video could not be created');
                // }
                $videoDB=new VideoDB($video);
                $videoDB->set_db($db);

                $videoDB->write_video();
                $videoDB->write_video_post($postDB->post->get_postID());
                $data['data']=['postID'=>$videoDB->video->get_postID(),'filename'=>$videoDB->video->get_filename(),
                'filepath'=>$videoDB->video->get_filepath()];
                if(is_array($videoUpload)){
                    throw new Exception($videoUpload['errorMessage']);
                }

            }
            $data['status']='success';
            setcookie('postUploadStatus',json_encode($data), time() + (864 * 30), '/'); 
            $db->commit();
    }catch(Exception $err){
        $db->rollBack();
        //rollback
        $data['status']='failed';
        $data['message']=$err->getMessage();
        $data['trace']=$err->getTraceAsString();
        $data['errorArray']=$errorMessages;
        setcookie('postUploadStatus',json_encode($data), time() + (864 * 30), '/'); 
        
        
    }

    
    header('Location: /profile');
    die();
}
?>