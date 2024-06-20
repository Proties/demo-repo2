<?php
class CollaboratorDB extends Database{
	private $collaborator;
	public function __construct(Collaborator $collaborator){
		Database::__construct();
		$this->collaborator=$collaborator;

	}
	public function get_collaborator(){
		return $this->collaborator;
	}
	public function read_collaborator(){}
	public function write_collaborator(){}
	public function update_collaborator(){}
}


?>