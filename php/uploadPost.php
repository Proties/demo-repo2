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
use Insta\Databases\Video\VideoDB;



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
    $video=new Video();
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

            if($post->validate_caption($_POST['caption'])==false){
                $errorMessages=array('errcaption'=>'not valid caption');
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
        

            $post->set_postLinkID($image->file->get_postLinkID());
            $post->set_postLink('/@'.$user->get_username().'/'.$image->file->get_postLinkID());
            $post->set_authorID($user->get_id());
            
          
            $postDB=new PostDB($post);
            $postDB->set_db($db);
            $postDB->write_post();
            if($postDB->post->get_postID()==null){
                throw new Exception('post id not defined');
            }
            if(isset($_FILES['image'])){
                $image->load_image();
                $imageDB=new ImageDB($image);
                $imageDB->set_db($db);
                $imageDB->write_image();
                $imageDB->write_image_post($postDB->post->get_postID());
            }
            if(isset($_FILES['video'])){
                $video->load_video();
                $videoDB=new VideoDB($video);
                $videoDB->set_db($db);
                $videoDB->write_video();
                $videoDB->write_video_post($postDB->post->get_postID());

            }
            $data['status']='success';
            $db->commit();
    
            // setcookie('uploadPost',json_encode($data), time() +(86400 * 1), '/profile');
            // echo json_encode($data);
            header('Content-Type: application/json');
            echo json_encode($data);

    }catch(Exception $err){
        $db->rollBack();
        //rollback
        $data['status']='failed';
        $data['message']=$err->getMessage();
        $data['trace']=$err->getTraceAsString();
        $data['errorArray']=$errorMessages;
        
        // header('Location: '.$_SERVER['PHP_SELF']);
        header('Content-Type: application/json');
        echo json_encode($data);
        
    }
}
?>