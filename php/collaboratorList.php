<?php 
// this class will have acces to database
class CollaboratorList extends Post{
	public function __construct(){
		Post::__construct();
	}

	public suggest_user(string $name){

	}
	public function search_user(Users $user){
		return $arr;
	}
	public function add_user(Users $userID){
		array_push($this->collaborators, $user);
	}
	public function remove_user(Users $userID){
		unset($this->get_users()[$userID]);
	}
	public function move_user_up(Users $userID,$int){
		array_push($this->collaborators, $user);
	}
	public function move_user_down(Users $userID,$int){
		
	}
	public function get_users(){
		return $this->users;
	}
}
?>