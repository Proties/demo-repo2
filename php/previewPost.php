<?php 
session_start();
use Insta\Users\User;
use Insta\Database\Users\User;
use Insta\Posts\Post;
use Insta\Database\Post\PostDB;
$data=[];
$user=new Users();
$post=new Post();
try{
	$url=$_SERVER['REQUEST_URI'];
	$username;
	$postID;
	if(isset($_POST['sharerID'])){

	}


	$data['status']='success';
	$data['message']='post preview working';
	json_encode($data);
}catch(Exception $err){
	$data['status']='failed';
	$data['message']=$err->getMessage();
	$data['trace']=$err->getStackTrace();
	json_encode($data);
}
?>