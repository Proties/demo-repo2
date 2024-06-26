<?php declare(strict_types=1);
namespace Users;
// this class wil list all post that a user has and manipulate them
class PostList{
	private array $posts=[];

	public function __construct(){
	}

	public function move_post_up(Post $post,int $num){}
	public function move_post_down(Post $post,int $num){}
	public function remove_post(Post $post){}
	public function add_post(Post $post){}
	public function get_posts(Post $post){}
}


?>