<?php 
namespace Insta\Database\Template;
// require_once 'php/database.php';
use Insta\Databases\Database;
use Insta\Template\Template;
use Exception;
class TemplateDB extends Database{
	public Template $template;
	private $db;
	public function __construct($template){

		$this->template=$template;
		$this->db=Database::get_connection();
	}
	public function set_db($db){
		$this->db=$db;
	}

	public function get_current_template(){
		$db=$this->db;
		try{
			$query="
					SELECT t.filename FROM UserTemplate ut
					INNER JOIN Users u ON ut.userID=u.userID
					INNER JOIN Template t ON ut.templateID=t.id
					WHERE ut.tempStatus=:status AND u.username=:username

			";
			$statement=$db->prepare($query);
			$statement->bindValue(':status','selected');
			$statement->bindValue(':username',$this->template->get_userID());
			$statement->execute();
			return $statement->fetch();
		}catch(PDOException $err){
			return $err;
		}
	}
	public function addTemplate(){
		$db=$this->db;
		try{
			$query='
					INSERT INTO Template (filename,name,price,image,dateMade,timeMade,type)
					VALUES(:filename,:name,:price,:image,:dateMade,:timeMade,:type)
			';
			$stmt=$db->prepare($query);
			$stmt->bindValue(':dateMade',$this->template->get_dateMade());
			$stmt->bindValue(':timeMade',$this->template->get_timeMade());
			$stmt->bindValue(':name',$this->template->get_name());
			$stmt->bindValue(':filename',$this->template->get_filename());
			$stmt->bindValue(':price',$this->template->get_price());
			$stmt->bindValue(':type',$this->template->get_type());
			$stmt->bindValue(':image',$this->template->get_image());
			
			return $stmt->execute();
		}catch(PDOException $err){
			 return $err;
		}
	}
	public function addTemplateForNewUser(){
		$db=$this->db;
		try{
			$query='

					INSERT INTO UserTemplate(userID,templateID,status)
					VALUES(:userID,:templateID,:status)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':userID',$this->template->get_userID());
			$statement->bindValue(':templateID',$this->template->get_id());
			$statement->bindValue(':status','selected');
			return $statement->execute();


		}catch(PDOException $err){
			return $err;
		}
	}
	public function switchUserTemplate($new){
		$db=$this->db;
		try{
			$db->startTransaction();
			$queryOne='
					UPDATE UserTemplate
					SET status="not selected"
					WHERE userID=:userID AND templateID=:templateID

					';
			$statement=$db->prepare($queryOne);
			$statement->bindValue(':newTemp',$this->template->get_id());
			$statement->bindValue(':userID',$this->template->get_userID());
			$statement->execute();
			
			$queryTwo='
					INSERT INTO UserTemplate
					VALUES (:userID,:templateID,:status)	

			';
			$statement=$db->prepare($queryTwo);
			$statement->bindValue(':newTemp',$this->template->get_id());
			$statement->bindValue(':userID',$this->template->get_userID());
			$statement->execute();
		}catch(PDOException $err){
			return $err;
		}
	}
	public function getTemplateList(){
		$db=$this->db;
		try{
			$query='
					SELECT id,filename,name,type,image,price FROM Template;
			';
			$stmt=$db->prepare($query);
			$stmt->execute();
			return $stmt->fetchall();
		}catch(PDOException $err){
			return $err;
		}
	}
	public function removeTemplate(){
		$db=$this->db;
		try{
			$query='
					DELETE FROM Template 
					WHERE name=:name;
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':name',$this->template->get_name());
			$status=$statement->execute();
			return $status;

		}catch(PDOException $err){
			return $err;
		}
	}
	public function updateTemplate($id){}
	public function hideTemplate($id){}
	public function showTemplate($id){}
}


?>