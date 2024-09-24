<?php 
namespace Insta\Database\Template;
// require_once 'php/database.php';
use Insta\Databases\Database;
use Insta\Template\Template;
use Exception;
class TemplateDB extends Database{
	private Template $template;
	private $db;
	public function __construct($template){
		Database::__construct();
		$this->template=$template;
		$this->db=$this->get_connection();
	}

	public function addTemplate(){
		$db=$this->db;
		try{
			$query='
					INSERT INTO Template (creator,description,dateCreated,timeCreated,filename)
					VALUES(:owner,:descr,:dateCreated,:timeCreated,:name)
			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':owner',$this->template->get_creator());
			$stmt->bindValue(':descr',$this->template->get_description());
			$stmt->bindValue(':dateCreated',$this->template->get_dateMade());
			$stmt->bindValue(':timeCreated',$this->template->get_timeMade());
			$stmt->bindValue(':name',$this->template->get_filename());
			$stmt->execute();
		}catch(PDOException $err){
			 return $err;
		}
	}
	public function getTemplateList(){
		$db=$this->db;
		try{
			$query='
					SELECT filename FROM Template
			';
			$stmt=$db->prepare($query);
			$stmt->execute();
			return $stmt->fetchall();
		}catch(PDOException $err){
			return $err;
		}
	}
	public function removeTemplate($id){

	}
}


?>