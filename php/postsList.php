<?php declare(strict_types=1);
namespace Users;
// this class wil list all post that a user has and manipulate them
class PostList{
	private array $posts;

	public function __construct(array $arr){
		$posts=$arr;
	}

	public function move_post_up(Post $post,int $num):bool
	{}
	public function move_post_down(Post $post,int $num):bool
	{}
	public function remove_post(Post $post):bool
	{}
	public function add_post(Post $post):bool
	{
		$data=[];
		$errorMessages=[];
		try{
		 if($post->validate_caption($data_f['caption'])==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if($post->validate_preview_status($data_f['preview_status'])==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if($category->validate_name($data_f['categoryName'])==false){
            $errorMessages=array('errcaption'=>'not valid caption');
        }
        if(count($errorMessages)>1){
            throw new Exception('could not create post');
        }
        if(isset($_POST['collaborators'])){

        }
        if(isset($_POST['location'])){}

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
        $post->write_post();
    }catch(Exception $err){
    	$data['status']=false;
    	$data['errorMessages']=$errorMessages;
    	return $data;
    }

	}
	public function get_posts(Post $post):array
	{}
}


?>