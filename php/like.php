<?php 
class Like{
	private $id;
	private $date;
	private $time;
	private $postID;
	private $userID;

	public function __construct(int $userID,int $postID){
		$this->userID=$userID;
		$this->postID=$postID;
		$this->id=null;
		$this->time='';
		$this->date='';
	}

	public function get_postID(){
		return $this->postID;
	}
	public function get_userID(){
		return $this->userID
	}
	public function get_date(){
		return $this->date;
	}
	public function get_time(){
		return $this->time
	}


}


?>