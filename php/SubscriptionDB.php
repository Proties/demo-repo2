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
	public function addSubscription(){}

	public function cancelSubscription(){}

	public function pauseSubscription(){}

	public function resumeSubscription(){}

	public function getSubscription(){}


}
?>