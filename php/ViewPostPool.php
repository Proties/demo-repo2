<?php 
namespace Insta\User\Pool;
class ViewedPosts{
	private array $pool;
	private int $size;

	public function __construct(){
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
	public function addItem(int $item):bool 
	{}
	public function removeItem(int $item):bool 
	{}
	public function searchItem(int $item):void 
	{}

}
class ServedPosts{
	private array $pool;
	private int $size;

	public function __construct(){
		$this->size=0;
		$this->pool=[];
	}

	public function getSize():int
	{
		return $this->size;
	}
	public function setSize():int
	{
		$this->size=count($this->pool);
	}
	public function getPool():array
	{
		return $this->pool;
	}
	public function add_item(int $item):bool 
	{
		try{
			array_push($this->pool,$item);
			return true;
		}catch(Exception $err){
			return false;
		}
		
	}
	public function removeItem(int $item):bool 
	{}
	public function searchItem(int $item):void 
	{}

}
class FollowingUsers{
	private array $pool;
	private int $size;

	public function __construct(){
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
	public function addItem(int $item):bool 
	{}
	public function removeItem(int $item):bool 
	{}
	public function searchItem(int $item):void 
	{}
}

?>