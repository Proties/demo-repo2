<?php 
namespace Insta\Subscription;
class Subscription{
	private $type;
	private $initial_amount;
	private $token;
	private $amount;
	private $next_run;
	private $frequency;
	private $item_name;
	private $item_description;
	private $name_first;
	private $name_last;
	private $email_address;
	private $item;
	public function __construct(){

	}
	public function set_type($type){}
	public function set_initial_amount($type){}
	public function set_token($type){}
	public function set_amount($type){}
	public function set_next_run($type){}
	public function set_frequency($type){}
	public function set_item_name($type){}
	public function set_item_description($type){}
	public function set_name_first($type){}
	public function set_name_last($type){}
	public function set_email_address($type){}
	public function get_item(){
		return $this->item=[
			"type"=>"subscription.free-trial",
			"token"=>"dc0521d3-55fe-269b-fa00-b647310d760f",
			"initial_amount"=>0,
			"amount"=>10000,
			"next_run"=>"2021-03-30",
			"frequency"=>"3",
			"item_name"=>"Test Item",
			"item_description"=>"A test product",
			"name_first"=>"John",
			"name_last"=>"Doe",
			"email_address"=>"john@example.com"
		];
	}
}


?>