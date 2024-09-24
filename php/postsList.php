<?php declare(strict_types=1);
namespace Insta\Users;
use Insta\Posts\Post;
use Insta\Posts\PostDB;
use Exception;
// this class wil list all post that a user has and manipulate them
class PostList{
	private array $posts;

	public function __construct(array|null $arr=null){
		if($arr==null){
			$this->posts=[];
			return;
		}
		$this->posts=$arr;
	}
	public function get_last_added():object 
	{
		array_shift($this->posts);
	}
	public function search_post($caption):bool
	{
		
	}
	public function suggest_post($caption):array 
	{

	}
	public function move_post_up(Post $post,int $num):bool
	{

	}
	public function move_post_down(Post $post,int $num):bool
	{

	}
	public function remove_post(Post $post):bool
	{
		try{
			$post->get_postID();
			$lenArr=$this->$posts;
			for($i=0;$i<$lenArr;$i++){

			}
			$postDB->delete_post($id);
		}catch(Exception $err){
			return $err;
		}
		

	}
	public function add_post(Post $post):bool
	{
		array_push($this->posts, $post);
	}
	public function get_posts()
	{
		return $this->posts;
	}
}


?>