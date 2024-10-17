<?php 
namespace Insta\Subscription;
use Insta\Subscription\Subscription;
class Plan{
	private $id;
	private $description;
	private $name;
	private $features;
	private $price;
	private $billing_cycle;
	public function __construct(array $data=[]){
		$this->id=$data['id'] ?? null;
		$this->description=$data['description'] ?? '';
		$this->name=$data['name'] ?? '';
		$this->features=$data['features'] ?? [];
		$this->billing_cycle=$data['billing_cycle'] ?? '';
		$this->price=$data['price'] ?? '';
	}
	public function get_id(){
		return $this->id;
	}
	public function get_price(){
		return $this->price;
	}
	public function get_features(){
		return $this->features;
	}
	public function get_name(){
		return $this->name;
	}
	public function get_description(){
		return $this->description;
	}
	public function get_billing_cycle(){
		return $this->billing_cycle;
	}

	public function addFeature($feature){
		array_push($this->features, $feature);
	}
	public function removeFeature($feature){
		$len=count($this->features);
		for($i=0;$i<$len;$i++){
			if($this->features[$i]==$feature){
				array_splice($this->features, $feature);
				return;
			}
			
		}
		

	}

}

?>