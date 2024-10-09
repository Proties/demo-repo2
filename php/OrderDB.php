<?php 
namespace Insta\Database\Order;
use Insta\Order\Order;
use Insta\Databases\Database;

class OrderDB extends Database{
	private Order $order;
	private $db;
	public function __construct(Order $order){
		$this->order=$order;
		$this->db=Database::get_connection();
	}

	public function addOrder(){}
	public function updateOrder(){}
	public function cancelOrder(){}
	public function getOrder(){}

}

?>