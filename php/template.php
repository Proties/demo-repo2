<?php 
namespace Insta\Template;
class Template{
	private $creator;
	private $dateMade;
	private $timeMade;
	private $description;
	private $price;
	private $directory;
	private $id;
	private $elements;

	private $filename;
	private $jsScripts;
	private $html;
	private $css;


	public function __construct(){
		$this->directory='./templates';
		$this->creator=0;
		$this->description='';
		$this->timeMade='';
		$this->dateMade='';
		$this->id;
		$this->price='R20';
		$this->filename='';
	}
	public function set_filename($temp){
		$this->filename=$temp;
	}
	public function get_filename(){
		return $this->filename;
	}
	public function set_creator($temp){
		$this->creator=$temp;
	}
	public function get_creator(){
		return $this->creator;
	}
	public function set_dateMade($temp){
		$this->dateMade=$temp;
	}
	public function get_dateMade(){
		return $this->dateMade;
	}
	public function set_timeMade($temp){
		$this->timeMade=$temp;
	}
	public function get_timeMade(){
		return $this->timeMade;
	}
	public function get_directory(){
		return $this->directory;
	}
	public function get_price(){
		return $this->price;
	}
	public function get_description(){
		return $this->description;
	}
	public function get_id(){
		return $this->id;
	}

}


?>