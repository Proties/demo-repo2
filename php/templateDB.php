<?php 
namespace Insta\Database\Template;
// require_once 'php/database.php';
use Insta\Databases\Database;
use Insta\Template\Template;
use Exception;
class TemplateDB extends Database{
	private Template $template;
	public function __construct($template){
		$this->template=$template;
	}

	public function addTemplate(){
		$this->db=$db;
		try{
			$query='
					INSERT INTO Template (owner,description,price,dateCreated,timeCreated,name,tmplateDirectory,id)
					VALUES(:owner,:descr,:price,:dateCreated,:timeCreated,:name,:tmplateDirectory,:id)
			';
			$db->prepare($query);
			$db->bindValue(':owner',$this->template->get_name());
			$db->bindValue(':owner',$this->template->get_name());
			$db->bindValue(':owner',$this->template->get_name());
			$db->bindValue(':owner',$this->template->get_name());
			$db->bindValue(':owner',$this->template->get_name());
			$db->bindValue(':owner',$this->template->get_name());
			$db->execute();
		}catch(PDOException $err){
			 return $err;
		}
	}
	public function getTemplate(){}
}


?>