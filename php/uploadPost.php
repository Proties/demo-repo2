<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    $data_f=json_decode($data,true);
    $errorMessages=array();
    $post=new Post();
    $category=new Category();
    $user=new Users();
    $image=new Image();
    $collaborator=new Collaborator();
    $location=new Location();
    $username=$data_f['username'];
    $user->set_username($username);
    try{
        if(empty($_SESSION['username'])){
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
        if(isset($_POST['collaborators'])){}
        if(isset($_POST['location'])){}
        $user->create_user_folder();   
        $data_r=$data_f['img'];
        $img=$data_r['img'];
        $image->set_enoded_base64_string($img);
        $image->set_filePath($user->get_dir());
        $image->make_file();
        $image->get_fileName();

        $base64string=substr($img,strpos($img,',')+1);
        $post->create_post_file();
        
        file_put_contents($user->get_dir().'/'.$post->get_file(),base64_decode($base64string));
        $n=strpos($post->get_file(),'.');
        $post->set_postLinkID(substr($post->get_file(),0,$n));
        $post->set_postLink($user->get_dir().'/'.$post->get_file());
        $post->set_authorID($_SESSION['userID']);

        if(isset($_SERVER['userPosts'])){
            $previewCount=0;
            $i=0;
            $len=count($_SERVER['userPosts']);
            while($previewCount<2 && $i<$len){
                if($userPosts[$i]->get_preview_status()==True){
                    $previewCount++;
                }
               
                $i++;
            }
        
        }

        $post->write_post();
        if($post->get_status()==true){
            $item=array('status'=>'succes');
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