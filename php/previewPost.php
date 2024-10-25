<?php 
session_start();
use Insta\Users\Users;
use Insta\Database\Users\User;
use Insta\Posts\Post;
use Insta\Databases\Post\PostDB;
$data=[];
$user=new Users();
$post=new Post();
$url=urldecode($_SERVER['REQUEST_URI']);

// var_dump($_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$url);

try{

	$post->set_postLink($url);
	$postDB=new PostDB($post);
	$postDB->read_postID();
	if(isset($_SESSION['mainUser'])){
		$_SESSION['mainUser']->following->addItem($postDb->post->get_postID());
	}
	else{
		$_SESSION['mainUser']=$user;

	}
	$data['status']='success';
	$data['message']='post preview working';
	$data['data']=['postID'=>$postDB->post->get_postID(),
				'img'=>$postDB->post->filepath().'/'.$postdb->post->filename()
			];
	setcookie('postPreview',json_encode($data),time()+(36*10),'/');

}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	// $data['trace']=$err->getStackTrace();
	setcookie('postPreview',json_encode($data),time()+(36*10),'/');
}
header('Location: '.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$url);
?>