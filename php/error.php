<?php declare(strict_type=1);
use Exception;
 /**
if there is an error object with the same object instaited do not create a new error
instead use the error class that has that object

there hass to be a list of all instiated error object for this to work
so declare and instiate ErrorObjectList class then store error object inside it
 * 
 */
function erro_handler(){

}
class ErrorDB extends PDOException{
	private $id;
	private $object;
	private array $errorMessages;
public function __construct(string $str='',int $code,object ?$obj,Throwable ?$err){
	PDOException::__construct(string $str,int $code);
}
}
Class Error extends Exception{
	private $id;
	private $object;
	private array $errorMessages;


public function __construct(string ?$msg,int $code,object ?$obj,Throwable ?$err=null){
	Exception::__construct(string $msg,int $code);
	$this->object=$obj;
	$this->errorMessages=[];
}
public function get_object():object 
{
	return $this->$obj;
}
public function set_errorMessages(array $arr){
	$this->errorMessages=$arr;
}
public function get_errorMessages():array
{
	return $this->errorMessages;
}
public function add_errorMessages(string $err):bool
{

}
public function remove_errorMessages(string $err):bool
{

}

}
class ErrorObjectList{
	private array $errorObjects;
public function __construct(Throwable ?$err){
	$this->errorObjects=[];
}
public function get_errorObjects():array
{

}
public function add_errorObjects(Error $obj):bool 
{

}
public function remove_errorObjects(Error $obj):bool 
{

}

}
?>