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

	public function addOrder(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}
	public function updateOrder(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}
	public function cancelOrder(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}
	public function getOrder(){
		$db=$this->db;
		try{

		}catch(PDOException $err){
			return $err;
		}
	}

}

?>