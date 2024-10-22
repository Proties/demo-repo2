<?php 
namespace Insta\Pool\MostViewPostPool;
class MostViewPostPool{

	private array $pool;
	private int $poolLen;
	private int $size;
	private int $maxSize;
	private $filename='Users.json';
	public function __construct(){
		$this->maxSize=100;
	}

	public function addItem($item){}
	public function removeItem($item){}
	public function updateItem($item){}
	public function searchItem($item){}
}


?>