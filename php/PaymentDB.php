<?php 
namespace Insta\Databases\Payment;
use Insta\Payment\Payment;
use Insta\Databases\Database;
class PaymentDB extends Database{
	private Payment $payment;
	private $db;
	public function __construct(Payment $payment){
		$this->payment=$payment;
		$this->db=Database::get_connection();
	}


}
?>