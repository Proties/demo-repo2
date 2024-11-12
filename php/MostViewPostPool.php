<?php 
namespace Insta\Pool;
class MostViewPostPool{

	private array $pool;
	private int $poolLen;
	private int $size;
	private int $maxSize;
	private string $filename;
	public function __construct(){
		$this->filename='Users.json';
		$this->maxSize=100;
		$this->size=0;
		$this->pool=[];
		$this->set_pool();

		
	}
	private function create_file(){
		$file=fopen($this->filename,'a');
		fclose($file);
	}
	private function set_pool(){
		try{
			$data;
			if(!file_exists($this->filename)){
				$this->create_file();
			}
			$file=fopen($this->filename,'r+');
			if(!$file){
				throw new Exception("could not create file");
				
			}
			$length = filesize($this->filename);
			if($length<1){
				$data=[];
			}else{
				$data=fread($file, $length);
				$data=json_decode($data,true);
				$this->pool=$data;

			}
			
			fclose($file);
			
		}catch(Exception $err){
			return $err;
		}
	}
	public function getSize():int
	{
		return $this->size;
	}
	public function getPool():array
	{
		return $this->pool;
	}

	public function add_item(array $item):bool 
	{
		try{
			array_push($this->pool, $item);
			return true;
		}catch(Exception $err){
			return false;
		}
		
		
		
	}
	public function load_data_to_file(){
		try{
			$file=fopen($this->filename,'w');
			fwrite($file,json_encode($this->pool));
			fclose($file);
			return true;
		}catch(Exception $err){
			return false;
		}
	}
	public function removeItem(array $item):bool 
	{}
	public function updateItem(array $item):bool 
	{}
	public function searchItem(array $item):void 
	{}
}


?>