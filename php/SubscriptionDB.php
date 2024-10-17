<?php 
namespace Insta\Database\Subscription;
use Insta\Databases\Database;
use Insta\Subscription\Subscription;
class SubscriptionDB extends Database{
	private $db;
	private Subscription $subscription;
	public function __construct(Subscription $sub){
		$this->db=Database::get_connection();
		$this->subscription=$sub;

	}
	public function addSubscription(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}

	public function cancelSubscription(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}

	public function pauseSubscription(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}

	public function resumeSubscription(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}

	public function getSubscription(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}


}
?>