<?php 
namespace Insta\Follower;
use Insta\Users\Users;
class Follower{
	private $currentUserID;
	private $followerUserID;
	private $date;
	private $time;
	public function __construct(){
		$this->followerUserID=0;
		$this->currentUserID=0;
		$this->date=date('Y:m:d');
		$this->time=date('H:i');
	}

	public function set_current_userID(int $id){
		$this->currentUserID=$id;
	}
   	public function set_follower_userID(int $id){
   		$this->followerUserID=$id;
   	}


    public function get_current_userID(){
    	return $this->currentUserID;
	}
   	public function get_follower_userID(){
   		return $this->followerUserID;
   	}
    public function get_date(){
    	return $this->date;

    }
    public function get_time(){
    	return $this->time;
    }


}



?>