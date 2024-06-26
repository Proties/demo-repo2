<?php
session_start();
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
                    $post->get_collaboratorList()->add_collaborator($collab);
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
        $post->set_authorID($_SESSION['userID']);
        $data_r=$data_f['img'];
        $img=$data_r['img'];
        $post->image->set_enoded_base64_string($img);
        $post->image->set_filePath($user->get_dir());
        $status=$user->get_postList()->add_post($post);
        if(is_array($status)){
            $errorMessages=$status['errorMessages'];
            throw new Exception('could not add post');
        }
        $data['status']='success';
        echo json_encode($data);
        $db->commit();
    }catch(Exception $err){
        $db->rollBack();
        //rollback
        $item=array('status'=>'failed','msg'=>$err->getMessage(),'errorArray'=>$errorMessages);
        echo json_encode($item);
        return;
    }
}

?>