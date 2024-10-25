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
			$query='
					INSERT INTO OrderPayments(uuid,userID,dateMade,timeMade,itemName,itemDescription,total,status)
					VALUES (:uuid,:dateM,:timeM,:itemN,:itemD,:total,:stat)

			';
			$statement=$db->prepare($query);
			$statement->bindValue(':uuid',$this->order->get_uuid());
			$statement->bindValue(':dateM',$this->order->get_dateMade());
			$statement->bindValue(':timeM',$this->order->get_timeMade());
			$statement->bindValue(':itemN',$this->order->get_itemName());
			$statement->bindValue(':itemD',$this->order->get_itemDescription());
			$statement->bindValue(':total',$this->order->get_total());
			$statement->bindValue(':stat',$this->order->get_status());
			$statement->execute();
			$this->order->set_id($db->lastInsertID());
		}catch(PDOException $err){
			return $err;
		}
	}
	public function updateOrder(){
		$db=$this->db;
		try{
			$query='
					UPDATE OrderPayments
					status=:stat
					WHERE id=:id
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':stat',$this->order->get_status());
			$statement->bindValue(':id',$this->order->get_id());
			$statement->execute();
		}catch(PDOException $err){
			return $err;
		}
	}
	public function getOrder(){
		$db=$this->db;
		try{
			$query='
					SELECT * FROM OrderPayments
					WHERE id=:id
			';
			$statement=$db->prepare($query);
			$statement->bindValue(':id',$this->order->get_id());
			$statement->execute();
		}catch(PDOException $err){
			return $err;
		}
	}

}

?>