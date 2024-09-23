<?php 
namespace Insta\Template;
class Template{
	private $creator;
	private $dateMade;
	private $timeMade;
	private $price;
	private $directory;
	private $id;
	private $elements;
	private $id;
	private $name;
	private $jsScripts;
	private $html;
	private $css;
	private $directory;

	function __construct(){

	}
	public function set_name($temp){
		$this->name=$temp;
	}
	public function get_name(){
		return $this->name;
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
	public function get_id(){
		return $this->price;
	}
	
}


?>