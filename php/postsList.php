<?php
class PostList extends Users{
	private $posts=[];
	public function __construct(){
		Users::__construct();
	}
	public function move_post_up(Post $post,int $num){}
	public function move_post_down(Post $post,int $num){}
	public function remove_post(Post $post){}
	public function add_post(Post $post){}
	public function get_posts(Post $post){}
}


?>