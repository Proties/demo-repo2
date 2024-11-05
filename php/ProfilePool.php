<?php 
namespace Insta\Pool;
class ProfilePool{

	private array $pool;

	private int $size;
	private int $maxSize;
	private string $filename;
	public function __construct(){
		$this->filename='Profiles.json';
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
	public function addItem(array $item):bool
	{
		try{
			$file=fopen($this->filename,'ab');
			fwrite($file,json_encode($item));
			fclose($file);
			return true;
		}catch(Exception $err){
			return false;
		}
	}
	public function removeItem(array $item):bool
	{

	}
	public function updateItem(array $item):bool
	{

	}
	public function searchItem(array $item):void
	{

	}

}


?>