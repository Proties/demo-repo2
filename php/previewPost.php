<?php 
session_start();
use Insta\Users\Users;
use Insta\Database\Users\User;
use Insta\Posts\Post;
use Insta\Databases\Post\PostDB;
use Insta\Images\Image;
use Insta\Databases\Images\ImageDB;
use Insta\Video\Video;
use Insta\Database\Video\VideoDB;
$data=[];
$user=new Users();
$post=new Post();
$url=urldecode($_SERVER['REQUEST_URI']);

// var_dump($_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$url);
$image=new Image();
$video=new Video();
try{

	$post->set_postLink($url);
	$postDB=new PostDB($post);
	$postDB->get_postID_from_link();
	// if(isset($_SESSION['mainUser'])){
	// 	$_SESSION['mainUser']->following->addItem($postDb->post->get_postID());
	// }
	// else{
	// 	$_SESSION['mainUser']=$user;

	// }
	$data['status']='success';
	$data['message']='post preview working';
	var_dump($postDB->getVideo());
	if($postDB->getVideo()==false){
		$image->set_postID($postDB->post->get_postID());
		$imageDB=new ImageDB($image);
		$status=$imageDB->read_image();
		if($status==false){
			throw new Exception('image not defined');
			
		}
		$image->set_filename($status['fileName']);
		$image->set_filePath($status['filePath']);
		$data['data']=array('img'=>$image->get_filePath().'/'.$image->get_filename());
	}else{
		$data['data']=array('img'=>$video->get_filePath().'/'.$video->get_fileName());
	}
	setcookie('postPreview',json_encode($data),time()+(36*10),'/');

}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	// $data['trace']=$err->getStackTrace();
	setcookie('postPreview',json_encode($data),time()+(36*10),'/');
}
header('Location: '.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$url);
?>