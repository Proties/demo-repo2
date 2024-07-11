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
		}catch(PDOException $err){
			return $err;
		}
	}
	public function write_collaborator(){
		$db=$this->db;
		try{
			$query='
					INSERT INTO Collaborators(postID,userID,dateMade,timeMade,statusC)
					VALUES(:postID,userID,:dateM,:timeM,:status)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':userID',$this->collaborator->get_userID());
			$statement->bindValue(':postID',$this->collaborator->get_postID());
			$statement->bindValue(':dateM',$this->collaborator->get_date());
			$statement->bindValue(':timeM',$this->collaborator->get_time());
			$statement->bindValue(':status',$this->collaborator->get_status());
			$statement->execute();
		}catch(PDOException $err){
			return $err;
		}
	}
	public function update_collaborator(){}
}


?>