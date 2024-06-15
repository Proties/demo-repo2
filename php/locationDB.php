<?php 
class LocationDB extends Database{
	private $location;
	public function __construct(Location $location){
		Database::__construct();
		$this->location=$location;
	}
	public function get_location(){
		return $this->location;
	}

	public function write_location(){}
	public function read_location(){}
	public function update_location(){}
}



?>