<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
   
    $post=new Post();
    $category=new Category();
    $user=new Users();

    $username=$data_f['username'];
    $user->set_username($username);
    try{
        if($user->get_auth()->is_authanticated()){
            throw new Exception('create an account');
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
        if($status==false){
            throw new Exception('could not add post on user post list');
        }
    }catch(Exception $err){
        $item=array('status'=>'failed','msg'=>$err->getMessage(),'errorArray'=>$errorMessages);
        echo json_encode($item);
        return;
    }
}

?>