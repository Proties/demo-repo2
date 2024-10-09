<?php 
namespace Insta\Subscription;
class Subscription{
	private $price;
	private $startDate;
	private $startTime;
	private $endTime;
	private $endDate;
	private $id;
	private $planID;
	public function __construct(){

	}
}

$item=[
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
?>