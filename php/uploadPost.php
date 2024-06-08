<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
    $errorMessages=array();
    $post=new Post();
    $category=new Category();
    try{

        
        $post->set_caption($data_f['caption']);
        $post->set_preview_status($data_f['preview_status']);
        $category->set_name($data_f['categoryName']);
        $post->set_author($_SESSION['userID']);

        if($post->validate_caption($data_f['caption'])==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if($post->validate_preview_status($data_f['preview_status'])==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if($category->validate_name($data_f['categoryName'])==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if(count($errorMessages)>1){
            throw new Exception('could not create post');
        }
        $data=$data_f['img'];
        $image=base64_decode($data);
        $post->create_post_file();
        $f->open($post->get_file(),'w');
        fwrite($f,$data);
        fclose($f);
        $user->add_image_to_profile($image);
        if($user->is_user_profile_present()==false){
            throw new Exception('user profile not aviable');
        }
        
        $post->write_post();
        if($post->get_status()==true){
            $data=array('status'=>'succes','post'=>$post->get_data());
            echo json_encode($data);
            return;
        }
        throw new Exception('could not create post');
    }catch(Exception $err){
        $data=array('status'=>'failed','msg'=>$err->getMessage(),'errorArray'=>$errorMessages);
        echo json_encode($data);
        return;
    }
}

?>