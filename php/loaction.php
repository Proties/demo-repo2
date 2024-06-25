<?php 
class Location{
	private $id;
	private $province;
	private $town;
	private $city;
	private $street;
	private $postalCode;
	private $longitude;
	private $latitude;
	private $altitude;
	private $country;

	public function __construct(){
		$this->id=null;
		$this->country='SouthAfrica';
		$this->province='';
		$this->town='';
		$this->city='';
		$this->postalCode='';
		$this->street='';
		$this->latitude='';
		$this->altitude='';
		$this->longitude='';
		
	}
}


?>