<?php 
namespace Insta\Pool;
class TemplatePool{

	private array $pool;
	private int $poolLen;
	private int $size;
	private int $maxSize;
	private $filename='Templates.json';
	public function __construct(){
		$this->maxSize=5;
	}

	public function addItem($item){}
	public function removeItem($item){}
	public function updateItem($item){}
	public function searchItem($item){}
}


?>