<?php 
namespace Insta\Order;
class Order{
	private $id;
	private $dateMade;
	private $timeMade;
	private $timeCompleted;
	private $dateCompleted;
	private $customer;
	private $orderItems;
	private $total;
	private $tax;
	private array $dataItem;

	public function __construct(){
		$this->id='Order#123';
		$this->total=100.34;
		$this->orderItems=[];
		$this->customer;
		$this->uuid='00001';

	}
	public function set_id($i){
		$this->id=$i;
	}
	public function set_total($i){
		$this->total=$i;
	}
	public function add_items($item){
		array_push($this->orderItems, $item);
	}
	public function remove_item($item){
		array_splice($this->orderItems, $item);
	}
	public function get_id(){
		return $this->id;
	}
	public function get_total(){
		return $this->total;
	}
	public function get_dateMade(){
		return $this->dateMade;
	}
	public function get_timeMade(){
		return $this->timeMade;
	}
	public function get_timeCompleted(){
		return $this->timeCompleted;
	}
	public function get_dateCompleted(){
		return $this->dateCompleted;
	}
	public function get_orderItems(){
		return $this->orderItems;
	}
	public function get_uuid(){
		return $this->uuid;
	}
	public function genarete_uuid(){
		return $this->uuid;
	}
}


?>