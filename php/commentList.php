<?php 
class CommentList extends Post{

	private $comments=[];
	public function __construct(){
		Post::__construct();
	}
	public function get_comments(Comment $comment){}
	public function move_comment_up(Comment $comment,int $num){}
    public function move_comment_down(Comment $comment,int $num){}
    public function add_comment(Comment $comment){}
    public function remove_comment(Comment $comment){}
}


?>