<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
    $errorMessages=array();
    $post=new Post();
    $category=new Category();
    $user=new Users();
    $username=$data_f['username'];
    $user->set_username($username);
    try{
        if(!isset($_SESSION['username'])){
            throw new Exception('create account');
        }
        
        // $post->set_caption($data_f['caption']);
        // $post->set_preview_status($data_f['preview_status']);
        // $category->set_name($data_f['categoryName']);
        // $post->set_author($_SESSION['userID']);

        // if($post->validate_caption($data_f['caption'])==false){
        //     $errorMessages=array('errcaption'=>'not valid caption');
        // }
        // if($post->validate_preview_status($data_f['preview_status'])==false){
        //     $errorMessages=array('errcaption'=>'not valid caption');
        // }
        // if($category->validate_name($data_f['categoryName'])==false){
        //     $errorMessages=array('errcaption'=>'not valid caption');
        // }
        // if(count($errorMessages)>1){
        //     throw new Exception('could not create post');
        // }
        $user->create_user_folder();
        
        $data_r=$data_f['img'];
        $img=$data_r['img'];
   
        $username=$data_f['username'];
        print_r($data_f['username']);
        
        $image=base64_decode($img);
        $post->create_post_file();
        // if(!isset($_SESSION['username']) or $_SESSION['username']==''){
        //     throw new Execption('username not defined');
        // }
        
        $f=fopen($user->get_dir().'/'.$post->get_file(),'w');
        fwrite($f,$image);
        fclose($f);
        $user->add_image_to_profile($image);
        return;
        if($user->is_user_profile_present()==false){
            throw new Exception('user profile not aviable');
        }
        
        $post->write_post();
        if($post->get_status()==true){
            $item=array('status'=>'succes','post'=>$post->get_data());
            echo json_encode($item);
            return;
        }
        throw new Exception('could not create post');
    }catch(Exception $err){
        $item=array('status'=>'failed','msg'=>$err->getMessage(),'errorArray'=>$errorMessages);
        echo json_encode($item);
        return;
    }
}

?>