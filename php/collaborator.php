<?php 
class Collaborator{
	private $collaborators=array();
	private $collaboratorID;
	private $postID;
	private $status;
	private $time;
	private $date;

	public function __construct(){
		$this->collaboratorID=null;
		$this->postID=null;
	}
	public function set_postID($id){}
	public function set_status($id){}
	public function set_time($id){}
	public function set_date($id){}

	public function add_user($userID){}
	public function read_collaborator(){}
	public function write_collaborator(){}
	public function update_collaborator(){}
}

?>