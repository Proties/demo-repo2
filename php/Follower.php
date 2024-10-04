<?php 
namespace Insta\Follower;
class Follower{
	private int $id;
	private User $user;
	private User $follower;
	private $dateMade;
	private $timeMade;

	public function __construct(User $user,User $follower){
		$this->user=$user;
		$this->follower=$follower;
	}


}

	
?>