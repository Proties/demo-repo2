<?php 
namespace Insta\Pool;
class MostViewPostPool{

	private array $pool;
	private int $poolLen;
	private int $size;
	private int $maxSize;
	private $filename='Users.json';
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
	public function addItem($item){}
	public function removeItem($item){}
	public function updateItem($item){}
	public function searchItem($item){}
}


?>