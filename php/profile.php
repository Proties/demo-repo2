<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='GET'){
    include_once('Htmls/Personalprofile.html');
    return;
}
$user=new Users();

$action=$_POST['action'];

switch($action){
    case 'initialise':
        $data=array();
        $data['user']=array('username'=>$user->get_username(),'userProfilePicture'=>$user->get_profilePicture(),
                            'bio'=>get_bio());
        $info=$user->get_post();

        for ($i = 0; $i < count($info); $i++) {
            $post = new Post();
            $data['post'][] = array(
                'postLink' => $post->get_postLink(),
                'img' => $post->get_img(),
                'title' => $post->get_title()
            );
        }
        echo json_encode($data);
        break;
    case 'initialise_post_preview':
        $post=new Post();
        $post->set_postLink($_SERVER['REQUEST_URI']);
        $post->read_postID();
        $post->read_post();
        $data=array(
        'title'=>$post->get_title(),
        'authorName'=>$post->get_authorName(),
        'description'=>$post->get_description(),
        'img'=>$post->get_img(),
        'comments'=>$post->get_comments(),
        'postID'=>$post->get_id()
        );
        echo json_encode($data);
        break;
    case 'addPost':
        $post=new Post();
        $post->set_authorID($user->get_id());
        $post->set_image();
        $post->set_categoryName($_POST['categoryName']);
        $post->set_title($_POST['title']);
        $post->set_description($_POST['description']);
        $post->set_date($_POST['date']);
        $post->set_time($_POST['time']);
        $post->write_post();
        break;
    case 'create_custom_profile':
        break;
}
?>