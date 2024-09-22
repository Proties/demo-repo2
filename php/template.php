<?php 
namespace Insta\Template;
class Template{
	private $creator;
	private $dateMade;
	private $timeMade;
	private $elements;
	private $id;
	private $name;
	private $jsScripts;
	private $html;
	private $css;
	private $directory;

	function __construct(){

	}
	public function set_template($temp){
		$this->name=$temp;
	}
	public function get_template(){
		return $this->name;
	}

}


?>