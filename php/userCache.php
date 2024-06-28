<?php declare(strict_types=1);
//this file will create,read,write a registeredUser.json file 
// this calls will access username and email of already created users

class userCache{
	private array $listUsers;
	private string $cacheFileName;
	private string $targetUserName;
	private string $targetUserEmail;

	public function __construct(string $username='',string $email=''){
		$this->cacheFileName='';
		$this->targetUserEmail=$email;
		$this->targetUserName=$username;
	}
	public function set_targetUserName(string $name){
		$this->targetUserName=$name;
	}
	public function set_targetUserEmail(string $email){
		$this->targetUserEmail=$email;

	}
	public function get_targetUserName():string 
	{
		return $this->targetUserName;
	}
	public function get_targetUserEmail():string 
	{
		return $this->targetUserEmail;
	}
	public function set_cacheFileName(string $fileName):void
	{
		$this->cacheFileName=$fileName;
	}
	public function get_cacheFileName():string
	{
		return $this->cacheFileName;
	}
	public function create_cacheFile():bool 
	{}
	public function read_cacheFile():array
	{}
	public function write_to_cacheFile():bool 
	{}

	public function search_username():bool
	{}
	public function add_username(){}
	public function search_email():bool 
	{}
	public function add_email(){}

	public function update_username(){}
	public function update_email(){}

	public function delete_username(){}
	public function delete_email(){}




}