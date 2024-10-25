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
			$query='
					INSERT INTO Subscription(type,startDate,startTime,nextPayment,userID,subscriptionStatus)
					VALUES (:type,:startD,:startT,:nextP,:userID,:stat)
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':type',$this->subscription->get_type());
			$statement->bindValue(':startD',$this->subscription->get_startDate());
			$statement->bindValue(':startT',$this->subscription->get_startTime());
			$statement->bindValue(':nextP',$this->subscription->get_nextPaymentDate());
			$statement->bindValue(':userID',$this->subscription->get_userID());
			$statement->bindValue(':stat',$this->subscription->get_status());
			$statement->execute();
		}catch(PDOException $err){
			return $err;
		}
	}

	public function cancelSubscription(){
		$db=$this->db;
		try{
			$query='
					UPDATE Subscription
					WHERE id=:id


			';
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