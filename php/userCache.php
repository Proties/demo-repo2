<?php declare(strict_types=1);
namespace Insta\Users;
//this file will create,read,write a registeredUser.json file 
// this calls will access username and email of already created users

class UserCache{
	private array $listUsers;
	private string $cacheFileName;
	private string $targetUserName;
	private string $targetUserEmail;

	public function __construct(string $username='',string $email=''){
		$this->cacheFileName='registeredUsers.json';
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
	public function read_cacheFile():array
	{
		$this->listUsers=lfile_get_contents($this->cacheFileName);
	}
	public function search_username():bool
	{
		for($i=0;$i<$len;$i++){
			if($this->listUsers[$i]['username']==$targetUserName){
				return true;
			}
		}
		return false;
	}
	public function search_email():bool 
	{
		for($i=0;$i<$len;$i++){
			if($this->listUsers[$i]['email']==$targetEmail){
				return true;
			}
		}
		return false;
	}
	public function add_entry(){
		$entry=['email'=>$this->targetUserEmail,'username'=>$this->targetUserName];
		file_put_contents(json_encode($this->cacheFileName, $entry));
	}
}