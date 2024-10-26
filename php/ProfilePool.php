<?php 
namespace Insta\Pool;
class ProfilePool{

	private array $pool;

	private int $size;
	private int $maxSize;
	private $filename='Profiles.json';
	public function __construct(){
		$this->maxSize=100;
		$this->size=0;
		$this->pool=[];
	}
	public function getSize():int
	{
		return $this->size;
	}
	public function getPool():array
	{
		return $this->pool;
	}
	public function addItem(Users $item):bool
	{

	}
	public function removeItem(Users $item):bool
	{

	}
	public function updateItem(Users $item):bool
	{

	}
	public function searchItem(Users $item):void
	{

	}

}


?>