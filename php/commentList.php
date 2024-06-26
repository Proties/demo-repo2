<?php  declare(strict_types=1);
namespace Posts;
class CommentList{

	private array $comments=[];
	public function __construct(){
		
	}
	public function get_comments(Comment $comment):array
	{}
	public function move_comment_up(Comment $comment,int $num):void
	{}
    public function move_comment_down(Comment $comment,int $num):void
    {}
    public function add_comment(Comment $comment):void
    {}
    public function remove_comment(Comment $comment):void
    {}
}


?>