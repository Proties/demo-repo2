<?php 
namespace Insta\Order;
class Order{
	private $id;

	private $userID;
	private $type;
	private $uuid;
	private $dateMade;
	private $timeMade;
	private $timeCompleted;
	private $dateCompleted;
	private $customer;
	private $orderItems;
	private $total;
	private $tax;

	private $itemName;
	private $itemDescription;
	private $status;

	private $userName;
	private $userLastName;
	private $userEmail;
	private array $dataItem;

	public function __construct(){
		$this->id='Order#123';
		$this->userID=0;
		$this->total=0;
		$this->orderItems=[];
		$this->customer;
		$this->uuid='00001';
		$this->type='';
		$this->userEmail='';
		$this->userName='';
		$this->userLastName='';
		$this->itemName='';
		$this->itemDescription='';
		$this->status='';

	}
	public function set_userEmail($i){
		$this->userEmail=$i;
	}
	public function set_userName($i){
		$this->userName=$i;
	}
	public function set_userID($i){
		$this->userID=$i;
	}
	public function set_userLastName($i){
		$this->userLastName=$i;
	}
	public function set_id($i){
		$this->id=$i;
	}
	public function set_time_created($tm){
		$this->timeMade=$tm;
	}
	public function set_date_created($dt){
		$this->dateMade=$dt;
	}
	public function set_total($i){
		$this->total=$i;
	}
	public function set_type($i){
		$this->type=$i;
	}
	public function set_status($i){
		$this->status=$i;
	}

	public function set_itemName($i){
		$this->itemName=$i;
	}
	public function set_itemDescription($i){
		$this->itemDescription=$i;
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
	public function get_type(){
		return $this->type;
	}
	public function get_status(){
		return $this->status;
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
	public function get_userName(){
		return $this->userName;
	}
	public function get_userLastName(){
		return $this->userLastName;
	}
	public function get_userEmail(){
		return $this->userEmail;
	}

	public function get_itemName(){
		return $this->itemName;
	}
	public function get_itemDescription(){
		return $this->itemDescription;
	}

	
}


?>