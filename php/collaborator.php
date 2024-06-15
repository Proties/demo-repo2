<?php 
class Collaborator{
	private $users=[];
	private $collaboratorID;
	private $postID;
	private $status;
	private $errorMessage;
	private $errorStatus;
	private $time;
	private $date;

	public function __construct(){
		$this->collaboratorID=null;
		$this->postID=null;
	}
	public function set_postID(Int $id){
		$this->postID=$id;
	}
	public function set_status(String $id){
		$this->status=$id;
	}
	public function set_time($id){
		$this->time=$id;
	}
	public function set_date($id){
		$this->date=$id;
	}

	public function get_postID(){
		return $this->postID;
	}
	public function get_status(){
		return $this->status;
	}
	public function get_time(){
		return $this->time;
	}
	public function get_date(){
		return $this->date;
	}
	public function get_users(){
		return $this->users;
	}
	public function get_collaboratorID(){
		return $this->collaboratorID;
	}

	public function add_user(Users $userID){
		array_push($this->collaborators, $user)
	}
	
}

?>