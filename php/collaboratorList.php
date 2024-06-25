<?php 
class CollaboratorList extends Post{
	public function __construct(){
		Post::__construct();
	}

	public function add_user(Users $userID){
		array_push($this->collaborators, $user);
	}
	public function remove_user(Users $userID){
		
	}
	public function move_user_up(Users $userID){
		array_push($this->collaborators, $user);
	}
	public function move_user_down(Users $userID){
		
	}
	public function get_users(){
		return $this->users;
	}
}



?>