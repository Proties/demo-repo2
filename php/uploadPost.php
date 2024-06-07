<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=file_get_contents('php://input');
    json_decode($data,true);
    $errorMessages=array();
    $post=new Post();
    $category=new Category();
    try{

        
        $post->set_caption();
        $post->set_preview_status();
        $category->set_name();
        $post->set_author($_SERVER['userID']);

        if($post->validate_caption()==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if($post->validate_caption()==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if($post->validate_caption()==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if(count($errorMessages)>1){
            throw new Exception('could not create post');
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