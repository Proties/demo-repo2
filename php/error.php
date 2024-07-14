<?php declare(strict_types=1);
namespace Insta\Exception;
 /**
if there is an error object with the same object instaited do not create a new error
instead use the error class that has that object

there hass to be a list of all instiated error object for this to work
so declare and instiate ErrorObjectList class then store error object inside it
 * 
 */
use Exception;

Class ErrorHandler extends Exception{
	private $id;
	private $object;
	private array $errorMessages;


public function __construct(){
	$this->errorMessages=[];
}
public function get_object():object 
{
	return $this->$object;
}
public function set_error(array $arr){
	$this->errorMessages=$arr;
}
public function get_errors():array
{
	return $this->errorMessages;
}
public function add_error(array $err)
{
	$this->errorMessages[]=$err;
}
public function remove_error(array $err):bool
{
	for($i=0;$i<len;$i++){
		if($this->errorMessages[$i]['id']==$err['id']){
			unset($this->errorMessages[$i]);
			return true;
		}
	}
	return false;
	
}

}

?>