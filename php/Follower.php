<?php 
namespace Insta\Follower;
use Insta\Users\Users;
class Follower{
	private int $id;
	private Users $user;
	private Users $follower;
	private $dateMade;
	private $timeMade;

	public function __construct(Users $user,Users $follower){
		$this->user=$user;
		$this->follower=$follower;
	}
	public function get_userID(){
		return $this->user->get_id();
	}
	public function get_followerID(){
		return $this->follower->get_id();
	}
	public function get_dateMade(){
		return $this->dateMade;
	}
	public function get_timeMade(){
		return $this->timeMade;
	}


}

	
?>