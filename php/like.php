<?php  declare(strict_types=1);
namespace Posts;
class Like{
	private int $id;
	private string $date;
	private string $time;
	private int $postID;
	private int $userID;

	public function __construct(int $userID,int $postID){
		$this->userID=$userID;
		$this->postID=$postID;
		$this->id=null;
		$this->time='';
		$this->date='';
	}

	public function get_postID():int
	{
		return $this->postID;
	}
	public function get_userID():int
	{
		return $this->userID;
	}
	public function get_date():int
	{
		return $this->date;
	}
	public function get_time():int
	{
		return $this->time;
	}


}


?>