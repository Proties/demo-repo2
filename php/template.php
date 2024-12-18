<?php 
namespace Insta\Template;
class Template{
	private $creator;
	private $userID;
	private $username;
	private $dateMade;
	private $timeMade;
	private $description;
	private $price;
	private $directory;
	private $id;
	private $elements;

	private $type;
	private $name;
	private $filename;
	private $imagePreview;
	private $jsScripts;
	private $image;
	private $html;
	private $css;


	public function __construct(){
		// $this->directory='./templates';
		$this->directory='Htmlfiles';
		$this->creator=0;
		$this->username='';
		$this->description='';
		$this->timeMade=date('H:i');
		$this->dateMade=date('Y:m:d');
		$this->id;
		$this->type='';
		$this->price='R20';
		$this->imagePreview='';
		$this->filename='Personalprofile.html';
		$this->name='';
		$this->image='';
	}
	public function set_image($temp){
		$this->image=$temp;
	}
	public function set_type($temp){
		$this->type=$temp;
	}
	public function set_price($temp){
		$this->price=$temp;
	}
	public function set_previewImage($temp){
		$this->imagePreview=$temp;
	}
	public function set_name($temp){
		$this->name=$temp;
	}
	public function set_filename($temp){
		$this->filename=$temp;
	}
	public function set_username($temp){
		$this->username=$temp;
	}
	public function get_previewImage(){
		return $this->imagePreview;
	}
	public function get_username(){
		return $this->username;
	}
	public function get_filename(){
		return $this->filename;
	}
	public function set_userID($temp){
		$this->userID=$temp;
	}
	public function get_userID(){
		return $this->userID;
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
	public function get_name(){
		return $this->name;
	}
	public function get_type(){
		return $this->type;
	}
	public function get_image(){
		return $this->image;
	}

}


?>