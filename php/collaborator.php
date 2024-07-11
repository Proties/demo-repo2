<?php  declare(strict_types=1);
namespace Insta\Collaborator;
class Collaborator{
	private array $users=[];
	private int $collaboratorID;
	private int $postID;
	private string $status;
	private string $errorMessage;
	private string $errorStatus;
	private string $time;
	private string $date;

	public function __construct(){
		$this->collaboratorID=0;
		$this->postID=0;
		$this->userID=0;
		$this->status='show';
		$this->date=date('Y:m:d');
		$this->time=date('H:i');
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

	public function get_collaboratorID(){
		return $this->collaboratorID;
	}

	public function add_collab($arr){
		array_push($this->users, $arr);
	}
	public function get_users(){
		return $this->users;
	}

	
}

?>