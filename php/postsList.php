<?php declare(strict_types=1);
namespace Insta\Users;
use Insta\Posts\Post;
use Insta\Posts\PostDB;
use Error;
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
		$data=[];
		$errorMessages=[];
		try{
		 if($post->validate_caption($post->get_caption())==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if($post->validate_preview_status($post->previewStatus())==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if($category->validate_name($post->get_categoryName())==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if(count($errorMessages)>1){
            throw new Exception('could not create post');
        }


        $user->create_user_folder();   
     
        $post->image->make_file();
        $post->image->get_fileName();

        $base64string=substr($img,strpos($img,',')+1);
        $post->create_post_file();
        
        file_put_contents($user->get_dir().'/'.$post->get_file(),base64_decode($base64string));
        $n=strpos($post->get_file(),'.');
        $post->set_postLinkID(substr($post->get_file(),0,$n));
        $post->set_postLink($user->get_dir().'/'.$post->get_file());
        $post->set_authorID($_SESSION['userID']);
        $postDB=new PostDB($post);
        $postDB->write_post();
        $postDB->image->write_image();
        $postDB->image->write_image_post();
        return true;
    }catch(Error $err){
    	// $data['status']=false;
    	// $data['errorMessages']=$errorMessages;

    	return $err;
    }

	}
	public function get_posts()
	{
		return $this->posts;
	}
}


?>