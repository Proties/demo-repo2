<?php 
namespace Insta\User\Pool;
class ViewedPosts{
	private array $pool;
	private int $poolLen;
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
	public function addItem(int $item){}
	public function removeItem(int $item){}
	public function searchItem(int $item){}

}
class ServedPosts{
	private array $pool;
	private int $poolLen;
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
	public function addItem(int $item){}
	public function removeItem(int $item){}
	public function searchItem(int $item){}

}
class FollowingUsers{
	private array $pool;
	private int $poolLen;
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
	public function addItem(int $item){}
	public function removeItem(int $item){}
	public function searchItem(int $item){}
}

?>