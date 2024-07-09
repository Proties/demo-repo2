<?php
namespace Insta\Databases\Collaborator;
use Insta\Databases\Database;
class CollaboratorDB extends Database{
	private $collaborator;
	private $db;
	public function __construct(Collaborator $collaborator){
		Database::__construct();
		$this->collaborator=$collaborator;
		$this->db=$this->get_connection();

	}
	public function set_db($d){
		$this->db=$d;
	}
	public function get_collaborator(){
		return $this->collaborator;
	}
	public function read_collaborator(){}
	public function read_collaborators(){
		try{
			$query='
					SELECT FROM Users 
					
					WHERE userID=
			';
		}catch(PDOExcepion $err){
			return $err;
		}
	}
	public function write_collaborator(){
		$db=$this->db;
		try{
			$query='
				INSERT INTO collaborators();
				VALUES()
			';
		}
	}
	public function write_collaborator_post(int $postID){}
	public function update_collaborator(){}
}


?>