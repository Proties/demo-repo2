<?php declare(strict_types=1);
namespace Insta\Location;
class Location{
	private int $id;
	private string $province;
	private string $town;
	private string $city;
	private string $street;
	private string $postalCode;
	private string $region;
	private string $zipCode;
	private string $country;
	private array $data;

	public function __construct(){
		$this->id=0;
		$this->country='SouthAfrica';
		$this->province='';
		$this->postalCode='';
		$this->street='';
		$this->zipCode='';
		$this->region='';
		$this->data=[];
		
	}
	public function get_data(){

		return $this->data;
	}

	public function set_id(int $i){
		$this->id=$i;
	}
	public function set_country($c){
		$this->country=$c;
	}
	public function set_zipCode($c){
		$this->zipCode=$c;
	}
	public function set_province($p){
		$this->province=$p;
	}
	public function set_region($c){
		$this->region=$c;
	}
	public function set_street($c){
		$this->street=$c;
	}

	public function get_id(){
		return $this->id;
	}
	public function get_country(){
		return $this->country;
	}
	public function get_zipCode(){
		return $this->zipCode;
	}
	public function get_province(){
		return $this->province;
	}
	public function get_region(){
		return $this->region;
	}
	public function get_street(){
		return $this->street;
	}
	
	public function set_local(string $str){
		$arr=explode(',',$str);
		$this->set_street($arr[0]);
		$this->set_region($arr[1]);
		$this->set_zipCode($arr[2]);
		$this->set_province($arr[3]);
		$this->set_country($arr[4]);

	}
}


?>