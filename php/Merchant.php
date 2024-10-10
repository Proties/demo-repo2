<?php 
namespace Insta\Merchant;
class Merchant{
	private $id;
	private $key;
	private $passphrase;
	private $webUrl;
	private $name;

	public function __construct(){
		$this->id='10000100';
		$this->key='46f0cd694581a';
		$this->passphrase='jt7NOE43FZPn';

	}
	public function get_id(){
		return $this->id;
	}
	public function get_key(){
		return $this->key;
	}
	public function get_passphrase(){
		return $this->passphrase;
	}
	public function get_webUrl(){
		return $this->webUrl;
	}
}

?>