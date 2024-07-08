<?php 
namespace Insta\Databases\Location;
use Insta\Databases\Database;
use Insta\Location\Location;
class LocationDB extends Database{
	public Location $location;
	private $db;
	public function __construct(Location $location){
		Database::__construct();
		$this->location=$location;
		$this->db=$this->get_connection();
	}

	public function set_db($d){
		$this->db=$d;
	}

	public function write_location(){

		$db=$this->db;
		try{
			$query='
				INSERT INTO Location (country,region,province,street,zipCode)
				VALUES(:country,:region,:province,:street,:zipCode)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':country',$this->location->get_country());
			$statement->bindValue(':region',$this->location->get_region());
			$statement->bindValue(':province',$this->location->get_province());
			$statement->bindValue(':street',$this->location->get_street());
			$statement->bindValue(':zipCode',$this->location->get_zipCode());
			$statement->execute();
			$this->location->set_id($db->lastInsertId());
		}catch(Exception $err){
			echo $err->getMessage();
			return $err;
		}
	}
	public function write_locationPost($postID){
		$db=$this->db;
		try{
			$query='
				INSERT INTO PostLocation
				VALUES(:postID,:locationID)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':postID',$postID);
			$statement->bindValue(':loctionID',$this->location->get_id());
			$statement->execute();
		}catch(Exception $err){
			echo $err->getMessage();
			return $err;
		}

	}
	public function read_location(){}
	public function update_location(){}
}



?>