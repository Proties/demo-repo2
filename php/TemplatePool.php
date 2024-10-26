<?php 
namespace Insta\Pool;
use Insta\Template\Template;
class TemplatePool{

	private array $pool;

	private int $size;
	private int $maxSize;
	private $filename='Templates.json';
	public function __construct(){
		$this->maxSize=5;
		$this->size=0;
		$this->pool=[];
		%this->pool
	}

	public function addItem(Template $item):bool 
	{}
	public function removeItem(Template $item):bool 
	{}
	public function updateItem(Template $item):bool 
	{}
	public function searchItem(Template $item):void 
	{}
}


?>