<?php declare(strict_types=1);
namespace Insta\Location;
class Location{
	private int $id;
	private string $province;
	private string $town;
	private string $city;
	private string $street;
	private string $postalCode;
	private string $longitude;
	private string $latitude;
	private string $altitude;
	private string $country;
	private array $data;

	public function __construct(){
		$this->id=0;
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
	public function get_data(){
		$this->data;
	}
	public function add_location(){}
}


?>