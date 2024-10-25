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

	public function addItem($item):bool 
	{}
	public function removeItem($item):bool 
	{}
	public function updateItem($item):bool 
	{}
	public function searchItem($item):void 
	{}
}


?>