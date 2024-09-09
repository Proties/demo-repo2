<?php 
session_start();
use Monolog\Handler\StreamHandler;
use Insta\Users\Users;
use Insta\Databases\User\UserDB;
use Insta\Posts\Post;
use Insta\Databases\Post\PostDB;

if($_SERVER['REQUEST_METHOD']=='GET'){
	include_once('Htmlfiles/Editpersonalprofile.html');
	exit();
}
switch ($action) {
	case 'value':
		// code...
		break;
	
	default:
		// code...
		break;
}
?>